<?php /** @var MBLCategory $category */ ?>
<?php /** @var MBLPage $mblPage */ ?>

<?php

$term = get_term($category->getTermId());

?>


<section class="lesson-row clearfix scbt__single_lesson">
    <div class="col-xs-12">
        <div class="scbt__course_structure_toggle scbt__course_structure_button">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M12 16C13.1 16 14 16.9 14 18S13.1 20 12 20 10 19.1 10 18 10.9 16 12 16M12 10C13.1 10 14 10.9 14 12S13.1 14 12 14 10 13.1 10 12 10.9 10 12 10M12 4C13.1 4 14 4.9 14 6S13.1 8 12 8 10 7.1 10 6 10.9 4 12 4M6 16C7.1 16 8 16.9 8 18S7.1 20 6 20 4 19.1 4 18 4.9 16 6 16M6 10C7.1 10 8 10.9 8 12S7.1 14 6 14 4 13.1 4 12 4.9 10 6 10M6 4C7.1 4 8 4.9 8 6S7.1 8 6 8 4 7.1 4 6 4.9 4 6 4M18 16C19.1 16 20 16.9 20 18S19.1 20 18 20 16 19.1 16 18 16.9 16 18 16M18 10C19.1 10 20 10.9 20 12S19.1 14 18 14 16 13.1 16 12 16.9 10 18 10M18 4C19.1 4 20 4.9 20 6S19.1 8 18 8 16 7.1 16 6 16.9 4 18 4Z" />
            </svg>
            <span>Структура курса</span>

        </div>
    </div>

    <div class="container">
        <div class="col-xs-12">
            <div class="scbt__lesson_header_posts_list">
                <?php
                $my_posts = get_posts( array(
                    'numberposts' => 30,
                    'category'    => 0,
                    'tax_query'=> array(
                        array(
                            'taxonomy'=> 'wpm-category',
                            //'field'=> 'id',
                            'terms'=>$category->getTermId()
                        )
                    ),
                    'orderby'     => 'menu_order',
                    'order'       => 'ASC',
                    'include'     => array(),
                    'exclude'     => array(),
                    'meta_key'    => '',
                    'meta_value'  =>'',
                    'post_type'   => 'wpm-page',
                    'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                ) );
                $counter = 1;
                $current_id = get_queried_object()->ID;

                foreach( $my_posts as $post ){
                    setup_postdata( $post );
                    ?>
                    <?php
                    $post_id = $post->ID;
                    $post_title = $post->post_title;
                    $active_post = false;
                    if($post_id === $current_id){
                        $active_post = true;
                    }

                    ?>
                    <?php if($active_post): ?>
                        <div class="scbt__lesson_header_posts_list_item scbt__lesson_header_posts_list_item--active">
                            Урок <?= $counter ?><span class="scbt__lesson_header_posts_list_tooltip"><?= $post_title ?></span>
                        </div>
                    <?php else: ?>
                        <div class="scbt__lesson_header_posts_list_item">


                            <a href="<?php echo '/wpm/' . $term->slug . '/' . $post->post_name; ?>    <?php //echo get_permalink($post_id); ?>">

                                Урок <?= $counter ?><span class="scbt__lesson_header_posts_list_tooltip"><?= $post_title ?></span>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php
                    $counter++;
                    ?>
                    <?php
                }

                wp_reset_postdata();

                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="lesson-tabs bordered-tabs white-tabs tabs-count-<?php echo $mblPage->getTabsCount(); ?>">
                    <?php if ($mblPage->getTabsCount() > 1) : ?>
                        <ul class="nav nav-tabs text-center" role="tablist">
                            <li role="presentation" class="lesson-content-nav tab-1">
                                <a href="#lesson-content"
                                   aria-controls="lesson-content"
                                   role="tab"
                                >
                                    <span class="icon-graduation-cap"></span>
                                    <span class="tab-label"><?php _e('Контент', 'mbl'); ?></span>
                                </a>
                            </li>
                            <?php if ($mblPage->hasHomework() && is_user_logged_in()) : ?>
                                <li role="presentation" class="lesson-tasks-nav tab-2">
                                    <a href="#lesson-tasks"
                                       aria-controls="lesson-tasks"
                                       data-mbl-lesson-tasks
                                       role="tab"
                                    >
                                        <span id="response-status-tab-icon" class="icon-file-text-o <?php echo $mblPage->getHomeworkStatusClass(); ?>"></span>
                                        <span class="tab-label"><?php _e('Задание', 'mbl'); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if ($mblPage->hasAttachments()) : ?>
                                <li role="presentation" class="lesson-files-nav tab-<?php echo $mblPage->hasHomework() && is_user_logged_in() ? '3' : '2'; ?>">
                                    <a href="#lesson-files"
                                       aria-controls="lesson-files"
                                       role="tab"
                                    >
                                        <span class="icon-paperclip"></span>
                                        <span class="tab-label"><?php _e('Вложения', 'mbl'); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <?php wpm_render_partial('material-content', 'base', compact('mblPage')) ?>
                        <?php if ($mblPage->hasAccess()) : ?>
                            <?php if ($mblPage->hasHomework() && is_user_logged_in()) : ?>
                                <div role="tabpanel" class="tab-pane lesson-tasks" id="lesson-tasks">
                                    <?php wpm_render_partial('material-homework', 'base', compact('category', 'mblPage')) ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($mblPage->hasAttachments()) : ?>
                                <div role="tabpanel" class="tab-pane lesson-files" id="lesson-files">
                                    <h3>Вложения</h3>
                                    <?php wpm_render_partial('material-attachments', 'base', compact('mblPage')) ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div>
                <?php if ($mblPage->getId() != wpm_get_option('schedule_id') && $mblPage->hasAccess()) : ?>
                    <?php wpm_render_partial('material-status-row', 'base', compact('category', 'mblPage')) ?>
                <?php endif; ?>
            </div>

        </div>
        <?php if (comments_open() && (is_user_logged_in() || wpm_comments_is_visible()) && wpm_check_access() && $mblPage->getId() != wpm_get_option('schedule_id')) : ?>
            <div class="row">
                <div class="col-xs-12 wpm-comments-wrap">
                    <?php wpm_comments_wordpress(get_the_ID()) ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php
    $video_1 = get_field('scbt_video_url_1', get_the_ID());
    $video_2 = get_field('scbt_video_url_2', get_the_ID());
    $video_3 = get_field('scbt_video_url_3', get_the_ID());
    $video_4 = get_field('scbt_video_url_4', get_the_ID());
    $video_5 = get_field('scbt_video_url_5', get_the_ID());
    $video_6 = get_field('scbt_video_url_6', get_the_ID());
?>

<?php if($video_1 || $video_2 || $video_3 || $video_4 || $video_5 || $video_6): ?>
    <h2>Дополнительные материалы:</h2>
    <section class="scbt__lesson_additional_videos">
        <?php if($video_1): ?>
            <div class="scbt__lesson_additional_video">
                <iframe width="480" height="270" src="<?= $video_1 ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        <?php endif; ?>

        <?php if($video_2): ?>
            <div class="scbt__lesson_additional_video">
                <iframe width="480" height="270" src="<?= $video_2 ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        <?php endif; ?>

        <?php if($video_3): ?>
            <div class="scbt__lesson_additional_video">
                <iframe width="480" height="270" src="<?= $video_3 ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        <?php endif; ?>

        <?php if($video_4): ?>
            <div class="scbt__lesson_additional_video">
                <iframe width="480" height="270" src="<?= $video_4 ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        <?php endif; ?>

        <?php if($video_5): ?>
            <div class="scbt__lesson_additional_video">
                <iframe width="480" height="270" src="<?= $video_5 ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        <?php endif; ?>

        <?php if($video_6): ?>
            <div class="scbt__lesson_additional_video">
                <iframe width="480" height="270" src="<?= $video_6 ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        <?php endif; ?>
    </section>
<?php endif; ?>
<script>

    /* Отметить курс пройденным или нет
     ***************************************************************************
     */
    jQuery( document ).ready(function() {
        jQuery(document).on('click', '.reading-status-row .next', function(e){
            let icon = jQuery('.reading-status-row .iconmoon');
            var passed = icon.hasClass('icon-toggle-on');
            if(!passed){
                e.preventDefault();
                const href = jQuery(this).attr('href');
                let modalHTML = `
                    <div class="scbt__pass_lesson_modal">
                        <div class="scbt__pass_lesson_modal_close">
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M13.46,12L19,17.54V19H17.54L12,13.46L6.46,19H5V17.54L10.54,12L5,6.46V5H6.46L12,10.54L17.54,5H19V6.46L13.46,12Z" />
                            </svg>
                        </div>
                        <div class="scbt__pass_lesson_modal_title">Урок не пройден!</div>
                        <div class="scbt__pass_lesson_modal_text">Отметить урок пройденным или просто перейти к следующему уроку?</div>
                        <div>
                            <button class="scbt__pass_lesson_modal_pass">Отметить и перейти</button>
                            <a href="${href}"><button>Не отмечать и перейти</button></a>
                        </div>
                    </div>
                `;
                jQuery(this).parent().append(modalHTML);
                jQuery(document).on('click', '.scbt__pass_lesson_modal_pass', function(){
                    jQuery('.status-toggle-wrap').click();
                    jQuery('.scbt__pass_lesson_modal').html(`
                        <svg width="60px" height="60px" version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                            <path fill="#f80000" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite"></animateTransform>
                            </path>
                        </svg>
                    `);
                    setTimeout(function(){
                        window.location.href = href;
                    }, 100)
                })
            }
        });
        jQuery(document).on('click', '.scbt__pass_lesson_modal_close', function(){
            jQuery('.scbt__pass_lesson_modal').remove();
        });

    });
    /****************************************************************************/

</script>