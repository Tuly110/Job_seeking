
// $('#btn_submit').click(function(){
//     console.log(1);
// });

ClassicEditor
    .create( document.querySelector( '#Job_requirements' ) )
    .catch( error => {
        console.error( error );
} );

ClassicEditor
    .create( document.querySelector( '#job_description' ) )
    .catch( error => {
        console.error( error );
} );

document.getElementById('fileImg').onchange = function(){
    document.getElementById('image').src = URL.createObjectURL(fileImg.files[0])
}
