<?php
namespace bunq\Model\Generated\Endpoint;

use bunq\Context\ApiContext;
use bunq\Http\ApiClient;
use bunq\Http\BunqResponse;
use bunq\Model\Core\BunqModel;
use bunq\Model\Generated\Object\LabelMonetaryAccount;

/**
 * The public endpoint for retrieving and updating a promotion display
 * model.
 *
 * @generated
 */
class PromotionDisplay extends BunqModel
{
    /**
     * Endpoint constants.
     */
    const ENDPOINT_URL_READ = 'user/%s/promotion-display/%s';
    const ENDPOINT_URL_UPDATE = 'user/%s/promotion-display/%s';

    /**
     * Field constants.
     */
    const FIELD_STATUS = 'status';

    /**
     * Object type.
     */
    const OBJECT_TYPE = 'PromotionDisplay';

    /**
     * The id of the promotion.
     *
     * @var int
     */
    protected $id;

    /**
     * The alias of the user you received the promotion from.
     *
     * @var LabelMonetaryAccount
     */
    protected $counterpartyAlias;

    /**
     * The event description of the promotion appearing on time line.
     *
     * @var string
     */
    protected $eventDescription;

    /**
     * The status of the promotion. (CREATED, CLAIMED, EXPIRED, DISCARDED)
     *
     * @var string
     */
    protected $status;

    /**
     * @param ApiContext $apiContext
     * @param int $userId
     * @param int $promotionDisplayId
     * @param string[] $customHeaders
     *
     * @return BunqResponsePromotionDisplay
     */
    public static function get(ApiContext $apiContext, int $userId, int $promotionDisplayId, array $customHeaders = []): BunqResponsePromotionDisplay
    {
        $apiClient = new ApiClient($apiContext);
        $responseRaw = $apiClient->get(
            vsprintf(
                self::ENDPOINT_URL_READ,
                [$userId, $promotionDisplayId]
            ),
            [],
            $customHeaders
        );

        return BunqResponsePromotionDisplay::castFromBunqResponse(
            static::fromJson($responseRaw, self::OBJECT_TYPE)
        );
    }

    /**
     * @param ApiContext $apiContext
     * @param mixed[] $requestMap
     * @param int $userId
     * @param int $promotionDisplayId
     * @param string[] $customHeaders
     *
     * @return BunqResponseInt
     */
    public static function update(ApiContext $apiContext, array $requestMap, int $userId, int $promotionDisplayId, array $customHeaders = []): BunqResponseInt
    {
        $apiClient = new ApiClient($apiContext);
        $responseRaw = $apiClient->put(
            vsprintf(
                self::ENDPOINT_URL_UPDATE,
                [$userId, $promotionDisplayId]
            ),
            $requestMap,
            $customHeaders
        );

        return BunqResponseInt::castFromBunqResponse(
            static::processForId($responseRaw)
        );
    }

    /**
     * The id of the promotion.
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
     * The alias of the user you received the promotion from.
     *
     * @return LabelMonetaryAccount
     */
    public function getCounterpartyAlias()
    {
        return $this->counterpartyAlias;
    }

    /**
     * @param LabelMonetaryAccount $counterpartyAlias
     */
    public function setCounterpartyAlias($counterpartyAlias)
    {
        $this->counterpartyAlias = $counterpartyAlias;
    }

    /**
     * The event description of the promotion appearing on time line.
     *
     * @return string
     */
    public function getEventDescription()
    {
        return $this->eventDescription;
    }

    /**
     * @param string $eventDescription
     */
    public function setEventDescription($eventDescription)
    {
        $this->eventDescription = $eventDescription;
    }

    /**
     * The status of the promotion. (CREATED, CLAIMED, EXPIRED, DISCARDED)
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function isAllFieldNull()
    {
        if (!is_null($this->id)) {
            return false;
        }

        if (!is_null($this->counterpartyAlias)) {
            return false;
        }

        if (!is_null($this->eventDescription)) {
            return false;
        }

        if (!is_null($this->status)) {
            return false;
        }

        return true;
    }
}
