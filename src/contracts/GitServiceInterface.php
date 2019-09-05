<?php

namespace Console\contracts;


/**
 * Interface GitServiceInterface
 * @package Console\contracts
 */
interface GitServiceInterface
{
    /**
     * GitServiceInterface constructor.
     * @param HtmlParserInterface $parser
     */
    public function __construct(HtmlParserInterface $parser);

    /**
     * @param string $repo
     */
    public function setRepo(string $repo);

    /**
     * @param string $branch
     */
    public function setBranch(string $branch);

    /**
     * @return string
     */
    public function getSha();
}