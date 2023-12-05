
const form = document.querySelector('.form_job_detail');

// if(form != null){
    $('.form_job_detail').submit(function(e){

        e.preventDefault();

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
                    alert(response.status);
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
        
    })

const enter_comment = document.getElementById('enter_comment');
const append_show_comment = document.querySelector('.show_comments')
const show_name_comment = document.querySelector('.span_name');
const show_content = document.querySelector('.user_content lable');
const nick_name = document.getElementById('nick_name');

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
                alert(data);
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

const btn_like = document.querySelectorAll('.like');
const btn_dislike = document.querySelectorAll('.dislike');
const id_comment = document.querySelectorAll('.id_comment');
const num_like = document.querySelectorAll('.num_like');
const num_dislike = document.querySelectorAll('.num_dislike');

btn_like.forEach(function(element,index){
    element.addEventListener('click', function(e){
        e.preventDefault();
        if(nick_name.value != ''){
            var number_like;
            var number_dislike;
            if(btn_like[index].classList.contains('action_color') == false){
                number_like = parseInt(num_like[index].innerHTML) + 1;
            }else{
                number_like = parseInt(num_like[index].innerHTML) - 1;
            }

            if(btn_dislike[index].classList.contains('action_color') == true){
                number_dislike = parseInt(num_dislike[index].innerHTML) - 1;
            }else{
                number_dislike = parseInt(num_dislike[index].innerHTML);
            }

            $.ajax({
                type: 'post',
                url : 'job_apply_controller.php?like_or_dislike='+id_comment[index].value+'',
                data: [
                    {name: 'num_like', value: number_like},
                    {name: 'num_dislike', value:number_dislike}
                ]
        
            })
            .done(function(data){
                element.classList.toggle('action_color');
                btn_dislike[index].classList.remove('action_color');
                num_dislike[index].innerHTML = number_dislike;
                num_like[index].innerHTML = number_like;
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
    })
});


btn_dislike.forEach(function(element,index) {
    element.addEventListener('click', function(e){
        e.preventDefault();
        
        if(nick_name.value != ''){
            var number_like;
            var number_dislike;

            if(btn_dislike[index].classList.contains('action_color') == false){
                number_dislike = parseInt(num_dislike[index].innerHTML) + 1;
            }else{
                number_dislike = parseInt(num_dislike[index].innerHTML) - 1;
            }

            if(btn_like[index].classList.contains('action_color') == true){
                number_like = parseInt(num_like[index].innerHTML) - 1;
            }else{
                number_like = parseInt(num_like[index].innerHTML);
            }
        
            $.ajax({
                type: 'post',
                url : 'job_apply_controller.php?like_or_dislike='+id_comment[index].value+'',
                data: [
                    {name: 'num_like', value: number_like},
                    {name: 'num_dislike', value:number_dislike}
                ]
        
            })
            .done(function(data){
                // alert(data)
                element.classList.toggle('action_color');
                btn_like[index].classList.remove('action_color');
                num_dislike[index].innerHTML = number_dislike;
                num_like[index].innerHTML = number_like;
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
        
    })
});
