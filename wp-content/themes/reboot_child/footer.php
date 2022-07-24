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
global $wpshop_core;
global $class_advertising;

$is_show_arrow     = $wpshop_core->get_option( 'arrow_display' );
$is_show_arrow_mob = ( $wpshop_core->get_option( 'arrow_mob_display' ) ) ? ' data-mob="on"' : '';

?>

</div><!--.site-content-inner-->

<?php echo $class_advertising->show_ad( 'after_site_content' ) ?>

</div><!--.site-content-->

<?php do_action( THEME_SLUG . '_after_site_content' ) ?>

<?php
if ( $wpshop_core->is_show_element( 'footer' ) ) {
    get_template_part( 'template-parts/footer/footer' );
} ?>

<?php if ( $is_show_arrow ) { ?>
    <button type="button" class="scrolltop js-scrolltop"<?php echo $is_show_arrow_mob ?>></button>
<?php } ?>

</div><!-- #page -->


<?php wp_footer(); ?>
<?php $wpshop_core->the_option( 'code_body' ) ?>

<?php do_action( THEME_SLUG . '_before_body' ) ?>

<?php
$slider_per_view = 1;

if ( $wpshop_core->get_option( 'slider_type' ) == 'three' ) {
    $slider_per_view = apply_filters( THEME_SLUG . '_slider_three_count', 3 );
}

if ( $wpshop_core->get_option( 'slider_type' ) == 'thumbnails' ) {
    $slider_per_view = 1;
}

if ( apply_filters( THEME_SLUG . '_slider_output', is_front_page() || is_home() ) && $wpshop_core->get_option( 'slider_count' ) != 0 ) {
    if ( ! wp_is_mobile() || ( wp_is_mobile() && ! $wpshop_core->get_option( 'slider_mob_disable' ) ) ) { ?>
        <!-- Initialize Swiper -->
        <script>
            <?php if ( $wpshop_core->get_option( 'slider_type' ) == 'thumbnails' ) { ?>

            var wpshopSwiperThumbs = new Swiper('.js-swiper-home-thumbnails', {
                spaceBetween: 10,
                slidesPerView: 4,
                freeMode: true,
                loopedSlides: 5, //looped slides should be the same
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
                breakpoints: {
                    1024: {
                        slidesPerView: 4,
                    },
                    900: {
                        slidesPerView: 3,
                    },
                    760: {
                        slidesPerView: 2,
                    },
                    600: {
                        slidesPerView: 1,
                    },
                },
            });

            <?php } ?>

            var wpshopSwiper = new Swiper('.js-swiper-home', {
                <?php if ( $wpshop_core->get_option( 'slider_type' ) != 'thumbnails' ) { ?>
                slidesPerView: <?php echo $slider_per_view ?>,
                <?php } ?>
                <?php if ( $wpshop_core->get_option( 'slider_type' ) == 'three' ) { ?>
                breakpoints: {
                    1201: {
                        slidesPerView: <?php echo $slider_per_view ?>,
                        spaceBetween: 30,
                    },
                    300: {
                        slidesPerView: 1,
                    }
                },
                <?php } ?>
                spaceBetween: 30,
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                <?php if ( is_numeric( $wpshop_core->get_option( 'slider_autoplay' ) ) && $wpshop_core->get_option( 'slider_autoplay' ) > 0 ) { ?>
                autoplay: {
                    delay: <?php $wpshop_core->the_option( 'slider_autoplay' ) ?>,
                    disableOnInteraction: true,
                },
                <?php } ?>
                <?php if ( $wpshop_core->get_option( 'slider_type' ) == 'thumbnails' ) { ?>
                thumbs: {
                    swiper: wpshopSwiperThumbs,
                },
                loopedSlides: 5, //looped slides should be the same
                <?php } ?>
            });
        </script>

    <?php }
} ?>


<script>
    /*****Registration***********************************************************/
    jQuery(document).on('click', '.scbt__register_form .scbt__submit' , function (e) {
        e.preventDefault();
        const resultBlock = jQuery('.scbt__register_result');
        const userName = jQuery('.user_name').val();
        const userEmail = jQuery('.user_email').val();
        const userPassword = jQuery('.user_password').val();
        const userRole = jQuery('.user_role').val();
        const accept = jQuery('#scbt__checkbox_accept').is(':checked');
        const first_name = jQuery('.first_name').val();
        const billing_phone = jQuery('.billing_phone').val();

        const user_company_name = jQuery('.user_company_name').val();
        const user_inn = jQuery('.user_inn').val();
        const user_position = jQuery('.user_position').val();
        const user_snils = jQuery('[name="snils"]').val();

        if(userName && userEmail && userPassword){
            regRequest (userName,
                userEmail,
                userPassword,
                userRole,
                accept,
                first_name,
                billing_phone,
                user_company_name,
                user_inn,
                user_position,
                user_snils).then(res => resultBlock.html(res));
        }else{
            resultBlock.html('<div class="scbt__notice_error">Заполните все обязательные поля</div>')
        }

    });

    function regRequest (userName,
                         userEmail,
                         userPassword,
                         userRole,
                         accept,
                         first_name,
                         billing_phone,
                         user_company_name,
                         user_inn,
                         user_position,
                         user_snils) {
        return jQuery.ajax(
            {
                method: 'Post',
                url: ajaxUrl.url,
                data: {
                    action: 'new_user_registration',
                    userName,
                    userEmail,
                    userPassword,
                    userRole,
                    accept,
                    first_name,
                    billing_phone,
                    user_company_name,
                    user_inn,
                    user_position,
                    user_snils
                }
            },
        )
    }
    /********************************************************************************/



    /**Checkbox*****************************************************************************/
    jQuery(document).on('click', '.scbt__checkbox', function (e) {
        jQuery(this).toggleClass('active');
    });
    /*******************************************************************************/



    /*Register form show diler fields***********************************************/
    jQuery(document).on('change', '#user_role', function (e) {
        if(jQuery(this).val() === 'customer_company'){
            jQuery('.scbt_diler_register_fields').show(100);
        }else{
            jQuery('.scbt_diler_register_fields').hide(100);
        }

    });

    /*******************************************************************************/



    /*Register form add close********************************************************/
    jQuery(document).ready(function () {
        jQuery('#rcl-overlay').html('<div class="scbt__form_close">&#x2715</div>')

    });
    /********************************************************************************/



    /*Dealer form trigger************************************************************/
    jQuery(document).on('click', '.scbt__dealer_form_trigger', function (e) {
        jQuery('.rcl-login').click();
        jQuery('#register-form-rcl').show();
        jQuery('#login-form-rcl').hide();
        jQuery("#user_role").val('dealer');
        jQuery('.scbt_diler_register_fields').show();
    });
    /********************************************************************************/


    /*Course structure sidebar trigger************************************************************/
    jQuery(document).on('click', '.scbt__course_structure_toggle', function (e) {
        jQuery('.scbt__course_structure_sidebar').toggleClass('active');
    });

    jQuery(document).ready(function(){
        /**
         * При прокрутке страницы
         */
        jQuery(window).scroll(function () {
            // Если отступ сверху больше 50px то показываем кнопку "Наверх"
            if (jQuery(this).scrollTop() > 500) {
                jQuery('.scbt__course_structure_button').addClass('fly');
            } else {
                jQuery('.scbt__course_structure_button').removeClass('fly');
            }
        });
    });
    /********************************************************************************/
</script>
</body>
</html>