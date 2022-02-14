<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <!-- SEO Meta Tags-->
  <meta name="description" content="Cartzilla - Bootstrap E-commerce Template">
  <meta name="keywords" content="bootstrap, shop, e-commerce, market, modern, responsive,  business, mobile, bootstrap, html5, css3, js, gallery, slider, touch, creative, clean">
  <meta name="author" content="Createx Studio">
  <!-- Viewport-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
  
    <title>Cartzilla | Fashion Store v.2</title>
    <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset("css/normalize.css") }}">
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset("css/util.css") }}">
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset("css/main.css") }}">
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset("css/bootstrap.css") }}">
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset("css/main-app.css") }}">
</head>
<style type="text/css">
    .error{
        color:red;
        font-size:14px;
    }
</style>
<section class="m-t-80 m-b-30">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-xl-5 col-md-6 col-sm-7" style="padding:20px;">
                <form id="loginForm" novalidate>
                    <h3 class="text-center" style="font-weight:bolder;">Sign up</h3>
                    <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

                    <div class="d-flex flex-column">
                        <input type="text" placeholder="Name" id="name" name="name" class="form-control form-control-border" value="">
                        <p class="error">@error("name") {{ $message }} @enderror</p>
                    </div>

                    <div class="d-flex flex-column">
                        <input type="email" placeholder="Email" id="email" name="email" class="form-control form-control-border" value="">
                        <p class="error">@error("email") {{ $message }} @enderror</p>
                    </div>

                    <div class="d-flex flex-column m-t-15">
                        <div class="d-flex" style="border:1px solid #e9ecef;">
                            <input type="password" placeholder="Password" name="password" class="form-control" id="password">
                            <span class="d-flex align-items-center justify-content-center p-r-10 p-l-10" onclick="togglePassword()"><i class="lni lni-eye"></i></span>
                        </div>
                        <p class="error">@error("password") {{ $message }} @enderror</p>
                    </div>
                   
                    <div class="d-flex justify-content-end m-t-20">
                        <button type="submit" name="submit" class="btn btn-primary rounded-all w-full">Sign Up</button>
                    </div>
                </form>
                <p class="m-t-10">Already have an account?<a href="{{ route("auth.login") }}" style="color:#00004e;padding-left:5px;display:inline-block;">Sign In</a></p>
            </div>
        </div>  
    </div>
</section>


<script href="{{ asset("js/jquery-3.4.1.min.js") }}"></script>
<script>
    document.getElementById("loginForm").addEventListener("submit", (event) => {
        event.preventDefault();
        let formData = {
            name : document.getElementById("name").value,
            email : document.getElementById("email").value,
            password : document.getElementById("password").value,
            _token : document.getElementById("_token").value
        };

        const url = '{{ route("auth.reg") }}';
        let fetchData = {
            method : "POST",
            body: JSON.stringify(formData),
            headers : new Headers({
                'Content-Type' : 'application/json; charset=UTF-8'
            })
        };
        fetch(url, fetchData)
        .then(function(response){
            /*if(response.status == 201){
                return response.json();
            }else{
                alert("error in registration");
            }*/
            return response.json();
        })
        .then(function(data){
            if(data){
                console.log(data);
            }
        })
        .catch(function(){

        })
    })
</script>
<script>
    function togglePassword(){
        var toggle = document.getElementById('password');
        switch(true){
            case(toggle.type === "password"):
                toggle.type = "text";
            break;
            default:
                toggle.type = "password";
        }
    }
</script>
</body>
</html>