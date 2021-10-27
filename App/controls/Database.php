<?php


namespace App;

class Database extends \mysqli
{
    public function __construct()
    {
        require ('App/config/database.php');
        parent::__construct($dbConfig['host'], $dbConfig['login'], $dbConfig['password'], $dbConfig['database'], $dbConfig['port'], $dbConfig['socket']);
    }

    /**
     * @param string $query
     * @param array $params
     * @return bool|\mysqli_result
     */
    public function result(string $query, array $params = [])
    {
        foreach ($params as $i => $param)
        {
            $query = str_replace("?$i", "'" . $this->real_escape_string($param) . "'", $query);
        }
        $result = $this->query($query);
            return $result;
    }
}