<?php /** @var WC_Product_MBL $_product */ ?>
<?php $thumbnail = wpm_remove_protocol(wp_get_attachment_image_url($_product->get_image_id(), 'full')); ?>
<?php $name = (!wpm_option_is('mblp_design.product_content.disable_title', 'on') && is_callable(array($_product, 'getProductName'))) ? $_product->getProductName(true) : ''; ?>
<span
   class="folder-wrap folder-with-files folder-unlock">
    <?php if ($name) : ?>
        <div class="folder-content">
            <h1 class="title">
                <?php echo $name; ?>
            </h1>
            <div class="bottom-icons">
                <span class="bottom-icons-clearfix"></span>
            </div>
        </div>
    <?php endif; ?>
    <svg class="folder-front"
         version="1.1"
         id="folder-<?php echo $cart_item_key; ?>"
         xmlns="http://www.w3.org/2000/svg"
         xmlns:xlink="http://www.w3.org/1999/xlink"
         width="100%"
         viewBox="0 0 270 204"
         preserveAspectRatio="xMidYMid slice">
        <defs>
            <pattern
                    id="image-front-<?php echo $cart_item_key; ?>"
                    patternUnits="userSpaceOnUse"
                    width="270"
                    height="204"
                    x="0"
                    y="0">
                <image xlink:href="<?php echo $thumbnail; ?>"
                       x="0"
                       y="0"
                       preserveAspectRatio="xMidYMid slice"
                       width="100%"
                       height="100%"></image>
            </pattern>
            <path id="shape-front-<?php echo $cart_item_key; ?>"
                  d="M262.61,0H104.69C98,0,94,15,86,15H6.75A6.77,6.77,0,0,0,0,21.75v175.5A6.77,6.77,0,0,0,6.75,204h256.5a6.77,6.77,0,0,0,6.75-6.75V7.39A7.41,7.41,0,0,0,262.61,0Z"
            ></path>
        </defs>
        <use xlink:href="#shape-front-<?php echo $cart_item_key; ?>" fill="#adc8dd"></use>
        <use xlink:href="#shape-front-<?php echo $cart_item_key; ?>" fill="url(#image-front-<?php echo $cart_item_key; ?>)"></use>
    </svg>
    <div class="files-group">
        <img class="file file-1" src="<?php echo plugins_url('/member-luxe/2_0/images/file.svg'); ?>" alt="">
        <img class="file file-2" src="<?php echo plugins_url('/member-luxe/2_0/images/file.svg'); ?>" alt="">
        <img class="file file-3" src="<?php echo plugins_url('/member-luxe/2_0/images/file.svg'); ?>" alt="">
        <img class="file file-4" src="<?php echo plugins_url('/member-luxe/2_0/images/file.svg'); ?>" alt="">
    </div>
    <svg class="folder-back"
         version="1.1"
         id="folder-back-<?php echo $cart_item_key; ?>"
         xmlns="http://www.w3.org/2000/svg"
         xmlns:xlink="http://www.w3.org/1999/xlink"
         width="100%"
         viewBox="0 0 270 239"
         preserveAspectRatio="">
        <defs>
            <pattern id="image-back-<?php echo $cart_item_key; ?>"
                     patternUnits="userSpaceOnUse"
                     width="270"
                     height="239"
                     x="0"
                     y="0">
                <image
                    xlink:href="<?php echo $thumbnail; ?>"
                    opacity="1"
                    x="0%"
                    y="0%"
                    width="100%"
                    preserveAspectRatio="xMidYMin slice"
                    height="100%"/>
            </pattern>

            <path id="shape-back-<?php echo $cart_item_key; ?>"
                  d="M7.39,0H77.23c6.69,0,14.19,22,22.19,22H263.25A6.77,6.77,0,0,1,270,28.75V232.22a6.77,6.77,0,0,1-6.75,6.75H6.75A6.77,6.77,0,0,1,0,232.22V7.39A7.41,7.41,0,0,1,7.39,0Z"
            />
        </defs>
        <use xlink:href="#shape-back-<?php echo $cart_item_key; ?>" fill="white"></use>
        <use xlink:href="#shape-back-<?php echo $cart_item_key; ?>" fill="rgba(173, 200, 221, 0.3)"></use>
        <use x="0" y="0"
                xlink:href="#shape-back-<?php echo $cart_item_key; ?>"
                fill="url(#image-back-<?php echo $cart_item_key; ?>)"></use>
        <use xlink:href="#shape-back-<?php echo $cart_item_key; ?>" fill="rgba(255, 255, 255, 0.5)"></use>
    </svg>
</span>
