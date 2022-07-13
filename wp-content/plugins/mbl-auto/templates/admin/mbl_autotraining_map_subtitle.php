<div class="flex-row flex-wrap">
    <div class="pr-10">
        <i class="fa fa-gift mbla-map-icon" aria-hidden="true"></i>
        <?php _e('Подарок финалистам', 'mbl_admin'); ?>:
    </div>
    <?php if ($addLevel && $newTermId && ($duration || $is_unlimited )) : ?>
        <div class="pr-10">
            <i class="fa fa-sitemap mbla-map-icon" aria-hidden="true"></i>
            <span class="dimmed"><?php _e('Название уровня', 'mbl_admin'); ?>:</span>
            "<a
                target="_blank"
                class="mbla-level-link"
                href="<?php echo admin_url('/edit-tags.php?action=edit&taxonomy=wpm-levels&tag_ID=' . $newTermId . '&post_type=wpm-page'); ?>"
            ><?php echo mbl_get_term_name($newTermId); ?></a>"
        </div>
        <div class="pr-10">
            <span class="dimmed"><?php _e('Время действия', 'mbl_admin'); ?>:</span>
            <?php echo $unitsText; ?>
        </div>
    <?php else : ?>
        <div class="dimmed pr-10"><?php _e('Нет', 'mbl_admin'); ?></div>
    <?php endif; ?>
</div>
<div class="flex-row flex-wrap mbla-map-coaches">
    <div class="pr-10">
        <i class="fa fa-user-circle-o mbla-map-icon" aria-hidden="true"></i>
        <?php _e('Ответственные за проверку заданий', 'mbl_admin'); ?>:
    </div>
    <?php if (count($coaches)) : ?>
        <?php foreach ($coaches as $coachId => $access) : ?>
            <div class="pr-10 mbla-map-coach">
                <?php mbla_render_partial('homework/access-icon', 'admin', compact('access')) ?>
                <a href="<?php echo admin_url('/user-edit.php?user_id=' . $coachId); ?>"
                   target="_blank"
                ><?php echo wpm_get_user($coachId, 'display_name'); ?></a>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="dimmed pr-10"><?php _e('Нет', 'mbl_admin'); ?></div>
    <?php endif; ?>
</div>
