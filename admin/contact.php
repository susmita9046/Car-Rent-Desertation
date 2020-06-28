<?php
    session_start();

    if(!isset($_SESSION['aUserId'])){
        header('Location:login.php');
    }
    require '../db/connect.php';
    $contac = $pdo->prepare("select * from contact");
    $contac->execute();
    
    if(isset($_GET['did'])){
        $stmt = $pdo->prepare('DELETE FROM contact WHERE id = :did');
        $stmt->execute($_GET);
        header('Location:contact.php?success=contact Deletted Successfully');
    }

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
                <?php if(isset($_GET['success'])){?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php echo $_GET['success']; ?>
                </div>
                <?php }?>  
                </div>
                <table class="table table-hover">
                            <thead>
                                <tr class="text-info">
                                    <th>S.N</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                   
                                </tr>
                            </thead>
                                <?php $i = 1; ?>
                                <?php foreach ($contac as $contacts) {?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $contacts['name'] ?></td>
                                    <td><?php echo $contacts['email'] ?></td>
                                    <td><?php echo $contacts['number'] ?></td>
                                    <td><?php echo $contacts['subject'] ?></td>
                                    <td><?php echo $contacts['message'] ?></td>
                                    <td>
                                        <a href="contact.php?did=<?php echo $contacts['id'];?>" cl="" ass="btn btn-sm btn-icon btn-danger"><i class="fa fa-trash"></i></a>
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
