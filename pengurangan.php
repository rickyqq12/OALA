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

$success = false;
// Prepare a select statement
$sql = "SELECT UserId FROM coursesolved WHERE UserId = ? AND CourseId = ?";

if($stmt = mysqli_prepare($link, $sql)){

	// Bind variables to the prepared statement as parameters
	mysqli_stmt_bind_param($stmt, "ss", $param_userid, $param_courseid);

	// Set parameters
	$param_userid = $_SESSION["id"];
	$param_courseid = "SUB01";

	// Attempt to execute the prepared statement
	if(mysqli_stmt_execute($stmt)){

		// Store result
		mysqli_stmt_store_result($stmt);

		if(mysqli_stmt_num_rows($stmt) == 0){
			$success = true;
		}
	} else {
		echo "Oops! Something went wrong. Please try again later.";
	}

	// Close statement
	mysqli_stmt_close($stmt);
}

if ($success == true) {
	$sql = "INSERT INTO coursesolved (userid, courseid) VALUES (?, ?)";
			
	if($stmt = mysqli_prepare($link, $sql)){
		// Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt, "ss", $param_userid, $param_courseid);

		// Set parameters
		$param_userid = $_SESSION["id"];
		$param_courseid = "SUB01";

		// Attempt to execute the prepared statement
		if (mysqli_stmt_execute($stmt)) {

		} else {
			echo "Oops! Something went wrong. Please try again later.";
		}
	}
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

	<body style="background-image:url(imgs/prob_pengurangan.jpg); background-size:cover;">
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

		<div class="container pt-1">
			<div class="row justify-content-center">
				<div class="col">
					<div class="container-fluid">
						<div class="d-flex align-items-center">
							<h1 class="display-5 px-1">Pengurangan</h1>
						</div>
					</div>
					<div class="container-fluid">
						<div class="d-flex align-items-center">
							<div class="p-2">
								<a href="material_list.php"><button type="button" class="btn btn-secondary" style="color:white;">< BACK</button></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End MAIN -->

		<div class="container mt-4 mb-5" style="width:1400px">
			<div class="row justify-content-center">
				<div class="col-15 carousel-panel">
					<div id="questions" class="carousel slide" data-bs-ride="carousel">
						<ol class="carousel-indicators">
							<li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></li>
						</ol>
						<div class="carousel-inner">
							<div class="carousel-item active">
								<div class="container-fluid">
									<div class="d-flex justify-content-center align-items-center">
										<div class="p-2">
											<img src="material/pengurangan.png" width="1100" height="500" style="margin:auto">
										</div>
									</div>
								</div>
							</div>
						</div>
						<a class="carousel-control-prev carousel-btn" href="#questions" role="button" data-bs-slide="prev" style="width:75px;">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Previous</span>
						</a>
						<a class="carousel-control-next carousel-btn" href="#questions" role="button" data-bs-slide="next" style="width:75px;">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Next</span>
						</a>
					</div>
				</div>
			</div>
		</div>

		<!-- Copyright -->
		<footer class="bg-light pb-1">
			<div class="container text-center">
				<p class="font-italic text-muted mb-0">&copy; Copyrights Santuy.CO All rights reserved.</p>
			</div>
		</footer>
<!-- End Copyright -->
	</body>
</html>