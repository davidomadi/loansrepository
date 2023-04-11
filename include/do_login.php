<?php
session_start();
require("cnx.php");

//$dt = date("Y-m-d h:i:sa");
$dt = date("Y-m-d");

$uname = $_POST['username'];
$pwd = md5($_POST['password']);

$ip = $_SERVER['REMOTE_ADDR'];
$agent = $_SERVER['HTTP_USER_AGENT'];
 
	
	$sql = "SELECT * FROM users WHERE uname='$uname' AND pwd='$pwd'"; 
	$result = $conn->query($sql);
	if(mysqli_num_rows($result)>0){
		
	$match = "TRUE";
    
	while($row = $result->fetch_assoc()) {
	  //$name =  $row["fullname"]; 
	  $urs_id =  $row["id"]; 
	  $urs_grp =  $row["uname"]; 
	  $ac_status = $row["status"];
	 }
	
	}



if(isset($match) AND $match=="TRUE"){
	 
if($ac_status=="SUSPENDED"){ 
//echo "Your account has not been activated. Check your email for an activation link.";
$err = base64_encode("Your account has been Suspended. Contact the administrator.");		

echo '<script>window.location.href = "../login.php?loginfail&rsp='.$err.'";</script>';


}
elseif($ac_status=="NO FILES"){ 
//echo "Your account has not been activated. Check your email for an activation link.";
$err = base64_encode("You do not have any applications assigned to you for review at this time.");		
$erruname = base64_encode("$uname");
echo '<script>window.location.href = "../login.php?loginfail&rsp='.$err.'&tkn='.$erruname.'";</script>';


} else {
	//session_start();
	$_SESSION['user_id']= $urs_id;
	$_SESSION['user']=$urs_grp;
	$_SESSION['started']=1;
	echo '<script>window.location.href = "../dash.php";</script>';

}//close is "not" pending activation

} else {
$err = base64_encode("Invalid username or password");		
$erruname = base64_encode("$uname");
echo '<script>window.location.href = "../login.php?loginfail&rsp='.$err.'&tkn='.$erruname.'";</script>';

}


?>