<?php 
session_start();
include('header.php');
include_once("db_connect.php");

if (empty($_SESSION['user_id'])){
header("Location: login.php");

}

if (!empty($_GET['id'])) {

    $movie_ID=$_GET['id'];

    $sql2 = "Select * FROM movies WHERE movie_id = '".$_GET['id']."' ";
    
    $result = mysqli_query($conn, $sql2);  
    $row = mysqli_fetch_array($result);
	$edit_movie_id = $row['movie_id'];
	$edit_movie_title = $row['movie_title'];	
	$edit_releaseyear = $row['releaseyear'];
	$edit_moviedb_id = $row['moviedb_id'];
	$edit_imdb_id = $row['imdb_id'];		
			

}



$error = false;
if (isset($_POST['addmovie'])) {
	$movie_title = mysqli_real_escape_string($conn, $_POST['movie_title']);
	$releaseyear = mysqli_real_escape_string($conn, $_POST['releaseyear']);
	$moviedb_id = mysqli_real_escape_string($conn, $_POST['moviedb_id']);
	$imdb_id = mysqli_real_escape_string($conn, $_POST['imdb_id']);

/* rebuild error checking later
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

		//intsert movie record
		if(mysqli_query($conn, "INSERT INTO movies(movie_title, releaseyear,  moviedb_id, imdb_id) VALUES('" . $movie_title . "','" . $releaseyear . "','" . $moviedb_id . "', '" . $imdb_id . "')")) {

			//select movie titles that equal submitted movie title 
			$result = mysqli_query ($conn,"SELECT * from movies where movie_title = '" . $movie_title . "' ");

			//set var movie_id = movie_id from sql search 
			while ($row = mysqli_fetch_array($result)) {
				$movie_id = $row['movie_id'];
			  }

			//add movie to users personal little   
			mysqli_query($conn,"INSERT INTO user_movie(user_id, movie_id) VALUES('" . $_SESSION['user_id'] . "','" . $movie_id . "')");
		
			//redirect to index page
			header("Location:index.php");
			exit();

		} else {
			$error_message = "Error in adding move...Please try again later!";
		}

	}
	
	
}




?>


<?php if ((isset($_SESSION['user_id']) )) { ?>
<head>
  <link rel="stylesheet" href="css/style.css">
</head>

    
    <div class="form">
	<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="addmovieform">
				<fieldset>
					<legend>Edit Movie</legend>

					<table>
					<tr> 
					<div class="form-group">
					<td>
						<label for="movie_title">Movie Title</label>
					<t/d>
					<td>
						<input type="text" name="movie_title" placeholder="Movie Title" value="<?php echo (isset($edit_movie_title))?$edit_movie_title:'';?>" required value="<?php if($error) echo $movie_title; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($mtitle_error)) echo $mtitle_error; ?></span>
					</td>	
					</div>
					</tr>	
					<tr> 
					<div class="form-group">
					<td>
						<label for="releaseyear">Release Year</label>
						</td>
						<td>	
						<input input type="number" name="releaseyear" min="1900" max="2099" step="1" value="<?php echo (isset($edit_releaseyear))?$edit_releaseyear:'';?>" required value="<?php if($error) echo $releaseyear; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($releaseyear_error)) echo $releaseyear_error; ?></span>
						</td>
					</div>
					</tr> 
					<tr> 				
					<div class="form-group">
					<td>
						<label for="moviedb_id">Moviedb ID</label>
						</td>
						<td>
						<input type="text" name="moviedb_id" placeholder="Enter Moviedb ID" value="<?php echo (isset($edit_moviedb_id))?$edit_moviedb_id:'';?>" required value="<?php if($error) echo $moviedb_id; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($moviedb_id_error)) echo $moviedb_id_error; ?></span>
						</td>
					</div>
					</tr> 
					<tr> 
					<div class="form-group">
					<td>
						<label for="imdb_id">IMDB ID</label>
						</td>
						<td>
						<input type="text" name="imdb_id" placeholder="Enter IMDB ID" value="<?php echo (isset($edit_imdb_id))?$edit_imdb_id:'';?>" required value="<?php if($error) echo $imdb_id; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($imdb_id_error)) echo $imdb_id_error; ?></span>
						</td>
					</div>
					</tr> 
					<tr> 
					<div class="form-group">
					<td>
						<input type="submit" name="editmovie" value="Edit Movie" class="btn btn-primary" />
						</td>
					</div>
					</tr> 
					</table>
				</fieldset>
			</form>
  </div>



    <P>
    Click <a href="logout.php">here</a> to logout
    

    

 <?php } ?>