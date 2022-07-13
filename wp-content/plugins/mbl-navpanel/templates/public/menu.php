<?php /** @var MBLCategory $category */ ?>
<?php if ($category->displayMaterials()) : ?>
    <div class="mbli3-left-menu" id="mbli3-left-menu">
        <div class="mbli3-left-menu-holder">
            <div class="container">
                <a href="#" data-mbli3-menu-toggle class="mbli3-menu-close"><span class="icon-close"></span></a>
                <h3 class="text-center mbli3-page-title"><?php echo $category->getName(); ?></h3>
            </div>
            <section class="materials-row one-in-line clearfix">
                <div class="container">
                    <div class="row">
                        <?php if ($category->getPageCollection()->count()) : ?>
                            <?php foreach ($category->getPageCollection()->getPages() as $MBLPage) : ?>
                                <?php $post = $MBLPage->getPost(); ?>
                                <?php setup_postdata($GLOBALS['post'] =& $post) ?>
                                <?php $category->getAutotrainingView()->iterate() ?>
                                <?php if ($category->postIsHidden()) : ?>
                                    <?php continue; ?>
                                <?php endif; ?>
                                <div class="col-md-12 <?php echo $MBLPage->getId() == $currentPost->ID ? 'current-post' : ''; ?>">
                                    <?php wpm_render_partial('material', 'base', compact('category')) ?>
                                </div>
                                <?php $category->getAutotrainingView()->updatePostIterator(); ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>
