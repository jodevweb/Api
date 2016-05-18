<?php
/**
 * User: Jordan Usoulet
 * Date: 18/05/2016
 * Time: 20:03
 */
include_once('config.php');
include_once('apiController.php');

$api = new \API\api($parameters);
?>

<?php if (!$_GET): ?>

    <ul>
        <?php foreach ($api->showTables() as $allTables): ?>
            <li><a href="?filtre=<?php echo $allTables; ?>"><?php echo $allTables; ?></a></li>
        <?php endforeach; ?>
    </ul>

<?php else: ?>

    <?php echo $api->showJson([
        'table' => $_GET['filtre'],
        'order' => 'DESC',
        'limit' => '4',
    ]);
    ?>

<?php endif; ?>
