<?php
//connection to database
require 'db/connect.php';
$error='';
if(isset($_POST['Submit'])){
    
    if($_POST['username'] == ''){
        $usernameError = 'USername can not be empty';
    }

    $user = $pdo->prepare('select * from user where email = :email');
    $criteria = [
        'email' => $_POST['email']
    ];
    $user->execute($criteria);

    $userByCN = $pdo->prepare('select * from user where citizenship_no = :citizenship_no');
    $criteria = [
        'citizenship_no' => $_POST['citizenship_no']
    ];
    $userByCN->execute($criteria);

    if($user->rowCount() > 0){
        $emailError = 'Supplied email already exists';
    }
    else if($userByCN->rowCount() > 0){
        $citizenshipNumbernError = 'Supplied Citizenship Number already exists';
    }
    else{
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
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Register Page</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
  <link rel="stylesheet" type="text/css" href="./css/fnavbar.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="js/menuToggle.js"></script>
<style type="text/css">
    .red{
        color: red;
    }
</style>

<script type="text/javascript">
    function validate(form){
        var check = true;
        var letters = /^[ A-Za-z]+$/;
        if(form.username.value == '' || !form.username.value.match(letters)){
            // document.getElementById('error-name').innerHTML = 'Invalid Name';
            document.getElementById('username-error').innerHTML = 'Invalid name';
            check = false;
        }

        if(form.email.value == ''){
            // alert('Please enter email');
            document.getElementById('email-error').innerHTML = 'Please enter email';
            check = false;
        }
        if(form.password.value == ''){
            // alert('Please enter password');
            document.getElementById('password-error').innerHTML = 'Please enter password';
            check = false;
        }
        if(form.password_confirm.value == ''){
            // alert('Please enter password again');
            document.getElementById('pw-error').innerHTML = 'Please enter password';
            check = false;
        }
        if(form.password.value != form.password_confirm.value){
            // alert('Password and confirm password do not match');
            document.getElementById('pw-error').innerHTML = 'Please enter correct password ';
            check = false;
        }  
        if(form.password.value.length < 6 || form.password_confirm.value.length < 6){
            document.getElementById('pw-error').innerHTML = 'Password must be atleaset 6 characters';
            check = false;
        }
        var number = /^[0-9]+$/;
         if(form.citizenship_no.value == '' || !form.citizenship_no.value.match(number) || form.citizenship_no.value.length != 6){
            document.getElementById('Citizenship-error').innerHTML = 'Invalid citizenship number';
            check = false;
        }

        if(form.location.value == ''){
            document.getElementById('location-error').innerHTML = 'Please enter Citizenship no';
            check = false;
        }

        var number = /^[0-9]+$/;
        if(form.Phone_Number.value == '' || !form.Phone_Number.value.match(number) || form.Phone_Number.value.length != 10){
            // document.getElementById('error-name').innerHTML = 'Invalid Name';
            document.getElementById('Phone-error').innerHTML = 'Invalid Phone number';
            check = false;
        }
        return  check;
    }
</script>

</head>
<body>
     <div class="full-height" id="app">
 <?php include 'navbar.php' ?>
            <BR>
            <BR>
            <BR>      
       
<div class="container">
<div class="row">
        <div class = "col-md-6">
            <a class="navbar-brand text-center" href="/">
            <img src="images/logocar.png"  width="100%"alt="car-logo"  class="" alt="Car image is here">
            <h3 style = "color:red">Register to hire a car</h3>
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
        <span id="username-error" class="red">
            <?php if(!empty($usernameError)) echo $usernameError; ?>
        </span>
        <span id="username-error" class="red"></span>
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
        <div class="col-md-6">
            <input id="email" type="email" class="form-control " name="email" value="" autocomplete="email">
            <span id="email-error" class="red">
                <?php if(!empty($emailError)) echo $emailError; ?>
            </span>
        </div>
</div>
<div class="form-group row">
    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
    <div class="col-md-6">
        <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
        <span id="password-error" class="red"></span>
    </div>
</div>
<div class="form-group row">
     <label for="confirm_password" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
    <div class="col-md-6">
        <input id="confirm_password" type="password" class="form-control" name="password_confirm" autocomplete="new-password">
     </div>
     <span id="pw-error" class="red"></span>
</div>

<div class="form-group row">
    <label for="citizenship_no" class="col-md-4 col-form-label text-md-right">Citizenship Number</label>
<div class="col-md-6">
    <input id="citizenship_no" type="text" class="form-control" name="citizenship_no" >
    <span id="email-error" class="red">
        <?php if(!empty($citizenshipNumbernError)) echo $citizenshipNumbernError; ?>
    </span>
</div>
 <span id="Citizenship-error" class="red"></span>
</div>

<div class="form-group row">
    <label for="location" class="col-md-4 col-form-label text-md-right">Location</label>
<div class="col-md-6">
    <input id="location" type="text" class="form-control" name="location" >
</div>
<span id="location-error" class="red"></span>
</div>

<div class="form-group row">
    <label for="Phone_Number" class="col-md-4 col-form-label text-md-right">Phone Number</label>
<div class="col-md-6">
    <input id="Phone_Number" type="text" class="form-control" name="Phone_Number" >
</div>
<span id="Phone-error" class="red"></span>
</div>
<hr>
<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
         <button type="submit" name="Submit" class="btn btn-primary btn-block">
                                   Register
                                    <?php if(!empty($msg)) echo $msg; ?>
        </button>
    </div>
</div>
<div class="form-group row mb-0 text-center">
    <div class="col-md-6 offset-md-4">
        <h6 class = "text-center">Already a user? <a href = "login.php" class = "text-primary">Login</a></h6>
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
<?php include 'footer.php' ?>
</body>
</html>