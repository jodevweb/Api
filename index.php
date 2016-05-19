<?php
/**
 * User: Jordan Usoulet
 * Date: 18/05/2016
 * Time: 20:03
 */
include_once('config.php');
include_once('apiController.php');

$api = new \API\api($parameters);

$getTable = (!empty($_GET['filtre'])) ? $_GET['filtre'] : false;
$getOrder = (!empty($_GET['order'])) ? $_GET['order'] : false;
$getLimit = (!empty($_GET['limit'])) ? $_GET['limit'] : false;
?>

<?php if (!$_GET): ?>

    <ul>
        <?php foreach ($api->showTables() as $allTables): ?>
            <li><a href="view/<?php echo $allTables; ?>"><?php echo $allTables; ?></a></li>
        <?php endforeach; ?>
    </ul>

<?php else: ?>

    <?php
    echo $api->showJson([
        'table' => $getTable,
        'order' => $getOrder,
        'limit' => $getLimit,
    ]);
    ?>

<?php endif; ?>
