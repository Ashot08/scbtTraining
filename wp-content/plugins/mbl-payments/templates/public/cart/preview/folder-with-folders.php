<?php /** @var WC_Product_MBL $_product */ ?>
<?php $thumbnail = wpm_remove_protocol(wp_get_attachment_image_url($_product->get_image_id(), 'full')); ?>
<?php $name = (!wpm_option_is('mblp_design.product_content.disable_title', 'on') && is_callable(array($_product, 'getProductName'))) ? $_product->getProductName(true) : ''; ?>

<span class="folder-wrap folder-with-subfolders folder-unlock">
    <?php if ($name) : ?>
        <div class="folder-content">
            <h1 class="title"><?php echo $name; ?></h1>
            <div class="bottom-icons">
                <span class="bottom-icons-clearfix"></span>
            </div>
        </div>
    <?php endif; ?>
    <svg class="folder-sub-front"
         version="1.1"
         id="folder-<?php echo $cart_item_key; ?>"
         xmlns="http://www.w3.org/2000/svg"
         xmlns:xlink="http://www.w3.org/1999/xlink"
         width="100%" viewBox="0 0 270 229.37"
         preserveAspectRatio="xMidYMid slice">
        <defs>
            <pattern id="image-front-<?php echo $cart_item_key; ?>" patternUnits="userSpaceOnUse" width="270" height="229.37" x="0" y="0">
                <image
                    xlink:href="<?php echo $thumbnail; ?>"
                    x="-10%"
                    y="-10%"
                    preserveAspectRatio="xMidYMid slice"
                    width="120%"
                    height="120%"></image>
            </pattern>
            <path id="shape-front-<?php echo $cart_item_key; ?>"
                  d="M7.39,0H77.23c6.69,0,14.19,22,22.19,22H263.25A6.77,6.77,0,0,1,270,28.75V222.62a6.77,6.77,0,0,1-6.75,6.75H6.75A6.77,6.77,0,0,1,0,222.62V7.39A7.41,7.41,0,0,1,7.39,0Z"
            ></path>
        </defs>
        <use xlink:href="#shape-front-<?php echo $cart_item_key; ?>" fill="#adc8dd"></use>
        <use xlink:href="#shape-front-<?php echo $cart_item_key; ?>" fill="url(#image-front-<?php echo $cart_item_key; ?>)"></use>
        </svg>
    <svg class="folder-sub" version="1.1" id="folder-back-<?php echo $cart_item_key; ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" viewBox="0 0 253.833 234.537" preserveAspectRatio="xMaxYMax">
        <defs>
            <pattern id="image-back-<?php echo $cart_item_key; ?>" patternUnits="userSpaceOnUse" width="253.833" height="234.537" x="0" y="0">
                <image xlink:href="//888.memberlux.ru/wp-content/uploads/2019/05/priroda-turtsii-gory.jpg" opacity=".5" x="-15%" y="-15%" width="130%" preserveAspectRatio="xMidYMin slice" height="130%"></image>
            </pattern>

            <path id="shape-back-<?php echo $cart_item_key; ?>" d="M7.39,0H77.23c6.69,0,14.19,21,22.19,21H247.08a6.77,6.77,0,0,1,6.75,6.75v200a6.77,6.77,0,0,1-6.75,6.75H6.75A6.77,6.77,0,0,1,0,227.79V7.39A7.41,7.41,0,0,1,7.39,0Z"></path>
        </defs>
        <use xlink:href="#shape-back-<?php echo $cart_item_key; ?>" fill="white"></use>
        <use xlink:href="#shape-back-<?php echo $cart_item_key; ?>" fill="rgba(173, 200, 221, 0.3)"></use>
        <use xlink:href="#shape-back-<?php echo $cart_item_key; ?>" fill="url(#image-back-<?php echo $cart_item_key; ?>)"></use>
        <use xlink:href="#shape-back-<?php echo $cart_item_key; ?>" fill="rgba(255, 255, 255, 0.5)"></use>
    </svg>
    <svg class="folder-sub-back" version="1.1" id="folder-sub-back-<?php echo $cart_item_key; ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" viewBox="0 0 239.833 238.537" preserveAspectRatio="xMaxYMax">
        <defs>
            <pattern id="image-sub-back-<?php echo $cart_item_key; ?>" patternUnits="userSpaceOnUse" width="239.833" height="238.537" x="0" y="0">
                <image xlink:href="<?php echo $thumbnail; ?>" x="-20%" y="-20%" preserveAspectRatio="xMidYMin slice" width="140%" height="140%"></image>
            </pattern>
            <path id="shape-sub-back-<?php echo $cart_item_key; ?>" d="M7.39,0H77.23c6.69,0,14.19,21,22.19,21H233.08a6.77,6.77,0,0,1,6.75,6.75v204a6.77,6.77,0,0,1-6.75,6.75H6.75A6.77,6.77,0,0,1,0,231.79V7.39A7.41,7.41,0,0,1,7.39,0Z"></path>
        </defs>
        <use xlink:href="#shape-sub-back-<?php echo $cart_item_key; ?>" fill="#adc8dd"></use>
        <use xlink:href="#shape-sub-back-<?php echo $cart_item_key; ?>" fill="url(#image-sub-back-<?php echo $cart_item_key; ?>)"></use>
    </svg>
</span>