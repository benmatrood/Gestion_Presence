<?php 
include('connection.php');
$username = $_POST['username'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$role = $_POST['role'];
$role1 = $_POST['role1'];

$sql = "INSERT INTO `masterlogin` (`username`,`email`,`mobile`,`role`,`role1`,`password`) values ('$username', '$email', '$mobile', '$role', '$role1', '$mobile' )";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{
   
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 

?>