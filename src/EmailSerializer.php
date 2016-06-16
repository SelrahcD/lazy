<?php

namespace SelrahcD\Lazy;

final class EmailSerializer
{
    /**
     * @var ContentSerializer
     */
    private $contentSerializer;
    /**
     * @var ContentDeserializer
     */
    private $contentDeserializer;

    /**
     * EmailRepository constructor.
     * @param ContentSerializer $contentSerializer
     * @param ContentDeserializer $contentDeserializer
     */
    public function __construct(ContentSerializer $contentSerializer, ContentDeserializer $contentDeserializer)
    {
        $this->contentSerializer = $contentSerializer;
        $this->contentDeserializer = $contentDeserializer;
    }


    public function serialize(Email $email)
    {
        return [
            'content' => $this->contentSerializer->serialize($email->content())
        ];
    }

    public function deserialize($serializedEmail)
    {
        return new Email($this->contentDeserializer->deserialize($serializedEmail['content']));
    }
}