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
$getParam = (!empty($_GET['param'])) ? $_GET['param'] : false;
$postParams = (!empty($_POST['params'])) ? $_POST['params'] : false;
?>

<?php if (!$_GET AND empty($_GET['generateKey']) AND !$_POST): ?>

    <ul>
        <?php foreach ($api->tablesRestriction() as $allTables): ?>
            <li><a href="view/<?php echo $allTables; ?>"><?php echo $allTables; ?></a></li>
        <?php endforeach; ?>
    </ul>

    <a href="generateKey/">Generate Key</a>
<?php elseif (!empty($_GET['generateKey'])): ?>

    <?php echo $api->generateKey(); ?>

<?php else: ?>
    <?php
    echo $api->showJson([
        'table' => $getTable,
        'order' => $getOrder,
        'limit' => $getLimit,
        'param' => $getParam,
        'postParams' => $postParams,
    ]);
    ?>

<?php endif; ?>
