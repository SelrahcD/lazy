<?php

namespace SelrahcD\Lazy;

final class Email
{
    /**
     * @var Content
     */
    private $content;

    /**
     * Email constructor.
     * @param Content $content
     */
    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    /**
     * @return Content
     */
    public function content()
    {
        return $this->content;
    }

    public function changeContent($newContent)
    {
        $this->content = $this->content->change($newContent);
    }
}