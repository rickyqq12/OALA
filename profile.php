<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "config.php";

// Prepare a select statement
$sql = "SELECT UserId FROM questionsolved WHERE userid = ?";

if($stmt = mysqli_prepare($link, $sql)){
   // Bind variables to the prepared statement as parameters
   mysqli_stmt_bind_param($stmt, "s", $param_id);
   
   // Set parameters
   $param_id = $_SESSION["id"];
   
   // Attempt to execute the prepared statement
   if(mysqli_stmt_execute($stmt)){
       // Store result
       mysqli_stmt_store_result($stmt);
       
       $_SESSION["solved"] = mysqli_stmt_num_rows($stmt);
   } else{
       echo "Oops! Something went wrong. Please try again later.";
   }

   // Close statement
   mysqli_stmt_close($stmt);
}

if(isset($_FILES['image'])){
   $errors= array();
   $file_name = $_FILES['image']['name'];
   $file_size =$_FILES['image']['size'];
   $file_tmp =$_FILES['image']['tmp_name'];
   $file_type=$_FILES['image']['type'];
   $arr=explode(".", strtolower($_FILES['image']['name']));
   $file_ext = end($arr);
   
   $extensions= array("jpeg","jpg","png");
   
   if(in_array($file_ext,$extensions)=== false){
      $errors[]="extension not allowed, please choose a JPEG or PNG file.";
   }
   
   if($file_size > 2097152){
      $errors[]='File size must be excately 2 MB';
   }
   
   if(empty($errors)==true){
      move_uploaded_file($file_tmp,"profile_pics/".$_SESSION["username"].".".$file_ext);

      $sql = "UPDATE users SET image = ? WHERE userid = ?";
         
      if($stmt = mysqli_prepare($link, $sql)){
         // Bind variables to the prepared statement as parameters
         mysqli_stmt_bind_param($stmt, "ss", $param_image, $param_id);
         
         // Set parameters
         $param_image = "profile_pics/".$_SESSION["username"].".".$file_ext;
         $param_id = $_SESSION["id"];

         // Attempt to execute the prepared statement
         if(mysqli_stmt_execute($stmt)){
             $_SESSION["image"] = $param_image;
         } else{
             echo "Something went wrong. Please try again later.";
         }

         // Close statement
         mysqli_stmt_close($stmt);
     }
   }else{
      print_r($errors);
   }
}
?>
<html>
   <head>
      <!-- Required meta tags -->
       <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Bootstrap CSS -->
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

      <!-- Font -->
      <script src="https://kit.fontawesome.com/af40733f6e.js" crossorigin="anonymous"></script>
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400&display=swap" rel="stylesheet">

      <!-- CSS -->
      <link rel="stylesheet" href="css/style.css">

      <!-- JS -->
      <script type="text/javascript" src="js/bootstrap.min.js"></script>

      <!-- Browser Title -->
      <title>OALA</title>
      <link rel="shortcut icon" href="/imgs/favicon.ico">
   </head>

   <body style="background-image:url(imgs/main_profile2.jpg); background-size:cover;">
      <!-- NAVBAR -->
      <nav class="navbar navbar-expand-lg navbar-light">
         <div class="container-fluid">
            <a class="navbar-brand ms-1" href="index.html"><img src="imgs/logo.png" style="width:50px">OALA</a>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
               <div class="navbar-nav ms-auto">
                  <a class="nav-link" href="material_list.php">MATERIALS</a>
                  <a class="nav-link" href="problem_list.php">PROBLEMS</a>
                  <a href="login.php"><img class="rounded-circle" src="<?=$_SESSION["image"]; ?>" width="50px"></a>
               </div>
            </div>
         </div>
      </nav>
      <!-- End NAVBAR -->

      <!-- MAIN -->

      <div class="py-5">
         <div class="container py-5">
            <div class="row mb-4"> </div>
            <div class="row">

               <!-- Pic-->
               <div class="col-xl-4 mb-4 text-center">
                  <div class="bg-light rounded shadow-sm py-3 px-5">
                     <img src="<?=$_SESSION["image"]; ?>" alt="" width="100" class="img-fluid rounded-circle img-thumbnail shadow-sm">
                     <h5 class="display-5" style="font-size: 40px"><?php echo htmlspecialchars($_SESSION["username"]); ?></h5>
                  </div>
                  </br>
                  <p>Change Pic</p>
                  <form action="" method="POST" enctype="multipart/form-data">
                     <input type="file" name="image" />
                     <input type="submit"/>
                  </form>
               </div>
               <!-- Pic End-->

               <!-- details -->
               <div class="col-xl-3 mb-4">
                  <h5 class="display-5" style="font-size: 30px">Email</h5>
                  <h5 class="display-5" style="font-size: 30px">Phone</h5>
                  <h5 class="display-5" style="font-size: 30px">DOB</h5>
                  <h5 class="display-5" style="font-size: 30px">Problems Solved</h5>
                  </br></br>
                  <a href="reset_password.php" class="btn btn-warning">Reset Your Password</a>
               </div>

               <div class="col-xl-5 mb-4">
                  <h5 class="display-5" style="font-size: 30px">: <?php echo htmlspecialchars($_SESSION["email"]); ?></h5>
                  <h5 class="display-5" style="font-size: 30px">: <?php echo htmlspecialchars($_SESSION["phone"]); ?></h5>
                  <h5 class="display-5" style="font-size: 30px">: <?php echo htmlspecialchars($_SESSION["dob"]); ?></h5>
                  <h5 class="display-5" style="font-size: 30px">: <?php echo htmlspecialchars($_SESSION["solved"]); ?></h5>
                  </br></br>
                  <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
               </div>
               <!-- details end -->

            </div>
         </div>
      </div>
      <div class="py-3"></div>
      <div class="py-1"></div>

      <!-- Copyright -->
      <footer class="bg-light pb-1">
         <div class="container text-center">
            <p class="font-italic text-muted mb-0">&copy; Copyrights Santuy.CO All rights reserved.</p>
         </div>
      </footer>
      <!-- End Copyright -->
      
   </body>
</html>