<?php 
function connect(
    $host = '213.227.218.133:3307',
    $user = 'skylink',
    $password = '2932105559',
    $db = 'shopdb'){

        $conn = mysql_connect($host, $user, $password) or die("Connection error".mysql_error());
        $database=mysql_select_db($db, $conn);
        // $link = mysql_connect($host, $user, $password) or die("db open error");
        mysql_query("set names 'utf-8'");

    }
function register($name, $pass, $email){
$name=trim(htmlspecialchars($name));
$pass=trim(htmlspecialchars($pass));
$email=trim(htmlspecialchars($email));
if (empty($name) || empty($pass) || empty($email)){
echo "<h3 class='alert alert-danger'>Fill All Fields!</h3>";
return false;
}
$_pass=md5($pass);
$insert = "insert into users(login, pass, email, roleId) values('$name', '$_pass', '$email', 2)";
connect();
mysql_query($insert);
$error= mysql_errno();
if ($error){
    if ($error==1062){
        echo "<h3 class='alert alert-danger'>This login is used already!</h3>";
}
else{
    echo "<h3 class='alert alert-danger'>Error code: $error</h3>";
}
    }
    
return true;
}

function leaveComment($name, $comment, $hotelId){
    $name=trim(htmlspecialchars($name));
    $comment=trim(htmlspecialchars($comment));
    
    if (empty($name) || empty($comment)){
    echo "<h3 class='alert alert-danger'>Fill All Fields!</h3>";
    return false;
    }
    $timenow = date("Y-m-d H:i:s"); 
    $insert = "insert into comments(name, comments, hotelId, datetime) values('$name', '$comment', '$hotelId', '$timenow')";
    connect();
    mysql_query($insert);
    $error= mysql_errno();
    if ($error){
        if ($error==1062){
            echo "<h3 class='alert alert-danger'>Comment adding fault</h3>";
    }
    else{
        echo "<h3 class='alert alert-danger'>Error code: $error</h3>";
    }
        }
        
    return true;
    }

?>