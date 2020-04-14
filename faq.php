<!DOCTYPE html>
<html>
<head>
	<title>Faq page</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="./css/fnavbar.css">
	
</head>
<body>
	 <div class="full-height" id="app">
 <nav class="navbar  navbar-expand-lg navbar-light bg-light">

<a class="navbar-brand" href="/">
 <img src="images/logocar.png"  alt="car-logo" width="60" height="40" class="d-inline-block align-top" alt="">
Arena Car
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
 <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarTogglerDemo02">

 <ul class="nav navbar-nav ml-auto">
                     <li><a href="home.php" >HOME</a></li>
                     <!-- Authentication Links -->
                          <li><a href="contact.php" >CONTACT</a></li>
                       <li><a href="faq.php" >FAQ</a></li>

                         <li><a href="login.php" ><i class="fas fa-door-open"></i> LOGIN</a></li>


                         <li><a href="register.php"> <i class="fas fa-user-edit"></i> REGISTER</a></li>

       			 
                 </ul>

</div>
</nav>
             
</head>
<body>
	<style>

.p1{
	margin-left:250px;
	font-size:50px;
	color:grey;
}

.form-control{
  margin-left: 0px;
  width:500px;
  height: 200px !important;

}
</style>

<div class="container">
<div class="p1">
    If Any Queries,Message Here
    </div><br>
  <div class="row">
  <div class="col-sm-7">
     <a class="navbar-brand text-center" href="/">
            <img src="images/logocar.png"  width="50%"alt="car-logo"  class="" alt="Car image is here">

            <h3 style = "color:red">Query About Rent car</h3>
          
          </a>
  </div>
  <div class="col-sm-5">
    <form>
      <div class="form-group">
    <label for="exampleFormControlTextarea1" style="font-size:20px">Enquiry</label><br>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"></textarea>
    <br>
           <button class="btn btn-primary" type="submit">Submit </button>

    </form>
  </div>
</div>
</div>
<!--script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
 -->
</div>
<div class="container-fluid footerr">
</div>
	<br><br><br><br>
<div class="container-fluid foot">
    <div class="text-center">
        <a href="#" class="foota">About</a>
        <a href="#" class="foota"> Contact</a>
          <a href="#" class="foota"> FAQ</a>
        <a href="#" class="foota">Help</a> <br>
        Copyright 2019. All Rights Reserved
    </div>
</div>
</body>
</html>