<?php

require __DIR__ . '/vendor/autoload.php';

use React\Http\Browser;

use DiDom\Document;
class KinopoiskParser {
    /**
     * @var Browser
     */
    private $client;

    /**
     * @var array
     */
    private $data = [];

    public function __construct(Browser $client)
    {
        $this->client = $client;
    }

    public function parse(array $urls)
    {
        foreach ($urls as $url) {
            $this->client->get($url)->then(
                function (\Psr\Http\Message\ResponseInterface $response) {
                    $this->data[] = $this->parseDOM((string)$response->getBody());
                });
        }
    }

    private function parseDOM(string $html)
    {
        $document = new Document($html);

        $title = $document->first('span')->text(); // Джон Уик 3
//        $alternativeHeadline = $document->first('h2')->text();
////        $tableRows = $document->find('table.info tr');
////        $year = $tableRows[0]->first('a')->text(); // 2019
////        $country = $tableRows[1]->first('a')->text(); // США
//        $year = $document->first('.k-label')->text(); // 2019
//        $country = $document->first('.k-label')->text(); // США
//
//        $time = $document->first('.k-label')->text();
//        $rating = $document->first('.k-label')->text();

        return [
            'title'             => $title,
//            'alternative_title' => $alternativeHeadline,
//            'year'              => $year,
//            'country'           => $country,
//            'time'              => $time,
//            'rating'            => $rating,
        ];
    }

    public function getData()
    {
        return $this->data;
    }
}

$loop = React\EventLoop\Factory::create();
$client = new Browser($loop);

$parser = new KinopoiskParser($client);

$parser->parse([
    'https://www.kinopoisk.ru/film/1009536/',
]);



$loop->run();
var_dump($parser->getData());

