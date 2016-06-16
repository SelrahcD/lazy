<?php

use SelrahcD\Lazy\ContentStore;
use SelrahcD\Lazy\LazyContent;

class LazyContentTest extends PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function it_should_load_the_content_only_once_from_the_store()
    {
        $contentStore = Mockery::mock(ContentStore::class);
        $contentStore->shouldReceive('contentWithId')->once()->andReturn('Something');

        $lazyContent = LazyContent::fromId($contentStore, 1);

        $lazyContent->__toString();
        $lazyContent->__toString();

    }

    /**
     * @test
     */
    public function it_should_not_load_content_from_store_when_value_has_changed()
    {
        $contentStore = Mockery::mock(ContentStore::class);
        $contentStore->shouldReceive('store');

        $originalLazyContent = LazyContent::fromId($contentStore, 1);
        $lazyContent = $originalLazyContent->change('New content');

        $lazyContent->__toString();

        $contentStore->shouldNotHaveReceived('contentWithId');
    }

    /**
     * @test
     */
    public function it_should_not_change_content_of_original_lazy_content_when_value_is_changed()
    {
        $contentStore = Mockery::mock(ContentStore::class);
        $contentStore->shouldReceive('store');
        $contentStore->shouldReceive('contentWithId')->with(1)->andReturn('Original content');

        $originalLazyContent = LazyContent::fromId($contentStore, 1);
        $lazyContent = $originalLazyContent->change('New content');

        $this->assertEquals('Original content', $originalLazyContent->__toString());
    }

    /**
     * @test
     */
    public function it_should_not_load_content_from_store_if_value_was_provided_at_instantiation()
    {
        $contentStore = Mockery::mock(ContentStore::class);
        $contentStore->shouldReceive('store');

        $lazyContent = LazyContent::fromValue($contentStore, 'A dummy content');

        $lazyContent->__toString();

        $contentStore->shouldNotHaveReceived('contentWithId');
    }

    /**
     * @test
     */
    public function it_should_store_value_when_built_from_value()
    {
        $contentStore = Mockery::mock(ContentStore::class);
        $contentStore->shouldReceive('store')->once()->with('A dummy content');

        LazyContent::fromValue($contentStore, 'A dummy content');
    }

    /**
     * @test
     */
    public function it_has_same_value_when_created_from_value_and_then_from_id()
    {
        $contenStore = new ContentStore();
        $lazyContentFromValue = LazyContent::fromValue($contenStore, 'A content');
        $lazyContentFromId = LazyContent::fromId($contenStore, $lazyContentFromValue->id());

        $this->assertEquals((string) $lazyContentFromValue, (string) $lazyContentFromId);
    }

    protected function tearDown()
    {
        Mockery::close();
    }
}
