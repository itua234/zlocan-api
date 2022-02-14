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
                <form method="post" action="{{ route("auth.save") }}" novalidate>
                    @if(Session::get("success"))
                        <p class="alert alert-success">{{ Session::get("success") }}</p>
                    @endif

                    @if(Session::get("fail"))
                        <p class="alert alert-danger">{{ Session::get("fail") }}</p>
                    @endif
                    <h3 class="text-center" style="font-weight:bolder;">Sign up</h3>
                    @csrf
                    <div class="d-flex flex-column">
                        <input type="text" placeholder="Name" name="name" class="form-control form-control-border" value="{{ old("name") }}">
                        <p class="error">@error("name") {{ $message }} @enderror</p>
                    </div>
                    <div class="d-flex flex-column">
                        <input type="email" placeholder="Email" name="email" class="form-control form-control-border" value="{{ old("email") }}">
                        <p class="error">@error("email") {{ $message }} @enderror</p>
                    </div>
                    <div class="d-flex flex-column m-t-15">
                        <div class="d-flex" style="border:1px solid #e9ecef;">
                            <input type="password" placeholder="Password" name="password" class="form-control" id="toggle">
                            <span class="d-flex align-items-center justify-content-center p-r-10 p-l-10" onclick="togglePassword()"><i class="lni lni-eye"></i></span>
                        </div>
                        <p class="error">@error("password") {{ $message }} @enderror</p>
                    </div>
                    <span class="" style="font-size:12px;font-style:italic">By registering your details, you agree with our Terms & Conditions, and Privacy and Cookie Policy. </span>
                    <div class="form-check form-switch m-t-10">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Sign me up for the Newsletter! </label>
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