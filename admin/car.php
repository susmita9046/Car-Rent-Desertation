<?php
    session_start();

    if(!isset($_SESSION['aUserId'])){
        header('Location:login.php');
    }

    require '../db/connect.php';
    //  $car = $pdo->prepare("select * from car");
    // $car->execute();

    $cars = $pdo->prepare("select car.*, model.name as modelName, user.username
                            from car 
                            JOIN model ON car.modelId = model.id
                            JOIN user on car.userId = user.id");
    $cars->execute();

     // join user on car.userId = user.id
    if(isset($_GET['did'])){
        $stmt = $pdo->prepare('DELETE FROM car WHERE id = :did');
        $stmt->execute($_GET);
        header('Location:car.php?success=Car Deletted Successfully');
    }
     
     if(isset($_POST['keyword'])){
      $cars = $pdo->prepare("SELECT car.*, model.name as modelName, user.username 
                              FROM car 
                              JOIN model ON car.modelId = model.id 
                              JOIN user on car.userId = user.id
                              WHERE 
                                    car.status = 'Yes' 
                                    AND (model.name like '%" . $_POST['keyword'] . "%' OR 
                                    car.fuelType like '%" . $_POST['keyword'] .  "%' OR
                                    car.plate_number like '%" . $_POST['keyword'] .  "%' OR 
                                    car.seat like '%" . $_POST['keyword'] .  "%' OR 
                                    car.fuelType like '%" . $_POST['keyword'] .  "%' OR 
                                    car.production_year like '%" . $_POST['keyword'] .  "%' OR 
                                    car.engine_capacity like '%" . $_POST['keyword'] .  "%' OR 
                                    car.cost like '%" . $_POST['keyword'] . "%')");
      $cars->execute();
    } 
 ?> 

<!DOCTYPE html>
<html>
<head>
    <title>Manage Car</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <style type="text/css"></style>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">

    <style>
        .card {
            width: fit-content;
        }
    </style>
        
</head>
<body>

<div class="container">
    <?php require 'sidebar.php';?>

    <div id="mid-content" class="col-md-9">
        <div class="container">
            <div class="col-md-12">

            <?php if(isset($_GET['success'])){?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php echo $_GET['success']; ?>
                </div>
            <?php }?>

            <div class="tab-content" id="">
                <div class="tab-pane fade show active">
                    <div class="card" style="padding:20px;">
                        <div class="top">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link ser-link" href="addcar.php"><i class="fas fas fa-car"></i>&nbsp; Add Car  </a>
                                </li>
                                <li>
                                    
                                </li>
                            </ul></div>
                            <br><br>
                            <!-- search  -->
                            <div class=" col-md-5 form-group ml-auto">
                            <form method="post" action="">
                            <input class="form-control" type="text" name="keyword" placeholder="Search Here">
                            </form>
                           </div>
                            <table class="table table-hover">
                                <thead>
                                <tr class="text-info">
                                    <th>Model</th>
                                    <th>username</th>
                                    <th>cost</th>
                                    <th>Production Year</th>
                                    <th>Plate No.</th>
                                    <th>Fuel</th>
                                    <th>Engine Capacity</th>
                                    <th>Seat</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody id="myTable">

                                <?php foreach ($cars as $car) {?>
                                    <tr>
                                        <td><?php echo $car['modelName'] ?></td>
                                        <td><?php echo $car['username'] ?></td>
                                        <td><?php echo $car['cost'] ?></td>
                                        <td><?php echo $car['production_year'] ?></td>
                                        <td><?php echo $car['plate_number'] ?></td>
                                        <td><?php echo $car['fuelType'] ?></td>
                                        <td><?php echo $car['engine_capacity'] ?></td>
                                        <td><?php echo $car['seat'] ?></td>
                                        <td><?php echo $car['stock'] ?></td>
                                        <td><?php echo $car['status'] ?></td>
                                        <td></td>
                                        <td>
                                            <a href="editcar.php?eid=<?php echo $car['id'];?>" cl="" ass="btn btn-sm btn-icon btn-danger"><i class="fa fa-edit"></i></a>
                                            
                                            <a href="car.php?did=<?php echo $car['id'];?>" cl="" ass="btn btn-sm btn-icon btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php }?>
                                
                                </tbody>
                            </table>
                        </div>
                        
                    </div>


</div>    
