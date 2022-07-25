<?php
function program_details($data, $program_id, $program_info){
    ?>
<?php if($data): ?>

        <?php
        $terms_array = [];
        $terms_ids = [];
        $term_by_parents = [];
        $program_title = $program_info->title ?? '';
        $director_name = get_user_meta( $program_info->director_id, 'first_name', true );


        $user_info = get_userdata(get_current_user_id());
        $is_company = false;
        if(is_user_logged_in() && isset($user_info->caps["customer_company"])){
            $is_company = true;
        }


        ?>

        <?php foreach ($data as $course): ?>
            <?php $term = get_term( $course->course_id, 'wpm-category' );?>
            <?php
            if($course->course_id){
                $terms_array[$course->course_id] = $term;

                $terms_ids[] = $course->course_id;
            }
            ?>
        <?php endforeach; ?>


    <?php
    $args = [
        'taxonomy'      => [ 'wpm-category' ], // название таксономии с WP 4.5
        'orderby'       => 'date',
        'order'         => 'ASC',
        'hide_empty'    => true,
        'object_ids'    => null,
        'include'       => array(),
        'exclude'       => array(),
        'exclude_tree'  => array(),
        'number'        => '',
        'fields'        => 'all',
        'count'         => false,
        'slug'          => '',
        'parent'         => '',
        'hierarchical'  => true,
        'child_of'      => 0,
        'get'           => '', // ставим all чтобы получить все термины
        'name__like'    => '',
        'pad_counts'    => false,
        'offset'        => '',
        'search'        => '',
        'cache_domain'  => 'core',
        'name'          => '',    // str/arr поле name для получения термина по нему. C 4.2.
        'childless'     => false, // true не получит (пропустит) термины у которых есть дочерние термины. C 4.2.
        'update_term_meta_cache' => true, // подгружать метаданные в кэш
        'meta_query'    => '',
    ];
    $categories = get_terms('wpm-category', $args);
    $categoryHierarchy = array();
    sort_terms_hierarchically($categories, $categoryHierarchy);

    function removeMissedTerms(&$termsArray, $terms_ids){
        foreach ($termsArray as $term){
            if($term->children){
                removeMissedTerms($term->children, $terms_ids);
            }else{
                if(!in_array($term->term_id, $terms_ids)){
                    unset($termsArray[$term->term_id]);
                }
            }
            if(empty($term->children) && !in_array($term->term_id, $terms_ids)){
                unset($termsArray[$term->term_id]);
            }
        }
    }


    removeMissedTerms($categoryHierarchy, $terms_ids);


    ?>


    <div class="cd__program_hierarchy_list">
        <?php
        renderProgramDetails($categoryHierarchy, $terms_ids);
        ?>
        <script>
            jQuery('.cd__program_hierarchy_list > ul').treeview({
                collapsed: false,
                animated: 'medium',
                unique: false
            });


        </script>
    </div>

    <?php if($is_company): ?>
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
                    <input class="cd__snils_input" type="text" name="snils" placeholder="СНИЛС">
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
            <script>
                /* Inputmask
                **********************************************/
                jQuery(document).ready(function () {
                    jQuery(".cd__snils_input").inputmask("999-999-999 99");
                    //jQuery("#example2").inputmask();
                });
                /*********************************************/
            </script>


        <div>
            <button class="cd__hidden_form_toggler">
                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M14 2H6C4.89 2 4 2.9 4 4V20C4 21.11 4.89 22 6 22H18C19.11 22 20 21.11 20 20V8L14 2M18 20H6V4H13V9H18V20M17.35 10L15.25 19H13.85L12.05 12.21L10.25 19H8.85L6.65 10H8.15L9.55 16.81L11.35 10H12.65L14.45 16.81L15.85 10H17.35Z" />
                </svg>
                Сгенерировать программу в формате Word (docx)
            </button>
            <div class="cd__hidden_form_box cd__send_program_details_document_form">
                <h4>Заполните нужные поля</h4>





                <label for="">
                    <input type="text" name="full_name" placeholder="Полное наименование организации">
                </label>
                <label for="">
                    <input type="text" name="short_name" placeholder="Сокращенное наименование организации">
                </label>
                <label for="">
                    <input type="text" name="program_name" placeholder="Название программы" value="<?= $program_title; ?>">
                </label>
                <label for="">
                    <input type="text" name="hours" placeholder="Количество часов обучения">
                </label>
                <label for="">
                    <input type="text" name="director_post" placeholder="Должность руководителя организации">
                </label>
                <label for="">
                    <input type="text" name="director_name" placeholder="ФИО руководителя" value="<?= $director_name; ?>">
                </label>

                <button data-courses="<?php echo implode(',', $terms_ids); ?>" data-action="cd__send_program_details_document">
                    Сгенерировать
                </button>
                <div class="cd__send_program_details_document_result"></div>
            </div>
        </div>

    <?php endif; ?>


<?php endif; ?>
    <?php

}
function renderProgramDetails($terms, $terms_ids){
    if($terms):?>

    <ul>
        <?php foreach ($terms as $term): ?>
            <?php
                $is_open = in_array($term->term_id, $terms_ids);
                $has_children = $term->children;

                $course_category = new MBLCategory($term);
                $progress = $course_category->getProgress(get_current_user_id()) ?? '0';
            ?>
            <li class="<?php echo $is_open ? 'cd__list_item_open' : 'cd__list_item_not_open'; ?>
                       <?php echo $has_children ? 'cd__list_has_children' : 'cd__list_has_not_children';?>
                    ">

                <?php if($is_open): ?>

                    <div class="cd__program_hierarchy_list_item_wrapper">
                        <a href="<?= get_term_link($term->term_id); ?>">
                            <span><?= $term->name ?></span>
                            <span class="cd__progress_value"> - <?= $progress; ?>%</span>
                        </a>
                    </div>

                <?php else: ?>

                    <div class="cd__program_hierarchy_list_item_wrapper">
                        <span><?= $term->name ?></span>
                        <svg style="width:14px;height:14px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12,17C10.89,17 10,16.1 10,15C10,13.89 10.89,13 12,13A2,2 0 0,1 14,15A2,2 0 0,1 12,17M18,20V10H6V20H18M18,8A2,2 0 0,1 20,10V20A2,2 0 0,1 18,22H6C4.89,22 4,21.1 4,20V10C4,8.89 4.89,8 6,8H7V6A5,5 0 0,1 12,1A5,5 0 0,1 17,6V8H18M12,3A3,3 0 0,0 9,6V8H15V6A3,3 0 0,0 12,3Z" />
                        </svg>
                    </div>

                <?php endif; ?>
                <?php if($has_children): ?>
                    <?php renderProgramDetails($term->children, $terms_ids) ?>
                <?php endif; ?>
            </li>
        <?php endforeach;?>
    </ul>

    <?php endif;
}
function sort_terms_hierarchically(Array &$cats, Array &$into, $parentId = 0)
{
    foreach ($cats as $i => $cat) {
        if ($cat->parent == $parentId) {
            $into[$cat->term_id] = $cat;
            unset($cats[$i]);
        }
    }

    foreach ($into as $topCat) {
        $topCat->children = array();
        sort_terms_hierarchically($cats, $topCat->children, $topCat->term_id);
    }
}



