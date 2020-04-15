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
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
  <link rel="stylesheet" type="text/css" href="./css/fnavbar.css">
  <script type="text/javascript" src="js/menuToggle.js"></script>

  <style type="text/css">
    .blur-body >:not(#popupcar) {
      pointer-events: none; opacity: 0.4;
    }
  </style>

  <script type="text/javascript">

    function closePopUp(){
      var modal = document.getElementById('popupcar');
      modal.style.opacity = '0'; modal.style.display = 'none';
      document.getElementById('body').className = "";
    }

    function popUpCar(id){
      var xmlHttp = new XMLHttpRequest();
      xmlHttp.open('POST', 'get_car_ajax.php', true);
      var post = new FormData();
      post.append('id', id);
      xmlHttp.send(post);

      xmlHttp.onreadystatechange = function(){
        if(xmlHttp.readyState == 4){
          document.getElementById('body').className = "blur-body";
          var modal = document.getElementById('popupcar');
          modal.style.opacity = '1'; modal.style.display = 'block';
          document.getElementById('popupcar').innerHTML = xmlHttp.responseText;

          var close = document.getElementById('close');
          close.addEventListener('click', closePopUp);

          var closeTop = document.getElementById('closeTop');
          closeTop.addEventListener('click', closePopUp);
        }
      }

    }
  </script>

</head>
<body id="body">
  <div class="full-height" id="app">
    
    <!-- menubar -->
    <nav class="navbar  navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="/">
      <img src="images/logocar.png"  alt="car-logo" width="60" height="40" class="d-inline-block align-top" alt="">
        ArenaCar
      </a>
      <button class="navbar-toggler" type="button" id="navbar-toggler">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="nav navbar-nav ml-auto">
          <li><a href="home.php" >HOME</a></li>
          <li><a href="contact.php" >CONTACT</a></li>
          <li><a href="faq.php" >FAQ</a></li>
          <li><a href="login.php" ><i class="fas fa-door-open"></i> LOGIN</a></li>
          <li><a href=""> <i class="fas fa-user-edit"></i> REGISTER</a></li>
        </ul>
      </div>
    </nav>
    <!-- menubar ends -->
    
    <!-- page title -->
    <div class="container justify-content-center">
      <div class = "col-md-12 ml-auto mr-auto contentmain">
        <div class ="row"> 
          <div class = "col-md-6 start">
            <div class="motto"><h2>Reach your Destination with</h2>
            </div>
            <span class=" slogan"><h3>Arena Rent Car</h3></span>
          </div>
          <div class = "col-md-6 imagecolhome"><img src="images/logocar.png"></div>
        </div>
      </div>
    </div>
    <!-- pate title ends -->
    <br><br>

    <!-- search form -->
    <div class ="col-md-5 form-group ml-auto">
      <form method="post" action="">
        <input class="form-control" type="text" name="keyword" placeholder="Search Here">
      </form>
    </div>
    <!-- search form ends -->

    <div class = "container">
      <div class = "row">
        <div class = "col-md-12">
          <div class = "row">
            <?php 
            if($cars->rowCount() > 0){
              foreach ($cars as $car) {?>
                <!-- list car -->
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
                        <button class="btn viewbtn" onclick="popUpCar('<?php echo $car['id'];?>')">
                          VIEW MORE
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- list car ends -->
              <?php }
            }else{?>
              <div>There are no products matching the search query</div>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
    <br><br>

    <div class="container-fluid foot">
      <div class="text-center">
        <a href="#" class="foota">About</a>
        <a href="#" class="foota"> Contact</a>
        <a href="#" class="foota"> FAQ</a>
        <a href="#" class="foota">Help</a> <br>
        Copyright 2019. All Rights Reserved
      </div>
    </div>

  </div>
 
  <div class="modal fade" id="popupcar" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">

  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>   
</body>
</html>