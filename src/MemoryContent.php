<?php

namespace SelrahcD\Lazy;

final class MemoryContent implements Content
{
    private $value;

    /**
     * Content constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function __toString()
    {
        return (string) $this->value;
    }

    /**
     * @param $newValue
     * @return Content
     */
    public function change($newValue)
    {
        return new self($newValue);
    }

    public function store(ContentStore $contentStore)
    {
        return LazyContent::fromValue($contentStore, $this->value);
    }
}