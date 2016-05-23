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
    private $action;
    private $ApiKey;
    private $valuesRequete;

    public function __construct($params)
    {
        $this->database = $params['database'];
        $this->user = $params['user'];
        $this->pwd = $params['password'];
        $this->host = $params['host'];

        $this->restriction = $params['restriction'];
        $this->ApiKey = $params['ApiKey'];

        // Assignation de l'action
        if (!empty($_GET['action'])) {

            if ($_GET['action'] == "get") {
                $this->action = "GET";
            } elseif ($_GET['action'] == "post") {
                $this->action = "POST";
            } elseif ($_GET['action'] == "put") {
                $this->action = "PUT";
            } elseif ($_GET['action'] == "delete") {
                $this->action = "DELETE";
            } else {
                $this->action = false;
            }
        } else {
            $this->action = false;
        }
    }

    public function connect()
    {
        // Connexion à la bdd
        $this->connect = new \PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->user, $this->pwd, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8, lc_time_names = 'fr_FR'"));
        return $this->connect;
    }

    public function showTables()
    {
        // Requête global pour récupérer les tables
        $query = $this->connect()->prepare('SHOW TABLES');
        $query->execute();

        return $query->fetchAll();
    }

    public function tablesRestriction()
    {
        // Restriction des tables avec une condition puis une récupération des tables acceptés
        foreach ($this->showTables() as $allTables) {
            if (in_array($allTables[0], $this->restriction['tables'])) {
                $this->tables = array_merge($allTables, $this->tables);
            }
        }
        // Supprésision de l'array inutile
        unset($this->tables['Tables_in_' . $this->database]);

        return $this->tables;
    }

    public function generateKey($len = 16)
    {
        $data = openssl_random_pseudo_bytes($len);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        // Génération de la key API
        $this->key = vsprintf('%s%s%s%s%s%s%s%s', str_split(bin2hex($data), 4));
        // Récupération des tables acceptés
        foreach ($this->showTables() as $allTables) {
            // Si la table api existe
            if ($allTables['Tables_in_' . $this->database] == "apikey") {
                // On ajoute la key API dans la table
                $addKey = $this->connect()->prepare('INSERT INTO apikey (value) VALUES(:key)');
                $addKey->execute([':key' => $this->key]);
                return $this->key;
            } else { // Sinon on créer la table
                $addTableKey = $this->connect()->prepare('CREATE TABLE apikey (id INT(11) AUTO_INCREMENT PRIMARY KEY, value VARCHAR(30) NOT NULL)');
                $addTableKey->execute();
                // Puis on insert la key API
                $addKey = $this->connect()->prepare('INSERT INTO apikey (value) VALUES(:key)');
                $addKey->execute([':key' => $this->key]);
                return $this->key;
            }
        }
    }

    public function getApiKey($key)
    {
        // Fonction global pour check la key API
        $ApiKey = $this->connect()->prepare('SELECT value FROM apikey WHERE value = :value');
        $ApiKey->execute([':value' => $key]);

        return $ApiKey->fetch();
    }

    public function verifyApiKey($method)
    {
        // On spécifie l'action d'appel pour récupérer la key API
        if ($method == "GET") $getKey = $_GET['apikey'];
        if ($method == "POST") $getKey = $_POST['params']['apikey'];
        if ($method == "PUT") $getKey = $_POST['params']['apikey'];
        if ($method == "DELETE") $getKey = $_POST['params']['apikey'];
        // Si la key API est vide on renvoie false
        if (empty($getKey) OR $this->getApiKey($getKey) === false) {
            return false;
        } else { // Sinon on renvoie true
            return true;
        }
    }

    public function describeTable($table)
    {
        // On créer une requête pour récupérer la liste des champs de la table
        $describe = $this->connect()->prepare('DESCRIBE ' . $table);
        $describe->execute();

        if ($describe) { // Si la requête ne possède pas d'erreur ou n'est pas vide
            return $describe->fetchAll(); // On retourne le résultat
        } else { // Sinon on renvoie false
            return false;
        }
    }

    public function showGet($params)
    {
        // Si dans la configuration on spécifie la demande de la key API pour l'action GET
        if ($this->ApiKey['GET'] === TRUE) {
            if ($this->verifyApiKey('GET') === false) { // Si la key API ne correspond pas
                // On renvoie une erreur
                header('Content-Type: application/json');
                return json_encode(['error' => 'ApiKey not found'], JSON_PRETTY_PRINT);
            }
        }
        // Sinon on continue

        if ($params['limit'] && intval($params['limit'])): // Si le paramètre limit est présent et est bien un intval
            $params['limit'] = ' LIMIT ' . intval($params['limit']); // On construit la requête
        else:
            $params['limit'] = false;
        endif;

        if ($params['order'] && $params['order'] == "DESC" OR $params['order'] == "ASC"): // Si le pramètre est présent et est égal à ASC OU DESC
            $params['order'] = ' ORDER BY ' . $params['table'] . '.id ' . $params['order']; // On construit la requête
        else:
            $params['order'] = false;
        endif;

        // Si la table demandé est accepté dans la configuration
        if (in_array($params['table'], $this->tablesRestriction()) && in_array($params['table'], $this->restriction['tables'])) {

            if ($params['param']): // Si il existe des paramètres
                $params['param'] = explode(',', $params['param']); // On fait un explode pour les récupérer

                foreach ($this->describeTable($params['table']) as $key => $parametres) { // On boucle les paramètres (champs)
                    if (!in_array($parametres[0], $this->restriction['parameters'])) { // Si les champs sont acceptés dans la configuration
                        $this->champsExist = array_merge($this->champsExist, [$parametres[0]]); // On créer un array des champs pour créer la requête
                    }
                }

                foreach ($params['param'] as $paramsExist) { // On boucle les champs demandé
                    if (in_array($paramsExist, $this->champsExist)) { // Si les paramètres demandé sont accepté dans la configuration
                        $this->paramsFinal = array_merge($this->paramsFinal, [$paramsExist]); // On créer un array
                    }
                }

                if (!$this->paramsFinal): // Si il n'y a aucun champs autorisé présent dans la demande on sélectionne tous les champs
                    $params['param'] = '*';
                endif;

            else:
                $params['param'] = '*';
            endif;

            if ($params['param'] != '*') { // Si le sélecteur n'est pas "*" on fait la requête en rapport avec les champs demandé.
                $params['param'] = implode(',', $this->paramsFinal);
                $query = $this->connect()->prepare('SELECT ' . $params['param'] . ' FROM ' . $params['table'] . $params['order'] . $params['limit']);
                $query->execute();
            } elseif ($params['param'] == '*') { // Sinon on créer une requête avec le sélecteur "*"
                $query = $this->connect()->prepare('SELECT * FROM ' . $params['table'] . $params['order'] . $params['limit']);
                $query->execute();
            } else { // Sinon on renvoie une erreur
                header('Content-Type: application/json');
                return json_encode(['error' => 'Parameters not found'], JSON_PRETTY_PRINT);
            }

            // On renvoie les valeurs en JSON
            header('Content-Type: application/json');
            return json_encode($query->fetchAll(\PDO::FETCH_ASSOC), JSON_PRETTY_PRINT);
        } else { // Sinon on renvoie une erreur si tout n'est pas OK
            header('Content-Type: application/json');
            return json_encode(['error' => 'true'], JSON_PRETTY_PRINT);
        }
    }

    public function showPost($params)
    {
        // Si l'action POST demande une key API
        if ($this->ApiKey['POST'] === TRUE) {
            if ($this->verifyApiKey('POST') === false) { // Si la key API n'est pas reconnue
                // On renvoie une erreur
                header('Content-Type: application/json');
                return json_encode(['error' => 'ApiKey not found'], JSON_PRETTY_PRINT);
            }
        }

        // Sinon on continue
        if (!empty($params['postParams'])) {

            if ($params['postParams']['table']) {

                foreach ($this->describeTable($params['postParams']['table']) as $key => $parametres) {
                    if (in_array($parametres[0], $this->restriction['parameters'])) {
                        $this->champsExist = array_merge($this->champsExist, [$parametres[0]]);
                    }
                }

                foreach ($params['postParams']['params'] as $key => $paramsExist) {
                    if (in_array($key, $this->champsExist)) {
                        $this->paramsFinal = array_merge($this->paramsFinal, [$key]);
                        $this->valuesRequete .= '"' . $paramsExist . '", ';
                    }
                }

                if ($this->paramsFinal) {
                    $params['postParams']['params'] = implode(',', $this->paramsFinal);
                    $this->valuesRequete = stripslashes(substr($this->valuesRequete, 0, -2));
                    $insert = $this->connect()->prepare('INSERT INTO ' . $params['postParams']['table'] . ' (' . $params['postParams']['params'] . ') VALUES(' . $this->valuesRequete . ')');
                    $insert->execute();

                    header('Content-Type: application/json');
                    return json_encode(['success' => 'true'], JSON_PRETTY_PRINT);
                } else {
                    header('Content-Type: application/json');
                    return json_encode(['error' => 'true', 'message' => 'parameters field not accepted'], JSON_PRETTY_PRINT);
                }
            } else {
                header('Content-Type: application/json');
                return json_encode(['error' => 'true', 'message' => 'table doesn\'t exist'], JSON_PRETTY_PRINT);
            }
        } else {
            header('Content-Type: application/json');
            return json_encode(['error' => 'true', 'message' => 'parameters doesn\'t exist'], JSON_PRETTY_PRINT);
        }

    }

    public function showPut($params)
    {

    }

    public function showDelete($params)
    {

    }

    public function showJson($params)
    {
        // On sélectionne la bonne action par rapport à l'action de demande
        if ($this->action == "GET") {
            echo $this->showGet($params);
        } elseif ($this->action == "POST") {
            echo $this->showPost($params);
        } elseif ($this->action == "PUT") {
            echo $this->showPut($params);
        } elseif ($this->action == "DELETE") {
            echo $this->showDelete($params);
        }
    }
}