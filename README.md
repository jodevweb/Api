# Api

Create an API very easily

# Install

```
git clone https://github.com/jodevweb/Api.git
```

# Usage

### File: config.php

 - @host: host your database
 - @database: name of your database
 - @user: username of your database
 - @password: password of your database
 - @restriction: @array: Tables [Tables list you want to view] Parameters [list of fields that you wish to view]
 - @ApiKey: @array: false to disable, true to enable request token

```
$parameters = [
    'host' => 'localhost',
    'database' => 'project1',
    'user' => 'root',
    'password' => '',
    'restriction' => [
        'tables' => [
            'articles',
            'profile',
        ],
        'parameters' => [
            'id',
        ]
    ],
    'ApiKey' => [
        'GET' => false,
        'POST' => false,
        'PUT' => false,
        'DELETE' => true,
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


### http://localhost/api/view/articles/parameters/id,titre,user_id

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

## Generate a ApiKey
### http://localhost/api/generateKey/

## Order of the parameters of the url

+ order
+ limit
+ parameters
+ order/limit
+ order/limit/parameters
+ limit/parameters