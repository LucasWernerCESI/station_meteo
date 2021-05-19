<?php
	//reprise de la session
	session_start();
	//ecrasement de la session
	session_destroy();
	//redirection vers la page login.php
	header("location:login.php");
?>