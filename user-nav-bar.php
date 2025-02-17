<?php
$user = $pdo->prepare("select * from user where id = :UserId");
$user->execute(['UserId' => $_SESSION['UserId']]);
$user = $user->fetch();
?>

<nav class="navbar  navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" href="/susmitaFinalProject/userprofile.php">
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
        <?php if(isset($_SESSION['UserId'])){
                  $userId = $_SESSION['UserId'];
                  $user = $pdo->prepare("select * from user where id = '$userId'");
                  $user->execute();
                  $user = $user->fetch();
                  // print_r($user); die();
              }?>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user"><?php echo $user['username']; ?></i>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a href="confirmRent.php"><i class="fas fa-list"></i> Your rents</a><br>
          
          <!-- <div class="dropdown-divider"></div> -->
          <a href="viewfeedback.php">
               <i class="fas fa-list"></i> Your Feedback
           </a> <br>
           <a href="logout.php" class="logout">                              
               <i class="fas fa-sign-out-alt"></i> Logout
           </a> 
        </div>
      </li>   
    </ul>

</div>
</nav>

