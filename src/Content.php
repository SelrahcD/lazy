<?php namespace SelrahcD\Lazy;

interface Content
{
    public function __toString();

    /**
     * @param $newValue
     * @return Content
     */
    public function change($newValue);

    /**
     * @param ContentStore $contentStore
     * @return LazyContent
     */
    public function store(ContentStore $contentStore);
}