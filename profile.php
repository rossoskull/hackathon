<?php
session_start();
if(!isset($_SESSION['eid']) || !isset($_GET['id']) || $_GET['id']==''){
	header("Location: home.php");
	exit();
}
?>

<html>
	<head>
	<title>Profile - Collab</title>
	</head>
	
	<body>
	 <?php require("header.php"); ?>
		<?php
		require_once("phpscripts.php");
		$id = $_GET['id'];
		require('dbconnect.php');
		$q = "SELECT * FROM users WHERE eid = '$id'";
		$r = mysqli_query($dbc, $q);
		
		if($r){
			$data = mysqli_fetch_array($r);
			$fname = $data['fname'];
			$lname = $data['lname'];
			$skill = $data['skillset'];
			
			echo "<div class='miniwrapper'><h2>$fname $lname</h2><h3>E-Mail ID : $id</h3>
			<h4>Responded to : ".totalResponses($id)." Project(s)</h4>
			<h4>Total Projects : ".totalProjects($id)."</h4>
			
			</div>
			";
			
			
			$q = "SELECT * FROM project WHERE eid = '$id'";
			$r2 = mysqli_query($dbc, $q);
			
			if($r2){
				echo "<div class='miniwrapper'><h2>Projects of $fname $lname : </h2>";
				while($data2 = mysqli_fetch_array($r2)){
					$title = $data2['title'];
					$desc = $data2['description'];
					$skill = $data2['minskills'];
					$link = $data2['extlink'];
					
					echo "<h3> - $title</h3> <h4>$desc</h4>Minimum Reqiured Skills : $skill<br>
					";
					if($link != ""){
						echo "External Link to the project : <a href='https://$link'>Click Here</a>";
					}
					echo "<hr />";
				}
				echo "</div>";
				
			}
			
			
			
			
		}
		?>
	
	
	</body>

</html>