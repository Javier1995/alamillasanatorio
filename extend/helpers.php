<?php

function mostrarCategorias($id = null) {
    global $con;

    $resultado = array();
    $query = "SELECT id, nombre FROM categorias_medicamentos ";

    if (isset($id)) {
        $query .= " WHERE id = $id";
    }
    $query .= " ORDER BY nombre ASC";
    $sel = $con->query($query);
    if ($sel) {
        $resultado = $sel;
    } else {
        $resultado = array();
    }

    return $resultado;
}

function mostrarEntradas($id) {
    global $con;

    $resultado = array();
    $query = "SELECT * FROM entrada_medicamentos en INNER JOIN medicamentos me ON en.id_medicamento = me.id ";
    $query .= "INNER JOIN usuarios u ON en.id_usuario = u.id ";
    $query .= "INNER JOIN lotes lo ON en.id_lote = lo.id ";
    if (isset($id)) {
        $query .= " WHERE id = $id";
    } else {

        $query .= "WHERE fecha = CURDATE()";
    }

    $sel = $con->query($query);
    if ($sel) {
        $resultado = $sel;
    } else {
        $resultado = array();
    }

    return $resultado;
}

function guardarProductos($categoria, $cveMedicamento, $nombreGenerico, $nombrecomercial, $descripcion, $presentacion, $presioa, $preciov, $unidadesCaja, $stockMinimo, $usuario, $lote, $fechaCaducidad, $piezas) {
    global $con;
    $result = false;
    $query = "INSERT INTO medicamentos VALUES('$cveMedicamento','$nombreGenerico', '$nombrecomercial' ,'$descripcion', NULL ,'$presentacion', $presioa, $preciov, $unidadesCaja, $stockMinimo, CURRENT_TIMESTAMP, NULL, $categoria);";
    $query .= "INSERT INTO lotes VALUES('$lote', CURRENT_TIMESTAMP, '$fechaCaducidad', '$cveMedicamento');";
    $query .= "INSERT INTO operaciones VALUES(NULL,$piezas, NULL, NULL, 1, '$cveMedicamento', NULL, '$lote', CURRENT_TIMESTAMP);";
    $insert = $con->multi_query($query);
    if ($insert) {
        $result = true;
    }
    return $result;
}

//Valida la existencia del codigo
function barcodeExists($codigo) {

    global $con;

    $result = false;
    if (!isset($codigo)) {

        $result = false;
    } else {

        $query = "SELECT cve_medicamento FROM medicamentos WHERE cve_medicamento = '$codigo'";
        $sel = $con->query($query);
        $row = $sel->num_rows;

        if ($row >= 1) {

            $result = false;
        } else {

            $result = true;
        }
    }


    return $result;
}

function mostrar_medicamentos($id = null) {
    global $con;
    $resultado = array();
    $query = "SELECT m.*, cm.nombre as 'categoria' FROM medicamentos m LEFT JOIN categorias_medicamentos cm  ON cm.id = m.id_categoria ";
    if (isset($id)) {

        $query .= " WHERE cve_medicamento = '$id'";
    }

    $sel = $con->query($query);

    if ($sel) {
        $resultado = $sel;
    } else {
        $resultado = array();
    }

    return $resultado;
}

function Elimina_id_url() {

    $result = false;
    if (isset($_SESSION['q'])) {
        unset($_SESSION['q']);
        $result = true;
    }

    if (isset($_SESSION['l'])) {
        unset($_SESSION['l']);
        $result = true;
    }

    if (isset($_SESSION['paciente'])) {
        unset($_SESSION['paciente']);
        $result = true;
    }
    if (isset($_SESSION['edit'])) {
        unset($_SESSION['edit']);
        $result = true;
    }

    if (isset($_SESSION['re'])) {
        unset($_SESSION['re']);
        $result = true;
    }
    return $result;
}

function actualizarProductos($categoria, $cveMedicamentos, $nombreGenerico, $nombrecomercial, $descripcion, $presentacion, $presioa, $preciov, $unidadesCaja, $stockMinimo) {
    global $con;
    $result = false;
    $query = "UPDATE medicamentos SET nombre_generico = '$nombreGenerico', nombre_comercial = '$nombrecomercial', descripcion = '$descripcion', presentacion = '$presentacion', precio_adquisitivo = $presioa, precio_venta = $preciov, unidades_caja = $unidadesCaja, stock_minimo = $stockMinimo, id_categoria =  $categoria WHERE cve_medicamento = '$cveMedicamentos'";
    $insert = $con->query($query);
    if ($insert) {
        $result = true;
    }
    return $result;
}

function busqueda_medicamentos($barcode) {
    global $con;
    $resultado = array();
    $query = "SELECT * FROM medicamentos WHERE cve_medicamento = '$barcode'";
    $sel = $con->query($query);
    $row = $sel->num_rows;
    if ($row != 0) {

        $fetch = $sel->fetch_assoc();
        $resultado = $fetch;
    }

    return $resultado;
}

function guardar_lote($barcode, $lote, $caducidad, $cantidad) {
    global $con;

    $result = false;
    if (isset($barcode) && isset($lote) && isset($caducidad) && isset($cantidad)) {
        $query = "INSERT INTO lotes VALUES('$lote', CURRENT_TIMESTAMP, '$caducidad', '$barcode');";
        $query .= "INSERT INTO operaciones VALUES(NULL,$cantidad, NULL, NULL, 1, '$barcode', NULL, '$lote',CURRENT_TIMESTAMP);";

        $insert = $con->multi_query($query);
        if ($insert) {
            $result = true;
        }
    }
    return $result;
}

function mostrar_lotes($id = NULL) {

    global $con;
    $resultado = array();
    $query = "SELECT  l.cve_medicamento as 'clave', m.nombre_comercial as 'nombre_c', m.precio_venta as 'precio', l.cve_lote as 'lote', fecha_caducidad as caducidad, cantidad, l.fecha_alta as 'alta' FROM lotes l 
    INNER JOIN medicamentos m  ON l.cve_medicamento = m.cve_medicamento 
    INNER JOIN operaciones o ON o.cve_lote = l.cve_lote ";

    if (isset($id)) {

        $query .= " WHERE l.cve_lote = '$id' ";
    } else {
        $query .= " ORDER BY l.fecha_alta ASC;";
    }

    $sel = $con->query($query);

    if ($sel) {
        $resultado = $sel;
    } else {
        $resultado = array();
    }

    return $resultado;
}

/*
 * 
 * Esta función es especificamentar para validar la posible existencia del mismo lote a introducir 
 * y si se guarda *que se puede guardar el mismo dato existente
 *
 */

function valida_lote_actualizar($lote, $lote_antiguo) {

    $resultado = false;


    if ($lote == $lote_antiguo) {

        $resultado = true;
    } else {

        $resultado = lote_exists($lote);
    }



    return $resultado;
}

/* Valida la existencia del codigo */

function lote_exists($lote) {
    global $con;

    $result = false;
    if (!isset($lote)) {

        $result = false;
    } else {

        $query = "SELECT cve_lote FROM lotes WHERE cve_lote = '$lote'";
        $sel = $con->query($query);
        $row = $sel->num_rows;

        if ($row >= 1) {

            $result = false;
        } else {

            $result = true;
        }
    }


    return $result;
}

function update_lote($barcode, $lote, $caducidad, $piezas, $lote_antiguo) {
    global $con;
    $resultado = false;
    $query = '';
    if (isset($barcode) && isset($lote) && isset($caducidad) && isset($piezas)) {
        $query = "UPDATE lotes SET cve_lote = '$lote', fecha_caducidad = '$caducidad' WHERE cve_lote = '$lote_antiguo';";
        $query .= "UPDATE operaciones SET cve_lote = '$lote', cantidad = $piezas ";
        $query .= "WHERE cve_lote = '$lote_antiguo' AND id_medicamento = '$barcode';";

        $update = $con->multi_query($query);
        $resultado = $update;
    }


    return $resultado;
}

function borrar_medicamento($barcode) {
    global $con;
    $resultado = false;
    $query = "DELETE FROM medicamentos WHERE cve_medicamento = '$barcode'";

    $del = $con->query($query);

    if ($del) {

        $resultado = true;
    }

    return $resultado;
}

function borrar_lote($lote) {
    global $con;
    $resultado = false;
    $query = "DELETE FROM lotes WHERE cve_lote = '$lote'";
    $del = $con->query($query);

    if ($del) {

        $resultado = true;
    }

    return var_dump($lote);
}

function num_lotes() {
    global $con;
    $resultado = false;
    $query = "SELECT COUNT(*) FROM lotes";
    $sel = $con->query($query);

    if ($selt) {

        $resultado = $con->fetch_assoc();
    }

    return $resultado;
}

function updateUserPassword($password, $id) {
    global $con;
    $resultado = false;
    $query = "UPDATE usuarios SET pass = '$password' WHERE id = $id";
    $update = $con->query($query);
    if ($update) {

        $resultado = true;
    }

    return $resultado;
}

function getPassword($id) {
    global $con;
    $resultado = false;
    $query = "SELECT pass FROM usuarios WHERE id = $id";
    $select = $con->query($query);
    if ($select) {

        $pass = $select->fetch_assoc();
        $resultado = $pass['pass'];
    }

    return $resultado;
}

function buscarPaciente($busqueda) {
    global $con;
    $resultado = false;
    $query = "SELECT CONCAT(nombre,' ',apellidos) as 'nombre_completo', fecha_nacimiento, (YEAR(CURRENT_TIMESTAMP)- YEAR(fecha_nacimiento)) AS 'edad', id ";
    $query .= "FROM pacientes ";
    $query .= " WHERE nombre LIKE '%$busqueda%' OR ";
    $query .= " apellidos LIKE '%$busqueda%' OR ";
    $query .= " CONCAT(nombre,' ',apellidos) LIKE '%$busqueda%'";
    $select = $con->query($query);
    if ($select) {

        $resultado = $select;
        $con->close();
    }

    return $resultado;
}

function guardar_paciente($nombre, $apellidos, $nacimiento, $id) {
    global $con;
    $resultado = false;
    $query = "INSERT INTO pacientes VALUES(NULL, '$nombre', '$apellidos', '$nacimiento', CURRENT_TIMESTAMP, $id)";
    $insert = $con->query($query);
    if ($insert) {
        $resultado = $con->insert_id;
    }

    return $resultado;
}

function mostrar_paciente($id) {
    global $con;
    $resultado = false;
    $query = "SELECT id, nombre, apellidos, fecha_nacimiento, (YEAR(CURRENT_TIMESTAMP)-YEAR(fecha_nacimiento)) as 'edad' FROM pacientes WHERE id = $id";
    $select = $con->query($query);
    if ($select) {

        $datos = $select->fetch_assoc();
        $resultado = $datos;
    }

    return $resultado;
}

function guardar_receta($id_paciente, $diagnostico, $medicamento, $id) {
    global $con;
    $resultado = false;
    $query = "INSERT INTO recetas VALUES(NULL,'$medicamento', '$diagnostico',CURRENT_TIMESTAMP,$id_paciente, $id)";
    $insert = $con->query($query);
    if ($insert) {
        $resultado = $con->insert_id;
    }

    return $resultado;
}

function getReceta($id) {
    global $con;
    $resultado = false;
    $query = "SELECT re.id AS 'folio', re.fecha_realizada AS 'fecha',pa.fecha_nacimiento AS 'nacimiento' ,re.diagnostico AS diagnostico, re.medicamento AS 'medicamento' ,(YEAR(CURRENT_TIMESTAMP)-YEAR(fecha_nacimiento)) AS 'edad'  ,CONCAT(pa.nombre,' ',pa.apellidos) as 'paciente', CONCAT('DR. ',u.nombre,' ', u.apellidos) AS 'medico' FROM recetas re INNER JOIN pacientes pa ON re.id_paciente = pa.id ";
    $query .= " INNER JOIN usuarios u ON re.id_usuario = u.id ";
    $query .= " WHERE re.id = $id";
    $select = $con->query($query);
    if ($select) {

        $datos = $select->fetch_assoc();
        $resultado = $datos;
    }

    return $resultado;
}

function atendidos_hoy() {
    global $con;
    $resultado = false;
    $query = "SELECT re.id AS 'folio', TIME(re.fecha_realizada) AS 'hora',pa.fecha_nacimiento AS 'nacimiento' ,re.diagnostico AS diagnostico, re.medicamento AS 'medicamento' ,(YEAR(CURRENT_TIMESTAMP)-YEAR(fecha_nacimiento)) AS 'edad'  ,CONCAT(pa.nombre,' ',pa.apellidos) as 'paciente', CONCAT('DR. ',u.nombre,' ', u.apellidos) AS 'medico' FROM recetas re INNER JOIN pacientes pa ON re.id_paciente = pa.id ";
    $query .= " INNER JOIN usuarios u ON re.id_usuario = u.id ";
    $query .= " WHERE fecha_realizada > DATE_SUB(NOW(), INTERVAL 24 HOUR) ORDER BY re.id DESC";
    $select = $con->query($query);
    if ($select) {

        $resultado = $select;
    }

    return $resultado;
}

function historial_paciente($id) {
    global $con;
    $resultado = false;
    $query = "SELECT u.id as 'id_usuario',re.id AS 'folio', re.fecha_realizada AS 'fecha',pa.fecha_nacimiento AS 'nacimiento' ,re.diagnostico AS diagnostico, re.medicamento AS 'medicamento' ,(YEAR(CURRENT_TIMESTAMP)-YEAR(fecha_nacimiento)) AS 'edad'  ,CONCAT(pa.nombre,' ',pa.apellidos) as 'paciente', CONCAT('DR. ',u.nombre,' ', u.apellidos) AS 'medico' FROM recetas re INNER JOIN pacientes pa ON re.id_paciente = pa.id ";
    $query .= " INNER JOIN usuarios u ON re.id_usuario = u.id ";
    $query .= " WHERE  pa.id = $id ORDER BY  re.id DESC";
    $select = $con->query($query);
    if ($select) {

        $resultado = $select;
    }

    return $resultado;
}

function actualizar_paciente($nombre, $apellidos, $nacimiento, $id) {
    global $con;
    $resultado = false;
    $query = "UPDATE pacientes SET nombre = '$nombre', apellidos = '$apellidos', fecha_nacimiento = '$nacimiento' WHERE id = $id";
    $update = $con->query($query);
    if ($update) {
        $resultado = true;
    }
    return $resultado;
}

function borrar_paciente($id) {
    global $con;
    $resultado = false;
    $query = "DELETE FROM pacientes WHERE id = '$id'";
    $del = $con->query($query);
    if ($del) {

        $resultado = true;
    }

    return $resultado;
}

//Funcion que hace return para el total de numero de recetas
function num_recetas() {
    global $con;
    $resultado = false;
    $query = "SELECT distinct count(*) as 'recetas' FROM recetas";
    $select = $con->query($query);
    if ($select) {

        $resultado = $select->fetch_assoc();
    }

    return $resultado;
}

//Funcion para el numero para el pacientes
function num_pacientes() {
    global $con;
    $resultado = false;
    $query = "SELECT distinct count(*) as 'pacientes' FROM pacientes;";
    $select = $con->query($query);
    if ($select) {

        $resultado = $select->fetch_assoc();
    }

    return $resultado;
}

//Funcion para mostrar una receta especifica
function mostrar_receta($id) {
    global $con;
    $resultado = false;
    $query = "SELECT pa.id AS 'id_paciente',re.id AS 'folio', re.fecha_realizada AS 'fecha',pa.fecha_nacimiento AS 'nacimiento' ,re.diagnostico AS diagnostico, re.medicamento AS 'medicamento' ,(YEAR(CURRENT_TIMESTAMP)-YEAR(fecha_nacimiento)) AS 'edad'  ,CONCAT(pa.nombre,' ',pa.apellidos) as 'paciente', CONCAT('DR. ',u.nombre,' ', u.apellidos) AS 'medico' FROM recetas re INNER JOIN pacientes pa ON re.id_paciente = pa.id ";
    $query .= " INNER JOIN usuarios u ON re.id_usuario = u.id ";
    $query .= " WHERE  re.id = $id";
    $select = $con->query($query);
    if ($select) {

        $dato = $select->fetch_assoc();
        $resultado = $dato;
    }

    return $resultado;
}

//Edita la receta
function editar_receta($folio, $diagnostico, $medicamento) {
    global $con;
    $resultado = false;
    $query = "UPDATE recetas SET medicamento = '$medicamento', diagnostico = '$diagnostico' WHERE id = $folio";
    $update = $con->query($query);
    if ($update) {
        $resultado = true;
    }

    return $resultado;
}

//Regresa la cantidad disponible de medicamentos de diferentes lotes
function stock($cve_medicamento) {
    global $con;
    $resultado = false;
    $query = "SELECT  SUM(cantidad) AS 'stock' FROM operaciones GROUP BY id_medicamento, id_tipo_operacion ";
    $query .= "HAVING id_medicamento = '$cve_medicamento' AND id_tipo_operacion = 1;";
    $select = $con->query($query);
    if ($select) {
        $cantidad = $select->fetch_assoc();
        $resultado = $cantidad['stock'];
    }

    return $resultado;
}

function busca_lote($barcode) {
    global $con;
    $resultado = array();
    $query = "SELECT SUM(cantidad) AS stock, m.*  FROM operaciones o ";
    $query .= " INNER JOIN medicamentos m ON id_medicamento = cve_medicamento";
    $query .= " GROUP BY id_medicamento, id_tipo_operacion";
    $query .= " HAVING id_medicamento = '$barcode' AND id_tipo_operacion = 1;";

    $sel = $con->query($query);
    $row = $sel->num_rows;
    if ($row != 0) {
        $fetch = $sel->fetch_assoc();
        $resultado = $fetch;
    }

    return $resultado;
}

//Regresar la cantidad de lotes
function cantidad_lotes() {
    global $con;
    $resultado = array();
    $query = "SELECT COUNT(cve_lote) as lote FROM operaciones ";
    $query .= " GROUP BY id_tipo_operacion";
    $query .= " HAVING id_tipo_operacion = 1;";
    $sel = $con->query($query);
    if ($sel) {
        $fetch = $sel->fetch_assoc();
        $resultado = $fetch['lote'];
    }
    return $resultado;
}

function medicine_exists($barcode) {
    global $con;
    $resultado = array();
    $query = "SELECT * FROM medicamentos WHERE cve_medicamento = '$barcode'";
    $sel = $con->query($query);

    return $sel;
}

function medicine_automplete($barcode) {
    global $con;
    $resultado = array();
    $query = "SELECT * FROM medicamentos WHERE cve_medicamento LIKE '%{$barcode}%'";
    $sel = $con->query($query);

    return $sel;
}

function efectua_compra($cantidad, $descuento, $precio, $cve_medicamento, $id_pedido, $lote = NULL) {
    global $con;
    $resultado = false;
    $query = "INSERT INTO operaciones VALUES(NULL,$cantidad, $descuento,$precio,2,'$cve_medicamento', $id_pedido,null,CURRENT_TIMESTAMP)";
    $insert = $con->query($query);
    if ($insert) {
        $resultado = true;
    }

    return $resultado;
}

function crea_pedido($money, $total, $usuario, $descuento) {
    global $con;
    $resultado = false;
    $query = "INSERT INTO pedidos VALUES(NULL,$money, $total, $descuento ,CURRENT_TIMESTAMP,2,null,null,$usuario)";
    $insert = $con->query($query);
    if ($insert) {
        $resultado = $con->insert_id;
    }

    return $resultado;
}

function recibo_pedido($id) {
    global $con;
    $resultado = array();
    $query = "SELECT u.*, pe.id as 'recibo', pe.* FROM pedidos pe INNER JOIN usuarios u ON u.id = pe.id_usuario WHERE pe.id = $id";
    $sel = $con->query($query);
    $resultado = $sel->fetch_object();
    return  $resultado;
}

function datos_pedidos($id){
    global $con;
    $query = "SELECT op.*, me.*, ca.* FROM pedidos pe ";
    $query.= "INNER JOIN operaciones op ON pe.id = op.id_pedido ";
    $query.= "INNER JOIN medicamentos me ON op.id_medicamento = me.cve_medicamento ";
    $query.= "INNER JOIN categorias_medicamentos ca ON ca.id = me.id_categoria ";
    $query.= "WHERE pe.id = $id";
    $resultado = $con->query($query);
    return $resultado;
}
function deleteSession($ms) {
    if (isset($_SESSION['medicamento'][$ms])) {
        $_SESSION['medicamento'][$ms] = null;
    }
    return true;
}
