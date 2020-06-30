<?php
session_start();
require 'db/connect.php';
$enquiry = $pdo->prepare('SELECT * FROM faq');
$enquiry->execute();

if(isset($_POST['save'])){
        $stmt = $pdo->prepare("insert into 
                faq(name,enquiry,email,phone_number) values(:name,:enquiry,:email,:phone_number)");
       
        unset($_POST['save']);
          // echo '<pre>'; print_r($_POST); die();
        $stmt->execute($_POST);
        header('Location:faq.php?success=Faq Added Successfully');
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Faq page</title>
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
	 <div class="full-height" id="app">
 <?php include 'navbar.php' ?>
             
</head>
<body>
	

<div class="container">
 
  <div class="row">   
  <div class="col-sm-12 col-md-6">
     <a class="navbar-brand text-center" href="/">
            <img src="images/logocar.png"  width="50%"alt="car-logo"  class="" alt="Car image is here">
            
            <h3 style = "color:red">Query About Rent car</h3>
          
          </a>
  </div>
  <div class="col-sm-12 col-md-6">
  <form class="form-signin"  method="POST" action="" class="col-xl-6" enctype="multipart/form-data">
  <div class="form-group">
    <label style="font-size:20px">FAQ FORM</label><br>
      <div class="form-group row">
          <label for="email" class="col-md-4 control-label">UserName</label>
            <div class="col-md-6">
              <input type="name" class="form-control" name="name" value="" required autofocus>
            </div>

      </div>
      <div class="form-group row">
          <label for="email" class="col-md-4 control-label">email</label>
            <div class="col-md-6">
              <input type="email" class="form-control" name="email" value="" required autofocus>
            </div>

      </div>
      <div class="form-group row">
          <label for="email" class="col-md-4 control-label">Phone Number</label>
            <div class="col-md-6">
              <input type="name" class="form-control" name="phone_number" value="" required autofocus>
            </div>

      </div>
    
    <p class="p1">
    Message your FAQ here
    </p>

    <textarea class="form-control" name="enquiry" rows="1"></textarea>
    <br>
      <button class="btn btn-primary" name="save" type="submit" required autofocus>Submit </button>

    </form>
  </div>
</div>
</div>

</div>

<?php include 'footer.php' ?>
</body>
</html>