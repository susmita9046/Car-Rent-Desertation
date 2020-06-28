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
    <link rel="stylesheet" type="text/css" href="./css/style.css">
  <link rel="stylesheet" type="text/css" href="./css/fnavbar.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="js/menuToggle.js"></script>

</head>
<body>
<div class="full-height">
   <?php include 'navbar.php' ?> 
   </div> 
<br> 
<div class="container">
    <div class="row">     
        <div class="col-lg-6 col-md-8 col-sm-12 login-form"> 
             <?php
                 if(isset($_GET['success'])){
                  echo '<h4 style="color:green">' . $_GET['success'] .'</h4>';
                      }
            ?>
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
            <div class = " col-lg-6 col-md-4 col-sm-12">
                <div class="map-div">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1222898.9729967888!2d-3.55072739827423!3d53.227269000000014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487add9d7c4b2fe7%3A0x1458b55b7024e327!2sChester%20Zoo!5e0!3m2!1sen!2snp!4v1592031657925!5m2!1sen!2snp" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>
<?php include 'footer.php' ?>