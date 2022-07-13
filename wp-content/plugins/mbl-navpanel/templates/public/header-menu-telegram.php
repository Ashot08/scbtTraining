<?php if( $enableMenu ) { ?>
    <div class="dropdown nav-item navbar-left hidden-xs hidden-sm user-registration-button" data-dropdown-backdrop>
        <a id="telegram-dropdown" class="dropdown-button dropdown-toggle telegram-dropdown" data-toggle="dropdown">
            <span class="iconmoon icon-telegram"></span>
			<?php echo wpm_get_option('mbli3_telegram.menu_name'); ?>
            <span class="caret"></span>
        </a>

        <ul class="dropdown-menu">

            <?php if ( $enableTelegramLogin ) { ?>
            <li id="mbli3-telegram-login-desktop">
				<?php echo do_shortcode(stripslashes(wpm_get_option('mbli3_telegram.telegram_login_code'))); ?>
            </li>
            <?php } ?>

			<?php if ( $enableTelegramNews ) { ?>
            <li>
                <a href="<?php echo wpm_get_option('mbli3_telegram.telegram_news_url')?>"
                    <?php echo wpm_get_option('mbli3_telegram.telegram_news_code') ? 'data-mbli3-telegram-news-toggle' : ''; ?>
                    target="_blank"
                >
                    <span class="iconmoon icon-bullhorn"></span>
					<?php echo wpm_get_option('mbli3_telegram.telegram_news_name'); ?>
                </a>
            </li>
			<?php } ?>

			<?php if ( $enableTelegramChat ) { ?>
            <li>
                <a href="<?php echo wpm_get_option('mbli3_telegram.telegram_chat_url')?>"
					<?php echo wpm_get_option('mbli3_telegram.telegram_chat_code') ? 'data-mbli3-telegram-chat-toggle' : ''; ?>
                   target="_blank"
                >
                    <span class="iconmoon icon-comment"></span>
					<?php echo wpm_get_option('mbli3_telegram.telegram_chat_name'); ?>
                </a>
            </li>
			<?php } ?>

			<?php if ( $enableTelegramBot ) { ?>
            <li>
                <a href="<?php echo wpm_get_option('mbli3_telegram.telegram_bot_url')?>"
                   target="_blank"
                >
                    <span class="iconmoon icon-android"></span>
					<?php echo wpm_get_option('mbli3_telegram.telegram_bot_name'); ?>
                </a>
            </li>
			<?php } ?>

        </ul>
    </div>
<?php } ?>
