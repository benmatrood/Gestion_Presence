<?php 
  session_destroy();
  // require_once '../connection.php'; // ajout connexion bdd
  header("location: ../index.php");
    // if (!isset($_SESSION['user_login'])) {
    //     header("location: ../index.php");
    // }
    //    // On récupere les données de l'utilisateur
    //    $req = $db->prepare('SELECT * FROM masterlogin WHERE email = ?');
    //    $req->execute(array($_SESSION['user_login']));
    //    $data = $req->fetch();

    //    // On récupere la date et l'heure courente
    //    date_default_timezone_set('Africa/abidjan');
    //     $now = date("Y-m-d H:i:s");
        

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compte Apprenant</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
 <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
   <script src="main.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body onload="init()">

    <div class="text-center mt-5">
        <div class="container ">

            <?php if(isset($_SESSION['success'])) : ?>
                <div class="alert alert-success">
                    <h3>
                        <?php 
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                        ?>
                    </h3>
                </div>
            <?php endif ?>

            <!-- <h1>User Page</h1> -->
            <hr>
        
            <h3>
            Welcome, <?php echo $data['username'];?>
            </h3>
            <a href="../logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
    <?php 
                    if(isset($_SESSION['status']))
                    {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                             <?php echo $_SESSION['status']; ?><strong> !</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                          
                        <?php
                         unset($_SESSION['status']);
                    }
                    date_default_timezone_set('Africa/abidjan');
                    $now = date("Y-m-d H:i:s");
                    // $now = date("Y-m- "); 
                // ?>
        <div class="row ">
            <div class="col-md-6 ">
                <div class="card mt-5 ">
                    <div class="card-header">
                        <h4>Enregistrer mon heure d'arrivé</h4>
                    </div>
                    <div class="card-body">

                        <form action="code.php" method="POST">
                                <input type="hidden" name="name" class="form-control"  value="<?=$data["username"];?>">
                                <input type="hidden" name="id" class="form-control"  value="<?=$data["id"];?>">
                            <div class="form-group mb-3">
                                <input type="text" name="event_dt"  value="<?=$now;?>" class="form-control" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="save_datetime"   class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4>Enregistrer mon heure de départ</h4>
                    </div>
                    <div class="card-body">

                        <form action="code.php" method="POST">
                            <input type="hidden" name="name" class="form-control"  value="<?=$data["username"];?>">
                            <input type="hidden" name="id" class="form-control"  value="<?=$data["id"];?>">
                            <div class="form-group mb-3">
                                <input type="text" name="event_depart"  value="<?=$now;?>" class="form-control" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="save_datetime_depart" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <br><br><br>
        <div id="map"></div>
        
      
        

</body>
</html>
<style>
    #map { height: 380px; }
    .row {
    
    margin-right: 0 !important;
    margin-left: 0 !important;
}
</style>