<?php if ( $enableTelegramNews ) { ?>
	<div class="mbli3-left-menu" id="mbli3-telegram-news">
		<div class="mbli3-left-menu-holder">
			<div class="container">
				<a href="#" data-mbli3-telegram-news-toggle class="mbli3-menu-close"><span class="icon-close"></span></a>
				<h3 class="text-center mbli3-page-title"><?php echo wpm_get_option('mbli3_telegram.telegram_news_name'); ?></h3>
			</div>
			<section class="materials-row one-in-line clearfix">
				<div class="container">
					<div class="row">
						<?php echo do_shortcode(stripslashes(wpm_get_option('mbli3_telegram.telegram_news_code'))); ?>
					</div>
				</div>
			</section>
		</div>
	</div>
<?php } ?>

<?php if ( $enableTelegramChat ) { ?>
	<div class="mbli3-left-menu transfer-to-right" id="mbli3-telegram-chat">
		<div class="mbli3-left-menu-holder">
			<div class="container">
				<a href="#" data-mbli3-telegram-chat-toggle class="mbli3-menu-close"><span class="icon-close"></span></a>
				<h3 class="text-center mbli3-page-title"><?php echo wpm_get_option('mbli3_telegram.telegram_chat_name'); ?></h3>
			</div>
			<section class="materials-row one-in-line clearfix">
				<div class="container">
					<div class="row">
						<?php echo do_shortcode(stripslashes(wpm_get_option('mbli3_telegram.telegram_chat_code'))); ?>
					</div>
				</div>
			</section>
		</div>
	</div>
<?php } ?>

<script type="text/javascript">
	$ = jQuery;
	var iframe = $('.wptelegram-widget-message iframe');

	iframe.on('resize_iframe', function () {
		var $this = $(this);
		var height = $this.contents().find('body').height();

		$this.height(height);
	});

	iframe.on('load', function () {
		var $this = $(this);
		if ($this.contents().find('body').is(':empty')) {
			$this.parent().remove();
		} else {
			$this.trigger('resize_iframe');
		}
	});

	$(window).on('resize', () => {
		iframe.trigger('resize_iframe');
	});
</script>