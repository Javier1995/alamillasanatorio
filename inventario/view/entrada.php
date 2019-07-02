
<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <span class="card-title">Entradas</span>
        <div class="row">
           <div class="input-field col s12 m12 l4 xl4 offset-l1 offset-xl1">
             <input type="text" class="datepicker" id="fecha_in">
             <label for="fecha_in">Fecha Inicio</label>
           </div>
           <div class="input-field col s12 m12 l4 xl4 offset-l1 offset-xl1">
             <input type="text" class="datepicker" id="fecha_fin">
             <label for="fecha_in">Fecha Fin</label>
           </div>
           <div class="col s12 m12 l2 xl2">
             <a href="#" id="buscarEn" class="btn"><i class="material-icons ">search</i></a>
             <br><br>
             <a href="#" id="buscarpdf" class="btn"><i class="material-icons ">picture_as_pdf</i></a>
           </div>
        </div>
      </div>
    </div>
  </div>
 </div>
<div id="resultadoEn"></div>
<div id="pdf"></div>
<?php include '../../extend/scripts.php'; ?>
