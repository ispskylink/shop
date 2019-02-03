<?php
define ('ROOT_PATH', realpath(dirname(__FILE__)));
define('BASE_URL', 'http://stream.skylink.dp.ua/php/shop/');
class TOOLS extends PDO {
static function connect(
    $host = '',
    $user = '',
    $password = '',
    $dbname = ''){

        $conn = "mysql:host=$host;dbname=$dbname;charset=utf8;";
      $options =[
          PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
          PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8'];
try{
  $pdo =new PDO($conn, $user, $password, $options);
    return $pdo;
}catch(PDOExeption $ex){
echo $ex->getMessage();
return false;
}}


//end connect def
static function register($name, $pass, $imagePath){
    $name = trim($name);
    $password = trim($pass);
    $imagePath = trim($imagePath);
    if (empty($name) || empty($password)){
            echo "<h3 class='alert alert-success'>Shit happens</h3>";
            return false;
    }
    $costumer = new Costomer($name, $password, $imagePath);
    $costumer->intoDb();
    return true;
}
}
class Item{
    public $id;
    public $title;
    public $categoryId;
    public $priceIn;
    public $priceSale;
    public $info;
    public $rate;
    public $imagePath;
    public $lastInsertedId;
    public function __get($name)
    {
        if ($name === 'priceSale'){
            return $this->priceSale;
        }
    }
    public function __construct($id=0, $title, $categoryId, $priceIn, $priceSale, $info, $rate, $imagePath)
    {
       $this->id=$id;
       $this->title=$title;
       $this->categoryId=$categoryId;
       $this->priceIn=$priceIn;
       $this->priceSale=$priceSale;
       $this->info=$info;
       $this->rate=0;
       $this->imagePath=$imagePath;  
    }
    static function GetItemsByPrice($val0,$val1){
        $ps=null;
        $items=[];
        try {
            $pdo = TOOLS::connect();
            $ps = $pdo->query("SELECT * from Items WHERE priceSale > $val0 AND priceSale < $val1");
         
                while ($row=$ps->fetch()){
                    $item = new Item($row['id'], $row['title'], $row['categoryId'], $row['priceIn'], $row['priceSale'], $row['info'], $row['rate'], $row['imagePAth']);
                    $items[]=$item;
                } 

            return $items;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }
    static function GetItems($catId=0){
        $ps=null;
        $items=[];
        try {
            $pdo = TOOLS::connect();
            if ($catId==0){
                $ps = $pdo->query("SELECT * from Items");
            }
            else {
                $ps = $pdo->query("SELECT * from Items where categoryId = '$catId'");              
                } 
                while ($row=$ps->fetch()){
                    $item = new Item($row['id'], $row['title'], $row['categoryId'], $row['priceIn'], $row['priceSale'], $row['info'], $row['rate'], $row['imagePAth']);
                    $items[]=$item;
                } 

            return $items;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }
    function Draw(){
        $pdo=TOOLS::connect();
        $ps = $pdo->query("select * from Images where itemId=$this->id");  
        echo "<div class='col-md-3 col-sm-3' style='display:block;margin:2px;'>";
        echo "<div class='row' style='margin-top: 2px; background: green'>";
        echo "<span><a  data-toggle='modal' data-target='#$this->id' href='views/itemInfo.php?name=$this->id' class='pull-left' style='color:black;overflow: hidden;margin-left:10px;' target='_blank'>";
        echo $this->title;
        echo "</a></span>";
        echo "<span class='pull-right' style='margin-right:10px;'>";
        echo $this->rate;
        echo "</span>";
        echo "</div>";
        echo "<div class='row'>";
        echo "<img src='$this->imagePath' class='img-responsive'>";
        echo "</div>";
        echo "<div class='row' style='margin-top:10px;'>";
        echo "<p class='text-left col-xs-12' style='background-color:white;'>";
        echo $this->info;
        echo "</p>";
        echo "</div>";
        echo "<div class='row' style='margin-top:2px;'>";
       // $ruser = '';
        if (!isset($_SESSION['reg']) || $_SESSION['reg'] ==''){
            $ruser="cart_".$this->id;
        } else{
            $ruser = $_SESSION['reg'].'_'.$this->id;

        }
        echo "<button class='btn btn-success' onclick=CreateCookie('$ruser','$this->id');>Add To Cart</button>";
        echo "</div></div>";
        echo "<div class='modal fade' tabindex='-1' id='$this->id' role='dialog'>";
        echo "<div class='modal-dialog' role='document'>";
        echo "  <div class='modal-content'>";
        echo "    <div class='modal-header'>";
        echo "      <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
        echo "      <h4 class='modal-title'>$this->title</h4>";
        echo "    </div>";
        echo "    <div class='modal-body'>";
        echo "      <p>";
        echo $this->info;
        echo "</p>";
        echo "    <img src='$this->imagePath' class='image-resonsitive'>";
        echo "   </div>";
        echo "    <div class='modal-footer'>";
        echo "      <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>";
        echo "      <button type='button' class='btn btn-primary'>Save changes</button>";
        echo "      <div id='carousel-example-generic' class='carousel slide' data-ride='carousel'>";
        echo "<ul class='carousel-indicators'>";
        echo "<li data-target='#carousel-example-generic' data-slide-to='0' class='active'></li>";
        echo "<li data-target='#carousel-example-generic' data-slide-to='1'></li>";
        echo "<li data-target='#carousel-example-generic' data-slide-to='2'></li>";
        echo "</ul>";
        echo "<div class='carousel-inner' role='listbox'>";
        echo "<div class='item active'>";
        echo " <img src='$this->imagePath' alt='picture'>";
        echo " </div>";
    while ($row=$ps->fetch()){
        $src = $row['imagePAth'];
        $alt = $row['alt'];
    
    echo "<div class='item'>";
    echo " <img src='$src' alt='$alt'>";
    echo " </div>";
}
    
  echo "</div>
    <a class='left carousel-control' href='#carousel-example-generic' role='button' data-slide='prev'>
    <span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span>
    <span class='sr-only'>Previous</span>
  </a>
  <a class='right carousel-control' href='#carousel-example-generic' role='button' data-slide='next'>
    <span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span>
    <span class='sr-only'>Next</span>
  </a>
</div>
              </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->";
    }
    function DrawForCart(){
        echo "<div class='row' style='margin-top:10px;'>";
        echo "<img src='$this->imagePath' width='90px' alt='image' class='col-md-1'>";
        echo "<span style='margin-right:10px; background:#3c763d;' class='col-md-3'>";
        echo $this->title;
        echo "</span>";
        echo "<span style='margin-right:10px; background:#5bc0de;'>";
        echo $this->priceSale;
        echo "</span>";
        $ruser ='';
        if (!isset($_SESSION['reg']) || $_SESSION['reg'] ==''){
            $ruser = 'cart_'.$this->id;
        }
        else{
        $ruser = $_SESSION['reg'].'_'.$this->id;
        }
       
        echo "<button class='btn  btn-sm btn-danger' style='margin-left:10px;' onclick=eraseCookie('$ruser');>x</button>";
        echo "</div>";
    }
    function Sale(){
        try{
            $pdo =TOOLS::connect();
            $ruser = 'cart';
            if (isset($_SESSION['reg']) && $_SESSION['reg'] !=''){
                    $ruser = $_SESSION['reg'];
                   // echo $this->priceSale;
            }
            $sql = "UPDATE Costomers SET total=total+:total WHERE login=:user";
            $ps=$pdo->prepare($sql);
            $ps->execute([
               'total'=> $this->priceSale,
                'user'=>$ruser
            ]);

            $ps= $pdo->prepare("INSERT into Sales(customerName,	priceIn, priceSale)
                                VALUES(:customerName, :priceIn, :priceSale)");
       $ps->execute([
        'customerName'=>$ruser,
        'priceIn'=>$this->priceIn,
        'priceSale'=>$this->priceSale
       // 'dateSale'=>'now()'
    ]);
    }catch(PDOExeption $ex){
           // echo $ex->getMessage();
            return $ex->getMessage(); ;
        }
    }
    public function intoDb(){
        try{
            $pdo =TOOLS::connect();
            $ps= $pdo->prepare("INSERT into Items(title, categoryId, priceIn, priceSale, info, rate, imagePAth)
                                VALUES(:title, :categoryId, :priceIn, :priceSale, :info, :rate, :imagePAth)");
           
            $ps->execute([
                'title'=>$this->title,
                'categoryId'=>$this->categoryId,
                'priceIn'=>$this->priceIn,
                'priceSale'=>$this->priceSale,
                'info'=>$this->info,
                'rate'=>$this->rate,
                'imagePAth'=>$this->imagePath
            ]);
           
              $this->lastInsertedId =  $pdo->lastInsertId();
        }catch(PDOExeption $ex){
               return $ex->getMessage(); 
               
        }
    
    }
    static function fromBD($id){
        $item=null;
        try{
            $pdo=TOOLS::connect();
            $ps=$pdo->query("SELECT * FROM Items WHERE id=$id");
            $row = $ps->fetch();
            $item = new Item($row['id'], $row['title'], $row['categoryId'], $row['priceIn'], $row['priceSale'], $row['info'], $row['rate'], $row['imagePAth']);
            return $item;
        }catch(PDOExeption $ex)
        {
            return $ex->getMessage(); 
           
        }
    }
    
}
class Images{
    public $id;
    public $itemId;
    public $imagePath;
    public $alt;
    public $title;
    function __construct($id=0, $itemId,$imagePath,$alt, $title){
        $this->id=$id;
        $this->itemId = $itemId;
        $this->imagePath = $imagePath;
        $this->alt = $alt;
        $this->title = $title;  
    }

static function GetImages($id){
        $images=[];
        try{
            $pdo=TOOLS::connect();
            $ps=$pdo->query("SELECT * from Images WHERE itemId=$id");  
            if ($ps->rowCount()>0){
            while ($row=$ps->fetch()){
            $item = new Images($row['id'], $row['itemId'], $row['imagePath'], $row['alt'], $row['title']);
            $images[]=$item;
            } 
             return $images;
            }  else{
                return false;
            }        
           
           
        }catch(PDOExeption $ex)
        {
            return $ex->getMessage(); 
            return false;
        }

    }
    public function imageToBD(){
        try{
        $pdo =TOOLS::connect();
            $ps= $pdo->prepare("INSERT into Images(itemId, imagePath, alt, title)
                                VALUES(:itemId, :imagePath, :alt, :title)");
            $ps->execute([
                'itemId'=>$this->itemId,
                'imagePath'=>$this->imagePath,
                'alt'=>$this->alt,
                'title'=>$this->title
            ]);
        }catch(PDOExeption $ex){
               return $ex->getMessage(); 
               
        }
    }}
class Costomer{
    protected $id;
    protected $login;
    protected $password;
    protected $roleId;
    protected $discount;
    protected $total;
    protected $imagePath;
    function __construct($login, $password, $imagePath, $id=0){
$this->login = $login;
$this->password = $password;
$this->imagePath = $imagePath;
$this->id = $id;
$this->total = 0;
$this->discount = 0;
$this->roleId = 3;}
    function intoDb(){
        try{
            $pdo = TOOLS::connect();
            $ps = $pdo->prepare("insert into Costomers(login, password, roleId, discount, total, imagePath)
                                VALUES(:login, :password, :roleId, :discount, :total, :imagePath)");
            // $ar = (array)$this;
            // array_shift($ar);
            // $ar = [
            //     'login'=>$this->login,
            // ]; a mi uzhe sdelali shiftom
            $ps->execute([
                'login'=>$this->login,
                'password'=>$this->password,
                'roleId'=>$this->roleId,
                'discount'=>$this->roleId,
                'total'=>$this->total,
                'imagePath'=>$this->imagePath
            ]);
        }catch(PDOExeption $ex){
                return $ex->getMessage();
        }
    }
    
    static function fromDb($id){
        $costumer = null;
        try{
            $pdo=TOOLS::connect();
            $ps = $pdo->query("SELECT * FROM Costomers WHERE id =$id");
            $row = $ps->fetch();
            $costumer =new Costomer($row['login'],$row['password'],$row['imagePath'],$row['id']);
            return $costumer; 
        }catch(PDOExeption $ex){
            return $ex->getMessage();
    }
    }
}
?>