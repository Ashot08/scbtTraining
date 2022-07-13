<?php
/**
 * ****************************************************************************
 *
 *   НЕ РЕДАКТИРУЙТЕ ЭТОТ ФАЙЛ
 *   DON'T EDIT THIS FILE
 *
 *   После обновления Вы потереяете все изменения. Используйте дочернюю тему
 *   After update you will lose all changes. Use child theme
 *
 *   https://support.wpshop.ru/docs/general/child-themes/
 *
 * *****************************************************************************
 *
 * @package reboot
 */

?>

<div class="post-cards">

    <?php
    $n = 0;
    while ( have_posts() ) : the_post();
	    $n++;
        get_template_part( 'template-parts/post-card/standard' );
	    do_action( THEME_SLUG . '_after_post_card', $n, 'standard' );
    endwhile;
    ?>

</div>