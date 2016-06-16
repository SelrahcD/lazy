<?php

namespace SelrahcD\Lazy;

class ContentStore
{
    private $contents = [];

    public function store($contentValue)
    {
        $id = count($this->contents);

        $this->contents[$id] = $contentValue;

        return $id;
    }

    public function contentWithId($id)
    {
        return $this->contents[$id];
    }
}