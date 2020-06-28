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
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/style.css"> 
  <link rel="stylesheet" type="text/css" href="../css/fnavbar.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="js/menuToggle.js"></script>
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
		
		
    </style>
	
</head>
<body>
	 <div class="full-height" id="app">
 <?php include 'admin-navbar.php' ?>
            <BR>
            <BR>
            <BR>      
       
       <div class="container">
    <div class="row">

        <div class="col-md-8 login-form mr-auto ml-auto"> 
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

<!-- <div class="container-fluid footer-admin ">
    <div class="text-center">
        <a href="#" class="foota">About</a>
        <a href="#" class="foota"> Contact</a>
          <a href="#" class="foota"> FAQ</a>
        <a href="#" class="foota">Help</a> <br>
        Copyright 2019. All Rights Reserved
    </div>
</div> -->

<?php include '../footer.php' ?>

          
</body>
</html>