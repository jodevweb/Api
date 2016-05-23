<?php
/**
 * User: Jordan Usoulet
 * Date: 18/05/2016
 * Time: 20:03
 *
 * @host: host de votre base de donnée
 * @database: nom de votre base de donnée
 * @user: nom d'utilisateur de votre base de donnée
 * @password: mot de passe de votre base de donnée
 * @restriction: @array: Tables [ liste des tables que vous souhaitez rendre accéssible ] Parameters [ liste des champs que vous souhaitez rendre accéssible ]
 * @ApiKey: @array: false pour désactiver, true pour activer la demande de token
 */

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
        'POST' => true,
        'PUT' => false,
        'DELETE' => true,
    ]
];