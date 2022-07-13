function cd__content_request (id, action ) {
    return jQuery.ajax(
        {
            method: 'Post',
            url: ajaxUrl.url,
            data: {
                action,
                id
            }
        },
    )
}
function cd__key_request (key, action ) {
    return jQuery.ajax(
        {
            method: 'Post',
            url: ajaxUrl.url,
            data: {
                action,
                key
            }
        },
    )
}
function cd__create_program_request (name= '', description= '', action, courses ) {

    let courses_arr = [];
    if(action === 'cd__create_new_program'){
        const chaptersArr = Object.keys(courses.chapters).map(function(k){return courses.chapters[k]});
        for(let arr of chaptersArr){
            courses_arr = courses_arr.concat(arr);
        }
    }else{
        courses_arr = courses;
    }


    return jQuery.ajax(
        {
            method: 'Post',
            url: ajaxUrl.url,
            data: {
                action,
                name,
                description,
                courses: courses_arr,
            }
        },
    )
}


function cd__add_new_student_form_request ( user_login, first_name, user_email, user_position, program_id ) {
    return jQuery.ajax(
        {
            method: 'Post',
            url: ajaxUrl.url,
            data: {
                action: 'cd__add_new_student',
                user_login,
                first_name,
                user_email,
                user_position,
                program_id
            }
        },
    )
}


function cd__send_program_details_document ( full_name, short_name, program_name, hours, director_post, director_name, courses ) {
    return jQuery.ajax(
        {
            method: 'Post',
            url: ajaxUrl.url,
            data: {
                action: 'cd__send_program_details_document',
                full_name,
                short_name,
                program_name,
                hours,
                director_post,
                director_name,
                courses
            }
        },
    )
}

