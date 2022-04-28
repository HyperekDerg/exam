<?php
require_once 'vendor/autoload.php';

    // Enter your host name, database username, password, and database name.
    // If you have not set database password on localhost then set empty.
    $con = mysqli_connect("localhost","root","","exam");
    // Check connection
    if (mysqli_connect_errno()){
        echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
    }

    for ($i=0; $i < 20; $i++) { 
        
// use the factory to create a Faker\Generator instance
$faker = Faker\Factory::create();


 $name = $faker->words(2, true);
 $picsum_id = $faker->unique()->numberBetween(0, 1000);

$pattern = '/ /';
$replacement = '_';

$imagefile = preg_replace($pattern, $replacement, $name).'.png';
$myfile = fopen('./images/'.$imagefile, "w") ;

$url = 'https://picsum.photos/id/'.$picsum_id.'/info';
$json = file_get_contents($url);

if($json == null){
    //url parsing didn't work
    return;
}else{
    $obj = json_decode($json);
    $author = $obj->author;
    $width = $obj->width;
    $height = $obj->height;
}
$added_at = date("Y-m-d H:i:s");


$queryadd  = "INSERT into `images` (name, picsum_id, imagefile, author, width, height, added_at)
VALUES ('$name', '$picsum_id', '$imagefile', '$author', '$width', '$height', '$added_at')";
$resultadd = mysqli_query($con, $queryadd);
    }
?>