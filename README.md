# Api

Create an API very easily

# Install

```
git clone https://github.com/jodevweb/Api.git
```

# Usage

### File: config.php

```
$parameters = [
    'host' => 'localhost',
    'database' => 'project1',
    'user' => 'root',
    'password' => '',
    'restriction' => [
        'articles',
        'images',
    ]
];
```

## View

### Url : http://localhost/api/


#### http://localhost/api/?filtre=articles

```
[{"id":"1","0":"1","titre":"Test 1","1":"Test 1","contenu":"Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n","2":"Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n","user_id":"1","3":"1"}]
```

## Parameters

```
    <?php echo $api->showJson([
        'table' => $_GET['filtre'],
        'order' => 'DESC',
        'limit' => '4',
    ]);
    ?>
```