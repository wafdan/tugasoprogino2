<?php

require_once("discussionhandler.php");

?>


<html>
    <head>
		<style type="text/css">
		table, td, th
		{
		border:1px solid green;
		}
		th
		{
		background-color:green;
		color:white;
		}
		</style>
    </head>

	<body>
		<form action="discussionhandler.php" method="post">
			<input type="hidden" name="action" value="newtopic" />
			Create New Topic :
			<input type="textbox" name="topicname" />
			<input type="submit" value="Create" />
		</form>
		<?php ShowTopics(); ?>
	</body>
</html>