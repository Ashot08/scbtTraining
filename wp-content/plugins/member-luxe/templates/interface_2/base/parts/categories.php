<?php /** @var MBLCategoryCollection $categoryCollection */ ?>
<?php $baseCategory = isset($category) ? $category : null; ?>
<section class="folders-row clearfix">
    <?php if (wpm_user_is_active()) : ?>
        <div class="container">
            <div class="row">
                

                <?php $counter = 1; ?>
                <?php foreach ($categoryCollection->getCategories() as $category) : ?>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 scbt__course_cat">
                        <?php wpm_render_partial('folder', 'base', compact('category', 'counter')) ?>
                    </div>
                    <?php $counter++; ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</section>
<?php if (wpm_user_is_active() && $baseCategory !== null) : ?>
    <?php wpm_render_partial('pagination', 'base', array('pager' => $baseCategory->getChildrenCollection())) ?>
<?php endif; ?>