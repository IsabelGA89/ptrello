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
        $cleardb_server   = $cleardb_url["host"];
        $cleardb_username = $cleardb_url["user"];
        $cleardb_password = $cleardb_url["pass"];
        $cleardb_db       = substr($cleardb_url["path"],1);

        try {
            $pdo = new PDO("mysql:host=".$cleardb_server."; dbname=".$cleardb_db, $cleardb_username, $cleardb_password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
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