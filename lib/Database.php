<?php
/**
 * Database handler
 *
 * @Author: Stefan Sjönnebring
 * 
 */
class Database {

    private $host   = EDITH_DB_HOST;
    private $user   = EDITH_DB_USER;
    private $pass   = EDITH_DB_PASS;
    private $dbname = EDITH_DB_NAME;

    private $dbh;
    private $error;

    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );

        // Create a new PDO instance
        try 
        {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Catch any errors
        catch(PDOException $e)
        {
            $this->error = $e->getMessage();
        }
    }


    /**
     * Bind values into SQL statements to prevent SQL-injections
     *
     */
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }
    

    /**
     * Bind inputs and assign types
     * If no data type is provided,
     *
     * @param $param, string | Placeholder value e.g. :name
     * @param $value, string | Actual value for binding e.g. "John Doe"
     * @param $type, string   | Datatype of the parameter
     */
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * Execute prepared statement
     *
     */
    public function execute(){
        return $this->stmt->execute();
    }

    /**
     * Fetch rows from database
     *
     * @return array
     */
    public function resultset()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Fetch a single row
     *
     * @return array
     */
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Returns the number of affected rows
     *
     * @return int
     */
    public function rowCount(){
        return $this->stmt->rowCount();
    }

    /**
     * Get the id of last inserted row
     *
     * @return id
     */
    public function lastInsertId(){
        return $this->dbh->lastInsertId();
    }

    public function beginTransaction(){
        return $this->dbh->beginTransaction();
    }

    public function endTransaction(){
        return $this->dbh->commit();
    }

    public function cancelTransaction(){
        return $this->dbh->rollBack();
    }
}

?>