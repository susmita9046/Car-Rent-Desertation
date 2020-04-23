
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
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
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
            <a href="userprofile.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <i class="fas fa-user">USER

                </i> 

            </a>
    <ul class="dropdown-menu li-padding" role="menu">
        <li>
            <a href="confirmRent.php" <i class="fas fa-list"></i> 
                Your rents
            </a>
                <form style="display: none;">
                                        
                </form>
        </li>
        <li>
            <a href="logout.php" class="logout" <i class="fas fa-sign-out-alt"></i>
             Logout
            </a>
        </li>
    </ul>
</div>
</nav>
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
                           <!--  <button class="btn viewbtn"  data-toggle="modal" data-target="#exampleModalScrollable">
                                VIEW MORE
                            </button>

 -->                      
                          <a href="rentcar.php?carId=<?php echo $car['id'] ?>" class="btn-primary btn <?php if($car['stock'] == 0) echo 'disabled' ?>" onclick="">
                            <i class="far fa-clock"></i> 
                                      Rent Car
                          </a>
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
<div class="container-fluid foot">
    <div class="text-center">
        <a href="#" class="foota">About</a>
        <a href="#" class="foota"> Contact</a>
        <a href="#" class="foota"> FAQ</a>
        <a href="#" class="foota">Help</a> <br>
        Copyright 2019. All Rights Reserved
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>   </body>
</html>