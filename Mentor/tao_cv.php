<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile and CV</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <title>Hello, world!</title> -->
   
    <style>
    .upload img {
        border: 2px solid rgb(208, 207, 207);
        width: 240px;
        height: 240px;
        object-fit: cover;
        object-position: center;
        overflow: hidden;
        border-style: dotted;
        padding: 5px;
    }
    .personal_infor{
        /* padding: 10px; */
    }
    .form_input{
    padding: 10px;
    border: none;
    /* border-bottom:1px solid rgba(170, 188, 219, 0.2) ; */
    outline: none;
    transition: 0.25s ease;
    z-index: 1;
    background-color: transparent;
}

.small_under{
    display: block;
    width:0;
    height: 2px;
    transition: .3s ease-in-out;
    position: absolute;
    bottom: 0;
    background-color: #203d6e;
}
.form_input:focus ~ .small_under{
    width:100%;
    background-color: #203d6e;
}

.your_name{
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    font-size: 50px;
}

/* .form_field{
    position: relative;
    margin-bottom: 10px;
    
} */
.text{
    text-align: center;
    border: none;
}
.upload{
    width: 125px;
    position: relative;
    /* margin: auto; */
    text-align: center;
    }

    .upload img{
        border: 2px solid rgb(208, 207, 207);
        width: 240px;
        height: 240px;
        object-fit: cover;
        object-position: center;
        overflow: hidden;
        border-style: dotted;
        padding: 5px;
    }

    .upload .rightRound{
        position: absolute;
        bottom: 16px;
        left: 20px;
        width: 205px;
        height: 205px;
        line-height: 33px;
        text-align: center;
        overflow: hidden;
        cursor: pointer;  
    }

    .upload input{
        position: absolute;
        transform: scale(10);
        opacity: 0;
    }
    </style>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-4 col-md-5">
                <div class="into-image">
                    <!-- <input type="file"  name="hinhanh"> -->
                    <input type="hidden" name="id" id="" value = "<?php !empty($_SESSION['user_admin'])?$user['ID']:'' ?>)">
                    <div class=upload>
                        <img src="../NiceAdmin/assets/img/Choose_Image.jpg" id="image" alt="">
                        <div class="rightRound" id="upload">
                            <input type="file" name="fileImg" id="fileImg" accept=".pdf">
                            <!-- <span class='fa'>+</span> -->
                        </div>
                    </div> 
                </div>
                <div class="personal_infor">
                    <div class="phone pt-2">
                        <div class="form_field">
                            <i class="fa-solid fa-phone"></i>
                            <input type="phone" class="form_input" name="phone" id="" placeholder="Your phone ">
                        </div>
                    </div>
                    <div class="address pt-2">
                        <div class="form_field">
                            <i class="fa-solid fa-location-dot"></i>
                            <input type="address" class="form_input" name="address" id="" placeholder="Your address ">
                        </div>
                    </div>
                    <div class="email pt-2">
                        <div class="form_field">
                            <i class="fa-solid fa-envelope"></i>
                            <input type="email" class="form_input" name="email" id="" placeholder="Your email ">
                        </div>
                    </div>
                </div>
                <div class="education p-1">
                    <label for="education" style="vertical-align: top; font-weight: 700;">Education</label> <br>
                    <textarea style="border-left-style: ridge;" class="text" name="education" id="education" cols="20" rows="2" placeholder="Enter here"></textarea>
                </div>
                <div class="expertise p-1">
                    <label for="expertise" style="vertical-align: top; font-weight: 700;">Expertise</label> <br>
                    <textarea style="border-left-style: ridge;" class="text" name="expertise" id="expertise" cols="20" rows="2" placeholder="Enter here"></textarea>
                </div>
                <div class="language p-1">
                    <label for="language" style="vertical-align: top; font-weight: 700;">Language</label> <br>
                    <textarea style="border-left-style: ridge;" class="text" name="language" id="language" cols="20" rows="2" placeholder="Enter here"></textarea>
                </div>
                
            </div>
            <div class="col-8 col-md-7">
                <div class="your_name p-1">
                    <div class="form_field">
                        <input type="email" class="form_input" name="email" id="" placeholder="Your name">
                        <small class="small_under"></small>
                    </div>
                </div>
                <hr>
                <div class="about_me p-1">
                    <label for="about_me" style="vertical-align: top; font-weight: 700;">About me</label> <br>
                    <textarea class="text" name="about_me" id="about_me" cols="40" rows="3" placeholder="Enter here"></textarea>
                </div>
                <div class="work_experience p-1">
                    <label for="work_experience" style="vertical-align: top; padding: 10px; font-weight: 700;">Work experience</label>
                    <div  class="p-2">
                        <textarea style="border-left-style: ridge;" class="text" name="work_experience" id="work_experience" cols="40" rows="3" placeholder="Enter here"></textarea>
                    </div>
                    <div  class="p-2">
                        <textarea style="border-left-style: ridge;" class="text" name="work_experience" id="work_experience" cols="40" rows="3" placeholder="Enter here"></textarea>
                    </div>
                    <div  class="p-2">
                        <textarea style="border-left-style: ridge;" class="text" name="work_experience" id="work_experience" cols="40" rows="3" placeholder="Enter here"></textarea>
                    </div>
                </div>
                <div class="reference p-1">
                    <label for="reference" style="vertical-align: top; font-weight: 700;">References</label> <br>
                    <textarea class="text" name="reference" id="reference" cols="40" rows="3" placeholder="Enter here"></textarea>
                </div>
            </div>
        </div>
    </div>
    <script>
        
        document.getElementById('fileImg').onchange = function(){
            document.getElementById('image').src = URL.createObjectURL(fileImg.files[0])
        }
    </script>
    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="../NiceAdmin/assets/js/add_info.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  </body>
</html>