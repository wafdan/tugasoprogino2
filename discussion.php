<?php

require_once('includes/session.php');
require_once("discussionhandler.php");

if(!($cinstid = $_GET['courseinstanceid'])) {
	header('Location: index.php');
}

function showTopicList($cinstid) {
	$data = discussionGetTopic($cinstid);
	
	//print_r($data);
	
	echo '<div>';
	echo '<table>';
	foreach($data as $topic) {
		echo '<tr>';
		echo '<td><a href="discussion.php?courseinstanceid='.$cinstid.'&viewtopic='.$topic['id'].'">'.$topic['title'].'</td>';
		echo '<td><a href="profile.php?id='.$topic['userid'].'">'.$topic['username'].'</a></td>';
		echo '<td>'.$topic['time'].'</td>';
		echo '</tr>';
	}
	echo '</table>';
	echo '</div>';
}

function showTopicDetail($topicid) {
	$data = discussionGetTopicDetail($topicid);
	
	//print_r($data);
	
	echo '<div>';
	
	if($data['post']) {
		echo '<table>';
		foreach($data['post'] as $post) {
			echo '<tr>';
			echo '<td>'.$post['username'].'</td>';
			echo '<td>'.$post['content'].'</td>';
			echo '<td>'.$post['time'].'</td>';
			echo '</tr>';
		}
		echo '</table>';
		echo '</div>';
	}
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
			<?php
			if($_GET['viewtopic']) {
				showTopicDetail($_GET['viewtopic']);
				?>
				
			<div>
				<form action="discussionhandler.php" method="post">
					<input type="hidden" name="action" value="addpost" />
					<input type="hidden" name="data[addpost][cinstid]" value="<?php echo $cinstid; ?>" />
					<input type="hidden" name="data[addpost][topicid]" value="<?php echo $_GET['viewtopic']; ?>" />
					<table>
						<tr>
							<td>Post reply</td>
							<td><input type="text" name="data[addpost][content]" /></td>
						</tr>
						<tr>
							<td><input type="submit" value="Submit" /></td>
						</tr>
					</table>
				</form>
			</div>
				
				<?php
			} else {
			?>
			<div>
				<?php showTopicList($cinstid); ?>
			</div>
			
			<div>
				<form action="discussionhandler.php" method="post">
					<input type="hidden" name="action" value="addtopic" />
					<input type="hidden" name="data[addtopic][cinstid]" value="<?php echo $cinstid; ?>" />
					<table>
						<tr>
							<td>Topic title</td>
							<td><input type="text" name="data[addtopic][title]" /></td>
						</tr>
						<tr>
							<td><input type="submit" value="Submit" /></td>
						</tr>
					</table>
				</form>
			</div>
			<?php
			}
			?>
		</div>
	</body>
</html>