

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Galeria</title>
</head>
<body>
<div class="collapse" id="navbarToggleExternalContent">
  <div class="bg-dark p-4">
    <h5 class="text-white h4">Jakub Rudnicki</h5>
    <span class="text-muted">
        <?php 
            echo date("Y-m-d H:i:s");
        ?>
    </span>
  </div>
</div>
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>


<?php
 $con = mysqli_connect("localhost","root","","exam");
 // Check connection
 if (mysqli_connect_errno()){
     echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
 }
 $sql = "SELECT * FROM images";
 $result = $con->query($sql);
 
 if ($result->num_rows > 0) { 


 ?>

<div class="container mt-4">
  <div class="row">

  <?php
            while($row = $result->fetch_assoc()) { ?>

    <div class="col-sm-3">
    <div class="card mt-4" style="width: 18rem;">
  <img class="card-img-top" style="height: 200px; width: 100%;" src="./images/<?php echo $row['imagefile'] ?>" alt="<?php echo $row['imagefile'] ?>">
  <div class="card-body">
    <p class="card-text">Autor: <?php echo $row['author'] ?></p>
    <p class="card-text">Nazwa: <?php echo $row['name'] ?></p>
    <input type="submit" value="Więcej" class="btn btn-dark" form="<?php echo $row['id'] ?>">
    <form action="/view.php" id="<?php echo $row['id'] ?>" method="get">
    <input type="hidden" name="id" value="<?php echo $row['id'] ?>" form="<?php echo $row['id'] ?>">
</form>
  </div>
</div>
    </div>
<?php 
            }
?>
    
  </div>
</div>

<?php 
            $con->close(); 
}
?>

</body>
</html>