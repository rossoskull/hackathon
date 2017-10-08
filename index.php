<?php
session_start();
if(isset($_SESSION['eid'])){
header("Location: home.php");
	exit();
} ?>


<html>
	
<head>
	<script src="script.js" type='text/javascript' ></script>
	
</head>


<body>
	
<!-- Header FILE -->
	<?php require('header.php'); ?>
	
	<!-- LOGIN FORM -->
	<div class = 'miniwrapper'>
	<form action='register.php' method="post" onsubmit="return validateuform();" >
		<div class='centrewrap'><h2>Log In</h2>
		
		<input type="email" placeholder="E-Mail ID" id='leid' name='eid' />
		<br>
			<input type="password" placeholder="Password" id='lpass' name='pass' />
		<br>
		<input type="submit" value="Log In" name='sublf' id='sublf' ></div>
		

		
		</form>
	</div>
	<!-- LOGIN FORM ENDS -->
	
	<!-- REGISTRATION FORM -->
	
	<div class='miniwrapper'>
		<h2>Register</h2>
		<form action='register.php' method="post"  onSubmit="return validateform()" >
		 <h3>Personal Details:</h3>
	 		<input type='text' name='fname' id='fname' placeholder="First Name" ><br>
	 		<input type='text' name='lname' id='lname' placeholder="Last Name" ><br>
		 	<input type='text' name='pno' id='pno' placeholder="Phone Number" ><br>
		 <h3>Account Details:</h3>
		 	<input type='email' name='eid' id='eid' placeholder="E-Mail ID" ><br>
		 	<input type='password' name='pass' id='pass' placeholder="Password" ><br>
		 	<input type='password' name='repass' id='repass' placeholder="Retype Password" ><br>
		 <h3>Skills:</h3>
			<p>Select skills from below given choices:</p><br>
			<input type="checkbox" value='C++' name='c1' id='c1' ><label for='c1'>C++</label><br>
			<input type="checkbox" value='JAVA' name='c2' id='c2' ><label for='c2'>JAVA</label><br>
			<input type="checkbox" value='PYTHON' name='c3' id='c3' ><label for='c3'>PYTHON</label><br>
			<input type="checkbox" value='C' name='c4' id='c4' ><label for='c4'>C</label><br>
			<input type="checkbox" value='GOLANG' name='c5' id='c5' ><label for='c5'>GOLANG</label><br>
			<input type="checkbox" value='DANCE' name='c6' id='c6' ><label for='c6'>DANCE</label><br>
			<input type="checkbox" value='SINGING' name='c7' id='c7' ><label for='c7'>SINGING</label><br>
			<input type="checkbox" value='GUITAR' name='c8' id='c8' ><label for='c8'>GUITAR</label><br>
			<input type="checkbox" value='PIANO' name='c9' id='c9' ><label for='c9'>PIANO</label><br>
			<input type="checkbox" value='FLUTE' name='c10' id='c10' ><label for='c10'>FLUTE</label><br>
			<input type="checkbox" value='ACTING' name='c11' id='c11' ><label for='c11'>ACTING</label><br>
			<input type="checkbox" value='POETRY' name='c12' id='c12' ><label for='c12'>POETRY</label><br>
		 
		 	<input type="submit" value='Register' name='subrf' id='subrf' >	 
	 	
	 	</form>
	
		
	</div>
	
	
	<!-- REGISTRATION FORM ENDS -->
	
	
	
	
	<!-- FOOTER FILE -->
	</body>

</html>