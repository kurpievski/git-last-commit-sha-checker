<?php

namespace Console\GitService;

/**
 * Class GitHub
 * @package Console\GitService
 */
class GitHub extends GitService
{
    const URL_PATTERN = 'https://github.com/:repo/commit/:branch';

    /**
     * @return string
     */
    public function getSha()
    {
        $parser = $this->parser;
        $url = $this->getUrl();
        $parser->load($url);

        $elements = $parser->getElements('.sha.user-select-contain');
        if (empty($elements) || !\is_array($elements)) {
            throw new \RuntimeException('Cannot find the element containing last commit. Checked url: '.$url);
        }

        return reset($elements)->text();
    }
}