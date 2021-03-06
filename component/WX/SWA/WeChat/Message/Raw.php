<?php
namespace MComponent\WX\SWA\WeChat\Message;

/**
 * Class Raw.
 */
class Raw extends AbstractMessage
{
    /**
     * @var string
     */
    protected $type = 'raw';

    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = ['content'];

    /**
     * Constructor.
     *
     * @param string $content
     */
    public function __construct($content)
    {
        parent::__construct(['content' => strval($content)]);
    }
}
