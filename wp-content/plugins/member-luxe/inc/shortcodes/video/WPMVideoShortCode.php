<?php

class WPMVideoShortCode
{
    private static $videoLink;
    private static $autoPlay;
    private static $width;
    private static $height;
    private static $ratio;
    private static $aspectRatio;
    private static $ratioStyle;
    private static $style;
    private static $videoUrl;
    private static $wrapperClass;
    private static $options;
    private static $isLocal;
    private static $camera_protection;
    private static $sources;
    private static $formats;

    public static function parse($options)
    {
        self::_init();
        self::$options = $options;

        self::_replaceOptions();
        self::_parseOptions();

        if (self::_isVimeo()) {
            $html = self::_parseVimeo();
        } elseif (self::_isYoutube()) {
            $html = self::_parseYoutube();
        } else {
            self::$isLocal = true;
            $html = self::_parseLocal();
        }
        
        if( self::$camera_protection == 'on' ){
        	$html =  '<div data-protect="on">' . $html . '</div>';
        }

        return apply_filters('video_html', $html);
    }

    private static function _init()
    {
        self::$isLocal = false;
    }

    private static function _replaceOptions()
    {
        self::$options['video'] = wpm_remove_protocol(str_replace(array('www.dropbox.com', 'dropbox.com'), 'dl.dropboxusercontent.com', self::$options['video']));
    }

    private static function _parseOptions()
    {
        self::$videoLink = wpm_array_get(self::$options, 'video');
        self::$autoPlay = wpm_array_get(self::$options, 'autoplay');
        self::$width = wpm_array_get(self::$options, 'width');
        self::$height = wpm_array_get(self::$options, 'height');
        self::$ratio = wpm_array_get(self::$options, 'ratio', '16by9');
        self::$style = wpm_array_get(self::$options, 'style', 'normal');
        self::$camera_protection = self::$options['protection']? 'on' : 'off';
        self::$sources = explode(',', self::$options['sources']);
        self::$formats = explode(',', self::$options['formats']);
        self::$ratioStyle = '';

        if (!empty(self::$width) && !empty(self::$height)) {
            self::$ratioStyle = '';
            self::$aspectRatio = round(self::$width / self::$height, 2);
        } elseif (self::$ratio == '4by3') {
            self::$aspectRatio = 1.33;
        } else {
            self::$aspectRatio = 1.77;
        }

        if (!empty(self::$width)) {
            self::$width = 'max-width: ' . self::$width . 'px';
        } else {
            self::$width = '';
        }

        self::$videoUrl = parse_url(self::$videoLink);
        self::$wrapperClass = 'embed-responsive';

        if (self::$ratioStyle === '') {
            self::$wrapperClass .= ' embed-responsive-' . self::$ratio;
        }
    }

    private static function _isVimeo()
    {
        return in_array(self::$videoUrl['host'], array('www.vimeo.com', 'vimeo.com'))
            || preg_match('/vimeo\.com/', self::$videoLink);
    }

	private static function _parseVimeo()
	{
		if (wpm_option_is('protection.vimeo_standard_player', '1') || is_admin()) {
			$html = self::_parseVimeoPlain();
		} else {
			$videoId = 'vid_id_' . substr(md5(rand(0, 1000)), 0, 20);

			if (self::$style != 'normal') {
				$html = '<div class="wpm-video-size-wrap video-comment" aria-hidden="true" style="' . self::$width . '"><div class="style-video wpm-video-direct wpm-video-vimeo wpjw style-' . self::$style . '" style="' . self::$width . '"><div class="">';
				$html .= '<video id="' . $videoId . '" class="embed-responsive-item" width="' . self::$width . '" height="' . self::$height . '" controls ></video>';
				$html .= '</div></div></div>';
			} else {
				$html = '<div class="wpm-video-size-wrap video-comment" aria-hidden="true" style="' . self::$width . '"><div class="wpm-video-direct wpm-video-vimeo no-style video_wrap video_margin_center" style="' . self::$width . '"><div class="" style="' . self::$ratioStyle . '">';
				$html .= '<video id="' . $videoId . '" class="embed-responsive-item" width="' . self::$width . '" height="' . self::$height . '" autobuffer controls></video>';
				$html .= '</div></div></div>';
			}

			$html .= sprintf('<script>wpmVideo.initDirect("%s", "%s", %s, %d, false, "%s")</script>', $videoId, 'vimeo', self::_getCryptedLink(), self::$autoPlay == 'on', wpm_plyr_version());
		}

		return $html;
	}

    private static function _isYoutube()
    {
        return strpos(self::$videoUrl['host'], 'youtu') !== false
            || preg_match('/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i', self::$videoLink);
    }

    private static function _parseYoutube()
    {
        $pattern = '#(?<=(?:v|i)=)[a-zA-Z0-9-]+(?=&)|(?<=(?:v|i)\/)[^&\n]+|(?<=embed\/)[^"&\n]+|(?<=‌​(?:v|i)=)[^&\n]+|(?<=youtu.be\/)[^&\n]+#';
        preg_match($pattern, self::$videoLink, $matches);
        if (isset($matches[0])) {
            $youtubeId = $matches[0];
        } else {
            parse_str(parse_url(self::$videoLink, PHP_URL_QUERY), $params);
            $youtubeId = isset($params['v']) ? $params['v'] : (isset($params['amp;v']) ? $params['amp;v'] : '0');
        }

        $youtubeId = preg_replace('/\?.*$/', '', $youtubeId);

        if(wpm_option_is('protection.youtube_standard_player', '1') || is_admin()) {
            $html = self::_parseYTPlain($youtubeId);
        } elseif (self::_protectionIsEnabled()) {
            $html = self::_parseYoutubeProtected($youtubeId);
        } else {
            $html = self::_parseYoutubeIframe($youtubeId);
        }

        return $html;
    }

    private static function _parseYTPlain($youtubeId)
    {
        $videoId = 'vid_id_' . substr(md5($youtubeId . rand(0, 1000)), 0, 20);
        $autoplay = (self::$autoPlay == 'on') ? '&autoplay=1' : '';
        $width = self::$width;
        $height = self::$height;

        if(is_admin()) {
            return '<div class="wpm-video-size-wrap video-comment" aria-hidden="true" style="width: 100%; max-width: 100%"><div class="wpm-video-direct no-style video_wrap video_margin_center"><div class="" style="' . self::$ratioStyle . '">'
                    .'<iframe id="' . $videoId . '" width="728px" style="width: 100%; max-width: 100%" height="410px" src="https://www.youtube.com/embed/' . $youtubeId . $autoplay . '" frameborder="0" allowfullscreen></iframe>'
                    .'</div></div></div>';
        }

        $iframe = '<iframe id="' . $videoId . '" width="' . $width . '" height="' . $height . '" src="https://www.youtube.com/embed/' . $youtubeId . $autoplay . '" frameborder="0" allowfullscreen></iframe>';

        if (self::$style != 'normal') {
            $html = '<div class="wpm-video-size-wrap video-comment" aria-hidden="true" style="' . $width . '"><div class="style-video wpm-video-youtube style-' . self::$style . '"  style="' . $width . '"><div class="embed-responsive embed-responsive-16by9">';
            $html .= $iframe;
            $html .= '</div></div></div>';

            return $html;
        } else {
            $html = '<div class="wpm-video-size-wrap video-comment" aria-hidden="true" style="' . $width . '"><div class="wpm-video-youtube no-style video_wrap video_margin_center" style="' . $width . '"><div class="' . self::$wrapperClass . '" style="' . self::$ratioStyle . '">';
            $html .= $iframe;
            $html .= '</div></div></div>';

            return $html;
        }

    }

	private static function _parseVimeoPlain()
	{
		$videoLink = self::$videoLink;
		$width = self::$width;
        $height = self::$height;
        $style = self::$style;

		sscanf(parse_url($videoLink, PHP_URL_PATH), '/%d', $vimeoVideoId);

		preg_match('#http://(?:player\.)?vimeo\.com(?:/video)?.*/(\d+)#', $videoLink, $matches);

		if (isset($matches[1])) {
			$vimeoVideoId = $matches[1];
		}
		$videoId = 'vid_id_' . substr(md5($vimeoVideoId . rand(0, 1000)), 0, 20);
		$autoplay = (self::$autoPlay == 'on') ? '?autoplay=true' : '';

		$link = 'https://player.vimeo.com/video/' . $vimeoVideoId . $autoplay;

		if(is_admin()) {
            return '<div class="wpm-video-size-wrap video-comment" aria-hidden="true" style="width: 100%; max-width: 100%"><div class="wpm-video-direct no-style video_wrap video_margin_center"><div class="" style="' . self::$ratioStyle . '">'
                    .'<iframe class="no_border" style="margin:0 auto; padding:0; width: 100%; max-width: 100%" src="' . $link . '" width="728px" height="410px" frameborder="0" allowFullScreen></iframe>'
                    .'</div></div></div>';
        }

		$iframe = '<iframe class="no_border" style="margin:0 auto; padding:0;" src="' . $link . '" width="' . $width . '" height="' . $height . '" frameborder="0" allowFullScreen></iframe>';

		if (self::$style != 'normal') {
            $html = '<div class="wpm-video-size-wrap video-comment" aria-hidden="true" style="' . $width . '"><div class="style-video wpm-video-youtube style-' . self::$style . '"  style="' . $width . '"><div class="embed-responsive embed-responsive-16by9">';
            $html .= $iframe;
            $html .= '</div></div></div>';

            return $html;
        } else {
            $html = '<div class="wpm-video-size-wrap video-comment" aria-hidden="true" style="' . $width . '"><div class="wpm-video-youtube no-style video_wrap video_margin_center" style="' . $width . '"><div class="' . self::$wrapperClass . '" style="' . self::$ratioStyle . '">';
            $html .= $iframe;
            $html .= '</div></div></div>';

            return $html;
        }
	}

    private static function _parseLocal()
    {
        if (self::_protectionIsEnabled()) {
            $html = self::_parseLocalProtected();
        } else {
            $html = self::_parseLocalFile();
        }

        return $html;
    }

    private static function _parseLocalFile()
    {
        $videoId = 'vid_id_' . substr(md5(rand(0, 1000)), 0, 20);

        if(is_admin()) {
            $html = '<div class="wpm-video-size-wrap video-comment" aria-hidden="true" style="width: 100%; max-width: 100%"><div class="wpm-video-direct no-style video_wrap video_margin_center"><div class="" style="' . self::$ratioStyle . '">';
            $html .= '<video id="' . $videoId . '" class="embed-responsive-item" width="100%" height="' . self::$height . '" autobuffer controls><source src="' . self::_getCryptedLink() . '" type="video/mp4"></video>';
            $html .= '</div></div></div>';

            return $html;
        } elseif (self::$style != 'normal') {
            $html = '<div class="wpm-video-size-wrap video-comment" aria-hidden="true" style="' . self::$width . '"><div class="style-video wpm-video-direct wpjw style-' . self::$style . '" style="' . self::$width . '"><div class="">';
            $html .= '<video id="' . $videoId . '" class="embed-responsive-item" width="' . self::$width . '" height="' . self::$height . '" controls></video>';
            $html .= '</div></div></div>';
        } else {
            $html = '<div class="wpm-video-size-wrap video-comment" aria-hidden="true" style="' . self::$width . '"><div class="wpm-video-direct no-style video_wrap video_margin_center" style="' . self::$width . '"><div class="" style="' . self::$ratioStyle . '">';
            $html .= '<video id="' . $videoId . '" class="embed-responsive-item" width="' . self::$width . '" height="' . self::$height . '" autobuffer controls></video>';
            $html .= '</div></div></div>';
        }

        $html .= sprintf('<script>wpmVideo.initDirect("%s", "%s", %s, %d, %s, "%s")</script>', $videoId, 'video', self::_getCryptedLink(), self::$autoPlay=='on', self::_parceSources(), wpm_plyr_version());

        return $html;
    }

    private static function _parseLocalProtected()
    {
        $linkCrypted = self::_getCryptedLink();
        $videoId = 'vid_id_' . substr(md5(rand(0, 1000)), 0, 20);
        $script = '<script>wpmVideo.initYT("%s",%s,"%s",%d, true)</script>';

        if (self::$style != 'normal') {
            $html = '<div class="wpm-video-size-wrap video-comment" aria-hidden="true" style="' . self::$width . '">';
            $html .= '<div class="style-video wpjw wpmjw inactive style-' . self::$style . '" style="' . self::$width . '">';
            $html .= '<div class="embed-responsive embed-responsive-16by9">';
            $html .= '<div id="' . $videoId . '"></div>';
            $html .= '</div></div></div>';
            $html .= sprintf($script, $videoId, $linkCrypted, "16:9", intval(self::$autoPlay == 'on'));
        } else {
            $html = '<div class="wpm-video-size-wrap video-comment" aria-hidden="true" style="' . self::$width . '">';
            $html .= '<div class="video_wrap video_margin_center wpmjw inactive" style="' . self::$width . '">';
            $html .= '<div class="' . self::$wrapperClass . '" style="' . self::$ratioStyle . '">';
            $html .= '<div id="' . $videoId . '"></div>';
            $html .= '</div></div></div>';
            $html .= sprintf($script, $videoId, $linkCrypted, self::$aspectRatio . ':1', intval(self::$autoPlay == 'on'));
        }

        return $html;
    }

    private static function _protectionIsEnabled()
    {
        return wpm_yt_protection_is_enabled();
    }

    private static function _parseYoutubeProtected($youtubeId)
    {
        $link = '//www.youtube.com/watch?v=' . $youtubeId;
        $linkCrypted = 'window[([][(![]+[])[+[]]+(![]+[]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]]+[])[!+[]+!+[]+!+[]]+([][(![]+[])[+[]]+(![]+[]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]]+[])[!+[]+!+[]+!+[]]]("' . utf8_uri_encode(base64_encode($link)) . '")';
        $videoId = 'vid_id_' . substr(md5($youtubeId . rand(0, 1000)), 0, 20);
        $script = '<script>wpmVideo.initYT("%s",%s,"%s",%d)</script>';
        if (self::$style != 'normal') {
            $html = '<div class="wpm-video-size-wrap video-comment" aria-hidden="true" style="' . self::$width . '">';
            $html .= '<div class="style-video wpm-video-youtube wpjw wpmjw inactive style-' . self::$style . '" style="' . self::$width . '">';
            $html .= '<div class="embed-responsive embed-responsive-16by9">';
            $html .= '<div id="' . $videoId . '"></div>';
            $html .= '</div></div></div>';
            $html .= sprintf($script, $videoId, $linkCrypted, "16:9", intval(self::$autoPlay == 'on'));
        } else {
            $html = '<div class="wpm-video-size-wrap video-comment" aria-hidden="true" style="' . self::$width . '">';
            $html .= '<div class="wpm-video-youtube video_wrap video_margin_center wpmjw inactive" style="' . self::$width . '">';
            $html .= '<div class="' . self::$wrapperClass . '" style="' . self::$ratioStyle . '">';
            $html .= '<div id="' . $videoId . '"></div>';
            $html .= '</div></div></div>';
            $html .= sprintf($script, $videoId, $linkCrypted, self::$aspectRatio . ':1', intval(self::$autoPlay == 'on'));
        }

        return $html;
    }

    private static function _parseYoutubeIframe($youtubeId)
    {
        $videoId = 'vid_id_' . substr(md5(rand(0, 1000)), 0, 20);
        $protectionClass = wpm_option_is('protection.youtube_hide_controls', '1') ? 'protected' : '';

        if (self::$style != 'normal') {
            $html = '<div class="wpm-video-size-wrap video-comment" aria-hidden="true" style="' . self::$width . '"><div class="style-video wpm-video-direct wpjw style-' . self::$style . ' ' . $protectionClass . '" style="' . self::$width . '"><div class="">';
            $html .= '<video id="' . $videoId . '" class="embed-responsive-item" width="' . self::$width . '" height="' . self::$height . '" controls ></video>';
            $html .= '</div></div></div>';
        } else {
            $html = '<div class="wpm-video-size-wrap video-comment" aria-hidden="true" style="' . self::$width . '"><div class="wpm-video-direct no-style video_wrap video_margin_center ' . $protectionClass . '" style="' . self::$width . '"><div class="" style="' . self::$ratioStyle . '">';
            $html .= '<video id="' . $videoId . '" class="embed-responsive-item" width="' . self::$width . '" height="' . self::$height . '" autobuffer controls></video>';
            $html .= '</div></div></div>';
        }

        $html .= sprintf('<script>wpmVideo.initDirect("%s", "%s", %s, %d, false, "%s")</script>', $videoId, 'youtube', self::_getCryptedLink($youtubeId), self::$autoPlay=='on', wpm_plyr_version());

        return $html;
    }

    private static function _getCryptedLink($link = null)
    {
        wpm_init_session();
        
        $_SESSION["flash"] = $_SERVER["HTTP_HOST"];

        if($link === null) {
            $link = self::$videoLink;
        }
        if(is_admin()) {
            return $link;
        } elseif (self::$isLocal && wpm_option_is('protection.video_url_encoded', 'on') && !self::_protectionIsEnabled()) {
            $link = wpm_array_get(wpm_protected_video_link($link), 'url', $link);
        }

        $encoded = base64_encode(utf8_uri_encode($link));

        $linkCrypted = 'window[([][(![]+[])[+[]]+(![]+[]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]]+[])[!+[]+!+[]+!+[]]+([][(![]+[])[+[]]+(![]+[]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]]+[])[!+[]+!+[]+!+[]]]("' . $encoded . '")';

        return $linkCrypted;
    }
	
	private static function _parceSources()
	{
		$sourset = '[';
		if (self::$formats[0] != '' && self::$sources[0] != '') {
			foreach ( self::$formats as $key=>$format ) {
				if(!self::_protectionIsEnabled()){
					$sourset .= '{'.
						'src:'. self::_getCryptedLink(self::$sources[$key]).
						', format: "' . $format .
					'"},';
				} else {
					$sourset .= '{'.
						'src: "'. self::$sources[$key].
						'", format: "' . $format .
						'"},';
				}
			}
		}
		
		$sourset .= ']';
		
		return $sourset;
	}
}