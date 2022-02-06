<?php

namespace App\Controller;

use App\Model\Secciones;
use App\Helper\ViewHelper;
use App\Helper\DbHelper;


class AppController
{
    var $db;
    var $view;

    function __construct()
    {
        //Conexión a la BBDD
        $dbHelper = new DbHelper();
        $this->db = $dbHelper->db;

        //Instancio el ViewHelper
        $viewHelper = new ViewHelper();
        $this->view = $viewHelper;
    }

    public function index(){

        //Consulta a la bbdd
        $rowset = $this->db->query("SELECT * FROM secciones WHERE activo=1 AND home=1 ORDER BY fecha DESC");

        //Asigno resultados a un array de instancias del modelo
        $secciones = array();
        while ($row = $rowset->fetch(\PDO::FETCH_OBJ)){
            array_push($secciones,new Secciones($row));
        }

        //Llamo a la vista
        $this->view->vista("app", "index", $secciones);
    }

    public function acercade(){

        //Llamo a la vista
        $this->view->vista("app", "acerca-de");

    }

    public function secciones(){

        //Consulta a la bbdd
        $rowset = $this->db->query("SELECT * FROM secciones WHERE activo=1 ORDER BY fecha DESC");

        //Asigno resultados a un array de instancias del modelo
        $secciones = array();
        while ($row = $rowset->fetch(\PDO::FETCH_OBJ)){
            array_push($secciones,new Secciones($row));
        }

        //Llamo a la vista
        $this->view->vista("app", "secciones", $secciones);

    }

    public function seccion($slug){

        //Consulta a la bbdd
        $rowset = $this->db->query("SELECT * FROM secciones WHERE activo=1 AND slug='$slug' LIMIT 1");

        //Asigno resultado a una instancia del modelo
        $row = $rowset->fetch(\PDO::FETCH_OBJ);
        $seccion = new Secciones($row);

        //Llamo a la vista
        $this->view->vista("app", "seccion", $seccion);

    }
}