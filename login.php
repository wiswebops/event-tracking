<?php include('head.php'); ?>


     <div class="container">
      <div class="row loginSection">
        <div class="col-md-3"></div>

        <div class="col-md-6 loginBox">
          <form class="form-signin" role="form">
            <h2 class="form-signin-heading">Event Tracking Website</h2>
            <input type="text" class="form-control" placeholder="Email address" required autofocus>
            <input type="password" class="form-control" placeholder="Password" required>
            <a href="signup.php"><button type="button" class="btn btn-default float-right">Sign Up</button></a>
            <a href="dashboard.php"><button type="button" class="btn btn-primary float-right" type="submit">Login</button></a>
            </form>

        </div>

        <div class="col-md-3"></div>
      </div>

      

    </div> <!-- /container -->

   <?php include('footer.php'); ?>