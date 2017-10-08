<?php

if(!isset($_POST['sublf']) && !isset($_POST['subrf']) && !isset($_POST['subpf'])){
	header("Location: index.php");
	exit();
}

/* LOGIN FORM SUBMIT SCRIPT */


if(isset($_POST['sublf'])){
	
	require_once("dbconnect.php");

            $eid = mysqli_real_escape_string($dbc,$_POST['eid']);
            $pass = mysqli_real_escape_string($dbc,$_POST['pass']);
            
            $q = "SELECT * FROM users WHERE eid='$eid' AND pass='$pass'; ";
            $result = mysqli_query($dbc, $q);
            
            if($result){
                if(mysqli_affected_rows($dbc)==1){
                    //Data is correct, create session variables and redirect
                    $data = mysqli_fetch_array($result);
                    
                    session_start();
                    
                    $_SESSION['fname'] = $data['fname'];
                    $_SESSION['lname'] = $data['lname'];
                    $_SESSION['eid'] = $data['eid'];
                    $_SESSION['pass'] = $data['pass'];
                    	
					header("Location: home.php");
					exit();
                
                } else if(mysqli_affected_rows($dbc)==0){
                    //Username or password is incorrect. Prompt to enter those again or the account is not verified.
                    require_once("header.php");
                    echo "<body>";                    
                    echo "
                        <div class='miniwrapper'>
                            Looks like we couldn't Log you in.<br>
                            The E-Mail ID or Password you entered are incorrect.<br>
                            <br>
                            Try to login again.<br>
							<form action='register.php' method='post'>
                            <input type='email' placeholder='E-Mail ID' id='eid' name='eid' />
							<br>
							<input type='password' placeholder='Password' id='pass' name='pass' />
							<br>
							<input type='submit' value='Log In' name='sublf' id='sublf' >
    						</form>
                    
                        </div>
                    
                    ";
                    
                    require_once("footer.php");
                  
                    
                
                }
                
            } else {
                //Print that the connection couldn't be established .
                
                require_once("header.php");
                    
                    echo "
                        <div class='cbox'>
                            Oops.. :'(<br>
                            There has been an error connecting the server<br>
                            We were unable to submit your data<br>
                            Please try again later<br>
                            Sorry for the inconvinience. <br>
                    
                        </div>
                    
                    ";
                    
                require_once("footer.php");
                
                
            }
	
	
	
}





/* LOGIN FORM SUBMI SCRIPT ENDS */




/* REGISTRATION FORM SUBMIT SCRIPT */
if(isset($_POST['subrf'])){
	/* GETTING THE SKILLSET STRING */

	$N = 12;
	$SKILLSET = "";
	
	if(!isset($_POST['skillset'])){
		for($I = 1;$I<=$N;$I++){
			$INDEX = "c".$I;
			if(isset($_POST[$INDEX]))
			$SKILLSET = $SKILLSET." ".$_POST[$INDEX];


		}
		
	} else {
		$SKILLSET = $_POST['skillset'];
	}
	
	/* GETTING THE SKILLSET STRING END */

	$fname = stripslashes($_POST['fname']);
	$lname = stripslashes($_POST['lname']);
	$pno = stripslashes($_POST['pno']);
	$eid = stripslashes($_POST['eid']);
	$pass = stripslashes($_POST['pass']);
	
	$search = strtoupper($fname)." ".strtoupper($lname)." ".$pno." ".strtoupper($eid);
	
	$q = "SELECT fname FROM users where eid = '$eid'";
	require_once("dbconnect.php");
	
	$result = mysqli_query($dbc, $q);
	
	if($result){
		
		if(mysqli_affected_rows($dbc)==0){
			$q = "INSERT INTO users VALUES ('$fname', '$lname', '$eid', '$pass', '$pno', '$search', '$SKILLSET');";
			$result = mysqli_query($dbc, $q);
			
			if($result){
				echo "<html><head>";
				echo "</head><body>";
				require_once("header.php");
				
				echo "
				<div class='miniwrapper'>
				<h2>Congratulations!</h2>
				<p>Your Account has been created with Collab.</p>
				<p>You are just one step away from your Collab experience.</p>
				<p>Get started by clicking the following button!.</p>
				
				<a href='home.php' class='greenbutton'> Go! </a>
				
				</div>
				
				";
				
				require_once("footer.php");
				
				if(!isset($_SESSION['eid'])){
					session_start();
				}
				
				$_SESSION['fname']= $fname;
				$_SESSION['lname']= $lname;
				$_SESSION['eid']= $eid;
				$_SESSION['pass'] = $pass;
				
				
				
				
				
			} else {
				/* ERROR CONNECTING SERVER */
				
				echo "<html><head>";
				echo "</head><body>";
				require_once("header.php");
				
				echo "
				<div class='miniwrapper'>
				<h2>Oops...</h2>
				<p>There was an error connecting the server.<br>Please try again later</p>
				
				</div>
				
				";
				
				require_once("footer.php");
				
				
				
			}
			
			
			

			
		} else {
			
			/* EMAIL ID IS ALREADY IN USE, PROMT FOR ANOTHER */
			
			echo "<html><head>";
				echo "</head><body>";
				require_once("header.php");
				
				echo "
				<div class='miniwrapper'>
				<h2>Re-enter the E-Mail ID</h2>
				<p>Looks like the E-Mail ID you entered is already in use.<br>Please enter a new E-Mail ID.</p>
				
				<form action='register.php' method='post'   >
	 		<input type='hidden' name='fname' id='fname' value='$fname'>
	 		<input type='hidden' name='lname' id='lname' value='$lname' >
		 	<input type='hidden' name='pno' id='pno' value='$pno' >
		 	<input type='email' name='eid' id='eid' placeholder='E-Mail ID' ><br>
		 	<input type='hidden' name='pass' id='pass' value='$pass' >
			<input type='hidden' name='skillset' id='skillset' value='$SKILLSET' >
		 
		 	<input type='submit' value='Register' name='subrf' id='subrf' >	 
	 	
	 	</form>
				
				
				
				
				</div>
				
				";
				
				require_once("footer.php");
			
			
		}
		
		
		
	} else {
		
		/* PRINT THAT THERE WAS AN ERROR CONNECTING THE SERVER */
		
		echo "<html><head>";
				echo "</head><body>";
				require_once("header.php");
				
				echo "
				<div class='miniwrapper'>
				<h2>Oops...</h2>
				<p>There was an error connecting the server.<br>Please try again later</p>
				
				</div>
				
				";
				
				require_once("footer.php");
		
	}

	
}

/* REGISTRATION FORM SUBMIT SCRIPT ENDS */








/* PROJECT DECLARATION SCRIPT */


if(isset($_POST['subpf'])){
	
	require_once("dbconnect.php");
	
	$title = mysqli_real_escape_string($dbc, $_POST['title']);
	$descr = mysqli_real_escape_string($dbc, $_POST['descr']);
	$link = mysqli_real_escape_string($dbc, $_POST['link']);
	
	$N = 12;
	$SKILLSET = "";
	
	$PID = time().rand(0,9999).rand(0,9999);
	
	
		for($I = 1;$I<=$N;$I++){
			$INDEX = "c".$I;
			if(isset($_POST[$INDEX]))
			$SKILLSET = $SKILLSET." ".$_POST[$INDEX];


		}
	session_start();
	$eid = $_SESSION['eid'];
	
	$q = "INSERT INTO project VALUES ('$PID', '$eid', '$title', '$descr', '$link', '$SKILLSET')";
	
	$result = mysqli_query($dbc, $q);
	
	require_once("phpscripts.php");
	
    $arrSearch = explode(' ', $SKILLSET);
    $query="SELECT * FROM users WHERE skillset LIKE '%$arrSearch[0]%' ".getKeywordsAsSql($arrSearch);
	$result2 = mysqli_query($dbc,  $query);
	while($data = mysqli_fetch_array($result2)){
		$id = $data['eid'];
		if($id == $eid){
			continue;
		}
		
		$sq = "INSERT INTO notification VALUES ('$PID', '$id', '0','".time()."')";
		$result = mysqli_query($dbc, $sq);
	}
	
	
	if($result){
		
		echo "<html><head>";
				echo "</head><body>";
				require_once("header.php");
				
				echo "
				<div class='miniwrapper'>
				<h2>The Project was declared.</h2>
				<p>The people matching the skill set required for your project will be notified.</p>
				
				<a href='home.php' class='menu'>Go to HomePage</a>
				
				</div>
				
				";
				
				require_once("footer.php");
		
		
		
	} else {
		/* COULDNT CONNECT */
		
	}
	
	
	
	
	
}





/* PROJECT DECLARATION SCRIPT ENDS */





?>