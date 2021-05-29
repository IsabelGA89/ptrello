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
            exit();
        }
        return $conection;
    }

    public function consulta_fetch($consulta){
        if ($resultado = $this->conection->query($consulta)) {

            /* obtener el array de objetos */
            while ($obj = $resultado->fetch_object()) {
                printf ("%s (%s)\n", $obj->username);
            }
            /* liberar el conjunto de resultados */
            $resultado->close();
        }

        /* cerrar la conexión */
        $this->conection->cerrar();
        return $resultado;
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