<?php
// Initialize the session
session_start();

// $color = array()
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

$color = array_fill(0, 4, "color:black;border-color:#999");

// Prepare a select statement
$sql = "SELECT CourseId FROM coursesolved WHERE UserId = ?";

if($stmt = mysqli_prepare($link, $sql)){

	// Bind variables to the prepared statement as parameters
	mysqli_stmt_bind_param($stmt, "s", $param_id);

	// Set parameters
	$param_id = $_SESSION["id"];

	// Attempt to execute the prepared statement
	if(mysqli_stmt_execute($stmt)){

		// Store result
		mysqli_stmt_store_result($stmt);

		if(mysqli_stmt_num_rows($stmt) >= 1){
			mysqli_stmt_bind_result($stmt, $id);

			while (mysqli_stmt_fetch($stmt)) {
				if ($id == "ADD01") {
					$color[0] = "color:black;border-color:#999;background-color:#90ee90";
				} elseif ($id == 'SUB01') {
					$color[1] = "color:black;border-color:#999;background-color:#90ee90";
				} elseif ($id == 'MUL01') {
					$color[2] = "color:black;border-color:#999;background-color:#90ee90";
				} elseif ($id == 'DIV01') {
					$color[3] = "color:black;border-color:#999;background-color:#90ee90";
				}
			}
		}
	} else{
		echo "Oops! Something went wrong. Please try again later.";
	}

	// Close statement
	mysqli_stmt_close($stmt);
}

?>

<!doctype html>
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

	<body style="background-image:url(imgs/main_menu.jpg); background-size:cover; width:100%; height:auto;">
		<!-- NAVBAR -->
		<nav class="navbar navbar-expand-lg navbar-light">
			<div class="container-fluid">
				<a class="navbar-brand ms-1" href="index.html"><img src="imgs/logo.png" style="width:50px">OALA</a>
				<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
					<div class="navbar-nav ms-auto">
						<a class="nav-link" href="material_list.php">MATERIALS</a>
						<a class="nav-link" href="problem_list.php">PROBLEMS</a>
						<a href="profile.php"><img class="rounded-circle" src="<?=$_SESSION["image"]; ?>" width="50px"></a>
					</div>
				</div>
			</div>
		</nav>
		<!-- End NAVBAR -->

		<!-- MAIN -->

		<div class="py-5">
			<div class="container py-5">
				<div class="row mb-4 justify-content-center">
					<div class="col-lg-5">
						<h2 class="display-4 font-weight-light text-center">Material List</h2>
					</div>
				</div>
				<div class="row justify-content-center text-center">

					<!-- Penjumlahan-->
					<div class="col-xl-2 col-sm-5 mb-4">
						<div class="bg-light rounded shadow-sm py-5 px-4">
							<img src="imgs/icons/plus.png" alt="" width="100" class="img-fluid mb-3 img-thumbnail shadow-sm">
							<h5 class="mb-0">Penjumlahan</h5></br></br>
							<a href="penjumlahan.php"><button type="button" class="tombol btn" style="<?=$color[0] ?>">CHOOSE</button></a>
						</div>
					</div>
					<!-- Penjumlahan End-->

					<!-- Pengurangan-->
					<div class="col-xl-2 col-sm-5 mb-4">
						<div class="bg-light rounded shadow-sm py-5 px-4">
							<img src="imgs/icons/minus.png" alt="" width="100" class="img-fluid mb-3 img-thumbnail shadow-sm">
							<h5 class="mb-0">Pengurangan</h5></br></br>
							<a href="pengurangan.php"><button type="button" class="tombol btn" style="<?=$color[1] ?>">CHOOSE</button></a>
						</div>
					</div>
					<!-- Pengurangan End-->

					<!-- Perkalian-->
					<div class="col-xl-2 col-sm-5 mb-4">
						<div class="bg-light rounded shadow-sm py-5 px-4">
							<img src="imgs/icons/time.png" alt="" width="100" class="img-fluid mb-3 img-thumbnail shadow-sm">
							<h5 class="mb-0">Perkalian</h5></br></br>
							<a href="perkalian.php"><button type="button" class="tombol btn" style="<?=$color[2] ?>">CHOOSE</button></a>
						</div>
					</div>
					<!-- Perkalian End-->

					<!-- Pembagian-->
					<div class="col-xl-2 col-sm-5 mb-4">
						<div class="bg-light rounded shadow-sm py-5 px-4">
							<img src="imgs/icons/divide.png" alt="" width="100" class="img-fluid mb-3 img-thumbnail shadow-sm">
							<h5 class="mb-0">Pembagian</h5></br></br>
							<a href="pembagian.php"><button type="button" class="tombol btn" style="<?=$color[3] ?>">CHOOSE</button></a>
						</div>
					</div>
					<!-- Pembagian End-->

				</div>
			</div>
		</div>
		<div class="py-2"></div>
		<!-- End MAIN -->

		<!-- Copyright -->
		<footer class="bg-light pb-1">
			<div class="container text-center">
				<p class="font-italic text-muted mb-0">&copy; Copyrights Santuy.CO All rights reserved.</p>
			</div>
		</footer>
		<!-- End Copyright -->
	</body>
</html>