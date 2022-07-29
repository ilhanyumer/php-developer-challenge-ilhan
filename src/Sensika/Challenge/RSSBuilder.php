<?php

namespace Sensika\Challenge;

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
     *
     * @param string $siteUrl - input site URL
     */
    public function __construct(string $siteUrl)
    {
        $this->siteUrl = $siteUrl;
    }

    /**
     *
     */
    public function getRSS(): string
    {
        $rss = '';
        // @TODO implement method
        return $rss;
    }

    /**
     * @return string
     */
    public function getJSON(): string
    {
        $json = '';
        // @TODO implement method
        return $json;
    }

}