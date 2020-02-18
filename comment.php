<?php
	session_start();
	$commentor = $_SESSION["farmer"];
	require("connections.php");
	require("func.php");

	$comObject = new threadDisplay();
	$comObject->setDB($serverName,$serverDatabase,$serverUsername,$serverPassword);
	$comObject->getDB();

	
	    

	if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['send']))
	{	
	
		if(isset($_POST['comment']) ) 
		{
			$time = date('d M Y H:i:s');
			$comm = strip_tags($_POST['comment']);
			$comm_thread = $_POST['thrD'];

			$comObject->storeComment($commentor,$time,$comm,$comm_thread);



		 header('location:forum2.php');

		}
		else
		{
		}

	}

?>
