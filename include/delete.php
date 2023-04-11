<?php 
	if(isset($_GET['delete'])){
	
	$table = $_GET['table'];
	$item = $_GET['item'];
	$clear = "DELETE FROM " . $table . " WHERE id='".$item."'";
		if ($conn->query($clear) === TRUE){ //if insert query successful
			$errhdg = 'Success!';
			$errmsg = 'The record has been deleted successfully';
			$divclass = "green";
			$errimg = "check";
		}else{
			$errhdg = 'Error!';
			$divclass = "red";
			$errmsg = "Error: The system was unbale to delete the record at this time. We apologise for inconveniece caused. <br><i>".$conn->error."</i>"; 	
			$errimg = "close";
		}
	} 
?>


<div class="card-alert card <?php echo $divclass; ?>">
    <div class="card-content white-text">
        <span class="card-title white-text darken-1">
            <i class="material-icons"><?php echo $errimg; ?></i> <?php echo $errhdg; ?></span>
        <p><?php echo $errmsg; ?></p>
    </div>
    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
