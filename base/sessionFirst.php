

<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
	<input type="text" name="first" />
	<input type="text" name="last" />
	<input type="submit" />
</form>

<?php
session_start(); 

var_dump($_POST);

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST["first"])) $_SESSION["first"] = $_POST["first"];
	if(isset($_POST["last"])) $_SESSION["last"] = $_POST["last"];

	echo $_SESSION["first"], " ", $_SESSION["last"];
}

var_dump($_SESSION);
?>

<a href="http://bsv.local/sessionSecond.php" target="_blank">go</a>