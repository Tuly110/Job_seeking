$("#submit_apply").on("submit", function(event)
{
    event.preventDefault();
    alert("okla");
    console.log($(this).serializeArray())
    $.ajax({
        
        type: "POST",
        url : 'check_apply_admin.php?id_apply=' + $('#id_apply').val(),
        data: $(this).serializeArray(),
        success:function(data)
        {
            res =JSON.parse(data);
            console.log("res: ", res)
            if(res.status == '0'){
                Swal.fire({
                    
                    title: 'Apply success',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = "list_apply.php";
                })
            }else{
                Swal.fire({
                    title: 'Apply fail',
                    icon: 'warning',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = "list_apply.php";
                })
            }
        }
        

    })
   
})




