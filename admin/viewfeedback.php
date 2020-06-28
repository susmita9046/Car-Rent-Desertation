<?php
    session_start();

    if(!isset($_SESSION['aUserId'])){
        header('Location:login.php');
    }
    require '../db/connect.php';
    $feedbacks = $pdo->prepare("select * from feedbacks");
    $feedbacks->execute();
   

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
<div id="mid-content" class="col-md-9">
    <div class="container">
        <div class="col-md-12">
            <div class="tab-content" id="myTabContent">
                <div class=" col-md-5 form-group ml-auto" style="margin-left: 0 !important;">
                <h4>Manage Contact</h4>
                </div>
                <table class="table table-hover">
                            <thead>
                                <tr class="text-info">
                                    <th>S.N</th>
                                    <th>Username</th>
                                    <th>Car Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Location</th>
                                    <th>Service</th>
                                    <th>Feedback</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                                <?php $i = 1; ?>
                                <?php foreach ($feedbacks as $faqq) {?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $faqq['username'] ?></td>
                                    <td><?php echo $faqq['name'] ?></td>
                                    <td><?php echo $faqq['email'] ?></td>
                                    <td><?php echo $faqq['location'] ?></td>
                                    <td><?php echo $faqq['Phone_Number'] ?></td>
                                    <td><?php echo $faqq['service'] ?></td>
                                    <td><?php echo $faqq['feedback'] ?></td>
                                </tr>
                                 <?php } ?>
                            </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>   
</body>
</html>
