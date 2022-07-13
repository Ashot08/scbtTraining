<?php /** @var WP_Term[] $categories  */ ?>
<div class="tab-pane" id="mbl_hw_stats_pane">
    <div class="page-content-wrap">
        <div class="mbla-stats-filter-block">
            <form id="mbla-stats-filter" lang="<?php echo $locale; ?>">
                <input type="hidden" name="action" value="mbla_get_homework_stats_charts">
                <div class="mbla-stats-filter-button" data-mobile-only>
                    <i class="fa fa-sliders mbla-filters-icon" aria-hidden="true"></i>
                    <?php _e('Фильтр', 'mbl_admin'); ?>
                    <i class="fa fa-chevron-down mbla-filters-closed" aria-hidden="true"></i>
                    <i class="fa fa-chevron-up mbla-filters-opened" aria-hidden="true"></i>
                </div>
                <div class="flex-row mbla-stats-filter-row">
                    <div class="flex-col-filters-stats pr-10">
                        <div class="mbla-select-wrap">
                            <i class="fa fa-flask" aria-hidden="true"></i>
                            <select name="type" data-mbla-select-2>
                                <option value="" selected><?php _e('Все типы заданий', 'mbl_admin'); ?></option>
                                <option value="question"><?php _e('Вопросы', 'mbl_admin'); ?></option>
                                <option value="test"><?php _e('Тесты', 'mbl_admin'); ?></option>
                            </select>
                        </div>
                        <div class="mbla-select-wrap">
                            <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                            <select name="wpm-category"  data-mbla-select-2>
                                <option value="" selected><?php _e('Все рубрики', 'mbl_admin'); ?></option>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?php echo $category->slug; ?>"><?php echo $category->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mbla-select-wrap">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i>
                            <select name="material" id="mbla_stats_material_select" data-placeholder="<?php _e('Все материалы', 'mbl_admin'); ?>"></select>
                        </div>
                        <div class="mbla-select-wrap">
                            <i class="fa fa-sitemap" aria-hidden="true"></i>
                            <select name="wpm-levels"  data-mbla-select-2>
                                <option value="" selected><?php _e('Все уровни доступа', 'mbl_admin'); ?></option>
                                <?php foreach ($levels AS $level) : ?>
                                    <option value="<?php echo $level->slug; ?>"><?php echo $level->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mbla-select-wrap">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?php mbla_render_partial('homework/dates-select', 'admin') ?>
                        </div>
                    </div>
                    <?php /*
                        <div class="flex-col-<?php echo $hasAccessToOtherStats ? '4' : '6'; ?> pr-10" data-desktop-only>
                            <div class="wpma-status-filter opened">
                                <i class="fa fa-clock-o"></i>
                                <?php _e('Ожидающие', 'mbl_admin'); ?>
                            </div>
                            <div class="wpma-status-filter approved">
                                <i class="fa fa-hand-pointer-o"></i>
                                <?php _e('Одобренные вручную', 'mbl_admin'); ?>
                            </div>
                            <div class="wpma-status-filter accepted">
                                <i class="fa fa-cogs"></i>
                                <?php _e('Одобренные автоматически', 'mbl_admin'); ?>
                            </div>
                            <div class="wpma-status-filter rejected">
                                 <i class="fa fa-times-circle-o"></i>
                                <?php _e('Неправильные', 'mbl_admin'); ?>
                            </div>
                            <div class="wpma-actions">
                                <button class="mbla-form-submit button button-primary" type="button"><?php _e('Применить', 'mbl_admin'); ?></button>
                                <button class="mbla-form-clear button button-secondary" type="button"><?php _e('Сбросить', 'mbl_admin'); ?></button>
                            </div>
                        </div>
                    */ ?>
                    <div class="flex-col-4 pr-10">
                        <?php if ($hasAccessToOtherStats) : ?>
                            <div class="wpma-stats-users">
                                <?php foreach ($users as $user) : ?>
                                    <div class="wpma-user-row pr-15">
                                        <label>
                                            <input type="checkbox"
                                                   name="users[]"
                                                   value="<?php echo $user->ID; ?>" />
                                            <i class="fa fa-user-circle-o"></i>
                                            <?php echo $user->display_name; ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <div class="wpma-actions">
                            <button class="mbla-form-submit button button-primary" type="button"><?php _e('Применить', 'mbl_admin'); ?></button>
                            <button class="mbla-form-clear button button-secondary" type="button"><?php _e('Сбросить', 'mbl_admin'); ?></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div id="mbla-hw-stats-charts">
            <?php do_action('mbla_hw_stats_charts'); ?>
        </div>
        <div class="mbla-note">
            <?php _e('Сбор данных статистики домашних заданий начинается с момента установки MEMBERLUX версии 2.5.0 или выше.', 'mbl_admin'); ?>
            <br>
            <?php _e('Если за один и тот же автотренинг отвечают два или более тренеров, то задания, ожидающие проверку, будут учитываться в статистике каждого из них.', 'mbl_admin'); ?>
        </div>
    </div>
</div>