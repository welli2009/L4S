<?php



session_start();
if(session_destroy()){
	

	
	if(! headers_sent() ){
		header("location: index.php");
		}else{
			echo '<script type="text\javascript">
			window.location.href="index.php";</script>';
		}
}
session_destroy()
?>