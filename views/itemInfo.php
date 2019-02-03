<?php
session_start();
include_once('classes.php');
if (isset($_GET['name'])){
    $item = Item::fromBD($_GET['name']);
    $images = Images::GetImages($_GET['name']);
    echo "<button type='button' class='close' data-dismiss='modal'>&times;</button>";
 echo "<h1>$item->title</h1>";  
 echo "<div class='block'>";

echo "<p><img src='$item->imagePath' alt='Main Photo' style='display:inline-block;margin:0 auto;heigh:250px;width:250px;'></p>";
echo "</div>";
if ($images){
    foreach ($images as $image) {
        echo "<div class='block'>";
      echo "<p><img src='$image->imagePath' alt='$image->alt' style='display:inline-block;margin:0 auto;heigh:250px;width:250px;'></p>"; 
      echo "</div>";
    }
   
}
echo "<p>Price: $item->priceSale</p>";
echo "<ul>";
echo "<li>$item->info</li>";

echo "</ul>";
echo "<p>Rate: $item->rate</p>";


echo "<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>";
}
?>