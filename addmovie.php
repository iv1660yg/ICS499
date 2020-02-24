<?php 
session_start();
include('header.php');
include_once("db_connect.php");

if (empty($_SESSION['user_id'])){
header("Location: login.php");

}
$error = false;
if (isset($_POST['addmovie'])) {
	$movie_title = mysqli_real_escape_string($conn, $_POST['movie_title']);
	$releaseyear = mysqli_real_escape_string($conn, $_POST['releaseyear']);
	$moviedb_id = mysqli_real_escape_string($conn, $_POST['moviedb_id']);
	$imdb_id_error = mysqli_real_escape_string($conn, $_POST['imdb_id']);

/*
	if (empty($movie_title)) {
		$error = true;
		$mtitle_error = "can't be empty";
	}
	if(empty($releaseyear)) {
		$error = true;
		$releaseyear_error = "Please Enter Valid Year";
	}
	if(empty($moviedb_id)) {
		$error = true;
		$moviedb_id_error = "Password must be minimum of 6 characters";
	}
	if(empty($imdb_id)) {
		$error = true;
		$imdb_id_error = "Password and Confirm Password doesn't match";
	}
	*/
	if (!$error) {
		if(mysqli_query($conn, "INSERT INTO movies(movie_title, releaseyear,  moviedb_id, imdb_id) VALUES('" . $movie_title . "','" . $releaseyear . "','" . $moviedb_id . "', '" . $imdb_id . "')")) {

			header("Location:index.php");
			exit();

		} else {
			$error_message = "Error in adding move...Please try again later!";
		}
	}
}




?>


<?php if ((isset($_SESSION['user_id']) )) { ?>

    <p><strong>Welcome!</strong> You are logged in as <strong><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></strong></p>

    
    <div class="form">
	<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="addmovieform">
				<fieldset>
					<legend>Add Movie</legend>

					<div class="form-group">
						<label for="movie_title">Movie Title</label>
						<input type="text" name="movie_title" placeholder="Enter Movie Title" required value="<?php if($error) echo $movie_title; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($mtitle_error)) echo $mtitle_error; ?></span>
					</div>

					<div class="form-group">
						<label for="releaseyear">Release Year</label>
						<input input type="number" min="1900" max="2099" step="1" value="2020" required value="<?php if($error) echo $releaseyear; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($releaseyear_error)) echo $releaseyear_error; ?></span>
					</div>
									
					<div class="form-group">
						<label for="moviedb_id">Moviedb ID</label>
						<input type="text" name="moviedb_id" placeholder="Enter Moviedb ID" required value="<?php if($error) echo $moviedb_id; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($moviedb_id_error)) echo $moviedb_id_error; ?></span>
					</div>

					<div class="form-group">
						<label for="imdb_id">IMDB ID</label>
						<input type="text" name="imb_id" placeholder="Enter IMDB ID" required value="<?php if($error) echo $imdb_id; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($imdb_id_error)) echo $imdb_id_error; ?></span>
					</div>

					<div class="form-group">
						<input type="submit" name="addmovie" value="Add Movie" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
  </div>



    <P>
    Click <a href="logout.php">here</a> to logout
    

    

 <?php } ?>