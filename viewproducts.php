<?php
include('index.php');
$query = "SELECT * FROM merch";
$prepared = $pdo->prepare($query);
$prepared->execute();
$result = $prepared->get_result();
?>
<table border="1" cellspacing="0" cellpadding="10">
  <tr>
    <th>S.N</th>
    <th>Product ID</th>
    <th>Cost</th>
    <th>Product Name</th>
    <th>Category</th>
    <th>Availability</th>
    <th>Material</th>
    <th>Color</th>
    <th>Size</th>
  </tr>
<?php
if ($result->num_rows > 0) {
  $sn=1;
  while($data = $result->fetch_assoc()) {
 ?>
 <tr>
   <td><?php echo $sn; ?> </td>
   <td><?php echo $data['product_id']; ?> </td>
   <td><?php echo $data['cost']; ?> </td>
   <td><?php echo $data['product_name']; ?> </td>
   <td><?php echo $data['category']; ?> </td>
   <td><?php echo $data['availability']; ?> </td>
   <td><?php echo $data['material']; ?> </td>
   <td><?php echo $data['color']; ?> </td>
   <td><?php echo $data['size']; ?> </td>
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