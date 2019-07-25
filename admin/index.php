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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Prayas Admin Area</title>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
  <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    />
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include('header.php'); // including header of admin panel ?>


  <!-- ACTIONS -->
  <section id="action" class="py-4 mb-4 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <a href="#" onclick="renderSubjects()" class="btn btn-red-grad btn-block" data-toggle="modal" data-target="#addQuestion">
            <i class="fa fa-plus"></i> <b>Add Test</b>
          </a>
        </div>
        <div class="col-md-3">
          <a href="#" class="btn btn-green-grad btn-block" data-toggle="modal" data-target="#addSubjectModal">
            <i class="fa fa-plus"></i> <b>Add Subject</b>
          </a>
        </div>
        <div class="col-md-3">
          <a href="#" class="btn btn-blue-grad btn-block" data-toggle="modal" data-target="#addUserModal">
            <i class="fa fa-plus"></i> <b>Add User</b>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- POSTS -->
  <section id="posts">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <div class="card">
            <div class="card-header">
              <h4>Latest Test</h4>
            </div>
            <table class="table table-striped">
              <thead class="thead-inverse">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Subject</th>
                  <th>Date</th>
                  <th>Detail</th>
                </tr>
              </thead>
              <tbody>
                  <?php




                  $limit = 10;  // Number of entries to show in a page. 
                  // Look for a GET variable page if not found default is 1.      
                  // *tl means 'tests limit'
                  if (isset($_GET["tl"])) {  
                    $tl  = $_GET["tl"];  
                  }  
                  else {  
                    $tl=1;  
                  };   
                  
                  $start_from = ($tl-1) * $limit;   
                  
                  $sql = "SELECT * FROM `tests` LIMIT $start_from, $limit";     
                                  
                  // $sql = "SELECT * FROM `tests`";
                  $query = $con->prepare($sql);
                  $query->execute();
                  $tests = $query->fetchAll(PDO::FETCH_OBJ);
                  foreach($tests as $test){
                  
                  ?>
                  <tr>
                                      <td scope="row"><?php echo $test->test_no; ?></td>
                                      <td><?php echo $test->test_name; ?></td>
                                      <td><?php echo $test->subject; ?></td>
                                      <td><?php echo $test->test_date; ?></td>

                                      <td> <a href="test.php?test=<?php echo $test->test_no; ?>" class="btn btn-info"> Detail <i class="fa fa-external-link"></i></a> </td>
                                    </tr>
                  
                  <?php
                  
                  }
                  
                                
                  $sql = "SELECT * FROM `tests`";
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
  echo '<li class="page-item"><a href="?tl='.$i.'" class="page-link">'.$i.'</a></li>';

}
?>
                 
                </ul>
              </nav>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-center bg-red-grad text-white mb-3">
            <div class="card-body">
              <h3>Questions</h3>
              <h1 class="display-6">
                <i class="fa fa-pencil"></i> 200
              </h1>
              <a href="questions.html" class="btn btn-outline-light btn-sm px-4">View</a>
            </div>
          </div>

          <div class="card text-center btn-green-grad text-white mb-3">
            <div class="card-body">
              <h3>Subjects</h3>
              <h1 class="display-6">
                <i class="fa fa-folder-open-o"></i> 


              <?php
              $sql="SELECT * FROM `subject`";
              $query=$con->prepare($sql);
              $query->execute();
              $subjects=$query->fetchAll(PDO::FETCH_OBJ);
              echo $query->rowCount();
                ?>

                
              </h1>
              <a href="categories.html" class="btn btn-outline-light btn-sm px-4">View</a>
            </div>
          </div>

          <div class="card text-center btn-blue-grad text-white mb-3">
            <div class="card-body">
              <h3>Users</h3>
              <h1 class="display-6">
                <i class="fa fa-users"></i> 2
              </h1>
              <a href="users.html" class="btn btn-outline-light btn-sm px-4">View</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer id="main-footer" class="bg-dark text-white mt-5 p-5">
    <div class="conatiner">
      <div class="row">
        <div class="col">
          <p class="lead text-center">Copyright &copy; 2019 Santosh Academy</p>
        </div>
      </div>
    </div>
  </footer>


  <!-- QUESTION MODAL -->
  <div class="modal fade" id="addQuestion">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">Add New Test</h5>
          <button class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <div id="newTestAddFormSubmitMessages"></div>
          <!-- Use Ajax to submit the form and upload into the DB & Clear All Field After Insert except [subject , test number] -->
          <form action="./includes/admin.inc.php" method="POST" id="addTestForm" >
            <div class="form-group">
              <div class="form-group">
                  <label for="category">Subject</label>
      
                  <select class="form-control" id="subjectSelectForAddQuestions" name="subject" >
                
                  </select>
              </div>
              <label for="test-number" class="text-danger">Test Name</label>
              <input type="text" name="test-name" class="form-control">

            </div>
          
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal" type="button" id="addTestModalCloseBtn" >Close</button>
          <button class="btn btn-red-grad" type="submit">Add Test</button>
        </div>
      </form>
      </div>
    </div>
  </div>


  <!-- Subject Add MODAL -->
  <div class="modal fade" id="addSubjectModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title">Add Subject</h5>
          <button class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
        <div id="addSubjectMessages">
         
          </div>
          <!-- Use Ajax and clear the field after Done -->
          <form id="addSubjectForm" action="./includes/admin.inc.php" method="post" >
            <div class="form-group">
              <label for="title">Subject Name</label>
              <input type="text" class="form-control" name="subject" id="subjectName" require>
            </div>
           
          
        </div>
        <div class="modal-footer">
          
          <button class="btn btn-secondary" id="addSubjectModalClose" data-dismiss="modal" type="button">Close</button>
          <button class="btn btn-green-grad" type="submit">Save Changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- USER MODAL -->
  <div class="modal fade" id="addUserModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Add User</h5>
          <button class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <div id="userAddFormMessages">

          </div>
           <!-- Use Ajax and clear the field after Done & Make sure to validate the email -->
          <form action="./includes/admin.inc.php" method="post" id="addUserFormSubmit"  >
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" class="form-control" autofocus>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
              <label for="name">Password</label>
              <input type="password" name="password" class="form-control">
            </div>
         
          
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal" type="button" id="addUserModalCloseBtn">Close</button>
          <button class="btn btn-blue-grad" type="submit">Save Changes</button>
        </div>
      </form>
      </div>
    </div>
  </div>

   <script src="js/jquery.min.js"></script>
  <!-- <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script> -->
<!--   
  <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script> -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
  <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
  <script src="js/ajax-function.js"></script>
  <script>
      CKEDITOR.replace( 'editor1' );
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
