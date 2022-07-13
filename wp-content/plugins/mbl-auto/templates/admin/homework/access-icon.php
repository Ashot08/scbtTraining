<?php if ($access === 'all') : ?>
    <i class="fa fa-question-circle"></i>
    <i class="fa fa-list-alt"></i>
<?php elseif($access === 'test') : ?>
    <i class="fa fa-list-alt"></i>
<?php elseif($access === 'question') : ?>
    <i class="fa fa-question-circle"></i>
<?php endif; ?>
