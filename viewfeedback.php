<?php
    session_start();

    if(!isset($_SESSION['UserId'])){
        header('Location:login.php');
    }
    require 'db/connect.php';

    $feedback = $pdo->prepare("SELECT feedbacks.*, model.name as modelName 
                            FROM 
                              feedbacks JOIN model ON feedbacks.modelId = model.id");
    $feedback->execute();
    if(isset($_GET['did'])){
        $stmt = $pdo->prepare('DELETE FROM feedbacks WHERE id = :did');
        $stmt->execute($_GET);
        header('Location:viewfeedback.php?success=feedback Deletted Successfully');
    }
    
?> 


<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/fnavbar.css">
    <link rel="stylesheet" type="text/css" href="css/styll.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="js/menuToggle.js"></script>
    <style type="text/css">
       
    </style>
</head>
<div class="full-height" id="app">
<?php include 'user-nav-bar.php' ?>
 <div class="container">
     <div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
            <?php
            if(isset($_GET['msg'])){
                echo '<h4 style="color:green">' . $_GET['msg'] .'</h4>';
            }
            ?>
            <h2>Your Feedback details</h2>
            <table class="table table-striped table-dark">
                <thead>
                <tr>
                 
                    <th>Car Name</th>
                    <th>Feedback</th>
                    <th>Service</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($feedback as $feedbacks) {?>
                        <tr>
                            <td><?php echo $feedbacks['modelName'] ?></td>
                            <td><?php echo $feedbacks['feedback'] ?></td>
                            <td><?php echo $feedbacks['service'] ?></td>
                            <td>
                        
                             <a href="viewfeedback.php?did=<?php echo $feedbacks['id'] ?>">Cancel</a>    
                            </td>                                  
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


    <?php include 'footer.php' ?>
    </body>

</html>