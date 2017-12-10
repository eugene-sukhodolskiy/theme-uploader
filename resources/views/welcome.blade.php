<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <ul>

        <?php foreach ($tasks as $task): ?>
         <li><?= $task->id; ?> </li>
         <li><?= $task->meta_name; ?></li>
         <li><?=$task->meta_value; ?></li>
         <br>
        <?php endforeach; ?>
    </ul>
</body>
</html>