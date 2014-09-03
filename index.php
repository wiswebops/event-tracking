<?php include('head.php'); ?>
 
<div class="container">

  <div class="row loginSection">

    <div class="col-md-3"></div>

      <div class="col-md-6 loginBox">
          <form class="form-signin" role="form">
          <h2 class="form-signin-heading">Sign In</h2>
          <input type="text" class="form-control" placeholder="Email Address" required>
          <input type="password" class="form-control" placeholder="Password" required>

          <a href="dashboard.php"><button type="button" class="btn btn-default float-right">Submit</button></a>
          <a href="signup.php"><button type="button" class="btn btn-default float-left signUpBtn">Sign Up</button></a>
          
          </form>
      </div>

    <div class="col-md-3"></div>

  </div> <!-- /loginSection -->

</div> <!-- /container -->

<?php include('footer.php'); ?>