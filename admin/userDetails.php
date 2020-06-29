<?php
    session_start();
    if(!isset($_SESSION['aUserId'])){
        header('Location:login.php');
    }
    require '../db/connect.php';
    $User = $pdo->prepare("select * from user where type = 0 order by type asc");
    $User->execute();

    if(isset($_GET['did'])){
        $stmt = $pdo->prepare('DELETE FROM user WHERE id = :did');
        $stmt->execute($_GET);
        header('Location:userDetails.php?success=Model Deletted Successfully');
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>Details User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">  
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <style type="text/css"></style>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->

<script>       
            function myDeleteFunction(a){
                var userID = a;
                console.log(userID);
                $('#delete_user_userDetails').attr('data-id', userID); //set the data attribute on the modal button
            };

</script>

</head>
<body>

<div class="container">
    <?php require 'sidebar.php';?>
<div id="mid-content" class="col-md-9">
    <div class ="col-md-5 form-group ml-auto">
      <form method="post" action="">
        <input class="form-control" type="text" name="keyword" placeholder="Search Here">
      </form>
    </div>
    <div class="container">
        <div class="col-md-12">
            <div class="tab-content" id="myTabContent">
                <div class=" col-md-5 form-group ml-auto" style="margin-left: 0 !important;">
                    
                </div>
                <table class="table table-hover">
                    <tbody>
                        <tr class="text-info">
                            <th>username</th>
                            <th>email</th>
                            <th>Citizenship Number</th>
                            <th>Location</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                        </tr>
                        
                        <?php 
                        foreach ($User as $user) {?>
                            <tr>
                                <td><?php echo $user['username'] ?></td>
                                <td><?php echo $user['email'] ?></td>
                                <td><?php echo $user['citizenship_no'] ?></td>
                                <td><?php echo $user['location'] ?></td>
                                <td><?php echo $user['Phone_Number'] ?></td>
                                </td>
                                
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete_user_modal">
                                      <i class="fa fa-trash"></i>
                                    </button>
                                  
                                    
                                    
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="delete_user_modal" tabindex="-1" role="dialog" aria-labelledby="delete_user_modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="delete_user_modal">Modal title</h5> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete?
      </div>
      <div class="modal-footer">
        <a href="userDetails.php?did=<?php echo $user['id'];?>" class="btn btn-sm btn-icon btn-danger"><i class="fa fa-trash"></i>Yes</a>
       
        <a type="button" class="btn btn-secondary" data-dismiss="modal">No</a>
  
      </div>
    </div>
  </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



</body>
</html>
