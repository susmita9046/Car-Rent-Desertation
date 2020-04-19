<?php
    session_start();
    if(!isset($_SESSION['aUserId'])){
        header('Location:login.php');
    }

    require '../db/connect.php';

    $admins = $pdo->prepare('select * from user where type = 2');
    $admins->execute();
    $adminCount = $admins->rowCount();

    $models = $pdo->prepare('select * from model');
    $models->execute();
    $modelCount = $models->rowCount();

    $cars = $pdo->prepare('select * from car');
    $cars->execute();
    $carCount = $cars->rowCount();

    $customers = $pdo->prepare('select * from user where type = 0');
    $customers->execute();
    $customerCount = $customers->rowCount();

    $bookings = $pdo->prepare('select * from rent_car');
    $bookings->execute();
    $bookingCount = $bookings->rowCount();

?>
    <!DOCTYPE html>
    <html>
    <head>
    	<title></title>
    	<title></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">     	
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    	<style type="text/css"></style>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    		
    </head>
    <body>
        <?php require 'sidebar.php'; ?>

            <div class="col-md-9">
                <h3 class="report-title">Admin Content Detail</h3>
                <div class="report">
                    <?php if($user['type'] == 1){?>
                        <div>
                            <a href="">
                                <i class="fas fas fa-user"></i><br>
                                <span>Admin Users : <?php echo $adminCount; ?></span>
                            </a>
                        </div>
                    <?php }?>
                    <div>
                        <a href="">
                            <i class="fas fas fa-car"></i><br>
                            <span>Car Models : <?php echo $modelCount; ?></span>
                        </a>
                    </div>
                    <div>
                        <a href="">
                            <i class="fas fas fa-car"></i><br>
                            <span>Cars : <?php echo $carCount; ?></span>
                        </a>
                    </div>
                    <div>
                        <a href="">
                            <i class="fas fas fa-home"></i><br>
                            <span>Customers : <?php echo $customerCount; ?></span>
                        </a>
                    </div>
                    <div>
                        <a href="">
                            <i class="fas fas fa-home"></i><br>
                            <span>Bookings : <?php echo $bookingCount; ?></span>
                        </a>
                    </div>
                    <div>
                        <a href="">
                            <i class="fas fas fa-home"></i><br>
                            <span>Enquiries : 5</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Holder  ends here-->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>
    </html>
