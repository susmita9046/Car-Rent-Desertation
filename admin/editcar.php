<?php
    session_start();

    if(!isset($_SESSION['aUserId'])){
        header('Location:login.php');
    }

    require '../db/connect.php';

    $models = $pdo->prepare('SELECT * FROM model');
    $models->execute();
    
    if(isset($_GET['eid'])){
        $model = $pdo->prepare('SELECT * FROM car WHERE id = :eid');
        $model->execute($_GET);
        $row = $model->fetch();
    }

    if(isset($_POST['update'])){
        $stmt = $pdo->prepare("UPDATE car SET 
        						modelId = :modelId, 
        						cost = :cost, 
        						production_year = :production_year, 
        						plate_number = :plate_number, 
        						fuelType = :fuelType, 
        						engine_capacity = :engine_capacity, 
        						seat = :seat, 
        						status = :status 
        					WHERE 
        					id = :id"
        				);

        unset($_POST['update']);
        // echo '<pre>'; print_r($_POST); die();
        $stmt->execute($_POST);
        header('Location:car.php?success=Car Updated Successfully');
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title> Edit Car</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin=" anonymous"> 
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
	

</head>
<body>

<div class="container">
<?php require 'sidebar.php'; ?>    

<div id="mid-content" style="padding:2% 0%">
        <div class="container">
            <div class="col-md-12">
                <div class="tab-content" id="myTabContent">
                    <div class="col-md-12 col-md-offset-1">
                        <div class="panel panel-yel">               
                            <div class="panel-body">
  
                            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                           		<input type="hidden" name="id" value="<?php echo $row['id'];?>">
                            <div class="col-md-12">
                                <h2 class="text-secondary">Edit Car</h2>
                            </div>
                            <div class="form-group">

                            <label for="name" class="col-md-4 control-label">Select Model</label>
                                <div class="col-md-6">
                                    <select name="modelId" class="form-control grey-glow">
                                        <?php 
                                        foreach ($models as $model) {?>
                                            <option value="<?php echo $model['id'];?>" <?php if($model['id'] == $row['modelId']) echo 'selected'; ?>>
                                                <?php echo $model['name'];?>
                                            </option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label ">Cost ($)</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control grey-glow" name="cost" value="<?php echo $row['cost'];?>" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="production-year" class="col-md-4 control-label">Production year</label>

                                <div class="col-md-6">
                                    <select name="production_year" class="form-control grey-glow">
                                        <?php for($d = 2000; $d < date('Y'); $d++){?>
                                            <option value="<?php echo $d;?>" <?php if($d == $row['production_year']) echo 'selected';?>>
                                            	<?php echo $d;?>
                                            </option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cost" class="col-md-4 control-label">Plate number </label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control grey-glow" name="plate_number" 
                                    value="<?php echo $row['plate_number'];?>" />
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
                                            <option value="Diesel" <?php if('Diesel' == $row['fuelType']) echo 'selected';?>>Diesel</option>
                                            <option value="Electric" <?php if('Electric' == $row['fuelType']) echo 'selected';?>>Electric</option>
                                        </select>
                                
                                </div>
                            </div>

                             <div class="form-group">
                                <label for="engine_capacity" class="col-md-4 control-label">Engine capacity (cm<sup>3</sup>):</label>

                                <div class="col-md-6">
                                    <input type="number" class="form-control grey-glow" name="engine_capacity" 
                                    value="<?php echo $row['engine_capacity'];?>">

                                   
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="seats" class="col-md-4 control-label">Seats:</label>

                                <div class="col-md-6">
                                    <input  type="number" class="form-control grey-glow" name="seat" 
                                    value="<?php echo $row['seat'];?>"/>
                                </div>
                            </div>

                             <div class="form-group">
                                <label for="status" class="col-md-1 control-label">Status</label> 
                                <input  type="radio" name="status" value="Yes" checke /> Yes 
                                <input  type="radio" name="status" value="No" <?php if('No' == $row['status']) echo 'checked' ?>/> No 
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <!-- <button type="submit" class="btn btn-primary grey-button"> -->
                                     <input class="btn btn-primary grey-button" type="submit" name="update">
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

