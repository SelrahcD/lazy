<?php

namespace SelrahcD\Lazy;

final class StoredContentSerializer implements ContentSerializer
{
    /**
     * @var ContentStore
     */
    private $contentStore;

    /**
     * StoredContentSerialiazer constructor.
     * @param ContentStore $contentStore
     */
    public function __construct(ContentStore $contentStore)
    {
        $this->contentStore = $contentStore;
    }

    public function serialize(Content $content)
    {
        $storedContent = $content->store($this->contentStore);

        return [
          'contentId' =>  $storedContent->id()
        ];
    }
}