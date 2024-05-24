<?php
class Torneo
{
    private $coleccionObjPartidos;
    private $importePremio;

	public function __construct($coleccionobjpartidos, $importepremio) {

		$this->coleccionObjPartidos = [];
		$this->importePremio = $importepremio;
	}

	public function getColeccionObjPartidos() {
		return $this->coleccionObjPartidos;
	}

	public function setColeccionObjPartidos($coleccionobjpartidos) {
		$this->coleccionObjPartidos = $coleccionobjpartidos;
	}

	public function getImportePremio() {
		return $this->importePremio;
	}

	public function setcoleccionPremiosGanadoresPartido($importepremio) {
		$this->importePremio = $importepremio;
	}

    public function recorrerColeccion($coleccion){
        $cad = "";
        foreach ($coleccion as $unElementoColeccion) {
            $cad = $cad . " ". $unElementoColeccion . " \n";
        }
        return $cad;
    }

    /**
     * en la clase Torneo el cual recibve por parametro 2 equipos, la fecha en la
     * realiza el partido y si se trata de un partido dfe futbol o basquetbol,
     * El metodo debe crear y retornar la instancia de la clase Partido que corresponda y almacenarla en la coleccion de partidos
     * del Torneo. Se debe chequear que los 2 equipos tengan la misma categoria e igual cantidad de jugadores, caso contrario no podra
     * ser registrado ese partido en el torneo
     */
    public function ingresarPartido($OBJEquipo1,$OBJEquipo2,$fecha,$tipoPartido){
        $objPartido = null;
        $objCategoria1 = $OBJEquipo1->getObjetoCategoria();
        $objCategoria2 = $OBJEquipo2->getObjetoCategoria();
        $cantJugadores1 = $OBJEquipo1->getCantJugadores();
        $cantJugadores2 = $OBJEquipo2->getCantJugadores();
        $coleccionObjetosPartidos = $this->coleccionObjPartidos;
        if ($objCategoria1->getidCategoria() == $objCategoria2->getidCategoria()
           && $cantJugadores1 ==  $cantJugadores2) {

            if ($tipoPartido == 'Futbol' || 'futbol') {
                $n = count($this->coleccionObjPartidos()+1);
                $objPartido = new PartidoFutbol($n,$fecha,$OBJEquipo1,0,$OBJEquipo2);
                array_push($coleccionObjetosPartidos,$objPartido);
                $this->setColeccionObjPartidos($coleccionObjetosPartidos);

            }elseif($tipoPartido == 'Basquet' || 'basquet'){
                $n = count($this->coleccionObjPartidos()+1);
                $objPartido = new PartidoBasquet($n,$fecha,$OBJEquipo1,0,$OBJEquipo2);
                array_push($this->$coleccionObjetosPartidos,$objPartido);
                $this->setColeccionObjPartidos($coleccionObjetosPartidos);
            }
            
        }
        return $objPartido;
    }

    /**
     * en la clase Torneo que recibe por parámetro si se 
     * trata de un partido de fútbol o de básquetbol y en base al parámetro busca entre esos partidos los 
     * equipos ganadores ( equipo con mayor cantidad de goles). El método retorna una colección con los
     * objetos de los equipos encontrados
     */
    public function darGanadores($deporte){
        $coleccionGanadores = [];
        $coleccionPartidos = $this->getColPartidos();
        foreach ($coleccionPartidos as $unPartido) {
            if ($deporte instanceof Futbol){
                $equipoGanador = $unPartido->darEquipoGanador();
                array_push($coleccionGanadores, $equipoGanador);
            }
            if ($deporte instanceof Basquet){
                $equipoGanador = $unPartido->darEquipoGanador();
                array_push($coleccionGanadores, $equipoGanador);
            }
            
        }   
        return $coleccionGanadores;
    }

    public function calcularPremioPartido($OBJPartido){
            $equipoGanador = $OBJPartido->darEquipoGanador();
            $premio = $OBJPartido->coeficientePartido() * $this->getImporte();
            $coleccion = ['equipoGanador'=>$equipoGanador, 'premioPartido' =>$premio];
            return $coleccion;
    }

    public function __toString(){
        return "Coleccion de Partidos".$this->recorrerColeccion($this->getColeccionObjPartidos())."\n".
                "Importe del premio:" .$this->getImportePremio()."\n";
    }
}