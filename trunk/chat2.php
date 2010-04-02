<?php

if(!$_COOKIE['myUserID']) {
	setCookie('myUserID', mt_rand(1, 9999));
}

?>

<html>
	<head>
		<link id="unique-style" rel="stylesheet" type="text/css" href="css/chat.css" />
		<script type="text/javascript" src="chat2/chat.js"></script>
	</head>
	
	<body onLoad="startPoll()">
		<div id="chatContainer">
			<div id="contactBar" onClick="toggleElement('contactBox')">
				<div id="chatStatus">
				</div>
				<div id="contactBox" style="display: none">
					<ul id="contactList">
					</ul>
				</div>
			</div>
			<div id="chatBoxes">
			</div>
		</div>
	</body>
</html>