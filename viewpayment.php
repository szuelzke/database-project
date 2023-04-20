<?php
include('index.php');
$query = "SELECT * FROM payment";
$prepared = $pdo->prepare($query);
$prepared->execute();
//$result = $prepared->get_result();
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
//if ($result->num_rows > 0) {
  $sn=1;
  while($data = $prepared->fetch()) {
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
//} else { 
  ?>
 </table