<?php
    session_start();

    if(!isset($_SESSION['aUserId'])){
        header('Location:login.php');
    }

    require '../db/connect.php';

    if(isset($_POST['save'])){
        $stmt = $pdo->prepare("insert into model(name, userId) values(:name, :userId)");
        $_POST['userId']= $_SESSION['aUserId'];
        unset($_POST['save']);
        $stmt->execute($_POST);
        header('Location:models.php?success=Model Added Successfully');
    }
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Model</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">         
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<style type="text/css"></style>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="../css/navbar.css">
<script type="text/javascript">
        function validate(form){
           
            if(form.name.value == ''){
                alert('Please enter the model name');
                form.name.focus();
                return false;
            }
            // if(form.save.value == ''){
            //     alert('Please enter the model name');
            //     form.save.focus();
            //     return false;
            // }
            
        }
</script>       
</head>
<body>

<div class="container">

<?php require 'sidebar.php'; ?>
    <div id="mid-content" style="padding:2% 0%">
        <div class="container">
            <div class="col-md-12">
                <div class="tab-content" id="myTabContent">
                    <div class="col-md-12 col-md-offset-1">
                        <div class="panel panel-yel">               
                            <div class="panel-body">
                                <form class="form-horizontal" method="POST" action="" onsubmit="return validate(this)"  enctype="multipart/form-data">
                                    
                                    <div class="col-md-12">
                                        <h2 class="text-secondary">Add Model:</h2>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-md-4 control-label">Model Name</label>

                                        <div class="col-md-6">
                                            <input type="text" class="form-control grey-glow" name="name" autofocus/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <input type="submit" class="form-control grey-glow" name="save" 
                                            value="Save" />
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
