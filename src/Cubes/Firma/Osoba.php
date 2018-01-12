<?php

namespace Cubes\Firma;

abstract class Osoba {
	
	protected $ime;
	protected $prezime;
	
	public function __construct($ime, $prezime) {
		$this->ime = $ime;
		$this->prezime = $prezime;
	}
	
	public function getIme() {
		return $this->ime;
	}

	public function getPrezime() {
		return $this->prezime;
	}

	public function setIme($ime) {
		$this->ime = $ime;
		return $this;
	}

	public function setPrezime($prezime) {
		$this->prezime = $prezime;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function predstaviSe() {
		
		return 'Ja sam ' . $this->ime . ' ' . $this->prezime . '.';
	}
}
