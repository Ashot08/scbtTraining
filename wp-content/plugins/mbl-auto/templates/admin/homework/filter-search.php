<th class="mbl-filter-toggle-th mbl-search-toggle-th js-mbl-search-toggle-th">
  <i class="fa fa-search" aria-hidden="true"></i>
  <span><?php _e('Поиск', 'mbl_admin'); ?></span>
</th>

<th class="mbl-search-th">
  <?php if (wpm_option_is('hw.enabled_fields.search', 'on', 'on')) : ?>
    <p class="search-box">
        <label class="screen-reader-text" for="post-search-input"><?php _e('Поиск', 'mbl_admin'); ?>
            :</label>
        <input type="search" id="post-search-input" name="s" value="">
        <input type="submit" name="" id="search-submit" class="button" value="<?php _e('Поиск', 'mbl_admin'); ?>">
    </p>
  <?php endif; ?>
</th>
