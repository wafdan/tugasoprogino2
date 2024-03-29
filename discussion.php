<?php

require_once('includes/session.php');
require_once("discussionhandler.php");

if(!($cinstid = $_GET['courseinstanceid'])) {
    header('Location: index.php');
}

function showTopicList($cinstid) {
    $data = discussionGetTopic($cinstid, 0, 10);

    //print_r($data);

    echo '<table>';
    foreach($data as $topic) {
        echo '<tr>';
        echo '<td><a href="discussion.php?courseinstanceid='.$cinstid.'&viewtopic='.$topic['id'].'">'.$topic['title'].'</td>';
        echo '<td><a href="profile.php?id='.$topic['userid'].'">'.$topic['username'].'</a></td>';
        echo '<td>'.$topic['time'].'</td>';
        echo '</tr>';
    }
    echo '</table>';
}

function showTopicDetail($topicid) {
    $data = discussionGetTopicDetail($topicid, 0, 10);

    //print_r($data);

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
    }
}

?>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		
		<title>Discussion</title>
		
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
		
        <link id="unique-style" rel="stylesheet" type="text/css" href="css/styleprofile1.css" />
        <link id="unique-style" rel="stylesheet" type="text/css" href="css/style1.css" />
		
		<script type="text/javascript" src="script/discussion.js"></script>
    </head>

    <body>
        <div id="header">
            <div id="logo">
                <h1>KulOn&trade;</h1>
                <h2><b>Kuliah Online</b></h2>
            </div>
            <div id="menu">
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li class="first">
                        <a href="profile.php">Profile</a>
                    </li>
                    <li>
                        <a href="repository.php">Repository</a>
                    </li>
                    <li>
                        <a href="courses.php">Kuliah</a>
                    </li>
                    <li>
                        <a href="courserepository.php?coursesid=<?php echo $cinstid; ?>">Repository Kuliah</a>
                    </li>
                    <li>
                        <a href="discussion.php?courseinstanceid=<?php echo $cinstid; ?>">Forum Diskusi Kuliah</a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
              </ul>
          </div>
        </div>
        <div id="container">
			<?php
			if($_GET['viewtopic']) {
				echo '<span id="prevPage" style="cursor: pointer" onclick="gotoTopicPostPage('.$_GET['viewtopic'].', 0)">&lt;&lt; Prev || </span>';
				echo '<span id="page">1</span>';
				echo '<span id="nextPage" style="cursor: pointer" onclick="gotoTopicPostPage('.$_GET['viewtopic'].', 2)"> || Next &gt;&gt;</span>';
				echo '<div id="topicDetail">';
				showTopicDetail($_GET['viewtopic']);
				echo '</div>';
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
				echo '<span id="prevPage" style="cursor: pointer" onclick="gotoTopicListPage('.$cinstid.', 0)">&lt;&lt; Prev || </span>';
				echo '<span id="page">1</span>';
				echo '<span id="nextPage" style="cursor: pointer" onclick="gotoTopicListPage('.$cinstid.', 2)"> || Next &gt;&gt;</span>';
				echo '<div id="topicList">';
				showTopicList($cinstid); 
				echo '</div>';
				?>

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
        <div id="footer">
            <p class="legal"><i>Copyright</i> &copy; 2010 KulOn&trade;. <i>All rights reserved</i>. </p>
        </div>
    </body>
</html>