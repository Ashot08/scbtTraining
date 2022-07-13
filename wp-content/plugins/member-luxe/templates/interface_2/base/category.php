<?php $category = new MBLCategory(get_term(get_queried_object()->term_id), true, true) ?>
<?php $showPage = is_user_logged_in() || wpm_get_option('main.opened'); ?>
<?php wpm_render_partial('head', 'base', compact('post')) ?>
<?php wpm_render_partial('navbar') ?>
<div class="site-content">
    <?php if (post_password_required()) : ?>
        <?php wpm_render_partial('header-cover'); ?>
        <div class="wpm-protected">
            <?php echo get_the_password_form(); ?>
        </div>
    <?php elseif ($showPage) : ?>
        <?php wpm_render_partial('header-cover'); ?>
        <?php wpm_render_partial('breadcrumbs', 'base', compact('category')); ?>
        <?php wpm_render_partial('category-description', 'base', compact('category')); ?>

        <div class="col-xs-12">
            <div class="scbt__course_structure_button scbt__course_structure_toggle">
                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12 16C13.1 16 14 16.9 14 18S13.1 20 12 20 10 19.1 10 18 10.9 16 12 16M12 10C13.1 10 14 10.9 14 12S13.1 14 12 14 10 13.1 10 12 10.9 10 12 10M12 4C13.1 4 14 4.9 14 6S13.1 8 12 8 10 7.1 10 6 10.9 4 12 4M6 16C7.1 16 8 16.9 8 18S7.1 20 6 20 4 19.1 4 18 4.9 16 6 16M6 10C7.1 10 8 10.9 8 12S7.1 14 6 14 4 13.1 4 12 4.9 10 6 10M6 4C7.1 4 8 4.9 8 6S7.1 8 6 8 4 7.1 4 6 4.9 4 6 4M18 16C19.1 16 20 16.9 20 18S19.1 20 18 20 16 19.1 16 18 16.9 16 18 16M18 10C19.1 10 20 10.9 20 12S19.1 14 18 14 16 13.1 16 12 16.9 10 18 10M18 4C19.1 4 20 4.9 20 6S19.1 8 18 8 16 7.1 16 6 16.9 4 18 4Z" />
                </svg>
                <span>Структура курса</span>
            </div>
        </div>

        <?php if ($category->hasChildren()) : ?>
            <?php wpm_render_partial('categories', 'base', array('categoryCollection' => $category->getChildrenCollection(), 'category' => $category)) ?>
        <?php else : ?>
            <?php wpm_render_partial('materials', 'base', compact('category')) ?>
        <?php endif; ?>
    <?php else : ?>
        <?php wpm_render_partial('header-cover', 'base', array('alias' => 'login')); ?>
        <?php wpm_render_partial('restricted') ?>
    <?php endif; ?>
</div>
<?php wpm_render_partial('footer') ?>
<?php wpm_render_partial('footer-scripts') ?>