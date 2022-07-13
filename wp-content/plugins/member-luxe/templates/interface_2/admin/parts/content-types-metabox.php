<?php /** @var MBLPage $mblPage */ ?>
<div class="">
    <ul class="categorychecklist form-no-clear">

        <li class="popular-category">
            <label class="selectit">
                <input type="hidden" name="page_meta[content_types][text]" value="0">
                <input value="1"
                       type="checkbox"
                       name="page_meta[content_types][text]"
                       <?php if ($mblPage->hasTextContent()) : ?>
                           checked="checked"
                       <?php endif; ?>
                >
                <?php _e('Текст', 'mbl_admin') ?></label>
        </li>
        <li class="popular-category">
            <label class="selectit">
                <input type="hidden" name="page_meta[content_types][video]" value="0">
                <input value="1"
                       type="checkbox"
                       name="page_meta[content_types][video]"
                       <?php if ($mblPage->hasVideoContent()) : ?>
                           checked="checked"
                       <?php endif; ?>
                >
                <?php _e('Видео', 'mbl_admin') ?></label>
        </li>
        <li class="popular-category">
            <label class="selectit">
                <input type="hidden" name="page_meta[content_types][audio]" value="0">
                <input value="1"
                       type="checkbox"
                       name="page_meta[content_types][audio]"
                       <?php if ($mblPage->hasAudioContent()) : ?>
                           checked="checked"
                       <?php endif; ?>
                >
                <?php _e('Аудио', 'mbl_admin') ?></label>
        </li>
    </ul>
</div>
