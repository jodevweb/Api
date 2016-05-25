<?php
// GET
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost/api/Api/view/articles/apikey/d8ac17509ccf43188b7fdfed9c1b283a");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
$response = json_decode($output, true);
if (empty($response->error)) {
    foreach ($response as $row) {
        echo 'Titre: ' . $row['titre'] . '<br>';
    }
} else {
    echo 'erreur';
}
curl_close($ch);



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

$fields_string = http_build_query($fields);
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
$output = curl_exec($ch);
curl_close($ch);

// PUT
$url = 'http://localhost/api/Api/update';
$fields = array(
    'params' => array(
        'apikey' => 'd8ac17509ccf43188b7fdfed9c1b283a',
        'table' => 'articles',
        'params' => array(
            'titre'     => 'CoucouByJson\'',
            'contenu'   => 'Et oui tout ceci via l\'api',
            'user_id'   => '2',
        ),
        'id' => '3',
    )
);

$fields_string = http_build_query($fields);
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
$output = curl_exec($ch);
curl_close($ch);