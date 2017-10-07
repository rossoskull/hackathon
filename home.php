
<?php
session_start();
if(!isset($_SESSION['eid'])){
	header("Location: index.php");
	exit();
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
	<td>My Projects </td>
	<td><a href='home.php?q=sug'>Suggestions <?php require_once("phpscripts.php"); $n = getNoSuggestions(); if($n!=0){ echo "($n)" ;} ?> </a></td>
	<td><a href='logout.php?q=yes'>Log Out</a></td>
	</tr>	
	</table>
	
	</div>
	
	
<!-- THE TOOL BAR OR MENU BAR ENDS -->
	
<div class='miniwrapper'>
	
	
</div>
	
<!-- CREATE A PROJECT -->
	
<div class='miniwrapper'>
	<h2>Declare A New Project</h2>
	<h3>You can declare a new project here.</h3>
	<h4>People meeting the criteria of defined skillset of<br>your project, will get a notification about your project.</h4>
	
	<form action='register.php' method='post'>
		<input type='text' name='title' placeholder='Title' ><br>
		<textarea name='descr' id='descr' >A brief description of your Project.</textarea><br>
		<p>Any External link to the project ( If Any ) : </p>
		<input type="text" name='link' id='link' placeholder='e.g. GitHub Repo Link' />
		<p>Minimum required skills:</p>
			<input type="checkbox" value='C++' name='c1' id='c1' ><label for='c1'>C++</label> 
			<input type="checkbox" value='JAVA' name='c2' id='c2' ><label for='c2'>JAVA</label> 
			<input type="checkbox" value='PYTHON' name='c3' id='c3' ><label for='c3'>PYTHON</label><br>
			<input type="checkbox" value='C' name='c4' id='c4' ><label for='c4'>C</label> 
			<input type="checkbox" value='GOLANG' name='c5' id='c5' ><label for='c5'>GOLANG</label> 
			<input type="checkbox" value='DANCE' name='c6' id='c6' ><label for='c6'>DANCE</label><br>
			<input type="checkbox" value='SINGING' name='c7' id='c7' ><label for='c7'>SINGING</label> 
			<input type="checkbox" value='GUITAR' name='c8' id='c8' ><label for='c8'>GUITAR</label> 
			<input type="checkbox" value='PIANO' name='c9' id='c9' ><label for='c9'>PIANO</label><br>
			<input type="checkbox" value='FLUTE' name='c10' id='c10' ><label for='c10'>FLUTE</label> 
			<input type="checkbox" value='ACTING' name='c11' id='c11' ><label for='c11'>ACTING</label> 
			<input type="checkbox" value='POETRY' name='c12' id='c12' ><label for='c12'>POETRY</label><br>
		<input type='submit' name='subpf' id='subpf' value='Declare Project' >
	
	
	</form>
	
</div>
	
	
</body>	



</html>