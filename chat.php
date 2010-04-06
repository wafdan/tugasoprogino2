<?php

if(!$_COOKIE['myUserID']) {
	setCookie('myUserID', mt_rand(1, 9999));
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
		<title>Chat</title>
		<link rel="stylesheet" type="text/css" href="css/chat.css" media="screen" title="default" />
		<script type="text/javascript" src="chat2/chat.js"></script>
	</head>
	
	<body onload="startPoll()">
		<div id="chatContainer">
			<div id="myID">
			</div>
			<div id="contactBar" onclick="toggleElement('contactBox')">
				<div id="chatStatus">
				</div>
				<div id="contactBox" style="display: none">
					<ul id="contactList">
						<li></li>
					</ul>
				</div>
			</div>
			<div id="chatBoxes">
			</div>
		</div>
		<div id="info">
<pre>
TODO: Bikin seperti omegle

Tested browser:
Mozilla Firefox 3.5.8		O
Mozilla Firefox 3.6.3		O
Internet Explorer 8		O

ket: O - jalan, X - error

Kritik dan saran pengembangan layangkan ke jiwandono[at]arc.itb.ac.id
</pre>
		</div>
	</body>
</html>
