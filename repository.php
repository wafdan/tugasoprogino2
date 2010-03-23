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
require_once("includes/repository.php");
ShowRepository();
?>



<br>
<h1>Upload File!</h1>
<form enctype="multipart/form-data" method="POST" action="repositoryhandler.php">
File yang diupload : <input type="file" name="fupload"><br>
Deskripsi : <br>
<textarea name="deskripsi" rows="8" cols="40"></textarea><br>
<select name="status">
	<option value="PUBLIC">PUBLIC</option>
	<option value="FOLLOWER">FOLLOWER</option>
	<option value="PRIVATE">PRIVATE</option>
</select><br>
<input type="submit" name="uploadfileuser" value="upload">
</form>
</body>
</html>