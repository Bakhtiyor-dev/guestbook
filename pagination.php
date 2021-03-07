<?php
	include('db.php');

	$offset=$_GET['offset'];
	$limit=$_GET['limit'];
	
	$sqlForCount="SELECT COUNT(id) FROM records";
	$count=$conn->query($sqlForCount)->fetch_array(MYSQLI_ASSOC)['COUNT(id)'];
	
	$sql="SELECT * FROM records LIMIT $offset,$limit";
	$result=$conn->query($sql);
	
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
        $myArray[] = $row;
    }
 
    
    echo json_encode([
    	'data'=>json_encode($myArray),
    	'count'=>$count
    ]);
	
	
