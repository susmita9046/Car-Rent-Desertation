<?php
    session_start();

    if(!isset($_SESSION['aUserId'])){
        header('Location:login.php');
    }

    require '../db/connect.php';
    
    if(isset($_GET['eid'])){
        $model = $pdo->prepare('SELECT * FROM model WHERE id = :eid');
        $model->execute($_GET);
        $row = $model->fetch();
    }

    if(isset($_POST['update'])){
        $stmt = $pdo->prepare("UPDATE model SET name = :name WHERE id = :id");
        unset($_POST['update']);
        $stmt->execute($_POST);
        header('Location:models.php?success=Model Updated Successfully');
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Model</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">         

    
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <style type="text/css"></style>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
        
</head>
<body>

<div class="container">

<?php require 'sidebar.php'; ?>
    <div id="mid-content" class="col-md-9" style="padding:2% 0%">
        <div class="container">
            <div class="col-md-12">
                <div class="tab-content" id="myTabContent">
                    <div class="col-md-12 col-md-offset-1">
                        <div class="panel panel-yel">               
                            <div class="panel-body">
                                <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                                    
                                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                    <div class="col-md-12">
                                        <h2 class="text-secondary">Edit Model:</h2>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-md-4 control-label">Model Name</label>

                                        <div class="col-md-6">
                                            <input type="text" class="form-control grey-glow" name="name" value="<?php echo $row['name'] ?>" autofocus/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <input type="submit" class="form-control grey-glow" name="update" 
                                            value="Update" />
                                        </div>
                                    </div>

                                    <br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
