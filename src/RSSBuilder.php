<?php

namespace App;

/**
 * Sensika Senior PHP Developer Challenge input structure
 */
class RSSBuilder
{
    /**
     * URL for converting to RSS/Atom/JSON
     * @var string
     */
    private $siteUrl;

    /**
     * @var string
     */
    private $xpath;

    /**
     * @var NewsList
     */
    private $newsList;

    /**
     *
     * @param string $siteUrl - input site URL
     */
    public function __construct(string $siteUrl, string $xpath)
    {
        $this->siteUrl = $siteUrl;
        $this->xpath = $xpath;

        $webCrawlerService = new WebCrawlerService($this->siteUrl, $this->xpath);
        $this->newsList = $webCrawlerService->run();
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getRSS(): string
    {
        $rss = $this->newsList->rssSerialize();
        return $rss;
    }

    /**
     * @return string
     */
    public function getJSON(): string
    {
        $json = json_encode($this->newsList, JSON_PRETTY_PRINT);
        return $json;
    }
}