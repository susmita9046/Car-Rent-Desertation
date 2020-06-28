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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    
    <?php include 'navbar.php' ?>
    
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
                            <td>Stock:</td>
                            <td><?php echo $car['stock'];?></td>
                        </tr>
                        <tr>
                            <td>Status:</td>                                
                            <td><?php echo $car['status'];?></td>
                        </tr>
                      </table>
                      <div class="text-center">
                        <button class="btn-primary btn" onclick="popUpCar('<?php echo $car['id'];?>')">
                          VIEW MORE
                        </button>
                        <a href="feedback_form.php" class="btn-secondary btn">Feedback</a>
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
<?php include 'footer.php' ?>