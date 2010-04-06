<?php

if($_POST) {
	setCookie('myUserID', $_POST['username']);
	header('Location: chat.php');
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
		<meta http-equiv="Content-Style-Type" content="text/css" />

		<title>Chat</title>
		<link rel="stylesheet" href="css/chat.css" type="text/css" media="screen" title="Default Theme" />
	</head>
	
	<body>
		<div id="chatContainer">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				Username:
				<input type="text" name="username" />
				<input type="submit" value="Login" />
			</form>
		</div>
	</body>
</html>
