<?php
declare(strict_types=1);

namespace WoohooLabs\Yin\Examples\Book\JsonApi\Document;

use WoohooLabs\Yin\Examples\Book\JsonApi\Resource\AuthorResourceTransformer;
use WoohooLabs\Yin\JsonApi\Document\AbstractCollectionDocument;
use WoohooLabs\Yin\JsonApi\Schema\JsonApiObject;
use WoohooLabs\Yin\JsonApi\Schema\Link;
use WoohooLabs\Yin\JsonApi\Schema\Links;

class AuthorsDocument extends AbstractCollectionDocument
{
    /**
     * @var string
     */
    protected $bookId;

    /**
     * @var array
     */
    protected $domainObject;

    public function __construct(AuthorResourceTransformer $transformer, string $bookId)
    {
        parent::__construct($transformer);
        $this->bookId = $bookId;
    }

    /**
     * Provides information about the "jsonapi" member of the current document.
     *
     * The method returns a new JsonApiObject schema object if this member should be present or null
     * if it should be omitted from the response.
     *
     * @return JsonApiObject|null
     */
    public function getJsonApi()
    {
        return new JsonApiObject("1.0");
    }

    /**
     * Provides information about the "meta" member of the current document.
     *
     * The method returns an array of non-standard meta information about the document. If
     * this array is empty, the member won't appear in the response.
     */
    public function getMeta(): array
    {
        return [];
    }

    /**
     * Provides information about the "links" member of the current document.
     *
     * The method returns a new Links schema object if you want to provide linkage data
     * for the document or null if the section should be omitted from the response.
     *
     * @return Links|null
     */
    public function getLinks()
    {
        return Links::createWithoutBaseUri(
            [
                "self" => new Link("/?path=/books/" . $this->bookId . "/authors")
            ]
        );
    }
}
