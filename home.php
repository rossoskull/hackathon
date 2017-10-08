
<?php
session_start();
if(!isset($_SESSION['eid'])){
	header("Location: index.php");
	exit();
}

?>

<?php

require("dbconnect.php");


if(isset($_GET['rid']) && isset($_GET['cid'])){
	require("dbconnect.php");
	if(!isset($_SESSION['eid'])){ session_start(); }
	$pid = $_GET['rid'];
	$cid = $_GET['cid'];
	$id = $_SESSION['eid'];
	
	$q = "SELECT * FROM response WHERE projectid = '$pid' AND respid = '$id'";
	$r = mysqli_query($dbc, $q);
	
	if(mysqli_affected_rows($dbc)==0){
		$q= "INSERT INTO response VALUES ('$pid','$cid','$id','0')";
	
		$r = mysqli_query($dbc, $q);
	}
	
}


?>


<html>
<head>
	
	
</head>


<body>
	
<?php
require_once("header.php");
	?>
	

<!-- THE TOOL BAR OR MENU BAR -->
	
	<div class='miniwrapper'>
	<table>
	<tr>
		<td><a href='home.php'>My Projects </a> </td>
	<td><a href='home.php?q=sug'>Suggestions <?php require_once("phpscripts.php"); $n = getNoSuggestions(); if($n!=0){ echo "($n)" ;} ?> </a></td>
	<td><a href='home.php?q=res'>Responses <?php require_once("phpscripts.php"); $n = getNoResponses(); if($n!=0){ echo "($n)" ;} ?> </a></td>
	<td><a href='logout.php?q=yes'>Log Out</a></td>
	</tr>	
	</table>
	
	</div>
	
	
<!-- THE TOOL BAR OR MENU BAR ENDS -->
	
<div class='miniwrapper'>
	
	
</div>
	
	
<?php
	
	if(isset($_GET['q'])){
		
		/* DISPLAY SUGGESTIONS */
		
		if($_GET['q']=='sug'){
		require("dbconnect.php");
		$eid = $_SESSION['eid'];
		$q = "SELECT * FROM notification WHERE eid = '$eid'";
		require_once("dbconnect.php");
		$result = mysqli_query($dbc, $q);
		
		if($result){
			while($data = mysqli_fetch_array($result)){
				
				$pid = $data['projectid'];
				
				
				if($data['seen']=='0'){
					$classname = "miniwrapperus";
					
					$q3 = "UPDATE notification SET seen='1' WHERE projectid='$pid'";
					$r3 = mysqli_query($dbc, $q3);
					
				} else {
					$classname = "miniwrapper";
				}
				
				
				$q2 = "SELECT * FROM project WHERE projectid='$pid'";
				
				$r2 = mysqli_query($dbc, $q2);
				
				$data2 = mysqli_fetch_array( $r2);
				
				$title = $data2['title'];
				$desc = $data2['description'];
				$link = $data2['extlink'];
				$creatorid = $data2['eid'];
				if($creatorid == $_SESSION['eid']){
					continue;
				}
				
				$q4 = "SELECT fname, lname FROM users WHERE eid='$creatorid'";
				$r4 = mysqli_query($dbc, $q4);
				$data4 = mysqli_fetch_array($r4);
				
				$fname = $data4['fname'];
				$lname = $data4['lname'];
				
				echo "
				<!-- DISPLAY SUGGESTIONS -->
				
				<div class='$classname'>
				<h2>$title</h2>
				<h3>Created By <a href=''>$fname $lname</a></h3>
				<p>$desc</p>";
				
				if($link!="") { echo "External Link to the project: <a href='http://$link'>Go</a>"; }				
				
				echo "
				<br>
				<a href='home.php?q=sug&rid=$pid&cid=$creatorid'>Interested in project</a>
				</div>
				
				<!-- DISPLAY SUGGESTIONS ENDS -->
				";
				
				
				
				
			}
			
		}
		}
		
		/* DISPLAY RESPONSES */
		if($_GET['q']=='res'){
			
			require("dbconnect.php");
			if(!isset($_SESSION['eid'])){
				session_start();
			}
			
			$eid = $_SESSION['eid'];
			
			$q = "SELECT * FROM response WHERE creatorid='$eid'";
			
			$r= mysqli_query($dbc, $q);
			
			if($r){
				while($data = mysqli_fetch_array($r)){
					$pid = $data['projectid'];
					$rid = $data['respid'];
					$status = $data['seen'];
					
					if($status == '0'){
						$classname = 'miniwrapperus';
						$q3 = "UPDATE response SET seen='1' WHERE projectid='$pid' AND respid = '$rid'";
						$r3 = mysqli_query($dbc, $q3);
						
					} else {
						$classname = 'miniwrapper';
					}
					
					$q = "SELECT fname, lname FROM users WHERE eid = '$rid'";
					$r2 = mysqli_query($dbc, $q);					
					$data2 = mysqli_fetch_array($r2);
					
					$q = "SELECT title from project where projectid='$pid'";
					$r3 = mysqli_query($dbc, $q);
					$data3 = mysqli_fetch_array($r3);
					$title = $data3['title'];
					
					$fnamer = $data2['fname'];
					$lnamer=$data2['lname'];
					
					
					echo "
					<div class='$classname'>
					<p><a href='$rid'>$fnamer $lnamer</a> responded to your project titled '<b>$title</b>'</p>
					
					</div>
					";
					
					
				}
				
			}
			
			
			
		}
		/* DISPLAY RESPONSES ENDS */
		
		
		
		
		
		
		
	} else {
	
echo "
<!-- CREATE A PROJECT -->
	
<div class='miniwrapper'>
	<h2>Declare A New Project</h2>
	<h3>You can declare a new project here.</h3>
	<h4>People meeting the criteria of defined skillset of<br>your project, will get a notification about your project.</h4>
	
	<form action='register.php' method='post'>
		<input type='text' name='title' placeholder='Title' ><br>
		<textarea name='descr' id='descr' >A brief description of your Project.</textarea><br>
		<p>Any External link to the project ( If Any ) : </p>
		<input type='text' name='link' id='link' placeholder='e.g. GitHub Repo Link' />
		<p>Minimum required skills:</p>
			<input type='checkbox' value='C++' name='c1' id='c1' ><label for='c1'>C++</label> 
			<input type='checkbox' value='JAVA' name='c2' id='c2' ><label for='c2'>JAVA</label> 
			<input type='checkbox' value='PYTHON' name='c3' id='c3' ><label for='c3'>PYTHON</label><br>
			<input type='checkbox' value='C' name='c4' id='c4' ><label for='c4'>C</label> 
			<input type='checkbox' value='GOLANG' name='c5' id='c5' ><label for='c5'>GOLANG</label> 
			<input type='checkbox' value='DANCE' name='c6' id='c6' ><label for='c6'>DANCE</label><br>
			<input type='checkbox' value='SINGING' name='c7' id='c7' ><label for='c7'>SINGING</label> 
			<input type='checkbox' value='GUITAR' name='c8' id='c8' ><label for='c8'>GUITAR</label> 
			<input type='checkbox' value='PIANO' name='c9' id='c9' ><label for='c9'>PIANO</label><br>
			<input type='checkbox' value='FLUTE' name='c10' id='c10' ><label for='c10'>FLUTE</label> 
			<input type='checkbox' value='ACTING' name='c11' id='c11' ><label for='c11'>ACTING</label> 
			<input type='checkbox' value='POETRY' name='c12' id='c12' ><label for='c12'>POETRY</label><br>
		<input type='submit' name='subpf' id='subpf' value='Declare Project' >
	
	
	</form>
	
</div> ";
		
		/* DISPLAY THE PROJECTS CREATED BY THIS USER */
		require("dbconnect.php");
		$eid = $_SESSION['eid'];
		$q = "SELECT * FROM project WHERE eid = '$eid'";
		$r = mysqli_query($dbc, $q);
		if($r){
			while($data = mysqli_fetch_array($r)){
				$title = $data['title'];
				$desc = $data['description'];
				$link = $data['extlink'];
				
				echo "
				
				<div class='miniwrapper'>
				<h2>$title</h2>
				<p>$desc</p>";
				
				if($link!="") { echo "External Link to the project: <a href='http://$link'>Go</a>"; }				
				
				echo "</div>";
				
			}
			
		}
		
		
		/* DISPLAY THE PROJECTS CREATED BY THIS USER ENDS */
		
				}
				?>
	
	
</body>	



</html>