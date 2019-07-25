<?php
session_start();
include('config.php');

if((isset($_SESSION['admin']) && ($_SESSION['admin'] != null)) && (isset($_GET['test']) && ($_GET['test'] != null))){
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
    <style>
    /* .pre-loader{
      width: 100%;
      height: 100%;
      background: white;
      position: fixed;
      top: 0;
    } */
.pre-loader{
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   z-index: 9999;
   background-image: url('./img/loader1.gif');
   background-repeat: no-repeat; 
   background-color: #FFF;
   background-position: center;
}
    </style>

  </head>
  <body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
      <div class="container">
        <a href="index.html" class="navbar-brand">Santosh Academy</a>
        <button
          class="navbar-toggler"
          data-toggle="collapse"
          data-target="#navbarNav"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item px-2">
              <a href="index.php" class="nav-link ">Dashboard</a>
            </li>
            <li class="nav-item px-2">
              <a href="questions.php" class="nav-link active">Questions</a>
            </li>
            <li class="nav-item px-2">
              <a href="categories.php" class="nav-link">Subjects</a>
            </li>
            <li class="nav-item px-2">
              <a href="users.php" class="nav-link">Users</a>
            </li>
          </ul>

          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown mr-3">
              <a
                href="#"
                class="nav-link dropdown-toggle"
                data-toggle="dropdown"
              >
                <i class="fa fa-user"></i> Welcome <span>UserName</span>
              </a>
              <div class="dropdown-menu">
                <a href="profile.html" class="dropdown-item">
                  <i class="fa fa-user-circle"></i> Profile
                </a>
              </div>
            </li>
            <li class="nav-item">
              <a href="login.html" class="nav-link">
                <i class="fa fa-user-times"></i> Logout
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header id="main-header" class="py-2 bg-red-grad text-white">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
              <?php
              $testNo = $_GET['test'];
              $sql = "SELECT * FROM `tests` WHERE test_no = ? ";
              $query = $con->prepare($sql);
              $query->execute([$testNo]);
                $testName = '';
                $testSubject = '';
                $test=$query->fetchAll(PDO::FETCH_OBJ);
                foreach($test as $data){
                    $testName = $data->test_name;
                    $testSubject = $data->subject;
                }
              ?>
            <h1><i class="fa fa-pencil"></i> <?php echo $testName; ?>  </h1>
          </div>
        </div>
      </div>
    </header>

    <!-- ACTIONS -->
    <section id="action" class="py-4 mb-4 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ml-auto">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search" />
              <span class="input-group-btn">
                <button class="btn btn-red-grad text-white">Search</button>
              </span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- POSTS -->
    <section id="posts">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                  <div>
                <h4>Question & Answers</h4>
                  </div>
             <div>
                 <button class="btn btn-outline-success float-right m-2"  data-toggle="modal" data-target="#addQuestionModal">Add Question <i class="fa fa-plus-circle"></i></button>
             </div>
                  
            </div>
              
              <table class="table table-striped">
                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="questionsAnswersTableBody">
                    
                  <!-- <tr>
                    <td scope="row">1</td>
                    <td>Question One</td>
                    <td>Web Development</td>
                   
                    <td>
                      <button class="btn btn-success">
                          <i class="fa fa-eye"></i>
                      </button>
                    </td>
                    <td>
                        <button class="btn btn-warning ">
                            <i class="fa fa-pencil-square-o"></i>
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                  </tr> -->
                  
                </tbody>
              </table>

              <nav class="ml-4">
                <ul class="pagination" id="questionPaginationBar">
                 
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



    <!-- Add Question Modal -->
<div class="modal fade" id="addQuestionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Question</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div id="addQuestionFormMessages"></div>
                    <form action="./includes/test.inc.php" method="post" id="addQuestionForm" >
                        <div class="form-group d-none">
                            <input type="number" class="form-control" value="<?php echo $_GET['test']; ?>" id="testNumberInput" >
                            
                        </div>
                            <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Question</label>
                                    <textarea class="form-control" id="QuestionInput" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                    <label for="addQuestionOption1">Option 1</label>
                                    <input type="text" class="form-control addQuestionOptionInput " id="addQuestionOption1">
                            </div>
                            <div class="form-group">
                                    <label for="addQuestionOption2">Option 2</label>
                                    <input type="text" class="form-control addQuestionOptionInput " id="addQuestionOption2">
                            </div>
                            <div class="form-group">
                                    <label for="addQuestionOption3">Option 3</label>
                                    <input type="text" class="form-control addQuestionOptionInput " id="addQuestionOption3">
                            </div>
                            <div class="form-group">
                                    <label for="addQuestionOption4">Option 4</label>
                                    <input type="text" class="form-control addQuestionOptionInput " id="addQuestionOption4">
                            </div>
                            <div class="form-group">
                                    <label for="AnswerInput">Correct Answer: </label>
                                    <select class="form-control" id="AnswerInput">
                                      <option>1</option>
                                      <option>2</option>
                                      <option>3</option>
                                      <option>4</option>
                                    </select>
                                  </div>
 
                            
                          
            </div>
            <div class="modal-footer">
                    <div class=" ml-2 alert alert-info">
                            <input type="checkbox" class="form-check-input" id="closeMeAfterQuestionAdded">
                            Close This Modal After Every Question Added
                    </div>
              <button type="button" class="btn btn-secondary" data-dismiss="modal" type="button" id="addQuestionModalcloseBtn" >Close</button>
              <button  class="btn btn-primary" type="submit">Add Question</button>
            </div>
        </form>
          </div>
        </div>
      </div>
        <!--End Of Add Question Modal -->

     <!-- View Question Modal -->
<div class="modal fade" id="viewQuestionAnswer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">View Question Answer</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div id="addQuestionFormMessages"></div>
                    <form action="./includes/test.inc.php" method="post" id="addQuestionForm" >
                        <div class="form-group d-none">
                                <label for="viewQuestionTestNumberInput">Question Test Number</label>
                               
                            <input type="number" class="form-control" value="<?php echo $_GET['test']; ?>" id="viewQuestionTestNumberInput" >
                            
                        </div>
                        <div class="form-group">
                                <label for="viewQuestionIDInput">Question ID</label>
                                <input class="form-control" id="viewQuestionIDInput" readonly />
                        </div>
                            <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Question</label>
                                    <textarea class="form-control" id="viewQuestionInput" rows="3" readonly ></textarea>
                            </div>
                            <div id="viewQuestionOptionsContainer">
                              
                            </div>
                            <div class="form-group">
                                    <label for="viewAnswerInput">Correct Answer</label>
                                    <input type="text" class="form-control viewQuestionOptionInput" id="viewAnswerInput" readonly>
                            </div>
                            
                          
            </div>
            <div class="modal-footer">
                    
              <button type="button" class="btn btn-secondary" data-dismiss="modal" type="button" id="addQuestionModalcloseBtn" >Close</button>
                       </div>
        </form>
          </div>
        </div>
      </div>
        <!--End Of View Question Modal -->














     <!-- Edit Question Modal -->
     <div class="modal fade" id="editQuestionAnswer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Question Answer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div id="editQuestionFormMessages"></div>
                  <form action="./includes/test.inc.php" method="post" id="editQuestionForm" >
                      <div class="form-group d-none">
                              <label for="editQuestionTestNumberInput">Question Test Number</label>
                             
                          <input type="number" class="form-control" value="<?php echo $_GET['test']; ?>" id="viewQuestionTestNumberInput" >
                          
                      </div>
                      <div class="form-group d-none">
                              <label for="editQuestionIDInput">Question ID</label>
                              <input class="form-control" id="editQuestionIDInput" readonly />
                      </div>
                          <div class="form-group">
                                  <label for="editQuestionInput">Question</label>
                                  <textarea class="form-control" id="editQuestionInput" rows="3" ></textarea>
                          </div>
                          <div id="editQuestionOptionsContainer">
                            
                          </div>
                          <div class="form-group">
                            <label for="editCorrectAnswerInput">Correct Answer: </label>
                            <select class="form-control" id="editCorrectAnswerInput">
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                            </select>
                          </div>
                          
                        
          </div>
          <div class="modal-footer">
                  
            <button type="button" class="btn btn-secondary" data-dismiss="modal" type="button" id="editQuestionModalcloseBtn" >Close</button>
            <button class="btn btn-warning" type="submit" >Update</button>
                     </div>
      </form>
        </div>
      </div>
    </div>
      <!--End Of Edit Question Modal -->























      <div class="pre-loader"> </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="./js/test.ajax.js"></script>
    <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
    <script>
     $(document).ready( function() {
  //  $('.pre-loader').fadeOut('slow');
  $('.pre-loader').fadeOut('slow');
});
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
