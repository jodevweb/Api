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
            'titre',
            'contenu',
            'user_id'
        ]
    ],
    'ApiKey' => [
        'GET' => true,
        'POST' => false,
        'PUT' => false,
        'DELETE' => true,
    ]
];
```

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

## GET


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

#### http://localhost/api/view/articles/order/desc

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

#### http://localhost/api/view/articles/limit/4

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


#### http://localhost/api/view/articles/parameters/id,titre,user_id

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

## ApiKey

### Generate a ApiKey

```
http://localhost/api/generateKey/
```

### Use a ApiKey

```
http://localhost/api/view/articles/apikey/d8ac17509ccf43188b7fdfed9c1b283a
```

### Error returned

```
    {
    "error": "ApiKey not found"
}
```

## Order of the parameters of the url

1. order
2. limit
3. parameters
4. order/limit
5. order/limit/parameters
6. limit/parameters

## POST

### URL : http://localhost/api/add

**Configuration :**

```
$fields = array(
    'params' => array(
        'apikey' => 'd8ac17509ccf43188b7fdfed9c1b283a',
        'table' => 'articles',
        'params' => array(
            'titre'     => 'MyTitle',
            'contenu'   => 'MyConte<strong>nu</strong>...',
            'user_id'   => '2',
        ),
    )
);
```