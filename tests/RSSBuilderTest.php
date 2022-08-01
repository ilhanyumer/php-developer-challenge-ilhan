<?php

namespace App\Tests;

use App\RSSBuilder;
use PHPUnit\Framework\TestCase;
use SimpleXMLElement;

class RSSBuilderTest extends TestCase
{

    public function testRssBuilder(): RSSBuilder
    {
        $siteUrl = 'https://www.bbc.com/';
        $xpath = '//h3[contains(@class, "media__title")]/a';
        $rssBuilder = new RSSBuilder($siteUrl, $xpath);
        self::assertIsObject($rssBuilder);
        return $rssBuilder;
    }

    /**
     * @depends testRssBuilder
     */
    public function testGetJSON(RSSBuilder $rssBuilder)
    {
        $json = $rssBuilder->getJSON();
        $links = json_decode($json);
        self::assertIsArray($links);
        $firstLink = $links[0];
        self::assertIsString($firstLink->url);
    }

    /**
     * @depends testRssBuilder
     * @throws \Exception
     */
    public function testGetRSS(RSSBuilder $rssBuilder)
    {
        $rss = $rssBuilder->getRSS();
        $x = new SimpleXMLElement($rss);
        $entry = $x->channel->item[0];
        $link = (string)$entry->link;
        self::assertIsString($link);
    }
}
