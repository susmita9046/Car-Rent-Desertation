<div class="row">
        
    <div class = "col-md-4">                    
          <nav id="Sidebar">
            <div class="Sidebar-header">
                <h2 class="text-center">
                    <i class="fas fa-tachometer-alt"></i>
                    <br>
                    Admin Panel
                </h2>
            </div>

            <ul class="nav nav-tabs list-unstyled components" style="display: inline-block;">
                <li class="nav-item">
                        <a class="nav-link" href="index.php">
                           <i class="fas fas fa-home"></i>  &nbsp;
                            Home
                        </a> 
                </li>

                <li class="nav-item">
                        <a class="nav-link" href="index.php">
                           <i class="fas fas fa-home"></i>  &nbsp;
                            Activity Log
                        </a> 
                </li>

                <?php 
                $stmt = $pdo->prepare('select * from user where id = :id'); 
                $stmt->execute(['id' => $_SESSION['aUserId']]);
                $user = $stmt->fetch();
                if($user['type'] == 1){?>
                    <li class="nav-item">
                        <a class="nav-link" href="users.php">
                            <i class="fas fa-user"></i>&nbsp;
                            Manage Admin Users
                        </a>
                    </li>
                <?php }?>

                <li class="nav-item">
                    <a class="nav-link" href="models.php">
                        <i class="fas fas fa-car"></i>&nbsp;
                         Manage Models
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="car.php">
                        <i class="fas fas fa-car"></i>&nbsp;
                         Cars
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="userDetails.php">
                        <i class="fas fas fa-car"></i>&nbsp;
                         Customers Details
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="userConfirmation.php">
                        <i class="fas fas fa-car"></i>&nbsp;
                         Booking Confirmation
                    </a>
                </li>

                
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="enquiry.php">
                        <i class="fas fa-newspaper"></i>&nbsp;
                        Enquiry
                    </a>
                </li>
                  
                <li>
                 
                    <a href="logout.php"> 

                        <i class="fas fa-sign-out-alt"></i>&nbsp;
                        Log Out
                      
                    </a>
                </li>

            </ul>
    </nav>

</div>