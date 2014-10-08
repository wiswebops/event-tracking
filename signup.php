<?php include('head.php'); ?>

     <div class="container">
      <div class="row loginSection">
        <div class="col-md-3"></div>

        <div class="col-md-6 loginBox">
          <form class="form-signin" role="form" action="doAddUser.php" method="post">
            <h2 class="form-signin-heading">Sign up</h2>
            <input type="text" class="form-control" placeholder="First Name" name="vFirstName" required autofocus>
            <input type="text" class="form-control" placeholder="Last Name" name="vLastName" required>
            <input type="text" class="form-control" placeholder="Email Address" name="vEmail" required>
            <input type="password" class="form-control" placeholder="Password" name="vPassword" required>

            <input class="btn btn-primary float-right" type="submit" name="submit" value="submit" />
            
            </form>

        </div>

        <div class="col-md-3"></div>
      </div>

      

    </div> <!-- /container -->

<?php include('footer.php'); ?>