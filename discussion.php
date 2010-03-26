<?php

require_once('includes/session.php');
require_once("discussionhandler.php");

if(!($cinstid = $_GET['courseinstanceid'])) {
	header('Location: index.php');
} else {
	$action = 'viewtopiclist';
}

function showTopicList($cinstid) {
	$data = discussionGetTopic($cinstid);
}

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
		<div>
			<div>
				<?php showTopicList($cinstid); ?>
			</div>
			
			<div>
				<form action="discussionhandler.php" method="post">
					<input type="hidden" name="action" value="addtopic" />
					<table>
						<tr>
							<td>Topic title</td>
							<td><input type="text" name="data[addtopic][title]" /></td>
						</tr>
						<tr>
							<td>Content</td>
							<td><textarea name="data[addtopic][content]"></textarea></td>
						</tr>
						<tr>
							<td><input type="submit" value="Submit" /></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</body>
</html>