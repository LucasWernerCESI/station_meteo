<?php
	//initialisation de la session pdo
	session_start();
	$login=$_POST["login"];
	$pass=$_POST["pass"];
	$valider=$_POST["valider"];
	$message="";
	if(isset($valider)){
		include("connexion.php");
		$res=$pdo->prepare("select * from users where login=? and pass=? limit 1");
		$res->setFetchMode(PDO::FETCH_ASSOC);
		$res->execute(array($login,md5($pass)));
		$tab=$res->fetchAll();
		if(count($tab)==0)
			$message="<li>Mauvais login ou mot de passe!</li>";
		else{
			$_SESSION["autoriser"]="oui";
			$_SESSION["Login"]=strtoupper($tab[0]["login"]);
			header("location:index.php");
		}
	}
?>
<!DOCYTPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<title>Authentification</title>
	</head>
	<body onLoad="document.fo.login.focus()">
		<header>
			Authentification
			<a href="inscription.php">S'inscrire</a>
		</header>
		<form name="fo" method="post" action="">
			<div class="label">Login</div>
			<input type="text" name="login" value="<?php echo $login?>" />
			<div class="label">Mot de passe</div>
			<input type="password" name="pass" />
			<Button type="submit" name="valider">Log In</Button>
		</form>
		<?php if(!empty($message)){ ?>
		<div id="message"><?php echo $message ?></div>
		<?php } ?>

	</body>
</html>