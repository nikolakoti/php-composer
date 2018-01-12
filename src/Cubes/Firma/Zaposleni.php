<?php

namespace Cubes\Firma;

class Zaposleni extends Osoba {
	
	protected $odeljenje;
	
	public function __construct($ime, $prezime, $odeljenje) {
		parent::__construct($ime, $prezime);
		$this->odeljenje = $odeljenje;
	}

	
	public function getOdeljenje() {
		return $this->odeljenje;
	}

	public function setOdeljenje($odeljenje) {
		$this->odeljenje = $odeljenje;
		return $this;
	}
	
	public function predstaviSe() {
		
		return parent::predstaviSe() . ' Zaposlen sam u odeljenju: ' . $this->odeljenje . '.'; 
	}
}

