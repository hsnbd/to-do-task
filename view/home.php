<?php
$date = date('Y-m-d');
$itemQuery = $db->prepare("
    SELECT id, name, done, created_at
    FROM item
    WHERE user = :user
");
$itemQuery->execute([
    'user' => $_SESSION['user_id']
]);
$item = $itemQuery->rowCount() ? $itemQuery : [];
?>

<h2 class="logo text-center">To Do List</h2>
<ul class="list-group">
<?php if(!empty($item))
    { 
        foreach($item as $item)
        { ?>
            <li class="list <?=$item['done'] ? ' done' : '' ?>">
        <?php if($item['created_at'] < $date)
                { ?>
                    <span class="old"><i class="fa fa-frown-o"></i></span>
        <?php   }

                else
                {
                    if(!$item['done'])
                    { ?>
                        <span class="new"><i class="fa fa-smile-o"></i></span>
            <?php   }
                    else
                    { ?>
                        <span><i class="fa fa-trash-o"></i></span>
            <?php   }
                }
                
                echo $item['name'];

                if(!$item['done'])
                { ?>
                    <a class="mark-done text-muted" href="model/mark_done.php?as=done&item=<?=$item['id']?>">Mark as done</a>
        <?php   } ?>
            </li>

    <?php }
    }else{ ?>
        <p>You haven't added any items yet</p>
<?php   } ?>
    <form class="form" action="model/add.php" method="post">
        <li class='list'>
            <input class="input" type="text" name="name" placeholder="new to-do">
        </li>
        <li class='list'>
            <input class="input" type="submit" name="submit" value="ADD To-Do">
        </li>
    </form>
</ul>



<?php 

$autoDelete = $db->prepare("
    DELETE
    FROM item
    WHERE created_at < CURRENT_DATE()
    AND done = 1
");
$autoDelete->execute();
?>