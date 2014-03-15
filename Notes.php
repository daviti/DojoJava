<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://wwww.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3org/1999/xhtml" xml:lang="en">
<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />

		<title>Note Pad</title>
	
</head>
	<h3> My Post:<h3> 
	<body>

	<style>

	p.inset {border-style:inset;}

		</style>
	</head>


		<p class="inset"></p>
	<h3> Django<h3>
	<textarea name="comment" rows="10" cols="25"></textarea>
</body>

	<style>

	p.inset {border-style:inset;}

</style>
</body>
		<p class="inset"></p>
		<h3>Python<h3>
			<form action="delete.php" method="post">
				<input type="submit" value="Delete" />
				</form>

	<textarea name="comment" rows="10" cols="25"></textarea>
	<br>

	<input type="text" name="comment"><br>
  	<style>
	p.inset {border-style:inset;}

		</style>
  <HR WIDTH="60%">
	   <input type="submit" name="submit" value="Add a note"> 



	   connection
	   <?php​
	// Initialize session variables​
	session_start();
​
	// Connect to MySQL Database using mysql_connect() function or return an error if connection was unsuccessful.​
	$connect = mysql_connect('localhost', 'root', 'root') or die ("Unable to connect to your database. Make sure your database settings are correct.");
​
	// Select Database name or return an error if database was not found.​
	$select_db = mysql_select_db('ajax_advanced') or die("Couldn't find your database.");
​
	// Functions:​
	//​
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

index

<?php​
	// Includes connection.php so we can interact with the database within this page.​
	require_once('connection.php');
​?>​
​<!doctype html>​
​<html lang="en">​
	<head>​
		<meta charset="UTF-8">​
		<title>Ajax Advanced</title>​
		<!-- BOOTSTRAP THEME FROM BOOTSWATCH.COM -->​
		<link rel="stylesheet" href="http://bootswatch.com/cosmo/bootstrap.min.css">​
​
		<!-- USER-DEFINED STYLESHEET -->​
		<link rel="stylesheet" href="style.css">​
​
		<!-- INCLUDE JQUERY LIBRARY FROM GOOGLE HOST -->​
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>​
		
		<!-- JQUERY SCRIPTS -->​
		<script>​
			$(document).ready(function()
			{
				// Form for adding a note​
				$("#add_note").on("submit", function()
				{
					var form = $(this);
​
					$.post(form.attr("action"), form.serialize(), function(data)
					{
						if(data.status)
						{
							$(data.note).appendTo("#notes").hide().fadeIn();
							form.find("input[type='text']").val("");
						}
						else​
						{
							alert(data.message);
						}
					}, "json");
​
					return false;
				});
​
				$("#notes").on("submit", "form.edit_note", function()
				{
					var form = $(this);
					var note_description = form.find("textarea").val();
​
					$.post(form.attr("action"), form.serialize(), function(data)
					{
						form.find("textarea").parent().remove();
						form.find("input[type='submit']").remove();
​
						form.prepend(data.note);
​
						if(data.status)
						{
							form.find(".note_description p").text(data.note_description);
						}
						else​
						{
							form.find(".note_description p").text(note_description);
						}
					}, "json");
​
					return false;
				});
​
				$("#notes").on("click", "button.edit_description", function(event)
				{
					var edit_button = $(this);
					var form = edit_button.closest("form");
					var note_id = form.find("input[name='note_id']").val();
					var edit_form = "<div class='control-group'>\n"+​
										"<textarea name='description' placeholder='Please enter your description...'>"+ form.find(".note_description p").text() +"</textarea>\n"+​
									"</div>\n"+​
									"<input type='submit' value='Save' class='btn btn-success btn-mini'>";
​
					form.find(".note_description").replaceWith(edit_form);
​
					event.preventDefault();
				});
​
				$("#notes").on("click", ".delete_note button", function(event)
				{
					var form = $(this).parent();
​
					$.post(form.attr("action"), form.serialize(), function(data)
					{
						if(data.status)
						{
							form.closest(".row-fluid").fadeOut();
						}
						else​
						{
							alert(data.message);
						}
					}, "json");
					
					event.preventDefault();
				});
			});
		</script>​
		<!-- END OF JQUERY SCRIPTS -->​
	</head>​
	<body>​
		<div class="container-fluid">​
			<div class="row-fluid">​
				<div class="span12">​
					<div class="well">​
						<h1>Notes</h1>​
					</div>​
				</div>​
			</div>​
			<div id="notes">​
​<?php	$query = "SELECT * FROM notes";
		$notes = fetch_all($query);
​
		if($notes)
		{
			foreach($notes as $note)
			{	?>​
				<div class="row-fluid">​
					<div class="offset3 span6 offset3 well">​
						<h3 class="pull-left"><?php echo $note['title']; ?></h3>​
						<form class="delete_note" action="process.php" method="post">​
							<button class="btn btn-link pull-right">delete</button>​
							<input type="hidden" name="action" value="delete">​
							<input type="hidden" name="note_id" value="<?php echo $note['id']; ?>">​
						</form>​
						<div class="clearfix"></div>​
						<form action="process.php" method="post" class="edit_note form-horizontal">​
​<?php 					if($note['description'] != NULL)
						{	?>​
							<div class="note_description">​
								<p><?php echo $note['description']; ?></p>​
								<button class="btn btn-mini btn-success edit_description">Edit</button>​
							</div>​
​<?php 					}
						else​
						{	?>​
							<div class="control-group">​
								<textarea name="description" placeholder="Please enter your description..."></textarea>​
							</div>​
							<input type="submit" value="Save" class="btn btn-success btn-mini">​
​<?php 					}	?>						
							<input type="hidden" name="note_id" value="<?php echo $note['id']; ?>">​
						</form>​
					</div>​
				</div>​
​<?php 		}
		}	?>​
			</div>​
			<div class="row-fluid">​
				<div class="offset3 span6 offset3">​
					<form id="add_note" action="process.php" method="post" class="form-horizontal">​
						<div class="control-group">​
							<input type="text" name="title">​
						</div>​
						<input type="submit" value="Add note" class="btn btn-primary">​
					</form>​
				</div>​
			</div>​
		</div>​
	</body>​
​</html>


process
<?php​
	require_once("connection.php");
​
	// Process creation of note​
	if(isset($_POST['title'])) 
	{
		if($_POST['title'] != NULL)
		{
			$query = "INSERT INTO notes (title, created_at)
						VALUES('". mysqli_real_escape_string($_POST['title']) ."', NOW())";
​
			mysqli_query($query);
​
			if(mysqli_affected_rows() > 0)			
			{
				$data['status'] = TRUE;
				$data['note'] = '<div class="row-fluid">
									<div class="offset3 span6 offset3 well">
										<h3 class="pull-left">'. $_POST['title'] .'</h3>​
										<form class="delete_note" action="process.php" method="post">​
											<button class="btn btn-link pull-right">delete</button>​
											<input type="hidden" name="action" value="delete">​
											<input type="hidden" name="note_id" value="'. mysqli_insert_id() .'">​
										</form>​
										<div class="clearfix"></div>​
										<form action="process.php" method="post" class="edit_note form-horizontal">​
											<div class="control-group">​
												<textarea name="description" placeholder="Please enter your description..."></textarea>​
											</div>​
											<input type="submit" value="Save" class="btn btn-success btn-mini">​
											<input type="hidden" name="note_id" value="'. mysqli_insert_id() .'">​
										</form>​
									</div>​
								</div>';
			}
			else​
			{
				$data['status'] = FALSE;
				$data['message'] = 'Something went wrong while adding your note.';
			}
		}
	}
​
	// Process edit note​
	if(isset($_POST['description']))
	{
		$data['note'] = '<div class="note_description">
							<p></p>
							<button class="btn btn-mini btn-success edit_description">Edit</button>
						</div>';
​
		if($_POST['description'] != NULL OR $_POST['description'] != "")
		{
			$query = "UPDATE notes SET description = '". $_POST['description'] ."', updated_at = NOW()
						WHERE id = '". $_POST['note_id'] ."'";
​
			mysqli_query($query);
​
			if(mysqli_affected_rows() > 0)
			{
				$data['status'] = TRUE;
				$data['note_description'] = $_POST['description'];
			}
			else​
			{
				$data['status'] = FALSE;
				$data['message'] = 'Something went wrong with your query.';
			}
		}
		else​
		{
			$data['status'] = FALSE;
		}
	}
​
	if(isset($_POST['action']) && $_POST['action'] == 'delete')
	{
		$query = "DELETE FROM notes
					WHERE id = '". $_POST['note_id'] ."'";
​
		mysqli_query($query);
​
		if(mysqli_affected_rows() > 0)
		{
			$data['status'] = TRUE;
		}
		else​
		{
			$data['status'] = FALSE;
			$data['message'] = 'Something went wrong while deleting your note.';
		}
	}
​
	echo json_encode($data);
​?>

stylecss

* {
	margin: 0;
	padding: 0;
	vertical-align: baseline;
}
​
​ul, ol {
	list-style-type: none;
}
​
​.note {
	max-height: 150px;
	overflow: auto;
}


