<?php
//connection to database
require 'db/connect.php';
$error='';
if(isset($_POST['Submit'])){
    
    $regis = $pdo->prepare("INSERT INTO user(username,email,password,citizenship_no,location,Phone_Number,type) VALUES (:username,:email,:password,:citizenship_no,:location,:Phone_Number,:type)");
         $criteria = [
            'username'=> $_POST['username'],
            'email'  => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'citizenship_no'=> $_POST['citizenship_no'],
            'location' => $_POST['location'],
            'Phone_Number' => $_POST['Phone_Number'],
            'type' => 0
          ];
        
        if($regis->execute($criteria))  {
           $msg = 'User Register';
            header('Location:login.php');
        }
        else{
            echo 'Not registered';
        } 
}
?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="./css/fnavbar.css">
    
   <script type="text/javascript">
        function validate(form){
            if(form.username.value == ''){
                alert('Please enter username');
                form.username.focus();
                return false;
            }
            if(form.email.value == ''){
                alert('Please enter email');
                form.email.focus();
                return false;
            }
            if(form.password.value == ''){
                alert('Please enter password');
                form.password.focus();
                return false;
            }
            if(form.password_confirm.value == ''){
                alert('Please enter password again');
                form.password_confirm.focus();
                return false;
            }
            if(form.password.value != form.password_confirm.value){
                alert('Password and confirm password do not match');
                form.password_confirm.focus();
                return false;
            }  
             if(form.citizenship_no.value == ''){
                alert('Please enter citizenship_no');
                form.citizenship_no.focus();
                return false;
            }
        }
   </script>

</head>
<body>
     <div class="full-height" id="app">
 <nav class="navbar  navbar-expand-lg navbar-light bg-light">

<a class="navbar-brand" href="/">
 <img src="images/logocar.png"  alt="car-logo" width="60" height="40" class="d-inline-block align-top" alt="">
Arena Car
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
 <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarTogglerDemo02">

 <ul class="nav navbar-nav ml-auto">
                     <li><a href="home.php" >HOME</a></li>
                     <!-- Authentication Links -->
                       <li><a href="contact.php" >CONTACT</a></li>
                       <li><a href="faq.php" >FAQ</a></li>
                    
                        <li><a href="login.php" ><i class="fas fa-door-open"></i> LOGIN</a></li>


                        <li><a href="register.php"> <i class="fas fa-user-edit"></i> REGISTER</a></li>

                 
                 </ul>

</div>
</nav>
            <BR>
            <BR>
            <BR>      
       
<div class="container">
<div class="row">
        <div class = "col-md-6">
            <a class="navbar-brand text-center" href="/">
            <img src="images/logocar.png"  width="100%"alt="car-logo"  class="" alt="Car image is here">
            <h3 style = "color:red">Login to hire a car</h3>
            </a>
</div>
    <div class="col-md-6 login-form"> 
        <h1 class = "text-center" style = ";  ">Register</h1>
<div class = "loglog" >
<form method="post" action="" onsubmit="return validate(this)">    
<div class="form-group row">
                        
<label for="username" class="col-md-4 col-form-label text-md-right">Name</label>
    <div class="col-md-6">
        <input id="username" type="text" class="form-control" name="username" value=""  autocomplete="name" autofocus>
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
        <div class="col-md-6">
            <input id="email" type="email" class="form-control " name="email" value="" autocomplete="email">
        </div>
</div>
<div class="form-group row">
    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
    <div class="col-md-6">
        <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
    </div>
</div>
<div class="form-group row">
     <label for="confirm_password" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
    <div class="col-md-6">
        <input id="confirm_password" type="password" class="form-control" name="password_confirm" autocomplete="new-password">
     </div>
</div>

<div class="form-group row">
    <label for="citizenship_no" class="col-md-4 col-form-label text-md-right">Citizenship Number</label>
<div class="col-md-6">
    <input id="citizenship_no" type="text" class="form-control" name="citizenship_no" >
</div>
</div>

<div class="form-group row">
    <label for="location" class="col-md-4 col-form-label text-md-right">Location</label>
<div class="col-md-6">
    <input id="location" type="text" class="form-control" name="location" >
</div>
</div>

<div class="form-group row">
    <label for="Phone_Number" class="col-md-4 col-form-label text-md-right">Phone Number</label>
<div class="col-md-6">
    <input id="Phone_Number" type="text" class="form-control" name="Phone_Number" >
</div>
</div>
<hr>
<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
         <button type="submit" name="Submit" class="btn btn-primary btn-block">
                                   Register
                                    <?php if(!empty($msg)) echo $msg; ?>
        </button>

            <a href="" class="btn btn-danger btn-block"><i class="fab fa-google-plus-g"></i> Register With Google</a>
    </div>
</div>
<div class="form-group row mb-0 text-center">
    <div class="col-md-6 offset-md-4">
        <h6 class = "text-center">Already a user? <a href = "" class = "text-primary">Login</a></h6>
</div>
</div>
<div class="form-group row mb-0 text-center">
    <div class="col-md-6 offset-md-2">
        <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
        </div>
    </div>
</div>  
</form>
                </div>
            </div>
        </div>
    </div>
</div>         
</div>
<br>
<br>
<br>
<div class="container-fluid foot" style = "margin-top: 150px;">
    <div class="text-center">
        <a href="#" class="foota">About</a>
        <a href="#" class="foota"> Contact</a>
        <a href="#" class="foota">Help</a> <br>
        Copyright 2019. All Rights Reserved
    </div>
</div>
</body>
</html>