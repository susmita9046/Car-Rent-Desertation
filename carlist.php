
<?php
    session_start();

    if(!isset($_SESSION['UserId'])){
        header('Location:login.php');
    }
?>
<?php
  require 'db/connect.php';
    $cars = $pdo->prepare("SELECT car.*, model.name as modelName 
                            FROM 
                              car JOIN model ON car.modelId = model.id 
                            WHERE status = :status ORDER BY production_year ASC");
    $criteria = [
      'status' => 'Yes'
    ];
    $cars->execute($criteria);
?>

 
<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/fnavbar.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="js/menuToggle.js"></script>
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
        

       
    </style>
	
</head>
<body>
<div class="full-height" id="app">
<?php include 'user-nav-bar.php' ?>
<br><br>

<h3>Your Current Rent Available</h3>
<div class = "container">
  <div class = "row">
    <div class = "col-md-12">
      <div class = "row">
        <?php foreach ($cars as $car) {?>
          <div class="col-md-3 ">
            <div class="card info" style="color:black;">                         
              <img src="admin/uploads/<?php echo $car['image'];?>" class="" height="auto" width="100%" height="200px";>
                <div class="card-body">
                    <table>
                      <tr>
                        <td>Model :</td>
                        <td><?php echo $car['modelName'];?></td>
                      </tr>
                      <tr>
                        <td>Production Year:</td>
                        <td><?php echo $car['production_year'];?></td>
                      </tr>
                      <tr>
                        <td>Status:</td>                                
                        <td><?php echo $car['status'];?></td>
                      </tr>
                    </table>
                  <div class="text-center">
                    <a href="rentcar.php?carId=<?php echo $car['id'];?>" class="btn-primary btn"
                                       onclick="">
                      <i class="far fa-clock"></i> Rent Car</a>
                  </div>
                </div>
            </div>
          </div>
            <?php }?>
      </div>
    </div>
  </div>
</div>
<br>
<br>
<?php include 'footer.php' ?>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  </body>
</html>