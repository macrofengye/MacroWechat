<?php
namespace WeChat\Utils\WeChat\Message;

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
     * @param array $content
     */
    public function __construct($content)
    {
        parent::__construct(['content' => strval($content)]);
    }
}
