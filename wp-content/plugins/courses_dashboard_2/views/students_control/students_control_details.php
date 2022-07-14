<?php


function students_control_details($data, $program_id){
    $users_array = [];

    foreach ($data as $user){
        $users_array[] = $user->student_id;
    }
    $users_array = array_unique($users_array);
    ?>

<?php if($users_array): ?>

    <table class="cd__table">
        <tbody>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Логин</th>
            <th>Пароль</th>
<!--            <th>Прогресс</th>-->
            <th>
                <label class="cd__table_select_all_label">
                    <input type="checkbox" data-action="cd__table_select_all">
                    Все
                </label>
            </th>
        </tr>
        <?php foreach ($users_array as $student_id):?>

            <?php
            $user_info = get_userdata($student_id);
            $user_id = $user_info->data->ID;
            $user_name = $user_info->data->display_name;
            $user_login = $user_info->data->user_login;
            $user_pass = '123';
            //$course_category = new MBLCategory(get_term($program_id), true, true);
            ?>

            <tr>
                <td><?php echo $user_id; ?></td>
                <td><?php echo $user_name; ?></td>
                <td><?php echo $user_login; ?></td>
                <td><?php echo $user_pass; ?></td>
<!--                <td>--><?php //echo $course_category->getProgress($user_id); ?><!--%</td>-->
<!--                <td>0%</td>-->
                <td>
                    <label>
                        <input data-action="cd__select_item" data-student_id="<?= $user_id; ?>" type="checkbox">
                    </label>
                </td>
            </tr>

            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>

    <div>
        <br>
        <button data-action="toggle__add_new_student_form">Добавить слушателя</button>
        <br><br>
        <div class="cd__add_new_student_form">
            <label for="">
                <input type="text" name="user_login" placeholder="Логин" required>
            </label>
            <label for="">
                <input type="text" name="first_name" placeholder="ФИО">
            </label>
            <label for="">
                <input type="email" name="user_email" placeholder="email" required>
            </label>
            <label for="">
                <input type="email" name="user_position" placeholder="Должность">
            </label>
            <button data-program_id="<?= $program_id; ?>" data-action="cd__send_add_new_student_form">
                Добавить
            </button>
            <div class="cd__add_new_student_form_result"></div>
        </div>
    </div>

<?php
}



