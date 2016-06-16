<?php

namespace SelrahcD\Lazy;

final class EmailStore
{
    /**
     * @var ContentStore
     */
    private $contentStore;

    private $content;

    /**
     * EmailStore constructor.
     * @param ContentStore $contentStore
     */
    public function __construct(ContentStore $contentStore)
    {
        $this->contentStore = $contentStore;
    }

    public function store(Email $email)
    {
        $this->content = $email->content()->store($this->contentStore);
    }

    /**
     * @return Email
     */
    public function retrieveEmail()
    {
        return new Email($this->content);
    }
}