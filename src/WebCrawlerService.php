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

    /**
     * @return NewsList
     */
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

    /**
     * @return NewsList
     */
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

            // If the URL is relative construct the absolute URL
            if (filter_var($href, FILTER_VALIDATE_URL) === false) {
                $href = $this->constructUrl($href);
            }

            $news->setUrl($href);
            $newsListObj->addNews($news);
        }

        return $newsListObj;
    }

    /**
     * @param string $endingPart
     * @return string
     */
    private function constructUrl(string $endingPart): string
    {
        $firstPart = $this->siteUrl;
        $lastPart = $endingPart;
        if (substr($this->siteUrl, -1) !== '/') {
            $firstPart .= '/';
        }
        if ($endingPart[0] === '/') {
            $lastPart = substr($endingPart, 1);
        }
        return $firstPart . $lastPart;
    }
}