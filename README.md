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
        'profile',
    ]
];
```

## View

#### Error returned
```
{
    "error": "true"
}
```

### Url : http://localhost/api/

```
+ profile
+ articles
```

#### http://localhost/api/view/articles

```
    [
    {
        "id": "1",
        "titre": "Test 1",
        "contenu": "Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n",
        "user_id": "1"
    },
]
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

### http://localhost/api/view/articles/order/desc

```
    [
    {
        "id": "7",
        "titre": "fergergergerhgrthrthrthrthrthrt",
        "contenu": "    eherhegerhdjrtbtybutryjtrynbrtyiknbtyinrtubfdurd udrtuyberturdbvrd fbret",
        "user_id": "1"
    },
]
```

### http://localhost/api/view/articles/limit/4

```
    [
    {
        "id": "1",
        "titre": "Test 1",
        "contenu": "Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n",
        "user_id": "1"
    },
    {
        "id": "2",
        "titre": "Test 2",
        "contenu": "Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n",
        "user_id": "1"
    },
    {
        "id": "3",
        "titre": "Test 3",
        "contenu": "Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n",
        "user_id": "1"
    },
    {
        "id": "4",
        "titre": "fefefef",
        "contenu": "    efefef",
        "user_id": "1"
    }
]
```

### http://localhost/api/view/articles/order/asc/limit/7

```

    [
    {
        "id": "1",
        "titre": "Test 1",
        "contenu": "Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n",
        "user_id": "1"
    },
    {
        "id": "2",
        "titre": "Test 2",
        "contenu": "Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n",
        "user_id": "1"
    },
    {
        "id": "3",
        "titre": "Test 3",
        "contenu": "Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n\r\nView details \u00bb\r\n",
        "user_id": "1"
    },
    {
        "id": "4",
        "titre": "fefefef",
        "contenu": "    efefef",
        "user_id": "1"
    },
    {
        "id": "5",
        "titre": "fzfzeg",
        "contenu": "    zgze",
        "user_id": "1"
    },
    {
        "id": "6",
        "titre": "fzegze",
        "contenu": "    gzegez",
        "user_id": "1"
    },
    {
        "id": "7",
        "titre": "fergergergerhgrthrthrthrthrthrt",
        "contenu": "    eherhegerhdjrtbtybutryjtrynbrtyiknbtyinrtubfdurd udrtuyberturdbvrd fbret",
        "user_id": "1"
    }
]
```

### http://localhost/api/view/articles/parameters/id,titre

```
    [
    {
        "id": "1",
        "titre": "Test 1"
    },
    {
        "id": "2",
        "titre": "Test 2"
    },
    {
        "id": "3",
        "titre": "Test 3"
    }
]
```

## Order of the parameters of the url

+ order
+ limit
+ parameters
+ order/limit
+ order/limit/parameters
+ limit/parameters