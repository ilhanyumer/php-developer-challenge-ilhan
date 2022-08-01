<?php

namespace App;

/**
 * A news, only one news, news itself
 */
class News implements \JsonSerializable
{
    private $url;
    private $title;

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function jsonSerialize(): array
    {
        return [
            'url' => $this->getUrl(),
            'title' => $this->getTitle(),
        ];
    }
}