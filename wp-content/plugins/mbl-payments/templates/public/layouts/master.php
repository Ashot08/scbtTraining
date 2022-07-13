<?php wpm_render_partial('head', 'base', array('post' => null)) ?>
<?php wp_enqueue_scripts();?>
<?php WC_Frontend_Scripts::localize_printed_scripts(); ?>
<?php mblp_render_partial('partials/js'); ?>
<?php wpm_render_partial('navbar') ?>
<div class="site-content mblp-site-content">
    <?php wpm_render_partial('header-cover'); ?>
    <?php mblp_render_partial('partials/breadcrumbs'); ?>
    <?php while (have_posts()): the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; ?>
</div>
<?php wpm_render_partial('footer') ?>
<?php wpm_render_partial('footer-scripts') ?>