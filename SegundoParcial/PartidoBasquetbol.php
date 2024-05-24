<?php

include_once "Partido.php";

class PartidoBasquetbol extends Partido
{
    //variables de PartidoBasquetbol
    private $cantidadInfracciones;
    private $coeficientePenalizacion;

    public function __construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2, $coefBase, $cantidadInfracciones)
    {

        parent::__construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2, $coefBase);

        $this->cantidadInfracciones = $cantidadInfracciones;
        $this->coeficientePenalizacion = 0.75;
    }

    public function getCantidadInfracciones(){
       return $this->cantidadInfracciones;
    }
    public function setCantidadInfracciones( $cantidadInfracciones){
        $this->cantidadInfracciones =  $cantidadInfracciones;
     }

    public function getCoeficientePenalizacion(){
        return $this->coeficientePenalizacion;
     }

     public function setCoeficientePenalizacion($coeficientePenalizacion){
         $this->coeficientePenalizacion = $coeficientePenalizacion;
     }

     public function coeficientePartido(){
        $coeficiente_base_partido = parent::coeficientePartido();

        $coef = $coeficiente_base_partido - ($this->getCoeficientePenalizacion() * $this->getCantidadInfracciones());

        return $coef;
     }


    public function __toString()
    {
        $cad = parent::__toString();
        $cad = $cad . "La cantidad de infracciones es: ".$this->getCantidadInfracciones()."\n"."El coeficiente de penalizacion es: ".$this->getCoeficientePenalizacion();
    }
}
