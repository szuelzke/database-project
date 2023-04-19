<?php
include('config.php');
$query = "SELECT * FROM payment";
$prepared = $db->prepare($query);
$prepared->execute();
$result = $prepared->get_result();
?>
<table border="1" cellspacing="0" cellpadding="10">
  <tr>
    <th>S.N</th>
    <th>Payment ID</th>
    <th>Customer ID</th>
    <th>Card Number</th>
    <th>Payment Date</th>
  </tr>
<?php
if ($result->num_rows > 0) {
  $sn=1;
  while($data = $result->fetch_assoc()) {
 ?>
 <tr>
   <td><?php echo $sn; ?> </td>
   <td><?php echo $data['payment_id']; ?> </td>
   <td><?php echo $data['customer_id']; ?> </td>
   <td><?php echo $data['card_number']; ?> </td>
   <td><?php echo $data['payment_date']; ?> </td>
 <tr>
 <?php
  $sn++;}
} else { 
  ?>
    <tr>
     <td colspan="8">No data found</td>
    </tr>
 <?php } ?>
 </table