<?php

namespace SelrahcD\Lazy;

final class LazyContent implements Content
{
    /**
     * @var ContentStore
     */
    private $contentStore;

    /**
     * @var
     */
    private $id;

    private $value;

    /**
     * LazyContent constructor.
     * @param ContentStore $contentStore
     * @param $id
     * @param String $value
     */
    private function __construct(ContentStore $contentStore, $id, $value = null)
    {
        $this->contentStore = $contentStore;
        $this->id = $id;
        $this->value = $value;
    }

    static public function fromValue(ContentStore $contentStore, $value)
    {
        return new self($contentStore, $contentStore->store($value), $value);
    }

    static public function fromId(ContentStore $contentStore, $id)
    {
        return new self($contentStore, $id);
    }

    public function __toString()
    {
        if($this->value === null)
        {
            $this->value = $this->contentStore->contentWithId($this->id);
        }

        return (string) $this->value;
    }

    /**
     * @param $newValue
     * @return Content
     */
    public function change($newValue)
    {
        $newContent = new self($this->contentStore, $this->contentStore->store($newValue), $newValue);

        return $newContent;
    }

    public function id()
    {
        return $this->id;
    }

    public function store(ContentStore $contentStore)
    {
        return $this;
    }
}