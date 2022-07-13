<?php /** @var MBLPage $mblPage */ ?>
<?php wpm_render_partial('text-protection', 'base', compact('mblPage')) ?>
<?php if ($mblPage->hasMaterialAccess()) : ?>
    <div role="tabpanel" class="tab-pane active lesson-content" id="lesson-content">
        <div class="content-wrap">
            <?php $mblPage->open(); ?>
            <?php add_filter('the_content', 'wpautop'); ?>
            <?php the_content(); ?>
            <?php remove_filter('the_content', 'wpautop'); ?>
            <?php echo get_interkassa_form($mblPage->getPostMeta()); ?>
        </div>
    </div>
<?php else : ?>
    <?php wpm_render_partial('material-no-access', 'base', compact('mblPage')) ?>
<?php endif; ?>
