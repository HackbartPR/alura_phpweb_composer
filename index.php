<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use HackbartPR\BuscadorDeCursos\Buscador;

//Classmap
Util::showMessage();
//Filesmap
firstTesteMessage();
secondTesteMessage();

$client = new Client(['verify' => false]);
$crawler = new Crawler();

$buscador = new Buscador($client, $crawler);
$cursos = $buscador->getCursos('https://www.alura.com.br/formacoes', '.formacao__title');

foreach($cursos as $curso) {
    echo $curso . PHP_EOL;
}


