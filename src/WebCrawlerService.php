<?php

namespace App;

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;

class WebCrawlerService
{
    /**
     * @var string site url
     */
    private $siteUrl;

    /**
     * @var string $xpath
     */
    private $xpath;

    public function __construct(string $siteUrl, string $xpath)
    {
        $this->siteUrl = $siteUrl;
        $this->xpath = $xpath;
    }

    public function run(): NewsList
    {
        return $this->getNewsList();
    }

    public function getContent(): string
    {
        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', $this->siteUrl, [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'
            ]
        ]);
        $content = $response->getContent();
        return $content;
    }

    public function getNewsList(): NewsList
    {
        $content = $this->getContent();

        $domCrawler = new Crawler($content);
        $domParts = $domCrawler->filterXPath($this->xpath);

        $newsListObj = new NewsList();

        foreach ($domParts as $domPart) {
            $news = new News();
            $href = $domPart->getAttribute('href');
            $nodeValue = trim($domPart->nodeValue);
            $news->setTitle($nodeValue);
            $news->setUrl($href);
            $newsListObj->addNews($news);
        }

        return $newsListObj;
    }
}