<?php

class BD_PDO
{
    /**
     * @var PDO|null  conexión a la BD
     */
    private $con;

    /**
     * @var string información de la conexión
     */
    private $estado="";


    /**
     * BD_PDO constructor.
     * @param array $datos datos para la conexión a bd (host, user, password bd)
     */
    public function __construct(array $datos)
    {
        $this->con=$this->conectar($datos);
    }

    /**
     * @param array $datos datos para la conexión a bd (host, user, password bd)
     * @return PDO|null Según se haya o no conectado a la BD
     */
    public function conectar(array $datos)
    {
        $h=$datos['host'];
        $u=$datos['user'];
        $p=$datos['password'];
        $bd=$datos['bd'];
        $dsn="mysql:host=$h;dbname=$bd";
        $opciones=[PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"];
        $opciones[PDO::ERRMODE_EXCEPTION]=true;
        $con=null; //Por si no se conecta que tenga un valor

        try {
            $con=new PDO($dsn, $u, $p);
            $this->estado="Conectado correctamente";


        } catch (PDOException $ex) {
            //Si no se ha podido conectar genero información
            $this->estado.="No se ha podido conectar a la base de datos<br />";
            $this->estado.="Descripción de la excepción de conexión " . $ex->getMessage () . "<br />";
            $this->estado.="Descripción del error" . $ex->errorInfo . "<br />";
        }

        return $con;

    }

    /**
     * @return string información de la conexión según la especificación del enuniciado
     */
    public function estado_conexion()
    {
        if ($this->con != null) { //Si estoy conectado, informo de los datos
            $info="Version usada en cliente <strong>{$this->con->getAttribute(PDO::ATTR_CLIENT_VERSION)}</strong><br />";
            $info.="Estado de la conexión   <strong>{$this->con->getAttribute(PDO::ATTR_CONNECTION_STATUS)}</strong><br />";
            $info.="Información del servidor  de BD<strong>{$this->con->getAttribute(PDO::ATTR_SERVER_INFO)}</strong><br />";
            $info.="Versión del servidor  BD <strong>{$this->con->getAttribute(PDO::ATTR_CLIENT_VERSION)}</strong><br />";
        }
        else
            $info="No se ha podido concectar a la BD, revise parámetros de conexión";
        return $info;
    }

    public function __toString()
    {
// TODO: Implement __toString() method.
        return $this->estado;
    }

    /**
     * Para desconcetar en pdo reasigno el valor null al objeto PDO
     */
    public function cerrar()
    {
// TODO: Implement __toString() method.
        unset($this->con);
    }
}

?>
