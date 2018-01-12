
<?php 

require_once __DIR__ . '/vendor/autoload.php';

//spl_autoload_register(function($className){
//    
//    echo $className;
//    
//    require_once __DIR__ . '/src/' . str_replace('\\', '/', $className) . '.php';
//});

//require_once './src/Cubes/Firma/Osoba.php';
//require_once './src/Cubes/Firma/Zaposleni.php';
//require_once './src/Cubes/Firma/Polaznik.php';
//require_once './src/Cubes/Firma/Praktikant.php';
//require_once './src/Cubes/Firma/Firma.php';


$firma = new \Cubes\Firma\Firma(); //fully qualified class name

$firma->addOsoba(new \Cubes\Firma\Zaposleni('Z1 Ime', 'Z1 Prezime', 'Z1 Odeljenje'));
$firma->addOsoba(new \Cubes\Firma\Zaposleni('Z2 Ime', 'Z2 Prezime', 'Z2 Odeljenje'));
$firma->addOsoba(new \Cubes\Firma\Zaposleni('Z3 Ime', 'Z3 Prezime', 'Z3 Odeljenje'));

$firma->addOsoba(new \Cubes\Firma\Polaznik('P1 Ime', 'P1 Prezime', 'P1 Kurs'));
$firma->addOsoba(new \Cubes\Firma\Polaznik('P2 Ime', 'P2 Prezime', 'P2 Kurs'));
$firma->addOsoba(new \Cubes\Firma\Polaznik('P3 Ime', 'P3 Prezime', 'P3 Kurs'));

$firma->addOsoba(new \Cubes\Firma\Praktikant('Pr1 Ime', 'Pr1 Prezime', 'Pr1 Odeljenje', 'Pr1 Mentor'));
$firma->addOsoba(new \Cubes\Firma\Praktikant('Pr2 Ime', 'Pr2 Prezime', 'Pr2 Odeljenje', 'Pr2 Mentor'));


//print_r($firma);

$firma->izlistajOsobe();