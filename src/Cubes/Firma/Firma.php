<?php

namespace Cubes\Firma;

class Firma {
	
	/**
	 * @var Osoba[] 
	 */
	protected $osobe = [];
	
	public function getOsobe() {
		return $this->osobe;
	}

	public function setOsobe(array $osobe) {
		
		foreach ($osobe as $osoba) {
			if (!($osoba instanceof Osoba)) {
				die('Clanovi niza osobe moraju biti instance klase Osoba');
			}
		}
		
		$this->osobe = $osobe;
		return $this;
	}
	
	public function addOsoba(Osoba $osoba) {
		
		$this->osobe[] = $osoba;
		
		return $this;
	}
	
	public function izlistajOsobe() {
		echo "Osobe u firmi: <br><br>";
		
		foreach ($this->osobe as $osoba) {
			echo $osoba->predstaviSe() . "<br>";
		}
	}

}

