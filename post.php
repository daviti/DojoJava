<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://wwww.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3org/1999/xhtml" xml:lang="en">
<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />

	<title>Ajax</title>
	
</head>
<h3> My Post:<h3> 
<body>

<div id="wrapper">
	<form id="register" action="/process">
		<textarea name="comment" rows="5" cols="25"></textarea>
		<textarea name="comment" rows="5" cols="25"></textarea>
		<textarea name="comment" rows="5" cols="25"></textarea>
	
	</form>
</div>

  </head>
    <br>Add a note: </br>
    <textarea name="comment" rows="5" cols="40"></textarea>
    <p><input type="submit" name="submit" value="Post It"></p>
   <br><br>


 </html>
</form>
</html>



Index
css
* {
	margin: 0;
	padding: 0;
	vertical-align: baseline;
}
​
​body {
	padding-bottom: 60px;
}
​
​.post {
	width: 150px;
	height: 150px;
	margin: 10px 15px;
	overflow: auto;
}
<?php​
	// Includes the connection file.​
	require_once('connection.php');
​?>​
​<!doctype html>​
​<html lang="en">​
	<head>​
		<meta charset="UTF-8">​
		<title>Ajax Basic 1</title>​
		<!-- INCLUDE BOOTSTRAP THEME FROM BOOTSWATCH.COM -->​
		<link rel="stylesheet" href="http://bootswatch.com/journal/bootstrap.min.css">​
​
		<!-- INCLUDE USER-DEFINED STYLESHEET -->​
		<link rel="stylesheet" href="style.css">​
​
		<!-- INCLUDE JQUERY LIBRARY FROM GOOGLE HOST -->​
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>​
​
		<!-- JQUERY SCRIPTS -->​
		<script>​
			$(document).ready(function()
			{
				$("#add_note").on("submit", function()
				{
					// $(this) means the parent selector which is the $("#search_leads") form.​
					// We store $(this) into the form variable because we will later inside another selector.​
					var form = $(this);
​
					$.post(form.attr("action"), form.serialize(), function(data)
					{
						// Checks for the status variable set on the backend. If it returns TRUE, we append posts to the page.​
						if(data.status)
						{
							$(data.post).appendTo("#posts").hide().fadeIn();
							form.find("textarea").val("");
						}
					}, "json");
​
					return false;
				});
			});
		</script>​
		<!-- END OF JQUERY SCRIPTS -->​
	</head>​
	<body>​
		<div class="container">​
			<div class="row">​
				<div class="span12">​
					<fieldset id="posts">​
						<legend><h1>My Posts:</h1></legend>​
​<?php 			// Query for retrieving all posts from the database.​
				$query = "SELECT * FROM posts";
​
				// We use the fetch_all function to get all posts from the database in an associative array format.​
				$posts = fetch_all($query);
​
				// We check if the $posts variable is available (This is to avoid errors when the $posts variable is empty). If it is, we do echo each post.​
				if($posts)
				{
					foreach($posts as $post)
					{	?>​
						<div class="well post pull-left">​
							<p><?php echo $post['description']; ?></p>​
						</div>​
​<?php 				}
				}	?>	
					</fieldset> <!-- END OF POSTS -->​
				</div> <!-- END OF SPAN12 -->​
			</div> <!-- END OF ROW -->​
			<div class="row">​
				<div class="span3">​
					<fieldset>​
						<legend>Add a post</legend>​
						<!-- FORM FOR ADDING A NOTE -->​
						<form id="add_note" action="process.php" method="post">​
							<textarea name="description" placeholder="Enter your description..."></textarea>​
							<input type="submit" value="Add Post" class="btn btn-success">​
						</form>​
						<!-- END OF FORM FOR ADDING A NOTE -->​
					</fieldset>​
				</div> <!-- END OF SPAN3 -->​
			</div> <!-- END OF ROW -->​
		</div> <!-- END OF CONTAINER -->​
	</body>​
​</html>

connection

<?php​
	// Initialize session variables ($_SESSION)​
	session_start();
​
	// Connect to MySQL server. If connection was unsuccessful, it will return an error.​
	// The die() function prints a message and exits (discontinues exection of codes) the current script.​
	$connect = mysql_connect('localhost', 'root', 'root') or die("Unable to connect to your database. Make sure your database settings are correct.");
​
	// If the above code works (If connection to the MySQL database was successful), This code will now select a database from the MySQL server and will return an error if unsuccessful.​
	$select_database = mysql_select_db('ajax_basic') or die("Unknown datbase name");
​
	// Function to fetch several records from the database.​
	function fetch_all($query)
	{
		$result = mysql_query($query);
		$data = array();
​
		if(mysql_num_rows($result) > 0)
		{
			while($row = mysql_fetch_assoc($result))
			{
				$data[] = $row;
			}
​
			return $data;
		}
		else​
		{
			return FALSE;
		}
	}
​?>

Process
<?php​
	require_once('connection.php');
​
	// Checks if $_POST variable is set.​
	if(isset($_POST))
	{
		// Checks if the description given was NULL.​
		if($_POST['description'] != NULL)
		{
			// Query for inserting a post into the database.​
			$query = "INSERT INTO posts (description, created_at)
						VALUES('". $_POST['description'] ."', NOW())";
​
			// Runs the query provided and then processed by the MySQL server.​
			mysql_query($query);
​
			// Checks if there are affected rows.​
			if(mysql_affected_rows() > 0)
			{
				// Sets the status to TRUE if there were affected rows. Then variable is then sent to the Javascript via json.​
				$data['status'] = TRUE;
​
				// Saves the post to be appended to the HTML page.​
				$data['post'] = '<div class="well post pull-left">
									<p>'. $_POST['description'] .'</p>​
								</div>';
			}
			else​
			{
				// Sets the status to FALSE if something went wrong with the insertion of data to the database.​
				$data['status'] = FALSE;
​
				// Sets an error message to be displayed.​
				$data['message'] = 'Something went wrong while adding your note.';
			}
		}
		else​
		{
			// Sets the status to FALSE when $_POST data is not set.​
			$data['status'] = FALSE;
		}
	}
	
	echo json_encode($data);
​

style

* {
	margin: 0;
	padding: 0;
	vertical-align: baseline;
}
​
​body {
	padding-bottom: 60px;
}
​
​.post {
	width: 150px;
	height: 150px;
	margin: 10px 15px;
	overflow: auto;
}