<?php include('head.php'); ?>


     <div class="container">
      <div class="row loginSection">
        <div class="col-md-3"></div>

        <div class="col-md-6 loginBox">
          <form class="form-signin" role="form" action="dologin.php" method="post">
            <h2 class="form-signin-heading">Event Tracking Website</h2>
            <input type="text" class="form-control" placeholder="Email address" name="vEmail" required autofocus>
            <input type="password" class="form-control" placeholder="Password" name="vPassword" required>
            <a href="signup.php"><button type="button" class="btn btn-default float-right">Sign Up</button></a>
            <input class="btn btn-primary float-right" type="submit" name="login" value="login" />
            </form>

        </div>

        <div class="col-md-3"></div>
      </div>

      

    </div> <!-- /container -->

   <?php include('footer.php'); ?>