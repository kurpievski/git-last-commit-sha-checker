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
        $parser->load($this->getUrl());

        return $parser->getElements('.sha.user-select-contain')[0]->text();
    }
}