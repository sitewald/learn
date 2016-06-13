<?php
session_start();

if(isset($_SESSION["first"]) and isset($_SESSION["last"]))
{
	echo $_SESSION["first"], " ", $_SESSION["last"];
}
?>