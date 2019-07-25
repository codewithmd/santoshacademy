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
    <?php include('header.php'); ?>

    <!-- ACTIONS -->
    <section id="action" class="py-4 mb-4 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ml-auto">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search" />
              <span class="input-group-btn">
                <button class="btn btn-primary">Search</button>
              </span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- USERS -->
    <section id="posts">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h4>All Users</h4>
              </div>
              <table class="table table-striped">
                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>


                <?php




$limit = 10;  // Number of entries to show in a page. 
// Look for a GET variable page if not found default is 1.      
if (isset($_GET["p"])) {  
  $pn  = $_GET["p"];  
}  
else {  
  $pn=1;  
};   

$start_from = ($pn-1) * $limit;   

$sql = "SELECT * FROM `users` LIMIT $start_from, $limit";     
                
// $sql = "SELECT * FROM `users`";
$query = $con->prepare($sql);
$query->execute();
$users = $query->fetchAll(PDO::FETCH_OBJ);
foreach($users as $user){

?>
<tr>
                    <td scope="row"><?php echo $user->user_id; ?></td>
                    <td><?php echo $user->user_name; ?></td>
                    <td><?php echo $user->user_email; ?></td>
                  </tr>

<?php

}

              
$sql = "SELECT * FROM `users`";
$query = $con->prepare($sql);
$query->execute();
$total_pages =  ceil($query->rowCount()/$limit);
// echo $total_pages;

                ?>
                </tbody>
              </table>

              <nav class="ml-4">
                <ul class="pagination">
               <?php

for ($i=1; $i<=$total_pages; $i++) {
  echo '<li class="page-item"><a href="?p='.$i.'" class="page-link">'.$i.'</a></li>';

}
?>
                 
                </ul>
              </nav>
            </div>
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

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
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

?>
