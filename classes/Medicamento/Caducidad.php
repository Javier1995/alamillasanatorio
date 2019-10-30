<?php
namespace Medicamento;
require_once '../conexion/DB.php';
use conexion\DB;
use Medicamento\Medicamento as Medicamento;

class Caducidad {    
    protected $connectDB;
    protected $currentDate;
    protected $activeLotes;

    public function __construct(){
      $this->currentDate = date('Y-m-d');
      $this->connectDB = DB::conection();
    }

    public static function expiredMedications(){
        
    }



  /*   
   Traeme todos los lotes activos
  public static function getAllActiveLotes(){
        $itself = new Caducidad();

        $sql = "SELECT * FROM lotes lo RIGHT JOIN medicamentos me ON me.cve_medicamento = lo.cve_medicamento WHERE fecha_caducidad <= '$itself->currentDate'";
        $query =  $itself->connectDB->query($sql);
        $list = '<div class="container">';
        $list.= '<div class="row">';
        $list.="<div class='col s12 l6'>";
        $list.= "<div class='collection'>";
        while($datos = $query->fetch_object()){

            $list.= "<a class='collection-item' href='javascript:void(0)'>".$datos->nombre_generico.'|'.$datos->fecha_caducidad."</a>";
        
        }
        $list.= "</div>";
        $list.='</div>';
        $list.= '</div>';
        $list.= '</div>';
        echo $list;
    }
 */


}