<?php

namespace Console\contracts;


/**
 * Interface HtmlParserInterface
 * @package Console\contracts
 */
interface HtmlParserInterface
{
    /**
     * @param string $url
     * @return HtmlParserInterface
     */
    public function load(string $url);

    /**
     * @param $selector
     * @return string
     */
    public function getElements($selector);
}