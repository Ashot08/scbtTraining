<?php if ($enableMenu) { ?>
    <li class="menu-item">
        <a class="panel-toggler">
            <span class="iconmoon icon-telegram"></span>
			<?php echo wpm_get_option('mbli3_telegram.menu_name'); ?>
            <span class="close-button">
            <span class="icon-close"></span>
        </span>
        </a>
        <div class="slide-down-wrap">

            <ul class="mobile-menu">

				<?php if ( $enableTelegramLogin ) { ?>
                    <li class="menu-item" id="mbli3-telegram-login-mobile">
                        <?php echo do_shortcode(stripslashes(wpm_get_option('mbli3_telegram_mobile.telegram_login_code'))); ?>
                    </li>
				<?php } ?>

				<?php if ( $enableTelegramNews ) { ?>
                    <li class="menu-item">
                        <a href="<?php echo wpm_get_option('mbli3_telegram.telegram_news_url'); ?>" target="_blank">
                            <span class="iconmoon icon-bullhorn"></span>
							<?php echo wpm_get_option('mbli3_telegram.telegram_news_name'); ?>
                        </a>
                    </li>
				<?php } ?>

				<?php if ( $enableTelegramChat ) { ?>
                    <li class="menu-item">
                        <a href="<?php echo wpm_get_option('mbli3_telegram.telegram_chat_url'); ?>" target="_blank">
                            <span class="iconmoon icon-comment"></span>
							<?php echo wpm_get_option('mbli3_telegram.telegram_chat_name'); ?>
                        </a>
                    </li>
				<?php } ?>

				<?php if ( $enableTelegramBot ) { ?>
                    <li class="menu-item">
                        <a href="<?php echo wpm_get_option('mbli3_telegram.telegram_bot_url'); ?>" target="_blank">
                            <span class="iconmoon icon-android"></span>
							<?php echo wpm_get_option('mbli3_telegram.telegram_bot_name'); ?>
                        </a>
                    </li>
				<?php } ?>

            </ul>
        </div>
    </li>
<?php } ?>
