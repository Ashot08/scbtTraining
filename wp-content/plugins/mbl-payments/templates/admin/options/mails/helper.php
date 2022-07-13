<div class="wpm-help-wrap">
    <h4><?php _e('Переменные для подстановки данных', 'mbl_admin'); ?></h4>
    <table class="mblp_mail_vars">
        <tr>
            <td>
                <h5><?php _e('Данные клиента', 'mbl_admin'); ?>:</h5>
                <?php foreach (MBLPMail::getClientVars() as $code => $label) : ?>
                    <span class="code-string">[<?php echo $code; ?>]</span> - <?php echo $label ?><br>
                <?php endforeach; ?>
            </td>
            <td>
                <h5><?php _e('Данные о заказе', 'mbl_admin'); ?>:</h5>
                <?php foreach (MBLPMail::getOrderVars() as $code => $label) : ?>
                    <span class="code-string">[<?php echo $code; ?>]</span> - <?php echo $label ?><br>
                <?php endforeach; ?>
            </td>
        </tr>
    </table>
</div>