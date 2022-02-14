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
                <form method="post" action="{{ route("auth.check") }}" novalidate>
                    @if(Session::get("success"))
                        <p class="alert alert-success">{{ Session::get("success") }}</p>
                    @endif

                    @if(Session::get("fail"))
                        <p class="alert alert-danger">{{ Session::get("fail") }}</p>
                    @endif
                    <h3 class="text-center" style="font-weight:bolder;">Sign In</h3>
                    @csrf
                    <div class="d-flex flex-column">
                        <input type="email" placeholder="Email" name="email" class="form-control form-control-border" value="{{ old("email") }}">
                        <p class="error">@error("email") {{ $message }} @enderror</p>
                    </div>
                    <div class="d-flex flex-column m-t-15">
                        <div class="d-flex" style="border:1px solid #e9ecef;">
                            <input type="password" placeholder="Password" name="password" class="form-control" id="toggle">
                            <span class="d-flex align-items-center justify-content-center p-l-10 p-r-10" onclick="togglePassword()"><i class="lni lni-eye"></i></span>
                        </div>
                        <p class="error">@error("password") {{ $message }} @enderror</p>
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
                        <button type="submit" class="btn btn-primary rounded-all w-full">Sign In</button>
                    </div>
                </form>
                <p class="m-t-10">Don't have an account?<a class="text-decoration-none" href="{{ route("auth.register") }}" style="color:#00004e;padding-left:5px;display:inline-block;">Sign up</a></p>
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