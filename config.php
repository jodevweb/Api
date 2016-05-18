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
 * @restriction: @array: liste des tables que vous souhaitez rendre accéssible
 */

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