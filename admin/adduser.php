<?php
    session_start();

    if(!isset($_SESSION['aUserId'])){
        header('Location:login.php');
    }

    require '../db/connect.php';

    if(isset($_POST['save'])){
        $stmt = $pdo->prepare("insert into user(username,email,password,type) values(:username, :email, :password, :type)");
        unset($_POST['save']);
        $_POST['type'] = 2;
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        // echo '<pre>'; print_r($_POST); die();
        $stmt->execute($_POST);
        header('Location:users.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">         

    
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <style type="text/css"></style>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
        
</head>
<body>

<div class="container">

<?php require 'sidebar.php'; ?>
    <div id="mid-content" style="padding:2% 0%" class="col-md-9">
        <div class="container">
            <div class="col-md-12">
                <div class="tab-content" id="myTabContent">
                    <div class="col-md-12 col-md-offset-1">
                        <div class="panel panel-yel">               
                            <div class="panel-body">
                                <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                           
                                    <div class="col-md-12">
                                        <h2 class="text-secondary">Admin:</h2>
                                    </div>
                                    <div class="form-group">

                                   
                                    
                                        <label for="name" class="col-md-4 control-label">Username</label>

                                        <div class="col-md-6">
                                        
                                            <input type="text" class="form-control grey-glow" name="username" value="" required="" autofocus/>


                    
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="model" class="col-md-4 control-label ">Email</label>

                                        <div class="col-md-6">
                                            <input id="model" type="text" class="form-control grey-glow" name="email" value="" required=""/>

                                
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="production-year" class="col-md-4 control-label">Password</label>

                                        <div class="col-md-6">
                                            <input type="password" class="form-control grey-glow" name="password" value="" required=""/>
                                        
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <input type="submit" class=" btn-primary form-control grey-glow" name="save" 
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
