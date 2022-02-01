<?php 
include('connection.php');
$username = $_POST['username'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$role = $_POST['role'];
$role1 = $_POST['role1'];
$id = $_POST['id'];

$sql = "UPDATE `masterlogin` SET  `username`='$username' , `email`= '$email', `mobile`='$mobile',  `role`='$role', `role1`='$role1' WHERE id='$id' ";
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