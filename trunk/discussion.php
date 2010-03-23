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
<?php
require_once("discussionhandler.php");
ShowTopics();
?>
<form action="discussionhandler.php" method="POST">
Create New Topic : <input type="textbox" name="newtopic">
</form>
</body>
</html>