<?php
  // $id = $_POST['id'];
  require 'db/connect.php';
  $stmt = $pdo->prepare('select * from car where id = :id');
  $stmt->execute($_POST);
  $car = $stmt->fetch();
?>
<!-- modal -->
<div class="modal-dialog modal-dialog-scrollable">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" >Car Detail</h5>
      <button type="button" class="close" id="closeTop" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <img src="admin/uploads/<?php echo $car['image'];?>" class="" height="auto" width="100%" height="200px";>         
      <table>
        <tr>
          <td>fuel_Type:</td>
          <td><?php echo $car['fuelType'];?></td>
        </tr>
        <tr>
            <td>Production_year :</td>
            <td><?php echo $car['production_year'];?></td>
        </tr>
        <tr>
            <td>Plate Number:</td>
            <td><?php echo $car['plate_number'];?></td>
        </tr>
        <tr>
            <td>Seat: </td>
            <td><?php echo $car['seat'];?></td>
        </tr>
        <tr>
            <td>Price/day:</td>
            <td><?php echo $car['cost'];?></td>
        </tr>

        <tr>
            <td>Stock:</td>
            <td><?php echo $car['stock'];?></td>
        </tr>
      </table>
    </div>
    <div class="modal-footer">
      <a href="userprofile.php" class="btn-primary btn <?php if($car['stock'] == 0) echo 'disabled' ?>" onclick="">
        <i class="far fa-clock"></i> Rent Car
      </a>            
      <button type="button" class="btn btn-danger" id="close" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
<!-- modal ends -->