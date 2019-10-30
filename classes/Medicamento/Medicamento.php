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
    protected function getCve_medicamento()
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


    /**
     * 
     * Trae todas las entradas que fueron realizadas
     */
    public function getEntries($search = null, $offset = null, $limit = null) {

        $where = ""; 
        $limitation = "";
        $orderBy =" ORDER BY o.fecha_operacion DESC";
        $resultado = array();

        if(isset($search) || $search == ''){
            $where.= " WHERE m.cve_medicamento LIKE '%$search%' OR ";
            $where.= "m.nombre_generico LIKE '%$search%'  OR ";
            $where.= "l.cve_lote LIKE '%$search%' OR ";
            $where.= "m.nombre_comercial LIKE '%$search%'  OR ";
            $where.= "m.descripcion LIKE '%$search%' ";
          }

        if(!is_null($offset)){
            $limitation.= ' LIMIT '.$offset;
        }

        if(!is_null($limit)){
            $limitation.=','.$limit;
            
        }


        //Extraccion de lotes de entradas
        $query =" SELECT  l.cve_medicamento as 'clave', m.nombre_comercial as 'nombre_c', m.precio_venta as 'precio', l.cve_lote as 'lote', fecha_caducidad as caducidad, cantidad, o.fecha_operacion as 'alta', l.id as 'id_lote'";
        $query.=" FROM operaciones o "; 
        $query.=" INNER JOIN lotes l ON o.id_lote = l.id ";
        $query.=" INNER JOIN medicamentos m  ON l.cve_medicamento = m.cve_medicamento ";  
        $query.= $where.$orderBy.$limitation;

        $resultado = $this->connectDB->query($query);
        return $resultado;
    }
    
    public function medicationStock(){
      $stockVigente = 0;  
      $sqlVigente = "SELECT SUM(cantidad) as total FROM operaciones WHERE id_tipo_operacion = 1 AND id_lote IN (SELECT id FROM lotes WHERE cve_medicamento = '{$this->getCve_medicamento()}' AND vigente <>0)";
      $sqlVendido = "SELECT SUM(cantidad) as total FROM operaciones WHERE id_tipo_operacion = 2 AND id_medicamento= '{$this->getCve_medicamento()}'";
      $sqlCaducado = "SELECT SUM(cantidad) as total FROM operaciones WHERE id_tipo_operacion = 3 AND id_lote IN (SELECT id FROM lotes WHERE cve_medicamento = '{$this->getCve_medicamento()}' AND vigente <>1)";
      $queryVigente = $this->connectDB->query($sqlVigente);
      $queryVendido = $this->connectDB->query($sqlVendido);
      $queryCaducado = $this->connectDB->query($sqlCaducado);
      $resVigente = $queryVigente->fetch_object();
      $resVendido  = $queryVendido->fetch_object();
      $resCaducado = $queryCaducado->fetch_object();

      $stockVigente = $resVigente->total - $resVendido->total  - $resCaducado->total;
      return $stockVigente;
    }
    
  
}