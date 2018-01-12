<?php

namespace Cubes\Firma;

class Praktikant extends Zaposleni {
	
	protected $mentor;
	
	public function __construct($ime, $prezime, $odeljenje, $mentor) {
		parent::__construct($ime, $prezime, $odeljenje);
		
		$this->mentor = $mentor;
	}

	public function predstaviSe() {
		return parent::predstaviSe() . ' Moj mentor je: ' . $this->mentor . '.';
	}

}

