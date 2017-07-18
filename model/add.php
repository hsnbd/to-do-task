<?php 
require '../app/functions.php';

if(filter_input(INPUT_POST, 'name'))
{
	$name = trim($_POST['name']);

	if(!empty($name))
	{
		$addedQuery = $db->prepare("
				INSERT INTO item (name, user, done, created_at)
				VALUES 	(:name, :user, 0, NOW())
			");
		$addedQuery->execute([
				'name' => $name,
				'user' => $_SESSION['user_id']
			]);
	}
}

header('Location: ../index.php');
?>