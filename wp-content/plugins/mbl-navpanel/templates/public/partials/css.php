<style type="text/css" id="mbli3-left-menu-style">
    body .mbli3-left-menu .mbli3-left-menu-holder {
        border-right: 1px solid #<?php echo wpm_get_design_option('breadcrumbs.border_color', 'ECEEEF'); ?>;

        background-color: #<?php echo wpm_get_option('mbli3_design.background_color', 'fff'); ?>;
        background-repeat: <?php echo wpm_get_option('mbli3_design.background_image.repeat', 'repeat'); ?>;
        background-position: <?php echo wpm_get_option('mbli3_design.background_image.position', 'center top'); ?>;
        background-size: <?php echo wpm_get_option('mbli3_design.background_image.repeat', 'repeat') == 'no-repeat' ? 'cover' : 'auto'; ?>;
        min-height: 100%;
        <?php if (wpm_get_option('mbli3_design.background_image.url')) : ?>
            background-image: url('<?php echo wpm_remove_protocol(wpm_get_option('mbli3_design.background_image.url', '')); ?>');

            <?php if (wpm_get_option('mbli3_design.background-attachment-fixed')=='on') : ?>
                position: fixed;
                height: 100%;
                overflow-y: scroll;
            <?php endif; ?>
        <?php endif; ?>
    }
    <?php if (wpm_get_option('mbli3_design.background_image.url') && wpm_get_option('mbli3_design.background-attachment-fixed')=='on') : ?>
        body > .mbli3-left-menu.mbli3-left-menu {
            overflow-y: auto !important;
        }
    <?php endif; ?>

    .mbli3-menu-close {
        color: #<?php echo wpm_get_option('mbli3_design.close_link.color', '868686'); ?>;
    }
    .mbli3-menu-close:hover {
        color: #<?php echo wpm_get_option('mbli3_design.close_link.color_hover', '2e2e2e'); ?>;
    }
    .mbli3-menu-close:active {
        color: #<?php echo wpm_get_option('mbli3_design.close_link.color_active', '2e2e2e'); ?>;
    }

    .top-nav-row a.nav-item[data-mbli3-menu-toggle] {
        color: #<?php echo wpm_get_option('mbli3_design.menu_text.color', '868686'); ?>;
    }
    .top-nav-row .nav-item[data-mbli3-menu-toggle]:hover {
        color: #<?php echo wpm_get_option('mbli3_design.menu_text.color_hover', '2e2e2e'); ?>;
    }
    .top-nav-row .nav-item[data-mbli3-menu-toggle]:active {
        color: #<?php echo wpm_get_option('mbli3_design.menu_text.color_active', '2e2e2e'); ?>;
    }

    .top-nav-row .nav-item[data-mbli3-menu-toggle] .iconmoon {
        color: #<?php echo wpm_get_option('mbli3_design.menu.color', '868686'); ?>;
    }
    .top-nav-row .nav-item[data-mbli3-menu-toggle]:hover > .iconmoon {
        color: #<?php echo wpm_get_option('mbli3_design.menu.color_hover', '2e2e2e'); ?>;
    }
    .top-nav-row .nav-item[data-mbli3-menu-toggle]:active > .iconmoon {
        color: #<?php echo wpm_get_option('mbli3_design.menu.color_active', '2e2e2e'); ?>;
    }

    body .mbli3-left-menu-holder .current-post .material-item.material-opened .col-content {
        background: #<?php echo wpm_get_design_option('materials.open_hover_desc_bg_color', 'dfece0'); ?>;
        border-color: #<?php echo wpm_get_design_option('materials.open_hover_desc_border_color', 'cedccf'); ?>;
    }

    body .mbli3-left-menu-holder .mbli3-page-title {
        color: #<?php echo wpm_get_option('mbli3_design.term_header_color', '000000'); ?>;
        font-size: <?php echo wpm_get_option('mbli3_design.term_header_size', '20'); ?>px;
    }
</style>