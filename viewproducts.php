<?php
include('index.php');
$query = "SELECT * FROM merch";
$prepared = $pdo->prepare($query);
$prepared->execute();
//$result = $prepared->get_result();
?>
<table border="1" cellspacing="0" cellpadding="10">
  <tr>
    <th>S.N</th>
    <th>Item ID</th>
    <th>Item Name</th>
    <th>Item Description</th>
    <th>Item Price</th>
    <th>rrp</th>
    <th>Item Quantity</th>
    <th>Item Image</th>
    <th>Date Added</th>
  </tr>
<?php
//if ($result->num_rows > 0) {
  $sn=1;
  while($data = $prepared->fetch()) {
 ?>
 <tr>
   <td><?php echo $sn; ?> </td>
   <td><?php echo $data['itemID']; ?> </td>
   <td><?php echo $data['itemName']; ?> </td>
   <td><?php echo $data['itemDesc']; ?> </td>
   <td><?php echo $data['itemPrice']; ?> </td>
   <td><?php echo $data['rrp']; ?> </td>
   <td><?php echo $data['itemQuantity']; ?> </td>
   <td><?php echo $data['itemImg']; ?> </td>
   <td><?php echo $data['date_added']; ?> </td>
 <tr>
 <?php
  $sn++;}
//} else { 
  ?>

 </table