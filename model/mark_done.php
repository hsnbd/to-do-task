<?php 
require '../app/functions.php';

if(isset($_GET['as'], $_GET['item']))
{
	$as = $_GET['as'];
	$item = $_GET['item'];

	if($as = 'done')
	{
		$doneQuery = $db->prepare("
				UPDATE item
				SET done = 1
				WHERE id = :item
				AND user = :user
			");
		$doneQuery->execute([
				'item' => $item,
				'user' => $_SESSION['user_id']
			]);
	}
}

header('Location: ../index.php');
?>