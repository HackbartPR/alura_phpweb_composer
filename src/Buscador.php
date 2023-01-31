<?php

namespace HackbartPR\BuscadorDeCursos;

require 'vendor/autoload.php';
use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{
    private $client;
    private $crawler;

    public function __construct(ClientInterface $client, Crawler $crawler)
    {
        $this->client = $client;
        $this->crawler = $crawler;
    }

    public function getCursos(string $url, string $cssSelector): array
    {
        $response = $this->client->request('GET', $url);

        if ($response->getStatusCode() !== 200) {
            return ['URL não encontrada'];
        }

        $this->crawler->addHtmlContent($response->getBody());
        $domElements = $this->crawler->filter($cssSelector);

        $cursos = [];
        foreach ($domElements as $element) {
            $cursos[] = $element->textContent;
        }

        return $cursos;
    }
}
