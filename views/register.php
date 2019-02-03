<h3>Registration Form</h3> 
<?php
include_once 'classes.php';
if (!isset($_POST['regBtn'])):?>
<form action="index.php?page=3" method="post" enctype="multipart/form-data">
<div class="form-group">
<label for="login">Login:</label>
<input type="text" class="form-control" name="login" id="">
</div>
<div class="form-group">
<label for="password">Password:</label>
<input type="password" class="form-control" name="password" id="">
</div>
<div class="form-group">
<label for="password2">Confirm Password:</label>
<input type="password" class="form-control" name="password2" id="">
</div>
<div class="form-group">
<label for="imagePath">Select image:</label>
<input type="file" class="form-control" name="imagePath" id="">
</div>
<button type="submit" class="btn btn-primary" name="regBtn">Register</button>
</form>
<?php else: ?>
<!-- нажата кнопка регистрации выполняем добовление пользователя -->
<?php 
        if (is_uploaded_file($_FILES['imagePath']['tmp_name'])) {
            $path = "images/".$_FILES['imagePath']['name'];
            move_uploaded_file($_FILES['imagePath']['tmp_name'], $path);
        }
        //ГРУЗИМ ПОЛЬЗОВАТЕЛЯ
        if (TOOLS::register($_POST['login'], $_POST['password'], $path)){
            echo "<h3 class='alert alert-success'>New User Added</h3>";
            $_SESSION['reg']=$_POST['login'];
        }
?>
<?php endif; ?>