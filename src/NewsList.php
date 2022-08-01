<?php

namespace App;

use DOMDocument;
use SimpleXMLElement;

class NewsList implements \JsonSerializable
{
    /**
     * @var News[]
     */
    private $newsList;

    /**
     * @return News[]
     */
    public function getNewsList(): array
    {
        return $this->newsList;
    }

    /**
     * @param News[] $newsList
     */
    public function setNewsList(array $newsList): void
    {
        $this->newsList = $newsList;
    }

    public function addNews(News $news): void
    {
        $this->newsList[] = $news;
    }

    public function jsonSerialize(): array
    {
        return $this->newsList;
    }

    /**
     * @throws \Exception
     */
    public function rssSerialize(): string
    {
        $rss_seed = <<<XML
<?xml version='1.0' standalone='yes'?>
<rss version="2.0">
</rss>
XML;

        $rss = new SimpleXMLElement($rss_seed);
        $channel = $rss->addChild('channel');
        $channel->addChild('title', 'RSS Title');
        $channel->addChild('description', 'RSS description');
        $channel->addChild('link', 'https://www.example.com/rss.xml');

        foreach ($this->newsList as $news) {
            $item = $channel->addChild('item');
            $item->addChild('title', $news->getTitle());
            $item->addChild('link', $news->getUrl());
            $item->addChild('guid', $news->getUrl());
        }

        $dom = new DOMDocument();
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($rss->asXML());
        return $dom->saveXML();
    }
}