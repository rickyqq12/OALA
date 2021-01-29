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
$sql = "SELECT UserId FROM questionsolved WHERE UserId = ? AND QuestionId = ?";

if($stmt = mysqli_prepare($link, $sql)){

	// Bind variables to the prepared statement as parameters
	mysqli_stmt_bind_param($stmt, "ss", $param_userid, $param_questionid);

	// Set parameters
	$param_userid = $_SESSION["id"];
	$param_questionid = "D-002";

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
	$sql = "INSERT INTO questionsolved (UserId, QuestionId) VALUES (?, ?)";
	
	if($stmt = mysqli_prepare($link, $sql)){
		// Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt, "ss", $param_userid, $param_questionid);

		// Set parameters
		$param_userid = $_SESSION["id"];
		$param_questionid = "D-002";

		// Attempt to execute the prepared statement
		if (mysqli_stmt_execute($stmt)) {

		} else {
			echo "Oops! Something went wrong. Please try again later.";
		}

		// Close statement
		mysqli_stmt_close($stmt);
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

	<body style="background-image:url(imgs/quest_2.jpg); background-size:cover;">
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
							<h1 class="display-5 px-1">Problem D-002</h1>
						</div>
					</div>
					<div class="container-fluid">
						<div class="d-flex align-items-center">
							<div class="p-2">
								<a href="problem_list.php"><button type="button" class="btn btn-secondary" style="color:white;">< BACK</button></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

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
											<img src="problem/pembagian 2.jpg" width="1100" height="500" style="margin:auto">
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


		<div class="container py-5">
			<div class="row justify-content-center text-center">

				<div id='block-11' class="col" style='padding: 10px;'>
					<label for='option-11' style=' padding: 5px; font-size: 2.5rem;'>
					<input type='radio' name='option' value='2' id='option-11' style='transform: scale(1.6); margin-right: 10px; vertical-align: middle; margin-top: -2px;' />
					2</label>
					<span id='result-11'></span>
				</div>

				<div id='block-12' class="col" style='padding: 10px;'>
					<label for='option-12' style=' padding: 5px; font-size: 2.5rem;'>
					<input type='radio' name='option' value='12' id='option-12' style='transform: scale(1.6); margin-right: 10px; vertical-align: middle; margin-top: -2px;' />
					12</label>
					<span id='result-12'></span>
				</div>

				<div id='block-13' class="col" style='padding: 10px;'>
					<label for='option-13' style=' padding: 5px; font-size: 2.5rem;'>
					<input type='radio' name='option' value='4' id='option-13' style='transform: scale(1.6); margin-right: 10px; vertical-align: middle; margin-top: -2px;' />
					4</label>
					<span id='result-13'></span>
				</div>

				<div id='block-14' class="col" style='padding: 10px;'>
					<label for='option-14' style=' padding: 5px; font-size: 2.5rem;'>
					<input type='radio' name='option' value='1' id='option-14' style='transform: scale(1.6); margin-right: 10px; vertical-align: middle; margin-top: -2px;' />
					1</label>
					<span id='result-14'></span>
				</div>

				<div id='block-14' class="col" style='padding: 10px;'>
					<button type='button' onclick='displayAnswer1()' class="btn btn-info" style="font-size:35px">Submit</button>
				</div>
				<a id='showanswer1'></a>
				<script>
					//    The function evaluates the answer and displays result
					function displayAnswer1() {
						document.getElementById('block-11').style.border = '5px solid limegreen'
						document.getElementById('result-11').style.color = 'limegreen'
						document.getElementById('result-11').innerHTML = 'Correct!'

						document.getElementById('block-12').style.border = '1px solid red'
						document.getElementById('result-12').style.color = 'red'
						document.getElementById('result-12').innerHTML = 'Incorrect!'

						document.getElementById('block-13').style.border = '1px solid red'
						document.getElementById('result-13').style.color = 'red'
						document.getElementById('result-13').innerHTML = 'Incorrect!'

						document.getElementById('block-14').style.border = '1px solid red'
						document.getElementById('result-14').style.color = 'red'
						document.getElementById('result-14').innerHTML = 'Incorrect!'
					}
				</script>

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