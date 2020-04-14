<?php
    session_start();

    if(!isset($_SESSION['UserId'])){
        header('Location:login.php');
    }
    require 'db/connect.php';

    if(isset($_GET['did'])){
        $stmt = $pdo->prepare('DELETE FROM rent_car WHERE id = :did');
        $stmt->execute($_GET);
        header('Location:confirmRent.php?success=Rent Deletted Successfully');
    }
    
    $pending_rents = $pdo->prepare("select rent_car.*, model.name as modelName from car JOIN model ON car.modelId = model.id join rent_car on car.id = rent_car.car_id WHERE rent_car.status=:status");
    $pending_rents->execute(['status'=> 0]);

    $confirmed_rents = $pdo->prepare("select rent_car.*, model.name as modelName from car JOIN model ON car.modelId = model.id join rent_car on car.id = rent_car.car_id WHERE rent_car.status=:status");
    $confirmed_rents->execute(['status'=> 1]);

?> 

<php ?
require '../css/fnavbar.css';
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <!-- <link rel="stylesheet" type="text/css" href="./css/fnavbar.css"> -->
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
           
            background-color:#3f4269  !important;
            color:#F89D13 !important;
        }
        .nav > li >a{
           
           
           
       }
        .navbar
        {
           background-color: #3f4269  !important;
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
<div class="full-height" id="app">
<nav class="navbar  navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" href="/">
 <img src="images/logocar.png"  alt="car-logo" width="60" height="40" class="d-inline-block align-top" alt="">
ArenaCar
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="nav navbar-nav ml-auto">
        <li><a href="userprofile.php" >HOME</a></li>
        <li><a href="carlist.php" >CAR LIST</a></li>
        <li class=" nav-item dropdown">
            <a href="userprofile.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <i class="fas fa-user">USER</i>  
            </a>
    <ul class="dropdown-menu li-padding" role="menu">
      
        <li>
            <a href="rent.php" <i class="fas fa-list"></i> 
                Your rents
            </a>
                <form style="display: none;">
                                        
                </form>
        </li>
        <li>
            <a href="logout.php" class="logout" <i class="fas fa-sign-out-alt"></i>
             Logout
            </a>
        </li>
    </ul>
</div>
</nav>
 <div class="container">

        <div class="container">
            <h2>Your pending rents</h2>
            <table class="table table-striped table-dark">
                <thead>
                <tr>
                    <th>Car Model</th>
                    <th>Date start</th>
                    <th>Date end</th>
                    <th>Days</th>
                    <th>Cost</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($pending_rents as $rent) {?>
                        <tr>
                            <td><?php echo $rent['modelName'] ?></td>
                            <td><?php echo $rent['rent_start'] ?></td>
                            <td><?php echo $rent['rent_end'] ?></td>
                            <td><?php echo $rent['day'] ?></td>
                            <td><?php echo $rent['cost'] ?></td>
                            <td><?php echo 'Pending';?></td>
                            <td>
                                <a href="confirmRent.php?did=<?php echo $rent['id'] ?>">Cancel</a>
                                <a href="paypal.php?id=<?php echo $rent['id'] ?>">Pay By Paypal</a>
                            </td>                                  
                        <tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="container">
            <h2>Your confirmed rents</h2>
            <table class="table table-striped table-dark">
                <thead>
                <tr>
                    <th>Car Model</th>
                    <th>Date start</th>
                    <th>Date end</th>
                    <th>Days</th>
                    <th>Cost</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($confirmed_rents as $rent) {?>
                        <tr>
                            <td><?php echo $rent['modelName'] ?></td>
                            <td><?php echo $rent['rent_start'] ?></td>
                            <td><?php echo $rent['rent_end'] ?></td>
                            <td><?php echo $rent['day'] ?></td>
                            <td><?php echo $rent['cost'] ?></td>
                            <td><?php echo 'Confirmed';?></td>
                            <td>
                                <a href="paypal.php?id=<?php echo $rent['id'] ?>">Pay By Paypal</a>
                                 
                            </td>                                  
                        <tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
    </body>
</html>