<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cubes;

use Cubes\Firma\Osoba;
use Cubes\HR\Osoba as HROsoba;

/**
 * Description of App
 *
 * @author backend
 */
class App {
    
    /**
     *
     * @var \Cubes\Firma\Osoba
     */
    protected $firmaOsoba;
    
   /**
    *
    * @var \Cubes\HR\Osoba
    */
    protected $hrOsoba;
    
    function __construct(\Cubes\Firma\Osoba $firmaOsoba, HROsoba $hrOsoba) {
        $this->firmaOsoba = $firmaOsoba;
        $this->hrOsoba = $hrOsoba;
    }
    
    function getFirmaOsoba() {
        return $this->firmaOsoba;
    }

    function getHrOsoba() {
        return $this->hrOsoba;
    }

    function setFirmaOsoba(Osoba $firmaOsoba) {
        $this->firmaOsoba = $firmaOsoba;
    }

    function setHrOsoba(HROsoba $hrOsoba) {
        $this->hrOsoba = $hrOsoba;
    }



}
