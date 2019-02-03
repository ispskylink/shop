<div class="row" style="marin-top:5px ;">
<img src="<?=$this->imagePath?>" width="70px" alt="image" class="col-md-1">
<span style="margin-right:10px; background:#3c763d" class="col-md-3">
<?=$this->title?>
</span>
<span style="margin-right:10px; background:#5bc0de;">
<?=$this->priceSale?></span>
<?php $ruser =''?>
<?php if (!isset($_SESSION['reg']) || $_SESSION['reg'] ==''){
    $ruser = 'cart_'.$this->id;
}
else{
$ruser = $_SESSION['reg'].'_'.$this->id;
}

?>
<button class="btn  btn-sm btn-danger" style="margin-left:10px;" onclick="eraseCookie('<?=$ruser?>')">x</button>
</div>
