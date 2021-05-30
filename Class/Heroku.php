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
        return $this->conectar();
    }


    public function conectar(){
        $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));

        $cleardb_server = $cleardb_url["host"];
        $cleardb_username = $cleardb_url["user"];
        $cleardb_password = $cleardb_url["pass"];
        $cleardb_db = substr($cleardb_url["path"],1);
        $active_group = 'default';
        $query_builder = TRUE;

        $conection = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

        if (mysqli_connect_errno()) {
            $status = ("Falló la conexión con la base de datos: ". mysqli_connect_error());
            $this->setStatus($status);
            exit();
        }
        return $conection;
    }

    public function consulta_fetch($consulta){
        $arr_result= [];
        if ($resultado = $this->conection->query($consulta)) {
            $numfilas = $resultado->num_rows;

            for ($x=0;$x<$numfilas;$x++) {
                $fila = $resultado->fetch_array();
                array_push($arr_result);
            }
        }
        var_dump($arr_result);
        /* cerrar la conexión */
        $this->conection->cerrar();
        return $arr_result;
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
       $this->conection->close();
    }



}