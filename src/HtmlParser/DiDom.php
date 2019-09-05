<?php

namespace Console\HtmlParser;


use Console\contracts\HtmlParserInterface;
use DiDom\Document;

/**
 * Class DiDom
 * @package Console\HtmlParser
 */
class DiDom implements HtmlParserInterface
{
    /**
     * @var Document
     */
    protected $document;

    /**
     * @param string $url
     */
    public function load(string $url)
    {
        $document = new Document($url, true);
        $this->document = $document;
    }

    /**
     * @param $selector
     * @return string
     */
    public function getElements($selector)
    {
        $sha = $this->document->find($selector);
        return $sha;
    }
}