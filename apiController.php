<?php
/**
 * User: Jordan Usoulet
 * Date: 18/05/2016
 * Time: 20:03
 */

namespace API;

class api
{
    private $database;
    private $user;
    private $pwd;
    private $host;
    private $connect;
    private $tables = [];
    private $restriction = [];

    public function __construct($params)
    {
        $this->database = $params['database'];
        $this->user = $params['user'];
        $this->pwd = $params['password'];
        $this->host = $params['host'];

        $this->restriction = $params['restriction'];
    }

    public function connect()
    {
        $this->connect = new \PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->user, $this->pwd, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8, lc_time_names = 'fr_FR'"));
        return $this->connect;
    }

    public function showTables()
    {
        $query = $this->connect()->prepare('SHOW TABLES');
        $query->execute();

        foreach ($query->fetchAll() as $allTables) {
            if (in_array($allTables[0], $this->restriction)) {
                $this->tables = array_merge($allTables, $this->tables);
            }
        }

        unset($this->tables['Tables_in_project1']);

        return $this->tables;
    }


    public function showJson($params)
    {
        if ($params['limit'] && intval($params['limit'])):
            $params['limit'] = ' LIMIT ' . intval($params['limit']);
        else:
            $params['limit'] = false;
        endif;

        if ($params['order'] && $params['order'] == "DESC" OR $params['order'] == "ASC"):
            $params['order'] = ' ORDER BY ' . $params['table'] . '.id ' . $params['order'];
        else:
            $params['order'] = false;
        endif;

        if (!$params['param']):
            $params['param'] = '*';
        endif;

        if (in_array($params['table'], $this->showTables()) && in_array($params['table'], $this->restriction)) {
            $query = $this->connect()->prepare('SELECT ' . $params['param'] . ' FROM ' . $params['table'] . $params['order'] . $params['limit']);
            $query->execute();

            header('Content-Type: application/json');

            return json_encode($query->fetchAll(\PDO::FETCH_ASSOC), JSON_PRETTY_PRINT);
        } else {
            header('Content-Type: application/json');

            return json_encode(['error' => 'true'], JSON_PRETTY_PRINT);
        }
    }
}