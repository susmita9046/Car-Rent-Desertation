<?php
    session_start();

    if(!isset($_SESSION['UserId'])){
        header('Location:login.php');
    }
    require 'db/connect.php';
?> 

<!DOCTYPE html>
<html>
<head>
    <title>Paypal Checkout Page</title>
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

    <script
        src="https://www.paypal.com/sdk/js?client-id=ATAaOooFljs5f-JluMDCNkxxCFIzofEdZ_fvgP75PTBsRVO_ycqmvkkz1BvrPy9yrmiht5oXVmdM5I4V">
    </script>

</head>
<body>
<div class="full-height" id="app">
<?php include 'user-nav-bar.php' ?>
 <div class="container">

    <div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
        <div id="paypal-button-container"></div>
    </div>
    <script type="text/javascript">
        paypal.Buttons({
            createOrder: function(data, actions) {
            // This function sets up the details of the transaction, including the amount and line item details.
            return actions.order.create({
                purchase_units: [{
                amount: {
                    value: '112.45'
                }
                }]
            });
            },
            onApprove: function(data, actions) {
            // This function captures the funds from the transaction.
            return actions.order.capture().then(function(details) {
                // This function shows a transaction success message to your buyer.
                alert('Transaction completed by ' + details.payer.name.given_name);
            });
            }
        }).render('#paypal-button-container');
        //This function displays Smart Payment Buttons on your web page.
    </script>


</div>
</div>



   

<?php include 'footer.php' ?>
    </body>
</html>