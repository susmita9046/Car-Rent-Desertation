<?php
session_start();
require 'db/connect.php';
$contac = $pdo->prepare('SELECT * FROM contact');
$contac->execute();

if(isset($_POST['save'])){
        $stmt = $pdo->prepare("insert into 
                contact(name,email,number,subject,message) values(:name,:email,:number,:subject,:message)");
        unset($_POST['save']);
        // echo '<pre>'; print_r($_POST); die();
        $stmt->execute($_POST);
        header('Location:contact.php?success=contacts Added Successfully');
        // echo "contact added Successfully";
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Contact Page</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
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
<div class="full-height">
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
<br> 
<div class="container">
    <div class="row">
       
        <div class="col-md-6 login-form"> 
            <h1 class = "text-center">Contact Us</h1>
            <hr>
            <div class = "loglog" >
            <form class="form-horizontal" method="POST" action="" onsubmit="return validate(this)">
                <div class="form-group row">
                    <label for="email" class="col-md-4 containerrol-label">Name</label>
                    <div class="col-md-6">
                        <input type="name" class="form-control" name="name" value="" required autofocus>
                    </div>
                </div>
                 <div class="form-group row">
                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                    <div class="col-md-6">
                        <input type="email" class="form-control" name="email" value="" required autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone number" class="col-md-4 control-label">Phone Number</label>
                    <div class="col-md-6">
                        <input  class="form-control" name="number" required autofocus>
                    </div>
                </div>
                </div> 
                <div class="form-group row">
                    <label class="col-md-4" class="col-md-4 control-label">Subject</label>
                    <div class="col-md-6">
                        <input class="form-control" name="subject" required autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4" class="col-md-4 control-label">Message</label>
                    <div class="col-md-6">
                        <textarea class="form-control" name="message" rows="3"></textarea>
                    </div>
                </div>
                <button class="btn btn-primary" name="save" type="submit">Submit </button>
            </form>
                </div>
                </div>
            <br>
               <div class = "col-md-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1222898.9729967888!2d-3.55072739827423!3d53.227269000000014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487add9d7c4b2fe7%3A0x1458b55b7024e327!2sChester%20Zoo!5e0!3m2!1sen!2snp!4v1592031657925!5m2!1sen!2snp" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
              </div>
        </div>
         
    </div>
</div>  
</div> 
</body>
</html>