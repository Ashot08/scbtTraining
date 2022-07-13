<?php /** @var MBLPage $mblPage */ ?>
<?php if (wpm_text_protection_is_enabled(wpm_get_option(), $mblPage->getId())) : ?>
    <style type="text/css">
        .site-content {
            -webkit-user-select: none;
            -moz-user-select: -moz-none;
            -ms-user-select: none;
            user-select: none;
        }
        .note-editor {
            -webkit-user-select: auto;
            -ms-user-select: auto;
            user-select: auto;
        }
    </style>
    <script>
        $(".site-content").on("contextmenu", function (event) {
            event.preventDefault();
        });
    </script>
<?php endif; ?>