<?php 
namespace Medicamento;

require_once '../conexion/DB.php';
use Conexion\DB;
class Medicamento {

    private $connectDB;
    private $cve_medicamento;
    private $nombre_generico;
    private $nombre_comercial;
    private $description;
    private $imagen;
    private $presentacion;
    private $precio_adquisitivo;
    private $precio_venta;
    private $unidades_caja;
    private $stock_minimo;
    private $fecha_alta;
    private $id_categoria;


    public function __construct(){
        $this->connectDB = DB::conection();
    }


    /**
     * Get the value of cve_medicamento
     */ 
    private function getCve_medicamento()
    {
        return $this->cve_medicamento;
    }

    /**
     * Set the value of cve_medicamento
     *
     * @return  self
     */ 
    public function setCve_medicamento($cve_medicamento)
    {
        $this->cve_medicamento = $cve_medicamento;

        return $this;
    }

    /**
     * Get the value of nombre_generico
     */ 
    private function getNombre_generico()
    {
        return $this->nombre_generico;
    }

    /**
     * Set the value of nombre_generico
     *
     * @return  self
     */ 
    public function setNombre_generico($nombre_generico)
    {
        $this->nombre_generico = $nombre_generico;

        return $this;
    }

    /**
     * Get the value of nombre_comercial
     */ 
    private function getNombre_comercial()
    {
        return $this->nombre_comercial;
    }
    /**
     * Set the value of nombre_comercial
     *
     * @return  self
     */ 
    public function setNombre_comercial($nombre_comercial)
    {
        $this->nombre_comercial = $nombre_comercial;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of fecha_alta
     */ 
    public function getFecha_alta()
    {
        return $this->fecha_alta;
    }

    /**
     * Set the value of fecha_alta
     *
     * @return  self
     */ 
    public function setFecha_alta($fecha_alta)
    {
        $this->fecha_alta = $fecha_alta;

        return $this;
    }

  


    public function getMedication($search = null, $offset = null, $limit = null){
        $where = ""; 
        $limitation = "";

        if(isset($search) || $search == ''){
            $where.= " WHERE cve_medicamento LIKE '%$search%' OR ";
            $where.= "nombre_generico LIKE '%$search%'  OR ";
            $where.= "nombre_comercial LIKE '%$search%'  OR ";
            $where.= "descripcion LIKE '%$search%' OR ";
            $where.= "presentacion LIKE '%$search%' OR ";
            $where.= "precio_adquisitivo LIKE '%$search%' OR ";
            $where.= "cm.nombre LIKE '%$search%' ";
          }

        if(!is_null($offset)){
            $limitation.= ' LIMIT '.$offset;
        }

        if(!is_null($limit)){
            $limitation.=','.$limit;
        }

      

        $sql= "SELECT m.*, cm.nombre as 'categoria' FROM medicamentos m INNER JOIN categorias_medicamentos cm  ON  cm.id = m.id_categoria $where $limitation";
        $resultado = $this->connectDB->query($sql);

        return $resultado;
    }

}