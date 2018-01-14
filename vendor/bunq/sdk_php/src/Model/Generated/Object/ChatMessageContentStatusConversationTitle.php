<?php
namespace bunq\Model\Generated\Object;

use bunq\Model\Core\BunqModel;

/**
 * @generated
 */
class ChatMessageContentStatusConversationTitle extends BunqModel
{
    /**
     * The new title of a conversation.
     *
     * @var string
     */
    protected $title;

    /**
     * The new title of a conversation.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return bool
     */
    public function isAllFieldNull()
    {
        if (!is_null($this->title)) {
            return false;
        }

        return true;
    }
}
