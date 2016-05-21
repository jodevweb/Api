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
    private $champsExist = [];
    private $paramsFinal = [];
    private $key;

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
            if (in_array($allTables[0], $this->restriction['tables'])) {
                $this->tables = array_merge($allTables, $this->tables);
            }
        }

        unset($this->tables['Tables_in_' . $this->database]);
        return $this->tables;
    }

    public function generateKey($len = 16)
    {
        $data = openssl_random_pseudo_bytes($len);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        $this->key = vsprintf('%s%s%s%s%s%s%s%s', str_split(bin2hex($data), 4));

        $query = $this->connect()->prepare('SHOW TABLES');
        $query->execute();

        foreach ($query->fetchAll() as $allTables) {
            if ($allTables['Tables_in_' . $this->database] == "apikey") {
                $addKey = $this->connect()->prepare('INSERT INTO apikey (value) VALUES(:key)');
                $addKey->execute([':key' => $this->key]);
                return $this->key;
            } else {
                $addTableKey = $this->connect()->prepare('CREATE TABLE apikey (id INT(11) AUTO_INCREMENT PRIMARY KEY, value VARCHAR(30) NOT NULL)');
                $addTableKey->execute();

                $addKey = $this->connect()->prepare('INSERT INTO apikey (value) VALUES(:key)');
                $addKey->execute([':key' => $this->key]);
                return $this->key;
            }
        }
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

        if (in_array($params['table'], $this->showTables()) && in_array($params['table'], $this->restriction['tables'])) {

            $describe = $this->connect()->prepare('DESCRIBE ' . $params['table']);
            $describe->execute();

            if ($params['param']):
                $params['param'] = explode(',', $params['param']);

                foreach ($describe->fetchAll() as $key => $parametres) {
                    if (!in_array($parametres[0], $this->restriction['parameters'])) {
                        $this->champsExist = array_merge($this->champsExist, [$parametres[0]]);
                    }
                }

                foreach ($params['param'] as $paramsExist) {
                    if (in_array($paramsExist, $this->champsExist)) {
                        $this->paramsFinal = array_merge($this->paramsFinal, [$paramsExist]);
                    }
                }

                if (!$this->paramsFinal):
                    $params['param'] = '*';
                endif;

            else:
                $params['param'] = '*';
            endif;

            if ($params['param'] != '*') {
                $params['param'] = implode(',', $this->paramsFinal);
                $query = $this->connect()->prepare('SELECT ' . $params['param'] . ' FROM ' . $params['table'] . $params['order'] . $params['limit']);
                $query->execute();
            } elseif ($params['param'] == '*') {
                $query = $this->connect()->prepare('SELECT * FROM ' . $params['table'] . $params['order'] . $params['limit']);
                $query->execute();
            } else {
                header('Content-Type: application/json');
                return json_encode(['error' => 'true'], JSON_PRETTY_PRINT);
            }

            header('Content-Type: application/json');
            return json_encode($query->fetchAll(\PDO::FETCH_ASSOC), JSON_PRETTY_PRINT);
        } else {
            header('Content-Type: application/json');
            return json_encode(['error' => 'true'], JSON_PRETTY_PRINT);
        }
    }
}