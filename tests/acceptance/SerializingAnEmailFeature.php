<?php

namespace tests\acceptance\SelrahcD\Lazy;

use SelrahcD\Lazy\ContentStore;
use SelrahcD\Lazy\EmailSerializer;
use SelrahcD\Lazy\EmailStore;
use SelrahcD\Lazy\LazyContent;
use SelrahcD\Lazy\MemoryContent;
use SelrahcD\Lazy\Email;
use SelrahcD\Lazy\StoredContentDeserializer;
use SelrahcD\Lazy\StoredContentSerializer;
use SelrahcD\Lazy\ValueContentDeserializer;
use SelrahcD\Lazy\ValueContentSerializer;

final class SerializingAnEmailFeature extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function Storage()
    {
        $contentStore = new ContentStore();

        $email = new Email(new MemoryContent('A content'));

        // Storage
        $store = new EmailStore($contentStore);

        $store->store($email);

        $email = $store->retrieveEmail();

        $this->assertInstanceOf(LazyContent::class, $email->content());
        $this->assertEquals('A content', $email->content());
    }

    /**
     * @test
     */
    public function Serialization_BUS_Deserialization_Storage()
    {
        $contentStore = new ContentStore();

        $serializer = new EmailSerializer(
            new StoredContentSerializer($contentStore),
            new StoredContentDeserializer($contentStore));

        $email = new Email(new MemoryContent('A content'));

        // Serialization
        $serializedEmail = $serializer->serialize($email);

        // Email goes in bus
        // Fake fake fake

        // Deserialization
        $deserializedEmail = $serializer->deserialize($serializedEmail);

        // Storage
        $store = new EmailStore($contentStore);

        $store->store($deserializedEmail);

        $email = $store->retrieveEmail();

        $this->assertEquals('A content', $email->content());
    }
}