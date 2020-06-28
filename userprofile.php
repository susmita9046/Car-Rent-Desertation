
<?php
    session_start();

    if(!isset($_SESSION['UserId'])){
        header('Location:login.php');
    }
    ?>

<?php
  require 'db/connect.php';
  // $stmt = $pdo->prepare('SELECT * FROM user WHERE username = :username 
    //   FROM user 
    //   JOIN user on user.userId = user.id');
    // $_SESSION['UserId'] = $user['id'];
    $cars = $pdo->prepare("SELECT car.*, model.name as modelName 
                            FROM 
                              car JOIN model ON car.modelId = model.id 
                            WHERE status = :status ORDER BY production_year ASC");
    $criteria = [
      'status' => 'Yes'
    ];
    $cars->execute($criteria);

    if(isset($_POST['keyword'])){
      $cars = $pdo->prepare("SELECT car.*, model.name as modelName FROM car JOIN model ON car.modelId = model.id 
        WHERE car.status = 'Yes' AND (model.name like '%" . $_POST['keyword'] . "%' OR car.fuelType like '%" . $_POST['keyword'] . "%')");
      $cars->execute();
    }
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

</head>
<body>
<div class="full-height" id="app">
<?php include 'user-nav-bar.php' ?>
 <!-- </div> -->
<div class="container justify-content-center">
        <div class = "col-md-12 ml-auto mr-auto contentmain">
            <div class ="row">
               <div class = "col-md-6 start">
                    <div class="motto">
                       <h2>Reach your Destination with</h2>
                    </div>
                    <span class=" slogan">
                       <h3>Arena Rent Car</h3>
                    </span>
                </div>
                 <div class = "col-md-6 imagecolhome">
                    <img src="images/logocar.png">
                </div>
            </div>
        </div>
</div>
<br><br>
<div class ="col-md-4 form-group ml-auto" style="margin-right: 8%;">
<form method="post" action="">
    <input class="form-control" type="text" name="keyword" placeholder="Search Here">
</form>

</div>
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
                          <tr>
                              <td>Stock:</td>                                
                              <td><?php echo $car['stock'];?></td>
                          </tr>
                        </table>
                        <div class="text-center">
                          <a href="rentcar.php?carId=<?php echo $car['id'] ?>" class="btn-primary btn <?php if($car['stock'] == 0) echo 'disabled' ?>" onclick="">
                            <i class="far fa-clock"></i> 
                                Rent Car
                          </a>
                          <a href="feedback_form.php?carId=<?php echo $car['id'];?>" class="btn-secondary btn">Feedback</a>
                        </div>
                </div>
          </div>
</div>
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Car Detail</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
                    <div class="modal-body">
                      <img src="admin/uploads/<?php echo $car['image'];?>" class="" height="auto" width="100%" height="200px";>
                             
                       <table>
                                <tr>
                                    <td>fuel_Type:</td>
                                    <td><?php echo $car['fuel_Type'];?></td>
                                </tr>
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
                    <div class="modal-footer">
                        <a href="rentcar.php?carId=<?php echo $car['id'] ?>" class="btn-primary btn"
                                       onclick="">
                                        <i class="far fa-clock"></i>Rent Car</a>
                                    
                          <button type="button" class="btn btn-danger" data-dismiss="modal">
                            Close
                          </button>
                        
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
</div>


<?php include 'footer.php' ?>

   </body>
</html>