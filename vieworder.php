<?php
include('index.php');
$query = "SELECT * FROM order_info";
$prepared = $db->prepare($query);
$prepared->execute();
$result = $prepared->get_result();
?>
<table border="1" cellspacing="0" cellpadding="10">
  <tr>
    <th>S.N</th>
    <th>Customer Email</th>
    <th>Order Number</th>
    <th>Number of Items</th>
    <th>Total Price</th>
    <th>Employee Email</th>
    <th>Purchase Date</th>
    <th>Arrival Date</th>
  </tr>
<?php
if ($result->num_rows > 0) {
  $sn=1;
  while($data = $result->fetch_assoc()) {
 ?>
 <tr>
   <td><?php echo $sn; ?> </td>
   <td><?php echo $data['customer_email']; ?> </td>
   <td><?php echo $data['Order_Number']; ?> </td>
   <td><?php echo $data['Num_Of_Items']; ?> </td>
   <td><?php echo $data['Total_Price']; ?> </td>
   <td><?php echo $data['employee_email']; ?> </td>
   <td><?php echo $data['Purchase_date']; ?> </td>
   <td><?php echo $data['Arrival_Date']; ?> </td>
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