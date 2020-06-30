<?php
    session_start();

    if(!isset($_SESSION['aUserId'])){
        header('Location:login.php');
    }

    require '../db/connect.php';

    $models = $pdo->prepare("select model.*, user.username from model join user on model.userId = user.id");
    $models->execute();

    if(isset($_GET['did'])){
        $cars = $pdo->prepare('select * from car where modelId = :did');
        $cars ->execute($_GET);
        if($cars->rowCount() == 0) {
            $stmt = $pdo->prepare('DELETE FROM model WHERE id = :did');
            $stmt->execute($_GET);
            header('Location:models.php?success=Model Deletted Successfully');
        }
        else{
            $_GET['success'] = 'Can not be deleted because there are cars under this model';
        }
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Car Models</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <style type="text/css"></style>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
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

            <?php if(isset($_GET['success'])){?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php echo $_GET['success']; ?>
                </div>
            <?php }?>

            <div class="tab-content" id="myTabContent">
                <div class=" col-md-5 form-group ml-auto" style="margin-left: 0 !important;">
                    <a class="nav-link ser-link" href="addmodel.php"><i class="fas fas fa-car"></i>&nbsp; Add Model  </a>
                </div>
                <table class="table table-hover">
                    <tbody>
                        <tr class="text-info">
                            <th>Model Name</th>
                            <th>User</th>
                        </tr>
                        
                        <?php foreach ($models as $model) {?>
                            <tr>
                                <td><?php echo $model['name'] ?></td>
                                <td><?php echo $model['username'];?></td>
                                <td>
                                    

                                    <a href="editmodel.php?eid=<?php echo $model['id'];?>"  class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>

                                    
                                    <a href="models.php?did=<?php echo $model['id'];?>" class="btn btn-sm btn-icon btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</body>
</html>
