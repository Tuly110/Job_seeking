const nick_name = document.getElementById('nick_name');
const form = document.querySelector('.form_job_detail');

// if(form != null){
    $('.form_job_detail').submit(function(e){
        console.log(nick_name.value);

        e.preventDefault();

        if(nick_name.value != ''){
            var formData = new FormData();
            var fileInput = $('#CV')[0].files[0];
            formData.append('CV', fileInput);

            console.log($(this).serializeArray());
            $(this).serializeArray().forEach(element => {
                formData.append(element.name, element.value);
            });

            
            $.ajax({
                type: "POST",
                url: 'job_apply_controller.php?apply='+$('#id_jobs').val()+'',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    response = JSON.parse(response);
                    // alert(response);
                    if(response.status == 0){
                        
                        Swal.fire({
                            icon: "success",
                            title: "Apply Success",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload();
                        });
                        
                    }
                    else{
                        // alert(response.status);
                        const input_appty = document.querySelectorAll('.form_job_input');
                        $html = '';
                        var err = document.querySelectorAll('.err');
                        input_appty.forEach(function(element,index){
                            if(element.value === ""){
                                $html = '* Please fill in all information!'
                                err[index].innerHTML = $html;
                            }
                        });
                    }
                }
                
            })
        }else{
            Swal.fire({
                icon: "warning",
                title: "You are not logged in",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                console.log(1);
                window.location.href="forms/form_login.php";
              });
        }
        
    })

const enter_comment = document.getElementById('enter_comment');
const append_show_comment = document.querySelector('.show_comments')
const show_name_comment = document.querySelector('.span_name');
const show_content = document.querySelector('.user_content lable');

enter_comment.addEventListener('keyup', function(e){
    e.preventDefault();

    
    if(e.key === 'Enter'){
        console.log($('#id_jobs').val());
        if(nick_name.value != ''){
            $.ajax({
                type: 'post',
                url : 'job_apply_controller.php?comments='+$('#id_jobs').val()+'',
                data: [
                    {name: 'content', value:enter_comment.value}
                ]
        
            })
            .done(function(data){
                // alert(data);
                html ='';
    
                var today = new Date();
                var day = today.getDate();
                var month = today.getMonth();
                var year = today.getFullYear();
    
                
                append_show_comment.innerHTML += `<div class="comments_user mt-3">
                            <div class="user_info">
                                <span class="span_name fw-bold">`+nick_name.value+`</span>
                                <small>`+day+'/'+month +'/'+year+`</small>
                            </div>
                            <div class="user_content my-2">
                                <label style="text-indent: 10px;">`+enter_comment.value+`</label>
                            </div>
                            <div class="like_or_dislike">
                                <div>
                                    <i class="fa-regular fa-thumbs-up"></i>
                                    <sup>0</sup>
                                </div>
                                <div>
                                    <i class="fa-regular fa-thumbs-down"></i>
                                    <sup>0</sup>
                                </div>
                            </div>
                        </div>`;
                
                enter_comment.value = '';
            })
            .fail(function(data){
                // alert(data);
                alert('Thất Bại')
            })
        }else{
            Swal.fire({
                icon: "warning",
                title: "You are not logged in",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.reload();
              });
        }
    } 
})

// Like bình luận 
$(document).ready(function(){

    // Khi người dùng like bình luận
    $('.like-btn').on('click', function(){
        var comment_id = $(this).data('id');
        $clicked_btn = $(this);
        console.log($clicked_btn);

        // Với nút like , chỉ có thể chọn like hoặc unlike. no phải dislike
        if ($clicked_btn.hasClass('fa-regular') && $clicked_btn.hasClass('fa-thumbs-up')) {
            action = 'like';
        } else if ($clicked_btn.hasClass('fa-solid') && $clicked_btn.hasClass('fa-thumbs-up')){
            action = 'unlike';
        }

        $.ajax({
            type: 'post',
            url : 'job_apply_controller.php?rating_action',
            data: {
                'action': action,
                'comment_id': comment_id
            },
            success: function(data){
                console.log(data);
                res = JSON.parse(data);

                if(action == 'like'){
                    $clicked_btn.removeClass('fa-regular fa-thumbs-up');
                    $clicked_btn.addClass('fa-solid fa-thumbs-up');
                    
                }else if(action == 'unlike'){
                    $clicked_btn.removeClass('fa-solid fa-thumbs-up');
                    $clicked_btn.addClass('fa-regular fa-thumbs-up');
                }

                $clicked_btn.siblings('span.num_likes').text(res.likes);
                $clicked_btn.siblings('span.num_dislikes').text(res.dislikes);

                // Xoá class 'action_color' cho tất cả các nút dislike
                $clicked_btn.siblings('i.fa-solid.fa-thumbs-down').removeClass('fa-solid').addClass('fa-regular');
            }
        })
    })

    // Khi người dùng dislike bình luận
    $('.dislike-btn').on('click', function(){
        console.log(1);
        var comment_id = $(this).data('id');
        $clicked_btn = $(this);

        // Với nút like , chỉ có thể chọn like hoặc unlike. no phải dislike
        if ($clicked_btn.hasClass('fa-regular') && $clicked_btn.hasClass('fa-thumbs-down')) {
            action = 'dislike';
        } else if ($clicked_btn.hasClass('fa-solid') && $clicked_btn.hasClass('fa-thumbs-down')){
            action = 'undislike';
        }

        $.ajax({
            type: 'post',
            url : 'job_apply_controller.php?rating_action',
            data: {
                'action': action,
                'comment_id': comment_id
            },
            success: function(data){
                // console.log(data);
                res = JSON.parse(data);

                if(action == 'dislike'){
                    $clicked_btn.removeClass('fa-regular fa-thumbs-down');
                    $clicked_btn.addClass('fa-solid fa-thumbs-down');
                }else if(action == 'undislike'){
                    $clicked_btn.removeClass('fa-solid fa-thumbs-down');
                    $clicked_btn.addClass('fa-regular fa-thumbs-down');
                }

                $clicked_btn.siblings('span.num_likes').text(res.likes);
                $clicked_btn.siblings('span.num_dislikes').text(res.dislikes);

                // Xoá class 'action_color' cho tất cả các nút dislike
                $clicked_btn.siblings('i.fa-solid.fa-thumbs-up').removeClass('fa-solid').addClass('fa-regular');
            }
        })
    })
})