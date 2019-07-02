<?php

namespace Caja;


require_once '../conexion/DB.php';
use Conexion\DB;
class Caja  {

    private $connectDB;
    private $order;
    private $id_user;


    public function setIdUser($id){
        $this->id_user = $id;
    }

    public function getIdUser(){
        return $this->id_user;
    }


    public function setCashoutId($id){
        $this->order = $id;
    }

    public function getCashoutId(){
        return $this->order;
    }

    public function __construct(){
        $this->connectDB = DB::conection();
    }

    public function getOrders($limit = null, $offset = null){
        $limitation = '';

      if(!is_null($offset)){
        $limitation.= 'LIMIT '.$offset;
      }

      if(!is_null($limit)){
        $limitation.=','.$limit;
      }

        $sql = "SELECT pe.*, CONCAT(us.nombre, ' ', us.apellidos) as usuario FROM pedidos pe INNER JOIN usuarios us ON pe.id_usuario = us.id  WHERE pe.id_corte_caja is null ORDER BY pe.id DESC ";
        $sql.= $limitation  ;
        $result =  $this->connectDB->query($sql);

        return $result;
    }

    public function getOrdersByCashout($limit = null, $offset = null){
        $limitation = '';

        if(!is_null($offset)){
            $limitation.= 'LIMIT '.$offset;
        }

        if(!is_null($limit)){
            $limitation.=','.$limit;
        }

        $sql = "SELECT pe.*, CONCAT(us.nombre, ' ', us.apellidos) as 'usuario' FROM pedidos pe INNER JOIN usuarios us ON pe.id_usuario = us.id";
        $sql.= "  WHERE pe.id_corte_caja = {$this->getCashoutId()} ORDER BY id $limitation";
        $result =  $this->connectDB->query($sql);

        return $result;

    }

    public function getCantidadProducto($id){
        $dato = $this->connectDB->escape_string($id);
        $sql = "SELECT COUNT(*) as 'num_producto' FROM operaciones WHERE id_pedido = $dato";
        $query = $this->connectDB->query($sql);
        $result = $query->fetch_object();

        $res = $result->num_producto.' producto';
        $contable = '';
        if($result->num_producto > 1) {
            $contable = 's';
        }
    
        return  $res.$contable;
        
    }
    /**
     * Obtiene la lista de los cortes de caja
     * 
     */
    public function getCashOut($limit = null, $offset = null) {
      $limitation = '';

      if(!is_null($offset)){
        $limitation.= 'LIMIT '.$offset;
      }

      if(!is_null($limit)){
        $limitation.=','.$limit;
      }
      

      $sql = "SELECT * FROM corte_cajas ORDER BY id DESC $limitation";
      $query = $this->connectDB->query($sql);
      return $query;
    }

    public function getCashOutByOne($id) {
        $sql = "SELECT * FROM corte_cajas WHERE id = $id";
        $query = $this->connectDB->query($sql);
        return $query;
      }


    public function createNewCashOut(){
        $message = false;

        if($this->existOrder() !=0){
            $insert_corte = "INSERT INTO corte_cajas(id_usuario, fecha_corte) VALUES({$this->getIdUser()},CURRENT_TIMESTAMP)";
            $insert = $this->connectDB->query($insert_corte);
            $id_corte_inserted =$this->connectDB->insert_id;
            $orders = $this->getOrders();

            while($corte = $orders->fetch_object()){
                $update_orders = "UPDATE pedidos SET id_corte_caja = $id_corte_inserted WHERE id_corte_caja is null";
                $this->connectDB->query($update_orders);
            }

           $message = true;

        } 

        return $message;

    }
    /*
    *Muestra cuantos pedidos existe con id_corte_caja en null
    *@return INT 
    */
    private function existOrder() {
        $sql = "SELECT * FROM pedidos WHERE id_corte_caja is null";
        $result =  $this->connectDB->query($sql);

        return $result->num_rows;
    }

}