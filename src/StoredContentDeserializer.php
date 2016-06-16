<?php

namespace SelrahcD\Lazy;

final class StoredContentDeserializer implements ContentDeserializer
{
    /**
     * @var ContentStore
     */
    private $contentStore;

    /**
     * StoredContentDeserializer constructor.
     * @param ContentStore $contentStore
     */
    public function __construct(ContentStore $contentStore)
    {
        $this->contentStore = $contentStore;
    }

    public function deserialize($serializedContent)
    {
        return LazyContent::fromId($this->contentStore, $serializedContent['contentId']);
    }
}