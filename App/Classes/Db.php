<?php


namespace App\Classes;

use \App\Exceptions\EDb;

class Db
{
    use TSingleton;

    protected $dbh;

    /**
     * @var Config $config
     * @var string $dsn
     */
    protected function __construct()
    {
        $config = Config::instance();
        $dsn = $config->data['db']['driver'] . ':host=' . $config->data['db']['host'] . ';dbname=' . $config->data['db']['dbname'];
        try {
            $this->dbh = new \PDO($dsn, $config->data['db']['user'], $config->data['db']['password'], [\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',]);
            $this->dbh->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->dbh->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            throw new EDb('Ошибка при соединении с БД: ' . $e->getMessage());
        }
    }

    /**
     * @param string $sql
     * @param array $params
     * @return bool
     */
    public function execute(string $sql, $params = [])
    {
        try {
            $sth = $this->dbh->prepare($sql);
        } catch (\PDOException $e) {
            throw new EDb('Ошибка при подготовке запроса: ' . $e->getMessage());
        }
        try {
            return $sth->execute($params);
        } catch (\PDOException $e) {
            throw new EDb('Ошибка при выполнении запроса: ' . $e->getMessage());
        }
    }

    /**
     * @param string $sql
     * @param Model $class
     * @param array $params
     * @return array
     */
    public function query(string $sql, $class = \stdClass::class, $params = [])
    {
        try {
            $sth = $this->dbh->prepare($sql);
        } catch (\PDOException $e) {
            throw new EDb('Ошибка при подготовке запроса: ' . $e->getMessage());
        }
        try {
            $sth->execute($params);
        } catch (\PDOException $e) {
            throw new EDb('Ошибка при выполнении запроса: ' . $e->getMessage());
        }
        return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    public function queryEach(string $sql, $class = \stdClass::class, $params = [])
    {
        try {
            $sth = $this->dbh->prepare($sql);
        } catch (\PDOException $e) {
            throw new EDb('Ошибка при подготовке запроса: ' . $e->getMessage());
        }
        try {
            $sth->execute($params);
        } catch (\PDOException $e) {
            throw new EDb('Ошибка при выполнении запроса: ' . $e->getMessage());
        }
        $sth->setFetchMode(\PDO::FETCH_CLASS, $class, []);
        while ($current = $sth->fetch()) {
            yield $current;
        }
    }



    /**
     * @return integer
     */
    public function lastId()
    {
        return (int)$this->dbh->lastInsertId();
    }

}