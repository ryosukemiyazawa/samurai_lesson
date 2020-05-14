<h1>GET Form</h1>

<form method="get">
	Text1=<input type="text" name="text1" value="" />
	<input type="submit" value="submit" />
</form>

<?php
if($_GET){
	echo "<p>GET DATA</p>";
	echo "<pre>";
	var_dump($_GET);
	echo "</pre>";
}
?>

<h1>POST Form</h1>

<form method="post">
	Text1=<input type="text" name="text1" value="" />
	<input type="submit" value="submit" />
</form>

<?php
if($_POST){
	echo "<p>POST DATA</p>";
	echo "<pre>";
	var_dump($_POST);
	echo "</pre>";
}
?>