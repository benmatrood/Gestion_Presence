<?php
session_start();
//connection a la base de donnée
$con = mysqli_connect("localhost","root","","php_multiplelogin");

//Heure d'arriver
if(isset($_POST['save_datetime']))
{ 
    $event_date1 = $_POST['event_dt'];
    $event_date = substr("$event_date1",0,10);
    $event_dt= substr("$event_date1",11,19);
    $name= $_POST['name'];
    $id = $_POST['id'];
    if (strlen($name)>15 || $id==0) {
        session_destroy();
        header("location: ../index.php");
    }else{
    
        $query = "INSERT INTO register (morningSignIn,dayDate,username,id_user) VALUES ('$event_dt','$event_date','$name','$id')";
        $query_run = mysqli_query($con, $query);

        if($query_run)
        {
            $_SESSION['status'] = "Votre heure d'arrivée à été enregistré avec succès";
            header("Location: emmarger.php");
        }
        else
        {
            $_SESSION['status'] = "Erreur d'incertion vous avez dejas émarger pour la journée";
            header("Location: emmarger.php");
        }
    }
}
$now = date("Y-m-d H:i:s");

//Heure de départ

if(isset($_POST['save_datetime_depart']))
{

    $event_depart= $_POST['event_depart'];
    $date_now =substr("$event_depart",0,10);
    $depart = substr("$event_depart",11,19);
    $name= $_POST['name'];
    $id = $_POST['id'];
    if (strlen($name)>15 || $id==0) {
        session_destroy();
        header("location: ../index.php");
    }else{

    $query = "UPDATE register SET eveningSignIn ='$depart' WHERE username='$name' AND dayDate = '$date_now' AND id_user ='$id'";

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Votre heure de départ à été enregistré avec succès";
        header("Location: emmarger.php");
    }
    else
    {
        $_SESSION['status'] = "Erreur d'incertion veuillez réssayer";
        header("Location: emmarger.php");
    }
}
}
?>
