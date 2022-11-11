<?php
session_start();
require 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<link>
    <title>armour_labs</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleCard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>
    <div Id="body" style="background-color: white; height:100vh">
    <?php
           include('message.php') ;
        ?>
        <nav id="navbar" class="navbar navbar-expand-lg navbar-light navbar-fixed-top" style="width: -webkit-fill-available;background: ghostwhite;z-index: 3;color: white;position: fixed;box-shadow: 0px 5px 10px darkgrey;">
            <div class="container-fluid" style="background:'red !important'; ">
              <a class="navbar-brand fw-bolder form-control-color" style="color:darkblue" href="index.php">ARMOUR Labs</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <form class="d-flex">
              <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                  <li class="nav-item">
                    <a class="nav-link bg-primary rounded-2 fw-bold me-2" aria-current="page" href="#">👤 ACCOUNT</a>
                  </li>                  
                  <li class="nav-item">
                    <a class="nav-link bg-muted rounded-2 fw-bold me-2" aria-current="page" href="addLabs.php">➕ ADD Labs</a>
                  </li>                  
                  <li class="nav-item">
                    <a class="nav-link bg-success rounded-2 fw-bold me-2" aria-current="page" href="addCategories.php">✏️ ADD Category</a>
                  </li>                  
                  <li class="nav-item" onclick="document.getElementById('login').style.display='block'" style="width:auto;">
                    <a class="nav-link bg-danger rounded-1 fw-bold me-2 ms-2" aria-current="page" href="#">LOGIN</a>
                  </li>                  
                  <li class="nav-item" onclick="document.getElementById('signup').style.display='block'" style="width:auto;" >
                    <a class="nav-link bg-warning rounded-2 fw-bold me-2 ms-2" aria-current="page" href="#">SIGNUP</a>
                  </li>                  
                </ul>
                </form>
              </div>
            </div>
          </nav>

         
          <div id="cards" style="padding: 2%; top:5%">
          <div class="row row-cols-1 row-cols-md-4 g-4" style="margin-top:2%">
          <?php 

            $query="SELECT * FROM web_categories";
            $query_run= mysqli_query($con, $query);
            if(mysqli_num_rows($query_run)>0)
            {   
                foreach($query_run as $title)
                {
          ?>
            <div class="col">
              <a href="labs/<?php echo $title['Title']; ?>/<?php echo $title['Title']; ?>Labs.php?Id=<?= $title['Id']; ?>" style="text-decoration:none;">
              <div class="card">
                <img src="./images/<?php echo $title['Img']; ?>" style="width: 100%; height:25vh;"></img>
                <div class="container">
                  <h5 class="card-title text-center fw-bolder"><?= $title['Topic']; ?></h5>
                </div>
              </div>
              </a>
            </div>
            <?php

                  }
              }
              else
              {
                  echo "<h4>No records found!</h4>";
              }

            ?>

          </div>
        </div>

<!--  login form  -->

<div id="login" class="modal">
  
  <form class="modal-content animate" action="registration.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('login').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container">
      <label for="email"><b>Email</b></label>
      <input type="email" placeholder="Enter Email" name="email" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button type="submit" name="loginSubmit">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('login').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>


<!-- signup form -->

<div id="signup" class="modal2">
  <form class="modal2-content" action="registration.php" method="POST">
    <div class="container">
      <h1>Sign Up</h1>
      <span onclick="document.getElementById('signup').style.display='none'" class="close2" title="Close Modal">&times;</span>

      <!-- <span onclick="document.getElementById('signup').style.display='none'" class="close" title="Close Modal">&times;</span> -->
      <p>Please fill in this form to create an account.&times;</p>
      <hr>
      <label for="fname"><b>First Name</b></label>
      <input type="text" placeholder="Enter First Name" name="fname" required>

      <label for="lname"><b>Last Name</b></label>
      <input type="text" placeholder="Enter Last Name" name="lname" required>

      <label for="email"><b>Email</b></label>
      <input type="email" placeholder="Enter Email" name="email" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
      
      <label>
        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
      </label>

      <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('signup').style.display='none'" class="cancelbtnn">Cancel</button>
        <button type="submit" class="signupbtnn">Sign Up</button>
      </div>
    </div>
  </form>
</div>


<script>
// Get the modal
var loginModal = document.getElementById('login');
var signupModal = document.getElementById('signup');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == loginModal) {
        modal.style.display = "none";
    }
    if(event.target == signupModal){
      modal.style.display = "none";
    }
}

</script>
    </div>
</body>
</html>