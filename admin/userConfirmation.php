<?php
    session_start();

    if(!isset($_SESSION['aUserId'])){
        header('Location:login.php');
    }

    require '../db/connect.php';
        
    if(isset($_GET['eid'])){
        $rent = $pdo->prepare('SELECT * FROM rent_car WHERE id = :eid');
        $rent->execute($_GET);
        $row = $rent->fetch();
        // print_r($row['status']); die();
        if($row['status'] == 0){
            $status = 1;
        }
        else{
            $status = 0;
        }

        $stmt = $pdo->prepare('UPDATE rent_car SET status = :status WHERE id = :id');
        $criteria = [
            'status' => $status,
            'id' => $_GET['eid']
        ];
        $stmt->execute($criteria);
        echo 'Rent Status Updated Successfully';
    }

    $rent_car = $pdo->prepare("SELECT 
                                    rent_car.*, 
                                    car.seat as seat, 
                                    model.name as modelName,
                                    user.username as userName 
                            FROM rent_car 
                                JOIN car ON rent_car.car_id = car.id
                                JOIN model ON car.modelId = model.id
                                JOIN user ON rent_car.user_id = user.id
                            ORDER BY rent_car.id DESC
                        ");
    $rent_car->execute();
 ?> 


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">         
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <style type="text/css"></style>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
        
</head>
<body>
<div class="container">
    <?php require 'sidebar.php';?>
    <div id="mid-content">
    <div class="container">
        <div class="col-md-12">
             <?php if(isset($_GET['success'])){?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                    <?php echo $_GET['success']; ?>
                </div>
            <?php }?>

            <div class="tab-content" id="">
                <div class="tab-pane fade show active">
                    <div class="card" style="padding:20px;">
                        <div class="top">
                            <ul class="nav nav-tabs">
                                <!-- <li class="nav-item">
                                    <a class="nav-link ser-link" href="addcar.php"><i class="fas fas fa-car"></i>&nbsp; Add Car  </a>
                                </li> -->
                                <li>
                                    
                                </li>
                            </ul></div>
                            <br><br>
                            <!-- search  -->
                            <div class=" col-md-5 form-group ml-auto">
                 <input class="form-control" id="myInput" type="text" placeholder="Search..">
             </div>
                            <table class="table table-hover">
                                <thead>
                                <tr class="text-info">
                                    <th> Car Model</th>
                                    <th>Rented By</th>
                                 
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <!-- <th>Seat</th> -->
                                    <th>cost</th>
                                    <th>Seat</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                               
                                 <tbody id="myTable">

                               <?php foreach ($rent_car as $rent) {?>
                                    <tr>
                                        <td><?php echo $rent['modelName'] ?></td>
                                        <td><?php echo $rent['userName'] ?></td>
                                        <td><?php echo $rent['rent_start'] ?></td>
                                        <td><?php echo $rent['rent_end'] ?></td>
                                        <td><?php echo $rent['cost'] ?></td>
                                        <td><?php echo $rent['seat'] ?></td>
                                        <td>
                                            <?php 
                                                if($rent['status'] == 0){
                                                    echo 'Not Confirmed';
                                                }
                                                else{
                                                    echo 'Confirmed';
                                                }
                                            ?>
                                                
                                            </td>
                                       <td></td>
                                       
                                        
                                        <td>
                                            <a href="userConfirmation.php?eid=<?php echo $rent['id'];?>" class="btn btn-sm btn-icon btn-primary">Confirm</a>
                                            
                                            <a href="car.php?did=<?php echo $rent['id'];?>" cl="" ass="btn btn-sm btn-icon btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                             <?php }?>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>


</div>    


</body>
</html>