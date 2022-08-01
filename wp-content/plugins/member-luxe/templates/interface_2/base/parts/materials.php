<?php /** @var MBLCategory $category */ ?>
<?php if ($category->displayMaterials()) : ?>
    <section class="materials-row <?php echo wpm_option_is('main.posts_row_nb', 1, 2) ? 'one-in-line' : ''; ?> clearfix">
        <div class="container">
            <div class="row">



                <div class="">
                    <?php
                    $my_posts = get_posts( array(
                        'numberposts' => 300,
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
                        $term = get_term($category->getTermId());
                        $post_id = $post->ID;
                        $post_title = $post->post_title;
                        $active_post = false;
                        if($post_id === $current_id){
                            $active_post = true;
                        }

                        ?>

                        <div class="col-md-6">
                            <article class="material-item material-opened ">
                                <a class="flex-wrap" href="<?php echo '/wpm/' . $term->slug . '/' . $post->post_name; ?>">
                                    <div class="col-thumb ">
                                        <div class="thumbnail-wrap" style="background-image: url('//training.sibcbt.ru/wp-content/uploads/2022/06/7.png');">
                                            <div class="icons-top">
                                                <div class="icons">
                                                    <span class="m-icon count"># <?= $counter ?></span>
                                                    <span class="status-icon"><span class="icon-unlock"></span></span>
                                                </div>
                                            </div>
                                            <div class="icons-bottom">
                                                <div class="icons">
                                                    <div class="right-icons">
<!--                                                        <span class="views"><span class="icon-eye"></span> 11</span>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-content ">
                                        <div class="content-wrap">
                                            <h1 class="title"><?= $post_title ?></h1>
                                            <div class="description">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="content-overlay">
                                            <span class="doc-label opened">доступ открыт</span>
                                        </div>
                                    </div>
                                </a>
                            </article>
                        </div>




                        <?php
                        $counter++;
                        ?>
                        <?php
                    }

                    wp_reset_postdata();

                    ?>
                </div>



                <?php if (false && have_posts()) : ?>
                    <?php while (have_posts()): ?>


                        <?php $category->iterateComposer() ?>

                        <?php if ($category->postIsHidden() || ( get_post_type(get_the_ID()) === 'cd__video' )) : ?>

                            <?php continue; ?>
                        <?php endif; ?>

                    
                        <div class="col-md-<?php echo wpm_option_is('main.posts_row_nb', 1, 2) ? '12' : '6'; ?>">
                            <?php wpm_render_partial('material', 'base', compact('category')) ?>
                        </div>

                        <?php $category->getAutotrainingView()->updatePostIterator(); ?>
                    <?php endwhile; ?>
                <?php elseif(false) : ?>
                    <div class="col-md-12">
                        <div class="no-posts">
                            <p>
                                <?php _e('Нет материалов', 'mbl') ?>
                            </p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php wpm_render_partial('pagination', 'base', array('pager' => $category)) ?>
<?php endif; ?>