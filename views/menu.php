<!-- <ul class="nav nav-pills nav-justified">
<li <?=($_GET['page']==1)? "class='active'":"" ?>><a href="index.php?page=1">Tours</a></li>
<li <?=($_GET['page']==2)? "class='active'":"" ?>><a href="index.php?page=2">Comments</a></li>
<li <?=($_GET['page']==3)? "class='active'":"" ?>><a href="index.php?page=3">Registration</a></li>
<li <?=($_GET['page']==4)? "class='active'":"" ?>><a href="index.php?page=4">Admin Form</a></li>
</ul> -->

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Shop</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?=($_GET['page']==1)? "class='active'":"" ?>><a href="index.php?page=1">Catalogue</a></li>
      
      
        <?php if (isset($_SESSION['reg'])):?>
          <li <?=($_GET['page']==2)? "class='active'":"" ?>><a href="index.php?page=2">Cart</a></li>
        <li <?=($_GET['page']==4)? "class='active'":"" ?>><a href="index.php?page=4">Admin Form</a></li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
      <li style="color:blue;">Welcome, <?= $_SESSION['reg'];?><span><a href="logout.php"> Logout</a></span></li>
     
      <?php else:?>
        <li <?=($_GET['page']==3)? "class='active'":"" ?>><a href="index.php?page=3">Registration</a></li>
       </ul>
      <ul class="nav navbar-nav navbar-right">
       <form method="POST" action="views/checkIfLogin.php" class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" name="login" class="form-control" placeholder="Login">
          <input type="text" name="password" class="form-control" placeholder="Password">
        </div>
        <button type="submit" name="login_btn"class="btn btn-default">Login</button>
      </form>
       </ul>
      <?php endif; ?>
     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>