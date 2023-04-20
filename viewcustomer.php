<?php
include('index.php');
$query = "SELECT * FROM customers";
$prepared = $db->prepare($query);
$prepared->execute();
$result = $prepared->get_result();
?>
<table border="1" cellspacing="0" cellpadding="10">
  <tr>
    <th>S.N</th>
    <th>Customer ID</th>
    <th>Customer Name</th>
    <th>Customer Email</th>
    <th>Phone Number</th>
    <th>Card Number</th>
    <th>Address Line</th>
    <th>City</th>
    <th>State </th>
    <th>Zip Code</th>
    <th>Password</th>
  </tr>
<?php
if ($result->num_rows > 0) {
  $sn=1;
  while($data = $result->fetch_assoc()) {
 ?>
 <tr>
   <td><?php echo $sn; ?> </td>
   <td><?php echo $data['customer_id']; ?> </td>
   <td><?php echo $data['customer_name']; ?> </td>
   <td><?php echo $data['customer_email']; ?> </td>
   <td><?php echo $data['phone_number']; ?> </td>
   <td><?php echo $data['card_number']; ?> </td>
   <td><?php echo $data['address']; ?> </td>
   <td><?php echo $data['city']; ?> </td>
   <td><?php echo $data['state']; ?> </td>
   <td><?php echo $data['zip_code']; ?> </td>
   <td><?php echo $data['password']; ?> </td>
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