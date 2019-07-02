<?php
class PDF extends FPDF {

    //Cabecera de la página
    function Header() {
        
    }

    //Pie de página
    function Footer() {
        //Posicion a 1.5mm del final de pagina
        $this->SetY(-25);
        //Arial B 12
        $this->SetFont('Arial', 'B', 11);
        //Movemos a la derecha un poco
    }

}