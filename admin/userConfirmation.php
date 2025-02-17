<?php
    session_start();

    if(!isset($_SESSION['aUserId'])){
        header('Location:login.php');
    }

    require '../db/connect.php';
        
    if(isset($_GET['eid'])){
        $rent = $pdo->prepare('SELECT rent_car.*, car.stock FROM rent_car 
                inner join car on rent_car.car_id = car.id WHERE rent_car.id = :eid');
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

        // update stock of car
            $stmt = $pdo->prepare('UPDATE car SET stock = :stock WHERE id = :id');
            $criteria = [
                'stock' => $row['stock'] - 1,
                'id' => $row['car_id']
            ];
            $stmt->execute($criteria);
        // update stock of car



        header('Location:userConfirmation.php?msg=Rent Status Updated Successfully');
    }

    if(isset($_GET['cid'])){
         $rent = $pdo->prepare('SELECT rent_car.*, car.stock FROM rent_car 
                inner join car on rent_car.car_id = car.id WHERE rent_car.id = :cid');
        $rent->execute($_GET);
        $row = $rent->fetch();

        // die($row['car_id']);
        $stmt = $pdo->prepare('update rent_car set complete = 1');
        $stmt->execute();

        $stmt = $pdo->prepare('update car set stock = :stock where id = :id');
        $criteria = [
            'stock' => $row['stock'] + 1,
            'id' => $row['car_id']
        ];
        $stmt->execute($criteria);

        header('Location:userConfirmation.php?msg=Rent Completed Successfully');
    }

    $rent_car = $pdo->prepare("SELECT 
                                    rent_car.*, 
                                    car.seat as seat, 
                                    car.stock as stock, 
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
    <div id="mid-content" class="col-md-9">
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
                            <?php if(isset($_GET['msg'])){
                                echo '<p style="color:red">'.$_GET['msg'].'</p>';
                            }?>
                            <br><br>
                            <!-- search  -->
                            <h4>Manage Booking</h4>
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
                                    <th>cost</th>
                                    <th>Seat</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th></th>
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
                                        <td><?php echo $rent['stock'] ?></td>
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
                                            <?php if($rent['status'] == 0){?>
                                                <a href="userConfirmation.php?eid=<?php echo $rent['id'];?>" class="btn btn-sm btn-icon btn-primary">Confirm</a>
                                            <?php }?>
                                              <?php if($rent['status'] == 1 && $rent['complete'] == 0){?>
                                                <a href="userConfirmation.php?cid=<?php echo $rent['id'];?>" class="btn btn-sm  btn-primary"><i class="fa fa-check"></i>Complete</a>
                                            <?php }?>
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#user_conf_modal">
                                      <i class="fa fa-trash"></i>Delete
                                    </button>
                                            

                                          
                                        </td>
                                    </tr>
                             <?php }?>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>


</div>    

<!-- Modal -->
<div class="modal fade" id="user_conf_modal" tabindex="-1" role="dialog" aria-labelledby="delete_user_modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="delete_user_modal">Modal title</h5> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete?
      </div>
      <div class="modal-footer">
        <a href="car.php?did=<?php echo $rent['id'];?>"  class="btn btn-sm btn-danger "><i class="fa fa-trash"></i>Delete</a>
        <a type="button" class="btn btn-secondary" data-dismiss="modal">No</a>
  
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>