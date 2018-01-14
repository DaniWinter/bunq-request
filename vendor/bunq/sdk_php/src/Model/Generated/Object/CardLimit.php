<?php
namespace bunq\Model\Generated\Object;

use bunq\Model\Core\BunqModel;

/**
 * @generated
 */
class CardLimit extends BunqModel
{
    /**
     * The daily limit amount.
     *
     * @var string
     */
    protected $dailyLimit;

    /**
     * Currency for the daily limit.
     *
     * @var string
     */
    protected $currency;

    /**
     * The type of transaction for the limit. Can be CARD_LIMIT_ATM,
     * CARD_LIMIT_CONTACTLESS, CARD_LIMIT_DIPPING or CARD_LIMIT_POS_ICC.
     *
     * @var string
     */
    protected $type;

    /**
     * The id of the card limit entry.
     *
     * @var int
     */
    protected $id;

    /**
     * @param string $dailyLimit
     * @param string $currency
     * @param string $type
     */
    public function __construct($dailyLimit, $currency, $type)
    {
        $this->dailyLimit = $dailyLimit;
        $this->currency = $currency;
        $this->type = $type;
    }

    /**
     * The id of the card limit entry.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * The daily limit amount.
     *
     * @return string
     */
    public function getDailyLimit()
    {
        return $this->dailyLimit;
    }

    /**
     * @param string $dailyLimit
     */
    public function setDailyLimit($dailyLimit)
    {
        $this->dailyLimit = $dailyLimit;
    }

    /**
     * Currency for the daily limit.
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * The type of transaction for the limit. Can be CARD_LIMIT_ATM,
     * CARD_LIMIT_CONTACTLESS, CARD_LIMIT_DIPPING or CARD_LIMIT_POS_ICC.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function isAllFieldNull()
    {
        if (!is_null($this->id)) {
            return false;
        }

        if (!is_null($this->dailyLimit)) {
            return false;
        }

        if (!is_null($this->currency)) {
            return false;
        }

        if (!is_null($this->type)) {
            return false;
        }

        return true;
    }
}
