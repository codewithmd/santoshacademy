<?php
session_start();
include('config.php');

if(isset($_SESSION['admin']) && ($_SESSION['admin'] != null) ){
  // echo '<h1>user logged</h1>';


  $sql = "SELECT * FROM admin WHERE admin_email = ?";
  $query = $con->prepare($sql);
  $query->execute([$_SESSION['admin']]);
  // echo '<br><h1>'.$query->rowCount().'</h1>';

  $alldata=$query->fetchAll(PDO::FETCH_OBJ);
  $admin = array(); // we will store currently logged admin email and name in this 'admin' array
  foreach($alldata as $data){
   $admin['name'] = $data->admin_name;
   $admin['email'] = $data->admin_email;

  }
// print_r($admin);
?>









<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Santosh Academy Admin Area</title>
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
   <?php include('header.php'); // including header of admin panel ?>

    <!-- ACTIONS -->
    <section id="action" class="py-4 mb-4 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-3 mr-auto">
            <a href="index.php" class="btn btn-light btn-block">
              <i class="fa fa-arrow-left"></i> Back To Dashboard
            </a>
          </div>
          <div class="col-md-3">
            <a
            
              href="#"
              class="btn btn-success btn-block"
              data-toggle="modal"
              data-target="#passwordModal"
            >
              <i class="fa fa-lock"></i> Change Password
</a>
          </div>
          <div class="col-md-3">
            <a
            
              href="#"
              class="btn btn-danger btn-block"
              data-toggle="modal"
              data-target="#deleteAccountModal"
            >
              <i class="fa fa-trash"></i> Delete Account
</a>
          </div>
        </div>
      </div>
    </section>

    <!-- PROFILE EDIT -->
    <section id="profile">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <div class="card">
              <div class="card-header">
                <h4>Edit Profile</h4>
              </div>
              <div class="card-body">
                <form>
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" value="<?php echo $admin['name'] ?>" />
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input
                      type="text"
                      class="form-control"
                      value="<?php echo $admin['email'] ?>"
                      readonly
                    />
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <h3 class="text-center">Your Name</h3>
            <img src="img/avatar.png" alt="" class="d-block img-fluid mb-3" />
            <button class="btn btn-primary btn-block">Edit Image</button>
            <button class="btn btn-danger btn-block">Delete Image</button>
          </div>
        </div>
      </div>
    </section>

    <footer id="main-footer" class="bg-dark text-white mt-5 p-5">
      <div class="conatiner">
        <div class="row">
          <div class="col">
            <p class="lead text-center">
              Copyright &copy; 2019 Santosh Academy
            </p>
          </div>
        </div>
      </div>
    </footer>

    <!-- PASSWORD MODAL -->
    <div class="modal fade" id="passwordModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">Change Password</h5>
            <button class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="includes/admin.inc.php" method="POST" onsubmit="checkBothPasswordInputValuesAreSame()">
              <div class="form-group">
                <label for="name">Password</label>
                <input type="password" name="password" class="form-control" id="ChangePasswordInput" />
              </div>
              <div class="form-group">
                <label for="name">Confirm Password</label>
                <input type="password" class="form-control" id="ChangePasswordConfirmInput"  />
              </div>
            
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-dismiss="modal" type="button">
              Close
            </button>
            <button class="btn btn-primary" type="submit" >
              Update Password
            </button>
          </div>
        </form>
        </div>
      </div>
    </div>


    <!-- DELETE ACCOUNT MODAL -->
    <div class="modal fade" id="deleteAccountModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">Delete Account</h5>
            <button class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="includes/admin.inc.php" method="post" id="deleteAccountForm" onsubmit="checkBothPasswordInputValuesAreSame()" >

              <input type="text" name="request" value="deleteAccount" class="d-none" />
            <div class="form-group d-none">
                <label for="email">email</label>
                <input type="text" name="email" id="emailToDeleteAccount" class="form-control" value="<?php echo $admin['email']; ?>" />
              </div>
              <div class="form-group">
                <label for="cofirmPasswordToDeleteAccount">Password</label>
                <input type="password" name="password" id="cofirmPasswordToDeleteAccount" class="form-control" />
              </div>
              
           
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              Close
            </button>
            <button class="btn btn-outline-danger disabled" id="deleteMyAccountBtn" disabled>
            I understand the consequences, delete this account
            </button>
          </div>
          </form>
        </div>
      </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
    <script src="js/ajax-function.js"></script>
    <script>
      CKEDITOR.replace("editor1");
      
    </script>
  </body>
</html>



<?php

}else{
  // echo 'not logged';
  header('location: login.php');
}


// logout admin
if(isset($_GET['logout'])){
  unset($_SESSION['admin']);
  header('location: login.php');
 
}else{

}




?>