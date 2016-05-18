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
    <?php
    echo $api->showJson([
        'table' => $getTable,
        'order' => $getOrder,
        'limit' => $getLimit,
    ]);
    ?>
```

### http://localhost/api/?filtre=articles&order=DESC

```
[{"id":"7","0":"7","titre":"fergergergerhgrthrthrthrthrthrt","1":"fergergergerhgrthrthrthrthrthrt","contenu":" eherhegerhdjrtbtybutryjtrynbrtyiknbtyinrtubfdurd udrtuyberturdbvrd fbret","2":" eherhegerhdjrtbtybutryjtrynbrtyiknbtyinrtubfdurd udrtuyberturdbvrd fbret","user_id":"1","3":"1"},{"id":"6","0":"6","titre":"fzegze","1":"fzegze","contenu":" gzegez","2":" gzegez","user_id":"1","3":"1"},{"id":"5","0":"5","titre":"fzfzeg","1":"fzfzeg","contenu":" zgze","2":" zgze","user_id":"1","3":"1"},{"id":"4","0":"4","titre":"fefefef","1":"fefefef","contenu":" efefef","2":" efefef","user_id":"1","3":"1"},{"id":"3","0":"3","titre":"Test 3","1":"Test 3","contenu":"Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n","2":"Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n","user_id":"1","3":"1"},{"id":"2","0":"2","titre":"Test 2","1":"Test 2","contenu":"Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n","2":"Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n","user_id":"1","3":"1"},{"id":"1","0":"1","titre":"Test 1","1":"Test 1","contenu":"Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n","2":"Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n","user_id":"1","3":"1"}]
```

### http://localhost/api/?filtre=articles&limit=4

```
[{"id":"1","0":"1","titre":"Test 1","1":"Test 1","contenu":"Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n","2":"Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n","user_id":"1","3":"1"},{"id":"2","0":"2","titre":"Test 2","1":"Test 2","contenu":"Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n","2":"Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n","user_id":"1","3":"1"},{"id":"3","0":"3","titre":"Test 3","1":"Test 3","contenu":"Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n","2":"Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n","user_id":"1","3":"1"},{"id":"4","0":"4","titre":"fefefef","1":"fefefef","contenu":" efefef","2":" efefef","user_id":"1","3":"1"}]
```

### http://localhost/api/?filtre=articles&order=ASC&limit=30

```
[{"id":"1","0":"1","titre":"Test 1","1":"Test 1","contenu":"Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n","2":"Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n","user_id":"1","3":"1"},{"id":"2","0":"2","titre":"Test 2","1":"Test 2","contenu":"Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n","2":"Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n","user_id":"1","3":"1"},{"id":"3","0":"3","titre":"Test 3","1":"Test 3","contenu":"Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n","2":"Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n","user_id":"1","3":"1"},{"id":"4","0":"4","titre":"fefefef","1":"fefefef","contenu":" efefef","2":" efefef","user_id":"1","3":"1"},{"id":"5","0":"5","titre":"fzfzeg","1":"fzfzeg","contenu":" zgze","2":" zgze","user_id":"1","3":"1"},{"id":"6","0":"6","titre":"fzegze","1":"fzegze","contenu":" gzegez","2":" gzegez","user_id":"1","3":"1"},{"id":"7","0":"7","titre":"fergergergerhgrthrthrthrthrthrt","1":"fergergergerhgrthrthrthrthrthrt","contenu":" eherhegerhdjrtbtybutryjtrynbrtyiknbtyinrtubfdurd udrtuyberturdbvrd fbret","2":" eherhegerhdjrtbtybutryjtrynbrtyiknbtyinrtubfdurd udrtuyberturdbvrd fbret","user_id":"1","3":"1"}]
```