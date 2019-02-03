<h3>Add Item</h3>
<hr>
<?php 
$pdo=TOOLS::connect();
$list = $pdo->query("select * from Categories");
?>
<?php if(!isset($_POST['addbtn'])):?>
<div class="well well-lg col-sm-5 col-lg-5" style="box-shadow: 5px 5px 10px lightblue;">
<form action="index.php?page=4" method="POST" role="form" enctype="multipart/form-data">
    <div class="form-group">
        <label for="catId">Category</label>
        
        <select name="catId"  class="form-control">
        <option selected disabled>Choose...</option>
        <?php while($row =$list->fetch()):?>
            <option value="<?=$row['id']?>"><?=$row['category']?></option>
<?php endwhile;?>
        </select>
        
    </div>
    <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name"  placeholder="Name">
    <label for="name">Income and Sale price</label>
    <input type="number" class="form-control" name="priceIn"  placeholder="Price In">
    <input type="number" class="form-control" name="priceSale"  placeholder="Sale price">
    <div class="form-group">
    <label for="imagePAth">Main Photo</label>
    <input type="file" class="form-control pull-right" name="imagePAth">
    </div>
    <div class="form-group">
    <label for="images[]">Additional Photos</label>
    <input type="file" class="form-control pull-right" name="images[]" multiple>
    </div></div>
    <div class="form-group">
    
    <label for="info" class="col-sm-2">Info</label>
    
    <textarea name="info" id="inputinfo" class="form-control" rows="3" required="required"></textarea>
    
    </div>

    <button type="submit" name="addbtn" class="btn btn-primary">Add Item</button>
</form>
</div>
<?php else:?>
<?php if(is_uploaded_file($_FILES['imagePAth']['tmp_name'])){
    $path = "images/".$_FILES['imagePAth']['name'];
    move_uploaded_file($_FILES['imagePAth']['tmp_name'], $path);
}
$catId = $_POST['catId'];
$priceIn = $_POST['priceIn'];
$priceSale = $_POST['priceSale'];
$name = $_POST['name'];
$info = $_POST['info'];
$item = new Item(0, $name, $catId, $priceIn,$priceSale, $info, $rate=5, $path);
$item ->intoDb();
$insertedId=   $item->lastInsertedId;

if(count($_FILES['images']['name'])>0){
// Loop through each file
for( $i=0 ; $i < count($_FILES['images']['name']); $i++ ) {

    //Get the temp file path
    $tmpFilePath = $_FILES['images']['tmp_name'][$i];
  
    //Make sure we have a file path
    if ($tmpFilePath != ""){
      //Setup our new file path
      $newFilePath = "images/" . $_FILES['images']['name'][$i];
  
      //Upload the file into the temp dir
      if(move_uploaded_file($tmpFilePath, $newFilePath)) {
  
        $image = new Images(0,$insertedId,$newFilePath, $alt="More Photos", $title="More Photos");
        $image->imageToBD();
  
      }
    }
  }

}

?>
<?php endif; ?>