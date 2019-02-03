<?php
include_once 'classes.php';
if (isset($_POST['cat'])){
   $cat = $_POST['cat'];
// $pdo = TOOLS::connect();
$items=Item::GetItems($cat);
foreach ($items as $item) {
    $item->Draw();
} }

if (isset($_POST['val1']) && isset($_POST['val0'])){
    $val0 = $_POST['val0'];
    $val1 = $_POST['val1'];
    // $pdo = TOOLS::connect();
    $items=Item::GetItemsByPrice($val0,$val1);
    foreach ($items as $item) {
        $item->Draw();
    } 

}



?>