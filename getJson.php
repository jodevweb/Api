<?php
/*// GET
$json = file_get_contents('http://localhost/api/Api/view/articles/apikey/d8ac17509ccf43188b7fdfed9c1b283a');

$response = json_decode($json, true);

if (empty($response->error)) {
    foreach ($response as $row) {
        echo 'Titre: ' . $row['titre'] . '<br>';
    }
} else {
    echo 'erreur';
}*/

// POST
$url = 'http://localhost/api/Api/add';
$fields = array(
    'params' => array(
        'apikey' => 'd8ac17509ccf43188b7fdfed9c1b283a',
        'table' => 'articles',
        'params' => array(
            'titre'     => 'CoucouByJson\'',
            'contenu'   => 'Et oui tout ceci via l\'api',
            'user_id'   => '2',
        ),
    )
);

//url-ify the data for the POST
$fields_string = http_build_query($fields);

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);