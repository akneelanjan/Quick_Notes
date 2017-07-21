<?php 

require 'core.inc.php';
require 'connect.inc.php';

$message = $name = $text = "";




if(loggedin()){
	$message = '<a href="logout.php">Log Out</a>';
	$name =  getuserfield('firstname')." ".getuserfield('surname');
	$username = getuserfield('username');
	
	if(isset($_POST['text'])){
	$text = $_POST['text'];
		if(!empty($text)){
			$query = "INSERT INTO `$username` VALUES ('','".mysql_real_escape_string($text)."','')";
			$query_run = mysql_query($query);
		}
	}
	
	function delete_note($del, $name){
	$delete = "DELETE FROM `$name` where `id` = '".$del."' ";
	$delete_run = mysql_query($delete);
	}
	
?>
<html>
<head>
<title>Quick Notes</title>

<meta charset="utf-8">
<link rel="stylesheet" href="project4.css">
<link rel="icon" href="favicon.png" type="image">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
			var name = "<?php echo $username; ?>";

			$(document).ready(function(){
				$(".del_note").click(function(){
					var id = $(this).attr('id') ;
					$.ajax({
						url: 'test.php',
						type: "POST",
						data: "id=" + id + "&name=" + name,	
						success: function(data) {
							console.log(data);
							$("#"+id).hide(1000);
						}
					});
				});
			});		
					
			
</script>


</head>
<body>
<div id="container">
	<div id="header_bar">
		QUICK NOTES
		<div id="logout"><?php echo $message; ?></div>
	</div>
	<div id="content">
		<div id="box">
			<div id="hello"><?php echo "<br>Hello ".$name; ?></div>
			<div id="newnote">
				<h2> Create Note </h2> <br>
				<form method="POST" action="index.php">
				<textarea id="text" name="text" placeholder="Write here" required></textarea><br>
				<button id="create" name="submit" type="submit">
					<i class='material-icons'>border_color</i>
				</button>
				</form>
			</div>
			<div id="old_notes">
				<div id="old_notes_header">YOUR DIARY</div>
			<?php 
			
			$table = "SELECT * FROM `$username`";
			$table_run = mysql_query($table);
			
			
			while($row = mysql_fetch_array($table_run)){
				echo "<div class='label' id='".$row['id']."'><div  class='rows' id='note_content'>" . $row['notes'] . "</div><div class='rows del_note'>" ."<button class='del_note' id='".$row['id']."'><i class='material-icons'>delete_forever</i></button>". "</div></div>";
			}
			
			
			
			?>
			
			
			</div>
		</div>	
	</div>	
	<div id="chat_space">
            <div id="chat_box">
			
			</div>
            <div id="chat_list">
			<?php 
			$chatters = "SELECT * FROM `users`";
			$chatters_run = mysql_query($chatters);
			
			while($chatters_row = mysql_fetch_array($chatters_run)){
				echo "<button class='chatters'>".$chatters_row['username']."</button><br>";
			}
			?>
			</div>
                <input type="text" name="name" id="name" placeholder="Enter Name: " required />
                <textarea name="enter message" id="message" placeholder="Enter Message" required></textarea>
                <button class="submit" type="submit" name="submit">click me</button>
				
            
    </div>
	<div id="copyright">
	Made with <i class="material-icons" style="color: red;">favorite</i> and <i class="fa fa-code" aria-hidden="true"></i>
	by Neelanjan Akuli © 2017
	</div>
</div>
</body>
</html>
<?php 
 

}
else{
	include 'login.inc.php';
}
?>
