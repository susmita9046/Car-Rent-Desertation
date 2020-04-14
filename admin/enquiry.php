<?php
    session_start();

    if(!isset($_SESSION['aUserId'])){
        header('Location:login.php');
    }

    require '../db/connect.php';

    // $users = $pdo->prepare("select * from user where type=:type");
    // $criteria = [
    //     'type' => 1
    // ];
    // $users->execute($criteria);
 ?> 

<!DOCTYPE html>
<html>
<head>
    <title>Enquiry</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">         

    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <style type="text/css"></style>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
        
</head>
<body>

<div class="container">
    <?php require 'sidebar.php';?>
<div id="mid-content">
    <div class="container">
        <div class="col-md-12">
            <div class="tab-content" id="myTabContent">
                <div class=" col-md-5 form-group ml-auto" style="margin-left: 0 !important;">
                    <a class="nav-link ser-link" href="adduser.php"><i class="fas fas fa-car"></i>&nbsp; Add User  </a>
                </div>
                <table class="table table-hover">
                            <thead>
                                <tr class="text-info">
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                   
                                </tr>
                            </thead>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr></tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>   
</body>
</html>
