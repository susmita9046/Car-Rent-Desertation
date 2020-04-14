<?php 
	session_start();

	if(isset($_SESSION['aUserId'])){
		header('Location:index.php');
	}

	require '../db/connect.php';

	if(isset($_POST['login'])){
		$stmt = $pdo->prepare('SELECT * FROM user WHERE email = :email and type in(1, 2)');
		$criteria = [
			'email' => $_POST['email']
		];
		$stmt->execute($criteria);
		if($stmt->rowCount() > 0){
			$user = $stmt->fetch();
			if(password_verify($_POST['password'],$user['password'])){
				$_SESSION['aUserId'] = $user['id'];
				header('Location:index.php');
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
<script type="text/javascript">
        function validate(form){
           
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
            
        }
</script>
<style type="text/css">
		
		
        .full-height {
            height: 100vh;
            
        }
        .border{
            border-color:rgba(99, 107, 111, 0.3) !important;
            border-width: 0 0 0px;
        }
        .grey-glow:focus{
            border-color: #636F6B;
            outline: 0;
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgb(208, 210, 212);
        }
        .grey-button{
            color: #636F6B;
            background-color: white;
            border-color: rgba(99, 107, 111, 0.3);
        }
        

        a{
            color:  whitesmoke !important;
        }
        
        .li-padding{
            padding-top: 10px;
        }
        .li-padding li{

            padding-left: 20px;
        }
        h1{
            color:#636F6B;
        }
        .logout{
            padding-left:0px !important;
        }
        .nav > li >a:hover{
           
            background-color:#871C13 !important;
            color:#F89D13 !important;
        }
        .nav > li >a{
           
          
           
       }
        .navbar
        {
           background-color: #3f4269 !important;
           color:red;
        }
        .navbar-brand
        {
            color:whitesmoke !important;
            font-family:"Brush Script MT", cursive;
            font-size:30px !important;
        }
        .dropdown-menu
        {
            background-color:#273746;
        }
        .nav > li >a {
    margin-left: 45px;
}
    </style>
	
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

</div>
</nav>
            <BR>
            <BR>
            <BR>      
       
       <div class="container">
    <div class="row">

        <div class="col-md-12 login-form"> 
            <h1 class = "text-center" style = "">Login</h1>
            <hr>
        <div class = "loglog" >
                    <form class="form-horizontal" method="POST" action="" onsubmit="return validate(this)">
                       

                        <div class="form-group row">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" autofocus>

                              
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" >

                            </div>
                        </div>

                       

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" name="login">
                                <i class="fas fa-door-open"></i> Login
                                </button>

                                <!-- <a class="btn btn-link text-secondary" href=""> 
                                    Forgot Your Password?
                                </a> -->
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