<?php 
    session_start();

    if(isset($_SESSION['UserId'])){
        header('Location:userprofile.php');
    }

    require 'db/connect.php';

    if(isset($_POST['login'])){
        $stmt = $pdo->prepare('SELECT * FROM user WHERE email = :email and type = :type');
        $criteria = [
            'email' => $_POST['email'],
            'type' => 0
        ];
        $stmt->execute($criteria);
        if($stmt->rowCount() > 0){
            $user = $stmt->fetch();
            if(password_verify($_POST['password'],$user['password'])){
                $_SESSION['UserId'] = $user['id'];
                header('Location:userprofile.php');
            }else{
                header('Location:login.php');
            }
        }
        else{
            echo 'Invalid Credentials. Please try again';
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
            <h1 class = "text-center" style = "">Login</h1>
            <hr>
        <div class = "loglog" >
                    <form class="form-horizontal" method="POST" action="" onsubmit="return validate(this)">
                       

                        <div class="form-group row">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" required autofocus>

                              
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" name="login">
                                <i class="fas fa-door-open"></i> Login
                                </button>
                                <a href="" class="btn btn-danger"><i class="fab fa-google-plus-g"></i> Login With Google</a>

                                <a class="btn btn-link text-secondary" href=""> 
                                    Forgot Your Password?
                                </a>
                            </div>
                            <div class="form-group">
                            <div class="g-signin2" data-onsuccess="onSignIn"></div>
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

<div class="container-fluid foot">
    <div class="text-center">
        <a href="#" class="foota">About</a>
        <a href="#" class="foota"> Contact</a>
          <a href="#" class="foota"> FAQ</a>
        <a href="#" class="foota">Help</a> <br>
        Copyright 2019. All Rights Reserved
    </div>
</div>

          
</body>
</html>