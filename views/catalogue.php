<h3>Catalogue</h3>
<hr>
<?php 
$pdo = TOOLS::connect();
$ps = $pdo->query('SELECT * from Categories');
?>
<div class="row" >
<div class="col-md-10" id="result" style="display:inline-block;margin-right:10px;">
<?php $items = Item::GetItems(); ?>
<?php foreach ($items as $i): ?>
<?php $i->Draw(); ?>
<?php endforeach; ?>
</div>

<div class=" col-md-offset-10">
<form action="index.php?page=1" method="post">


<h5 >Filters:</h5>
<p>Category:</p>
<select  name='catId' onchange="GetItemsCat(this.value);">
<option value="0">Select Category</option>
<?php while($row = $ps->fetch()): ?>
<option value="<?=$row['id']?>"><?=$row['category']?></option>
<?php endwhile; ?>
</select>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 50000,
      values: [ 75, 15000 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
       
      },
      stop: function(event, ui){
        GetItemsByPrice(ui.values[0],ui.values[1]);
      }
    });
    $( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) +
      " - " + $( "#slider-range" ).slider( "values", 1 ) );
       
  } );
  </script>
<p>
  <label style="margin-top:15px" for="amount">Price range(uah):</label>
  <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
</p>
 
<div style="margin-bottom:15px;width:200px;" id="slider-range"></div>
<button type="reset" class="btn  btn-danger">Reset Filter</button>
</form>
</div>






</div>
<script>
function GetItemsByPrice(val0, val1){
    if(window.XMLHttpRequest){
        req = new XMLHttpRequest();
    }
    else{
        req = new ActiveXObject('Microsoft.XMLHTTP');
    }
    req.onreadystatechange = function (){
        if(req.readyState==4 && req.status == 200){
            document.getElementById('result').innerHTML=req.responseText;
        }
    }
    req.open('post', 'views/lists.php', true);
    req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    req.send("val0="+val0+"&val1="+val1);
}
function GetItemsCat(cat){
    if (cat==""){
        document.getElementById('result').innerHTML="";
    }
    if(window.XMLHttpRequest){
        req = new XMLHttpRequest();
    }
    else{
        req = new ActiveXObject('Microsoft.XMLHTTP');
    }
    req.onreadystatechange = function (){
        if(req.readyState==4 && req.status == 200){
            document.getElementById('result').innerHTML=req.responseText;
        }
    }
    req.open('post', 'views/lists.php', true);
    req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    req.send("cat="+cat);
}
</script>