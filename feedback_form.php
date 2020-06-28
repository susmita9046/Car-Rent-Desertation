
<?php
session_start();
    if(!isset($_SESSION['UserId'])){
        header('Location:login.php');
    }

    require 'db/connect.php';

    $carId = $_GET['carId'];
    $model = $pdo->prepare("select model.id, model.name from car join model on car.modelId = model.id where car.id = '$carId'");
    $model->execute();
    $model = $model->fetch();

    if(isset($_POST['save'])){
        $stmt = $pdo->prepare("insert into 
                feedbacks(modelId,feedback,service,userId) values(:modelId,:feedback,:service,:userId)");
        $_POST['userId']= $_SESSION['UserId'];
        unset($_POST['save']);
        // echo '<pre>'; print_r($_POST); die();
        $stmt->execute($_POST);
        header('Location:viewfeedback.php?msg=feedback Added Successfully');
    }
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/fnavbar.css">
    <link rel="stylesheet" type="text/css" href="css/styll.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="js/menuToggle.js"></script>
    
    <style>
        textarea#opinion {
            width: 100%;
        }
    </style>

</head>
<body>

<div class="full-height" id="app">
<?php include 'user-nav-bar.php' ?>
<br><br>
<div class="container">
    <div class="row">

        <div class="col-md-8 login-form mr-auto ml-auto"> 
            <h1 class = "text-center" style = "">Feedback Form</h1>
            <hr>
        <div class = "loglog" >
                    <!-- <form class="form-signin"  method="POST" action="" class="col-xl-6" enctype="multipart/form-data"> -->
                    <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                        <div class="form-group row">
                           <label for="name" class="col-md-4 control-label">Car Model</label>
                                <div class="col-md-6">
                                    <?php echo $model['name'];?>
                                    <input type="hidden" name="modelId" value="<?php echo $model['id'];?>">
                                </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-md-4 control-label">Are You Happy With OurService?</label>
                            <div class="col-md-6">
                                <select class="form-control grey-glow" name="service" required="">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>  
                                </select>                              
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="opinion" class="col-md-4 control-label">Your FeedBack</label>
                            <div class="col-md-6">
                                <textarea id="opinion" name="feedback" cols="55" rows="5" required=""></textarea>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="save" class="btn btn-primary" name="save">
                                <!-- <i class="fas fa-door-open"></i> -->
                                 Submit
                                </button>
                                <a href="userprofile.php" type="btn" class="btn btn-danger">
                                <!-- <i class="fas fa-door-open"></i> -->
                                 Cancel
                                </a>

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

        
    
     <?php include 'footer.php' ?>     
</body>
</html>