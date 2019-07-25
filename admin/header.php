<?php

if(isset($_SESSION['admin']) && ($_SESSION['admin'] != null) ){
  // echo '<h1>user logged</h1>';
?>









<nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
    <div class="container">
      <a href="index.php" class="navbar-brand">Santosh Academy</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item px-2">
            <a href="index.php" class="nav-link active">Dashboard</a>
          </li>
          <li class="nav-item px-2">
            <a href="questions.html" class="nav-link">Questions</a>
          </li>
          <li class="nav-item px-2">
            <a href="subjects.php" class="nav-link">Subjects</a>
          </li>
          <li class="nav-item px-2">
            <a href="users.php" class="nav-link">Users</a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown mr-3">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-user"></i> Welcome <span><?php echo $admin['name']; ?></span>
            </a>
            <div class="dropdown-menu">
              <a href="profile.php" class="dropdown-item">
                <i class="fa fa-user-circle"></i> Profile
              </a>
            </div>
          </li>
          <li class="nav-item">
            <a id="logout" href="/admin/index.php?logout" class="nav-link" onclick="logout()">
              <i class="fa fa-user-times"></i> Logout
              <script>
                function logout(){
                  // alert('io');
                  let askingForLogout = confirm('Are Sure You Want To Logout?');
                  if(askingForLogout){
                    return true;
                  }else{
                    return false;
                  }
                }
              </script>
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



  <?php

}else{
  // echo 'not logged';
  header('location: login.php');
}



?>