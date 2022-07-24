<?php /** @var MBLCategory $category */ ?>
<?php /** @var MBLPage $mblPage */ ?>
<?php if (!isset($category)) : ?>
    <?php $category = null; ?>
<?php endif; ?>
<?php if (is_user_logged_in() || wpm_get_option('main.opened')) : ?>
    <section class="breadcrumbs-row">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="breadcrumbs-wrap">
                        <div class="breadcrumbs">
                            <?php echo apply_filters('mbl_breadcrumb_home', wpm_render_partial('breadcrumb-home', 'base', [], true)); ?>
                            <?php if (!isset($breadcrumbs)) : ?>
                                <?php if ($category && $category->hasAccess()) : ?>
                                    <?php $i = 0; ?>
                                    <?php foreach ($category->getBreadcrumbs() as $breadcrumb) : ?>
                                            <?php
                                                $user_id = get_current_user_id();
                                                $term_id = $breadcrumb['id'];
                                                $controller = new \Controllers\AccessController();
                                                $user_courses = $controller->actionGetUserCourses($user_id);

                                                $access = in_array($term_id, $user_courses);
                                            ?>

                                        <?php $i++; ?>
                                        <span class="separator"><span class="icon-angle-right"></span></span>
                                        <?php if ($i == count($category->getBreadcrumbs()) && !isset($mblPage)) : ?>
                                            <?php if($access): ?>
                                                <a class="item" href="<?php echo wpm_array_get($breadcrumb, 'link'); ?>" title="<?php echo wpm_array_get($breadcrumb, 'name'); ?>">
                                                    <span class="iconmoon icon-<?php echo wpm_array_get($breadcrumb, 'icon'); ?>"></span>
                                                    <?php echo wpm_array_get($breadcrumb, 'name'); ?>
                                                </a>
                                            <?php else: ?>
                                                <span class="item cd__breadcrumb_closed" title="<?php echo wpm_array_get($breadcrumb, 'name'); ?>">
                                                    <span>
                                                         <svg style="width:18px;height:18px" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M12,17C10.89,17 10,16.1 10,15C10,13.89 10.89,13 12,13A2,2 0 0,1 14,15A2,2 0 0,1 12,17M18,20V10H6V20H18M18,8A2,2 0 0,1 20,10V20A2,2 0 0,1 18,22H6C4.89,22 4,21.1 4,20V10C4,8.89 4.89,8 6,8H7V6A5,5 0 0,1 12,1A5,5 0 0,1 17,6V8H18M12,3A3,3 0 0,0 9,6V8H15V6A3,3 0 0,0 12,3Z" />
                                                        </svg>
                                                    </span>
                                                    <?php echo wpm_array_get($breadcrumb, 'name'); ?>
                                                </span>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <?php if($access): ?>
                                                <a class="item"
                                                   href="<?php echo wpm_array_get($breadcrumb, 'link'); ?>"
                                                   title="<?php echo wpm_array_get($breadcrumb, 'name'); ?>">
                                                    <span class="icon-<?php echo wpm_array_get($breadcrumb, 'icon'); ?>"></span>
                                                    <?php echo wpm_array_get($breadcrumb, 'name'); ?>
                                                </a>
                                            <?php else: ?>
                                                <span class="item cd__breadcrumb_closed"
                                                   title="<?php echo wpm_array_get($breadcrumb, 'name'); ?>">
                                                    <span>
                                                         <svg style="width:18px;height:18px" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M12,17C10.89,17 10,16.1 10,15C10,13.89 10.89,13 12,13A2,2 0 0,1 14,15A2,2 0 0,1 12,17M18,20V10H6V20H18M18,8A2,2 0 0,1 20,10V20A2,2 0 0,1 18,22H6C4.89,22 4,21.1 4,20V10C4,8.89 4.89,8 6,8H7V6A5,5 0 0,1 12,1A5,5 0 0,1 17,6V8H18M12,3A3,3 0 0,0 9,6V8H15V6A3,3 0 0,0 12,3Z" />
                                                        </svg>
                                                    </span>
                                                    <?php echo wpm_array_get($breadcrumb, 'name'); ?>
                                                </span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <?php if (isset($mblPage) && $mblPage->getId() == wpm_get_option('schedule_id')) : ?>
                                    <span class="separator"><span class="icon-angle-right"></span></span>
                                    <a class="item" href="<?php echo get_permalink(wpm_get_option('schedule_id')); ?>" title="<?php echo $mblPage->getTitle(); ?>">
                                        <span class="iconmoon icon-calendar"></span>
                                        <?php echo $mblPage->getTitle(); ?>
                                    </a>
                                <?php elseif (isset($mblPage) && $mblPage && is_single()) : ?>
                                    <span class="separator"><span class="icon-angle-right"></span></span>
                                    <a class="item" href="<?php echo wpm_material_link($category->getWpCategory(), $mblPage->getPost()); ?>" title="<?php echo $mblPage->getTitle(); ?>">
                                        <span class="iconmoon icon-file-text-o"></span>
                                        <?php echo $mblPage->getTitle(); ?>
                                    </a>
                                <?php endif; ?>
                            <?php else : ?>
                                <?php $i = 0; ?>
                                <?php foreach ($breadcrumbs as $breadcrumb) : ?>
                                        <?php $i++; ?>
                                        <span class="separator"><span class="icon-angle-right"></span></span>
                                        <?php if ($i == count($breadcrumbs)) : ?>
                                            <a class="item" href="<?php echo wpm_array_get($breadcrumb, 'link'); ?>" title="<?php echo wpm_array_get($breadcrumb, 'name'); ?>">
                                                <span class="iconmoon icon-<?php echo wpm_array_get($breadcrumb, 'icon'); ?>"></span>
                                                <?php echo wpm_array_get($breadcrumb, 'name'); ?>
                                            </a>
                                        <?php else : ?>
                                            <a class="item"
                                               href="<?php echo wpm_array_get($breadcrumb, 'link'); ?>"
                                               title="<?php echo wpm_array_get($breadcrumb, 'name'); ?>">
                                                <span class="icon-<?php echo wpm_array_get($breadcrumb, 'icon'); ?>"></span>
                                                <?php echo wpm_array_get($breadcrumb, 'name'); ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <?php if (!is_single() && isset($category) && $category->showProgressOnBreadcrumbs()) : ?>
                            <div class="course-progress-wrap" title="<?php _e('Пройдено уроков', 'mbl'); ?>">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $category->getProgress(); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $category->getProgress(); ?>%">
                                        <span class="sr-only"><?php echo $category->getProgress(); ?>% <?php _e('Пройдено уроков', 'mbl'); ?></span>
                                    </div>
                                </div>
                                <div class="progress-count">
                                    <?php echo $category->getProgress(); ?>%
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
