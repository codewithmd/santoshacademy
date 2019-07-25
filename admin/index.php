<?php
  session_start();

    if (!isset($_SESSION['a_id'])) {

        header("Location: login.php");
        exit();
    }


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
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
    <div class="container">
      <a href="index.html" class="navbar-brand">Santosh Academy</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item px-2">
            <a href="index.html" class="nav-link active">Dashboard</a>
          </li>
          <li class="nav-item px-2">
            <a href="questions.html" class="nav-link">Questions</a>
          </li>
          <li class="nav-item px-2">
            <a href="categories.html" class="nav-link">Subjects</a>
          </li>
          <li class="nav-item px-2">
            <a href="users.html" class="nav-link">Users</a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown mr-3">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-user"></i> Hey, &nbsp; <span class="font-weight-bold text-light"> <?php echo $_SESSION['a_email'] ?></span>
            </a>
            <div class="dropdown-menu">
              <a href="profile.html" class="dropdown-item">
                <i class="fa fa-user-circle"></i> Profile
              </a>
            </div>
          </li>
          <li class="nav-item">
            <a href="./includes/logout.inc.php?logout=1" class="nav-link">
              <i class="fa fa-user-times"></i> Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header id="main-header" class="py-2 btn-blue-grad text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1><i class="fa fa-gear"></i> Dashboard</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- ACTIONS -->
  <section id="action" class="py-4 mb-4 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <a href="#" class="btn btn-red-grad btn-block" data-toggle="modal" data-target="#addQuestion">
            <i class="fa fa-plus"></i> <b>Add Question</b>
          </a>
        </div>
        <div class="col-md-3">
          <a href="#" class="btn btn-green-grad btn-block" data-toggle="modal" data-target="#addCategoryModal">
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
              <h4>Latest Questions</h4>
            </div>
            <table class="table table-striped">
              <thead class="thead-inverse">
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Subject</th>
                  <th>Date Posted</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td scope="row">1</td>
                  <td>Post One</td>
                  <td>Web Development</td>
                  <td>July 12, 2017</td>
                  <td><a href="details.html" class="btn btn-secondary">
                    <i class="fa fa-angle-double-right"></i> Details
                  </a></td>
                </tr>
                <tr>
                  <td scope="row">2</td>
                  <td>Post Two</td>
                  <td>Tech Gadgets</td>
                  <td>July 13, 2017</td>
                  <td><a href="details.html" class="btn btn-secondary">
                    <i class="fa fa-angle-double-right"></i> Details
                  </a></td>
                </tr>
                <tr>
                  <td scope="row">3</td>
                  <td>Post Three</td>
                  <td>Web Development</td>
                  <td>July 14, 2017</td>
                  <td><a href="details.html" class="btn btn-secondary">
                    <i class="fa fa-angle-double-right"></i> Details
                  </a></td>
                </tr>
                <tr>
                  <td scope="row">4</td>
                  <td>Post Four</td>
                  <td>Business</td>
                  <td>July 14, 2017</td>
                  <td><a href="details.html" class="btn btn-secondary">
                    <i class="fa fa-angle-double-right"></i> Details
                  </a></td>
                </tr>
                <tr>
                  <td scope="row">5</td>
                  <td>Post Five</td>
                  <td>Web Development</td>
                  <td>July 15 2017</td>
                  <td><a href="details.html" class="btn btn-secondary">
                    <i class="fa fa-angle-double-right"></i> Details
                  </a></td>
                </tr>
                <tr>
                  <td scope="row">6</td>
                  <td>Post Six</td>
                  <td>Health & Wellness</td>
                  <td>July 16, 2017</td>
                  <td><a href="details.html" class="btn btn-secondary">
                    <i class="fa fa-angle-double-right"></i> Details
                  </a></td>
                </tr>
              </tbody>
            </table>
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
                <i class="fa fa-folder-open-o"></i> 4
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
          <h5 class="modal-title">Add Question</h5>
          <button class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <!-- Use Ajax to submit the form and upload into the DB & Clear All Field After Insert except [subject , test number] -->
          <form>
            <div class="form-group">
              <div class="form-group">
                  <label for="category">Subject</label>
                  <select class="form-control">
                    <option value="">Web Development</option>
                    <option value="">Tech Gadgets</option>
                    <option value="">Business</option>
                    <option value="">Health & Wellness</option>
                  </select>
              </div>
              <label for="test-number" class="text-danger">Test Number</label>
              <input type="number" class="form-control">

              <label for="question">Question</label>
              <input type="text" class="form-control">

              <label for="option-1">Option 1</label>
              <input type="text" class="form-control">

              
              <label for="option-2">Option 2</label>
              <input type="text" class="form-control">

              
              <label for="option-3">Option 3</label>
              <input type="text" class="form-control">

              
              <label for="option-4">Option 4</label>
              <input type="text" class="form-control">

              

              <label for="correct-answer" class="text-success">Correct Answer</label>
              <input type="text" class="form-control">
            </div>
      
            <!-- <div class="form-group">
              <label for="file">Image Upload</label>
              <input type="file" class="form-control-file">
              <small class="form-text text-muted">Max Size 3mb</small>
            </div> -->
            <!-- <div class="form-group">
              <label for="body">Body</label>
              <textarea name="editor1" class="form-control"></textarea>
            </div> -->
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="btn btn-red-grad" data-dismiss="modal">Save Changes</button>
        </div>
      </div>
    </div>
  </div>


  <!-- CATEGORY MODAL -->
  <div class="modal fade" id="addCategoryModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title">Add Category</h5>
          <button class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <!-- Use Ajax and clear the field after Done -->
          <form>
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="btn btn-green-grad" data-dismiss="modal">Save Changes</button>
        </div>
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
           <!-- Use Ajax and clear the field after Done & Make sure to validate the email -->
          <form>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control">
            </div>
            <div class="form-group">
              <label for="name">Password</label>
              <input type="password" class="form-control">
            </div>
            <div class="form-group">
              <label for="name">Confirm Password</label>
              <input type="password" class="form-control">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="btn btn-blue-grad" data-dismiss="modal">Save Changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script> -->
  <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
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
  <script>
      CKEDITOR.replace( 'editor1' );
  </script>
</body>
</html>
