<?php
include('index.php');
$query = "SELECT * FROM employees";
$prepared = $pdo->prepare($query);
$prepared->execute();
//$result = $prepared->get_result();
?>
<table border="1" cellspacing="0" cellpadding="10">
  <tr>
    <th>S.N</th>
    <th>Employee ID</th>
    <th>Employee Name</th>
    <th>Employee Email</th>
    <th>Date of Birth</th>
    <th>Department</th>
    <th>Start Date</th>
    <th>Salary</th>
    <th>Password</th>
  </tr>
<?php
//if ($result->num_rows > 0) {
  $sn=1;
  while($data = $prepared->fetch()) {
 ?>
 <tr>
   <td><?php echo $sn; ?> </td>
   <td><?php echo $data['employee_id']; ?> </td>
   <td><?php echo $data['employee_name']; ?> </td>
   <td><?php echo $data['employee_email']; ?> </td>
   <td><?php echo $data['date_of_birth']; ?> </td>
   <td><?php echo $data['department']; ?> </td>
   <td><?php echo $data['start_date']; ?> </td>
   <td><?php echo $data['salary']; ?> </td>
   <td><?php echo $data['password']; ?> </td>
 <tr>
 <?php
  $sn++;}
//} else { 
  ?>
 </table