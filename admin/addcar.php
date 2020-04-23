<?php
session_start();

    if(!isset($_SESSION['aUserId'])){
        header('Location:login.php');
    }

    require '../db/connect.php';

    $models = $pdo->prepare('SELECT * FROM model');
    $models->execute();

    if(isset($_POST['save'])){

        // image upload
        if(isset($_FILES['image'])){
            $image = $_FILES['image']['name'];
            $tmp_loc = $_FILES['image']['tmp_name'];
            $perm_loc = 'uploads/' . $image;
            copy($tmp_loc, $perm_loc);
        }

        $stmt = $pdo->prepare("insert into 
                    car(modelId,cost,production_year,plate_number,image,fuelType,engine_capacity,seat,stock,status,userId) values(:modelId, :cost, :production_year, :plate_number, :image, :fuelType, :engine_capacity, :seat,:stock,:status, :userId)");
        $_POST['userId']= $_SESSION['aUserId'];
        unset($_POST['save']);
        $_POST['image'] = $image;
        
        // echo '<pre>'; print_r($_POST); die();
        $stmt->execute($_POST);
        header('Location:car.php?success=Car Added Successfully');
    }

?>



<!DOCTYPE html>
<html>
<head>
    <title>Add Car</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin=" anonymous"> 
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
	

</head>
<body>

<div class="container">

<?php require 'sidebar.php'; ?>    

<div id="mid-content" class="col-md-9" style="padding:2% 0%">
        <div class="container">
            <div class="col-md-12">
                <div class="tab-content" id="myTabContent">
                    <div class="col-md-12 col-md-offset-1">
                        <div class="panel panel-yel">               
                            <div class="panel-body">
  
                            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                           
                            <div class="col-md-12">
                                <h2 class="text-secondary">Add Car</h2>
                            </div>
                            <div class="form-group">

                            <label for="name" class="col-md-4 control-label">Select Model</label>
                                <div class="col-md-6">
                                    <select name="modelId" class="form-control grey-glow">
                                        <?php 
                                        foreach ($models as $model) {?>
                                            <option value="<?php echo $model['id'];?>">
                                                <?php echo $model['name'];?>
                                            </option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label ">Cost ($)</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control grey-glow" name="cost" value="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="production_year" class="col-md-4 control-label">Production year</label>

                                <div class="col-md-6">
                                    <select name="production_year" class="form-control grey-glow">
                                        <?php for($d = 2000; $d < date('Y'); $d++){?>
                                            <option value="<?php echo $d;?>"><?php echo $d;?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cost" class="col-md-4 control-label">Plate number </label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control grey-glow" name="plate_number" value="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="picture" class="col-md-4 control-label">Add Car Photo</label>

                                <div class="col-md-6">
                                        <input type="file" class="form-control-file" id="car-img" name="image">
                                </div>
                            </div>

                        
                            </div>
                            <div class="form-group">
                                <label for="fuel" class="col-md-4 control-label">Fuel:</label>

                                <div class="col-md-6">

                                        <select class="form-control grey-glow" name="fuelType" required>
                                            <option value="Petrol">Petrol</option>
                                            <option value="Diesel">Diesel</option>
                                            <option value="Electric">Electric</option>
                                        </select>
                                
                                </div>
                            </div>

                             <div class="form-group">
                                <label for="engine_capacity" class="col-md-4 control-label">Engine capacity (cm<sup>3</sup>):</label>

                                <div class="col-md-6">
                                    <input type="number" class="form-control grey-glow" name="engine_capacity" value="">

                                   
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="seats" class="col-md-4 control-label">Seats</label>

                                <div class="col-md-6">
                                    <input  type="number" class="form-control grey-glow" name="seat" value=""/>

                                  
                                </div>
                            </div>
                            
                             <div class="form-group">
                                <label for="seats" class="col-md-4 control-label">Stock</label>

                                <div class="col-md-6">
                                    <input  type="number" class="form-control grey-glow" name="stock">

                                  
                                </div>
                            </div>

                             <div class="form-group">
                                <label for="status" class="col-md-1 control-label">Status</label> 
                                <input  type="radio" name="status" value="Yes"/> Yes 
                                <input  type="radio" name="status" value="No"/> No 
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <!-- <button type="submit" class="btn btn-primary grey-button"> -->
                                     <input class="btn btn-primary grey-button" type="submit" name="save">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
