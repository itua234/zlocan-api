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
<section class="m-b-30 m-t-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-xl-5 col-md-6 col-sm-7" style="padding:20px;">
                <form id="loginForm" novalidate>
                
                    <h3 class="text-center" style="font-weight:bolder;">Ajax Practise</h3>
                    <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                    <div class="d-flex flex-column">
                        <input type="email" placeholder="Email" name="email" class="form-control form-control-border" id="email">
                        
                    </div>
                    <div class="d-flex flex-column m-t-15">
                        <div class="d-flex" style="border:1px solid #e9ecef;">
                            <input type="password" placeholder="Password" name="password" class="form-control" id="toggle">
                            <span class="d-flex align-items-center justify-content-center p-l-10 p-r-10" onclick="togglePassword()"><i class="lni lni-eye"></i></span>
                        </div>
                    
                    </div>
                    <div class="d-flex justify-content-between m-t-10">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="remember" value="remember">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Remember Me</label>
                        </div>
                        <div class="">
                            <p class="text-center" style=""><a href="" class="text-decoration-none" style="color:#00004e;">Forgot password?</a></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary rounded-all w-full">Submit</button>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</section>



<script href="{{ asset("js/jquery-3.4.1.min.js") }}"></script>
<script>
    document.getElementById("loginForm").addEventListener("submit", (event) => {
        event.preventDefault();
        let formData = {
            email : document.getElementById("email").value,
            password : document.getElementById("toggle").value,
            remember : document.getElementById("flexSwitchCheckDefault").value,
            _token : document.getElementById("_token").value
        };

        const url = '{{ route("auth.ajax") }}';
        let fetchData = {
            method : "POST",
            body: JSON.stringify(formData),
            headers : new Headers({
                'Content-Type' : 'application/json; charset=UTF-8'
            })
        };
        fetch(url, fetchData)
        .then(function(response){
            if(response.status == 201){
                return response.json();
            }else{
                alert("error in registration");
            }
        })
        .then(function(data){
            if(data){
                alert(data.message);
            }
        })
        .catch(function(){

        })
    })
</script>
<script>
    function togglePassword(){
        var toggle = document.getElementById('toggle');
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