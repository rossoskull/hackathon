<?php




function getKeywordsAsSql($array){
    $noOfKeywords = count($array);
    $addquery = "";
    for($i=1;$i<$noOfKeywords;$i++){
        $key = $array[$i];
        $addquery = $addquery."OR skillset LIKE '%$key%' ";
        
    }
    
    return $addquery;

}


function getNoSuggestions(){
	$eid = $_SESSION['eid'];
	require("dbconnect.php");
	$q = "SELECT * FROM notification WHERE eid = '$eid' AND seen='0'";
	
	require_once("dbconnect.php");
	
	$r = mysqli_query($dbc, $q);
	
	if($r){
		return mysqli_affected_rows($dbc);
	}
	
	
}

function getNoResponses(){
	require("dbconnect.php");
	$eid = $_SESSION['eid'];
	$q = "SELECT * FROM response WHERE creatorid = '$eid' AND seen='0'";
	require("dbconnect.php");
	
	$r = mysqli_query($dbc, $q);
	
	if($r){
		return mysqli_affected_rows($dbc);
	}
}



?>