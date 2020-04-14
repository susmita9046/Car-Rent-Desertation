<?php
    session_start();

    if(!isset($_SESSION['UserId'])){
        header('Location:login.php');
    }
    require 'db/connect.php';

    if(isset($_GET['carId'])){
        $stmt = $pdo->prepare("SELECT * FROM car  WHERE id = :carId");
        $stmt->execute($_GET);
        $car = $stmt->fetch();
    }
    if(isset($_POST['confirm'])){
        $err = '';
        $startDate = $_POST['rent_start'];
        $endDate = $_POST['rent_end'];
        if($startDate >= $endDate){
            $err .= '<li>Start Date is greater or equal to end date</li>';
        }
        // echo $startDate;
        $curDate = date('Y-m-d');
        // die($curDate);
        if($startDate < $curDate){
            $err .= '<li>Start date is past date</li>';
        }
        if($endDate < $curDate){
            $err .= '<li>End date is past date</li>';
        }

        if(empty($err)){
            $startDate = date_create($startDate);
            $endDate = date_create($endDate);
            $daysDifference = date_diff($startDate, $endDate);
            $day = $daysDifference->format("%a");
            $cost = $day * $_POST['rate'];
            $stmt = $pdo->prepare("insert into 
                    rent_car(car_id,user_id,rent_start,rent_end,day,cost, status) values(:car_id, :user_id, :rent_start, :rent_end, :day, :cost, :status)");
            unset($_POST['confirm']);
            unset($_POST['calculate']);
            unset($_POST['rate']);
            $_POST['day'] = $day;
            $_POST['cost'] = $cost;
            $_POST['user_id'] = $_SESSION['UserId'];
            $_POST['status'] = 0;
            $stmt->execute($_POST);
            header('Location:confirmRent.php?success=Rent sent Successfully');
        }
     }

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Rent Car</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
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

    <script type="text/javascript">
        function calculateDaysNCostNValidateDates(){
            var start = document.getElementById('rent_start').value;
            var end = document.getElementById('rent_end').value;
            var startDate = new Date(start);
            var endDate = new Date(end);

            if(startDate >= endDate){
                alert('Start Date is greater or equal to end date');
                return false;
            }
            curDate = new Date();
            if(startDate < curDate){
                alert('Start date is past date');
                    return false;
            }
            if(endDate < curDate){
                alert('End date is past date');
                return false;
            }
            var diffTime = Math.abs(endDate - startDate);
            var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            if(diffDays > 15){
                alert('Date range should be less or equal to 15');
                return false;
            }

            var diff = endDate.getTime() - startDate.getTime();
            var days = diff / (1000 * 3600 * 24);
            var rate = document.getElementById('rate');
            var cost = days * rate.innerHTML;
            document.getElementById('days').innerHTML = days;
            document.getElementById('cost').innerHTML = cost;
        }
        function loadFunction(){
            var element = document.getElementById('calculate');
            element.addEventListener('click', calculateDaysNCostNValidateDates);
        }
        document.addEventListener('DOMContentLoaded', loadFunction);
    </script>

</head>
<body>

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
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <i class="fas fa-user">USER</i>  
            </a>
    <ul class="dropdown-menu li-padding" role="menu">
        <li>
            <a href="confirmRent.php" <i class="fas fa-list"></i> 
                Your rents
            </a>
        </li>
        <li>
            <a href="logout.php" class="logout" <i class="fas fa-sign-out-alt"></i>
             Logout
            </a>
        </li>
    </ul>
</div>
</nav>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-yel">               
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                            if(!empty($err)){
                               echo '<ul style="color:red; font-size18px; margin:10px;">';
                                    echo $err;
                               echo '</ul>';
                            }
                            ?>
                            <table>
                                <tr>
                                    <td>Production_year :</td>
                                    <td><?php echo $car['production_year'];?></td>
                                </tr>
                                <tr>
                                    <td>Plate Number:</td>
                                    <td><?php echo $car['plate_number'];?></td>
                                </tr>
                                <tr>
                                    <td>Seat: </td>
                                    <td><?php echo $car['seat'];?></td>
                                </tr>
                                <tr>
                                    <td>Price/day:</td>
                                    <td><?php echo $car['cost'];?></td>
                                </tr>
                               
                            </table>
                        </div>
                        <div class="col-md-6">
                            <form class="form-horizontal" method="POST" action="">
                                <input type="hidden" name="car_id" value="<?php echo $car['id'] ?>">
                                <br>
                                <h4>Car Rate(Per Day) : <span id="rate"><?php echo $car['cost']; ?></span></h4>
                                <input type="hidden" name="rate" value="<?php echo $car['cost'];?>">
                                <h4>Rent start date: </h4>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input id="rent_start" type="date" class="form-control grey-glow" name="rent_start" required autofocus>
                                        </div>
                                    </div>
                                </div>
                                <h4>Rent end date:</h4>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input id="rent_end" type="date" class="form-control grey-glow" name="rent_end" required autofocus> 
                                        </div>
                                        <div class="col-md-6">
                                            <input type="button" id="calculate" value="Calculate" name="calculate" />
                                        </div>
                                    </div>
                                </div>
                                <h4 id="total-days">Total days: <span id="days"></span></h4>
                                <h4 id="total-cost">Total cost : <span id="cost"></span></h4> 
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                       
                                        <input class="btn btn-success" type="submit" name="confirm">
                                        <a class="btn btn-primary " href="userprofile.php">
                                                Back
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>