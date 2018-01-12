<?php

namespace Cubes\Firma; 

class Polaznik extends Osoba {
	protected $kurs;
	
	public function __construct($ime, $prezime, $kurs) {
		parent::__construct($ime, $prezime);
		
		$this->kurs = $kurs;
	}
	
	public function getKurs() {
		return $this->kurs;
	}

	public function setKurs($kurs) {
		$this->kurs = $kurs;
		return $this;
	}

	public function predstaviSe() {
		return parent::predstaviSe() . ' Pohadjam kurs: ' . $this->kurs . '.'; 
	}


}

