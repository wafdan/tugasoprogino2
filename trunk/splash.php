<?php



require_once('includes/session.php');

sessionInit();

if(sessionGet('splashmsg')) {
	$msg = sessionGet('splashmsg');
	$target = sessionGet('splashtarget');
	
	sessionUnset('splashmsg');
	sessionUnset('splashtarget');
	?>
	
<html>
	<head>
		<META http-equiv="refresh" content="2;URL=<?php echo $target; ?>" >
	</head>
	
	<body>
		<?php echo $msg; ?>
	</body>
</html>

	<?php
}
?>