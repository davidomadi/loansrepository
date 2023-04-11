<?php

function databaseInsertShort($tbl, $dataArray ){
	if(isset($dataArray["id"])){
		return  databaseUpdateShort($tbl, $dataArray );
	} else {
		$qryx = "";
		$qry = "INSERT INTO ".$tbl." SET ";
		foreach (array_keys($dataArray) as $field)	{
			if(trim($dataArray[$field])!=""){
				$qryx .= "
				`".$field."`"."='".dbData(trim($dataArray[$field]))."', ";
			}	
		}
		$qry .= rtrim($qryx, ", ");
		return  $qry;
	}	
}

function databaseInsertMultiple($tbl, $dataArray, $fxt=0){ //$tbl=Table to insert, $dataArray=Data to insert, $fxt=Foreign key name and value
	
	if(count($dataArray)>0){
	
		$allkeys = array();
		$keys = array();
		$editArray = array();
		$qryx = "";
		$qry = "INSERT INTO `".$tbl."` ";
		foreach (array_keys($dataArray) as $field){
			array_push($allkeys,$field);
			if($field<>"id") array_push($keys,$field);
		}
		$qry .= " ( ";
		$k=0;
		foreach($keys as $keyy){
			if($k!=0){ $qry .= " ,"; }
			$qry .= "`".$keyy."` ";
			$k++;
		} 
		if(is_array($fxt)){ $qry .= ", `".key($fxt)."` "; }
		$qry .= " ) VALUES ";
		$rows = count($dataArray[$keys[0]]);
		for($i=0;$i<$rows;$i++){
			if(isset($dataArray["id"][$i])){
				$tempArray = array();
				foreach($allkeys as $ky){
					$tempArray[$ky]=$dataArray[$ky][$i];	
				}
				array_push($editArray,$tempArray);
			} else {
				$qryy ="";
				$qryx .= "
				( ";
				foreach($keys as $key){
					$qryy .="'".dbData(trim($dataArray[$key][$i]))."', ";	
				}	
				if(is_array($fxt)){ $qryy .="'".dbData(trim($fxt[key($fxt)]))."' "; }		
				$qryx .= rtrim($qryy, ", ");
				$qryx .= "), ";	
			}
		}
		$qry .= rtrim($qryx, ", ");
		if(count($editArray)>0){
			$qry_ex = array();
			array_push($qry_ex,$qry);
			foreach($editArray as $edt){
				array_push($qry_ex,databaseUpdateShort($tbl, $edt));
			}
		} else {
			$qry_ex=$qry;
		}
		return  $qry_ex;	
	}
}

function databaseUpdateShort($tbl, $dataArray ){
	$item = "id";
	$qry = "";
	$itemId = $dataArray['id'];
	unset($dataArray['id']);
	if(count($dataArray)>0){
		$qryx = "";
		$qry = "UPDATE ".$tbl." SET ";
		foreach (array_keys($dataArray) as $field){
			if(trim($dataArray[$field])!=""){
				$qryx .= "
				`".$field."`"."='".dbData(trim($dataArray[$field]))."', ";
			}
		}	
		$qry .= rtrim($qryx, ", ");
		$qry .= " WHERE "."`".$item."`"."='".$itemId."'";
	}
	return $qry;	
}

function databaseInsert($tbl, $dataArray ){
	
	require("cnx.php");
	
	$qryx = "";
	$qry = "INSERT INTO ".$tbl." SET ";
	
	foreach (array_keys($dataArray) as $field)
	{
		if(trim($dataArray[$field])!=""){
			$qryx .= "`".$field."`"."='".$conn->real_escape_string(trim($dataArray[$field]))."', ";
		}	
	}
	$qry .= rtrim($qryx, ", ");
	$conn->close();
	return  $qry;
		
}

function databaseInsertWithDates($tbl, $dataArray, $dateArray ){
	require("cnx.php");
	
	foreach ($dateArray as $dt)
	{
		$dataArray[$dt] = date("Y-m-d", strtotime($dataArray[$dt]));
	}
	$qryx = "";
	$qry = "INSERT INTO ".$tbl." SET ";
	
	foreach (array_keys($dataArray) as $field)
	{
		if(trim($dataArray[$field])!=""){
			$qryx .= "`".$field."`"."='".$conn->real_escape_string(trim($dataArray[$field]))."', ";
		}
	}
	
	$qry .= rtrim($qryx, ", ");
	$conn->close();
	return  $qry;
		
}

function databaseInsertExtras($tbl, $dataArray, $extrasArray ){
	require("cnx.php");
	foreach ($extrasArray as $key=>$val)	{	
		$dataArray[$key] = $val;		
	}
	$qryx = "";
	$qry = "INSERT INTO ".$tbl." SET ";
	foreach (array_keys($dataArray) as $field)
	{
		if(trim($dataArray[$field])!=""){
			if(trim($dataArray[$field])!=""){
				$qryx .= "`".$field."`"."='".$conn->real_escape_string(trim($dataArray[$field]))."', ";
			}
		}
	}
	$qry .= rtrim($qryx, ", ");
	$conn->close();
	return  $qry;
}

function databaseUpdate($tbl, $dataArray, $item, $itemId ){
	
	require("cnx.php");
	
	$qryx = "";
	$qry = "UPDATE ".$tbl." SET ";
	foreach (array_keys($dataArray) as $field){
		if(trim($dataArray[$field])!=""){
			$qryx .= "`".$field."`"."='".$conn->real_escape_string(trim($dataArray[$field]))."', ";
		}
	}
	$qry .= rtrim($qryx, ", ");
	$qry .= " WHERE "."`".$item."`"."='".$itemId."'";
	$conn->close();
	return $qry;	
}

function databaseUpdateWithExtras($tbl, $dataArray, $item, $itemId, $extrasArray ){
	require("cnx.php");
	foreach ($extrasArray as $key=>$val	)	{	
		$dataArray[$key] = $val;		
	}
	$qryx = "";
	$qry = "UPDATE ".$tbl." SET ";
	foreach (array_keys($dataArray) as $field){
		if(trim($dataArray[$field])!=""){
			$qryx .= "`".$field."`"."='".$conn->real_escape_string(trim($dataArray[$field]))."', ";
		}
	}
	
	$qry .= rtrim($qryx, ", ");
	
	$qry .= " WHERE "."`".$item."`"."='".$itemId."'";
	$conn->close();
	 
	return $qry;	
	
}

function uploadFile($file, $dir, $accepted_file_types){
	if(!is_dir($dir)){  
		mkdir($dir, 0755, true);
	}
    
	$ext = strtolower(substr(strrchr(basename($file['name']),'.'),1));
	$orig_name = basename($file['name'],".".$ext);
	$file_name = $file['name'];	
	
	if(in_array($ext, $accepted_file_types)){ 
		
		$attfile = $dir."/".str_replace("'","",$file_name);
		
		$ii = 2;
		while(file_exists($attfile)){           
			$attfile = $dir."/".$orig_name."(".$ii.").".$ext;
			$ii++;
		}		
		if(move_uploaded_file($file['tmp_name'], $attfile)) {
			return array(true,$attfile);
		} else {
			return array(false,"move_uploaded_file failed");
		}	
	} else { 
		return array(false,"Invalid file type. Not in (".implode(",",$accepted_file_types).")"); 
	} 

}


?>