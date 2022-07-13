<?php /** @var $accessAll string */ ?>
<?php /** @var $categories array */ ?>
<div class="wpma-stats-access flex-row flex-wrap">
    <div class="wpma-stats-access-title pr-10"><?php _e('Проверка заданий', 'mbl_admin'); ?>:</div>
    <div class="flex-col-9 wpma-stats-access-content">
        <?php if ($accessAll != 'off') : ?>
            <?php _e('Все автотренинги', 'mbl_admin'); ?>
            <?php mbla_render_partial('homework/access-icon', 'admin', ['access' => $accessAll]) ?>
        <?php elseif(count($categories)): ?>
            <?php foreach ($categories as $categoryId => $access) : ?>
                <div>
                    <?php $term = get_term($categoryId, 'wpm-category') ?>
                    <?php if (!$term) : ?>
                        <?php continue; ?>
                    <?php endif; ?>
                    <?php echo $term->name; ?>
                    <?php mbla_render_partial('homework/access-icon', 'admin', compact('access')) ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <?php _e('Нет', 'mbl_admin'); ?>
        <?php endif; ?>
    </div>
</div>