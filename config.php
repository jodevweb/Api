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
 * @restriction: @array: liste des tables que vous souhaitez rendre acc�ssible
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