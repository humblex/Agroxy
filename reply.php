<?php
	session_start();
	$commentor = $_SESSION["farmer"];
	require("connections.php");
	require("func.php");

	$comObject = new threadDisplay();
	$comObject->setDB($serverName,$serverDatabase,$serverUsername,$serverPassword);
	$comObject->getDB();



	if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['replySend']))
	{	
	
		if(isset($_POST['reply']) ) 
		{
			$replytime = date('d M Y H:i:s');
			$rep_body = strip_tags($_POST['reply']);
			$reply_comm = $_POST['replied'];

			$comObject->storeReply($reply_comm,$replytime,$rep_body,$commentor);

		echo "Reply sent successfully!";
		 header("Refresh: 3; url=forum2.php");

		}
		else
		{
		}

	}

?>
