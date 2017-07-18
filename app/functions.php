<?php 
session_start();
$_SESSION['user_id'] = 1;

$title = "My WebSite List";

$db = new PDO('mysql:dbname=id1553789_todo;host=localhost', 'id1553789_hasan', 'topSecret');

//Handle this in some other way
if(!isset($_SESSION['user_id']))
{
  die("You are not signed in.");
}
?>