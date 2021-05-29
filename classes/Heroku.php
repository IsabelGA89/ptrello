<?php


class Heroku
{
    private $conection;
    private $status;

    /**
     * Heroku constructor.
     */
    public function __construct()
    {
        //Get Heroku ClearDB connection information
        $cleardb_url      = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $cleardb_server   = "us-cdbr-east-03.cleardb.com";
        $cleardb_username = "b0a56ad1436acf";
        $cleardb_password = "64c5235e";
        $cleardb_db       = "heroku_4edea3226fe2494";

        try {
            $pdo = new PDO("mysql:host=".$cleardb_server."; dbname=".$cleardb_db, $cleardb_username, $cleardb_password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }


    public function conectar(){
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

        $server = $url["host"];
        $username = $url["user"];
        $password = $url["pass"];
        $db = substr($url["path"], 1);

        $conn = new mysqli($server, $username, $password, $db);
        return $conn;
    }



    /**
     * @return mixed
     */
    public function getConection()
    {
        return $this->conection;
    }

    /**
     * @param mixed $conection
     */
    public function setConection($conection): void
    {
        $this->conection = $conection;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }


    public function cerrar()
    {
        unset($this->conection);
    }



}