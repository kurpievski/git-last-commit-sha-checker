<?php

namespace Console\GitService;


use Console\contracts\HtmlParserInterface;

/**
 * Class GitService
 * @package Console\GitService
 */
abstract class GitService
{
    const URL_PATTERN = ':repo :branch';

    /**
     * @var string
     */
    protected $repo;

    /**
     * @var string
     */
    protected $branch;

    /**
     * @var HtmlParserInterface
     */
    protected $parser;

    /**
     * GitHub constructor.
     * @param HtmlParserInterface $parser
     */
    public function __construct(HtmlParserInterface $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param string $repo
     */
    public function setRepo(string $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param string $branch
     */
    public function setBranch(string $branch)
    {
        $this->branch = $branch;
    }

    protected function getUrl()
    {
        return \str_replace([':repo', ':branch'], [$this->repo, $this->branch], static::URL_PATTERN);
    }

    /**
     * @return string
     */
    abstract public function getSha();
}