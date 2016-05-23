<?php
/**
 * User: Jordan Usoulet
 * Date: 18/05/2016
 * Time: 20:03
 *
 * @host: host de votre base de donn�e
 * @database: nom de votre base de donn�e
 * @user: nom d'utilisateur de votre base de donn�e
 * @password: mot de passe de votre base de donn�e
 * @restriction: @array: Tables [ liste des tables que vous souhaitez rendre acc�ssible ] Parameters [ liste des champs que vous souhaitez rendre acc�ssible ]
 * @ApiKey: @array: false pour d�sactiver, true pour activer la demande de token
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