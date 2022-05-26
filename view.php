

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

$id = $_GET['id'];
$next_id = $id + 1;
$prev_id = $id - 1;

 $con = mysqli_connect("localhost","root","","exam");
 // Check connection
 if (mysqli_connect_errno()){
     echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
 }
 $sql = "SELECT * FROM images where id = '$id'";
 $result = $con->query($sql);

 $sql2 = "SELECT id FROM images ORDER BY id DESC LIMIT 1";
 $result2 = $con->query($sql2);

 $max = $result2->fetch_assoc();
 $max_id = $max['id'];
 $min_id = 1;

if ($next_id > $max_id) {
  $next_id = $min_id;
}

if ($prev_id < $min_id) {
  $prev_id = $max_id;
}

 if ($result->num_rows > 0) { 


 ?>

<div class="container mt-4">


  <?php
            while($row = $result->fetch_assoc()) { ?>
            <div class="card">
            <img class="card-img-top"  src="./images/<?php echo $row['imagefile'] ?>" alt="<?php echo $row['imagefile'] ?>">
            </div>

            <div class="card mt-4 mb-4">
            <h5 class="card-header">Dane</h5>
  <div class="card-body">
    <h5 class="card-title">Nazwa: <?php echo $row['name'] ?></h5>
    <p class="card-text">Picsum ID: <?php echo $row['picsum_id'] ?></p>
    <p class="card-text">Wysokość: <?php echo $row['height'] ?></p>
    <p class="card-text">Szerokość: <?php echo $row['width'] ?></p>
    <p class="card-text">Dodano: <?php echo $row['added_at'] ?></p>
    <a href="./index.php" class="btn btn-primary" style="width: 100%">Strona Główna</a>
      <div class="mt-4 mb-4 ">
        <a href="view.php?id=<?php echo $prev_id;?>" class="btn btn-danger mb-4 " style="width: 100%">Poprzednie zdjęcie</a>
        <a href="view.php?id=<?php echo $next_id;?>" class="btn btn-success" style="width: 100%">Następne zdjęcie</a>
      </div>
  </div>
            </div>
<?php 
            }
?>
    

</div>

<?php 
            $con->close(); 
}
?>

</body>
</html>