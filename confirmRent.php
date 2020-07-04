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

<!DOCTYPE html>
<html>
<head>
    <title></title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/fnavbar.css">
    <link rel="stylesheet" type="text/css" href="css/styll.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="js/menuToggle.js"></script>
    <style type="text/css">
        
    </style>
</head>
<body>
<div class="full-height" id="app">
<?php include 'user-nav-bar.php' ?>
 <div class="container">

        <div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
            <h2>Your pending rents</h2>
            <table class="table table-striped table-dark mb-0">
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
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        
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
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

</div>
</div>



   

<?php include 'footer.php' ?>
    </body>
</html>