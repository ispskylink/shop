<?php 
$ruser='';
if (!isset($_SESSION['reg']) || $_SESSION['reg'] ===''){
    $ruser = 'cart';
}
else{
    $ruser = $_SESSION['reg'];
}
if(isset($_POST['suborder'])){
    foreach ($_COOKIE as $k => $value) {
        $pos = strpos($k, "_");
        if (substr($k, 0,$pos) ==$ruser){
            $id = substr($k, $pos+1);
            $item = Item::fromBD($id);
            $item->Sale();
        }
    }
   echo " <div class='alert alert-success'>";
  echo "<strong>Success!</strong> You have bought all theese things right now!";
 echo "</div>"; 
}
?>
<h3>Cart</h3>

<form action="index.php?page=2" method="post">
<?php

$total=0;
foreach ($_COOKIE as $k => $v) {
  // echo $k.":".$value."<br>";
    $pos = strpos($k, "_");
    if (substr($k,0,$pos)==$ruser){
        $id = substr($k, $pos+1);
     //   echo $id."<br>";
        $item = Item::fromBD($id);
        $total+=$item->priceSale;
        $item->DrawForCart();
    }

}
?>
 <hr>
<span>Total:  <?php echo $total?> </span>
<button type="submit" name="suborder" onclick="eraseCookie('<?=$ruser?>',true);" class="btn btn-success pull-right">Purchase order</button>
</form>


