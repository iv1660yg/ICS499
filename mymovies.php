<?php 
session_start();
include('header.php');
include_once("db_connect.php");

if (empty($_SESSION['user_id'])){
header("Location: login.php");
}
    //SQL query

    $sql2 = "SELECT * FROM movies NATURAL JOIN user_movie WHERE user_id = '" .$_SESSION['user_id']."' ";  

    $result = mysqli_query($conn, $sql2);  

    //create array
     $json_array = array();  
    
     //fill array
     while($row = mysqli_fetch_assoc($result))  
     {  
          $json_array[] = array("movie_id" => $row['movie_id'], "movie_title" => $row['movie_title'],"releaseyear"=>$row['releaseyear'],"moviedb_id"=>$row['moviedb_id'],"imdb_id"=>$row['imdb_id']);
     } 


     //convert array to json
     $json_en_id = json_encode($json_array);
     $json_de_id  = json_decode($json_en_id);






// Close connection
mysqli_close($conn);

?>


<?php if ((isset($_SESSION['user_id']) )) { ?>

<head>
  <link rel="stylesheet" href="css/style.css">
</head>
    <p><strong>Welcome!</strong> You are logged in as <strong><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></strong></p>
    
    <center>
<table>
	<tbody>
    <tr>
      <th colspan="3"><h1>My Movies</h1></th>
    </tr>
		<tr>
			<th>Movie Title</th>
            <th>Release Year</th>
		</tr>
		<?php foreach ($json_de_id as $mymovies) : ?>
        <tr>
            <td> <?php echo $mymovies->movie_title; ?> </td>
            <td> <?php echo $mymovies->releaseyear; ?> </td>
        </tr>
		<?php endforeach; ?>
	</tbody>
</table>

    </center
    
    <P>
    Click <a href="logout.php">here</a> to logout
    

    

 <?php } ?>