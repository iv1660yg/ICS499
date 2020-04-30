<?php 
session_start();
include('header.php');
include_once("db_connect.php");

if (empty($_SESSION['user_id'])){
header("Location: login.php");



if (!empty($_GET['id'])) {

    $movie_ID=$_GET['id'];

    $sql2 = "Select FROM movies WHERE movie_id = '".$_GET['id']."' ";
    
    $result = mysqli_query($conn, $sql2);  
    

	
     //fill array
     while($row = mysqli_fetch_assoc($result))  
     {  
          $json_array[] = array("movie_id" => $row['movie_id'], "movie_title" => $row['movie_title'],"releaseyear"=>$row['releaseyear'],"moviedb_id"=>$row['moviedb_id'],"imdb_id"=>$row['imdb_id']);
     } 


     //convert array to json
     $json_en_id = json_encode($json_array);
	 $json_de_id  = json_decode($json_en_id);

	foreach ($json_de_id as $mymovies);

     $mymovies->moviedb_id;
       


}



$error = false;
if (isset($_POST['addmovie'])) {
	$movie_title = mysqli_real_escape_string($conn, $_POST['movie_title']);
	$releaseyear = mysqli_real_escape_string($conn, $_POST['releaseyear']);
	$moviedb_id = mysqli_real_escape_string($conn, $_POST['moviedb_id']);
	$imdb_id = mysqli_real_escape_string($conn, $_POST['imdb_id']);

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
    <p><strong>Welcome!</strong> You are logged in as <strong><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></strong></p>

    
    <div class="form">
	<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="addmovieform">
				<fieldset>
					<legend>Add Movie</legend>

					<table>
					<tr> 
					<div class="form-group">
					<td>
						<label for="movie_title">Movie Title</label>
					<t/d>
					<td>
						<input type="text" name="movie_title" placeholder="Movie Title" value="<?php echo (isset($scantitle))?$scantitle:'';?>" required value="<?php if($error) echo $movie_title; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($mtitle_error)) echo $mtitle_error; ?></span>click <a href="scan.php">here</a> to scan barcode
					</td>	
					</div>
					</tr>	
					<tr> 
					<div class="form-group">
					<td>
						<label for="releaseyear">Release Year</label>
						</td>
						<td>	
						<input input type="number" name="releaseyear" min="1900" max="2099" step="1" value="<?php echo (isset($mymovies->releaseyear))?$mymovies->releaseyear:'';?>"required value="<?php if($error) echo $releaseyear; ?>" class="form-control" />
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
						<input type="text" name="moviedb_id" placeholder="Enter Moviedb ID" value="<?php echo (isset($mymovies->moviedb_id))?$mymovies->moviedb_id:'';?>" required value="<?php if($error) echo $moviedb_id; ?>" class="form-control" />
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
						<input type="text" name="imdb_id" placeholder="Enter IMDB ID" value="<?php echo (isset($mymovies->imdb_id))?$mymovies->imdb_id:'';?>" required value="<?php if($error) echo $imdb_id; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($imdb_id_error)) echo $imdb_id_error; ?></span>
						</td>
					</div>
					</tr> 
					<tr> 
					<div class="form-group">
					<td>
						<input type="submit" name="update" value="update" class="btn btn-primary" />
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