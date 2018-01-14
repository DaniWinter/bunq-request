<?php
namespace bunq\Model\Generated\Endpoint;

use bunq\Context\ApiContext;
use bunq\Http\ApiClient;
use bunq\Http\BunqResponse;
use bunq\Model\Core\BunqModel;
use bunq\Model\Generated\Object\DraftPaymentAnchorObject;
use bunq\Model\Generated\Object\DraftPaymentEntry;
use bunq\Model\Generated\Object\DraftPaymentResponse;
use bunq\Model\Generated\Object\LabelUser;

/**
 * A DraftPayment is like a regular Payment, but it needs to be accepted by
 * the sending party before the actual Payment is done.
 *
 * @generated
 */
class DraftPayment extends BunqModel
{
    /**
     * Endpoint constants.
     */
    const ENDPOINT_URL_CREATE = 'user/%s/monetary-account/%s/draft-payment';
    const ENDPOINT_URL_UPDATE = 'user/%s/monetary-account/%s/draft-payment/%s';
    const ENDPOINT_URL_LISTING = 'user/%s/monetary-account/%s/draft-payment';
    const ENDPOINT_URL_READ = 'user/%s/monetary-account/%s/draft-payment/%s';

    /**
     * Field constants.
     */
    const FIELD_STATUS = 'status';
    const FIELD_ENTRIES = 'entries';
    const FIELD_PREVIOUS_UPDATED_TIMESTAMP = 'previous_updated_timestamp';
    const FIELD_NUMBER_OF_REQUIRED_ACCEPTS = 'number_of_required_accepts';

    /**
     * Object type.
     */
    const OBJECT_TYPE = 'DraftPayment';

    /**
     * The id of the created DrafPayment.
     *
     * @var int
     */
    protected $id;

    /**
     * The id of the MonetaryAccount the DraftPayment applies to.
     *
     * @var int
     */
    protected $monetaryAccountId;

    /**
     * The label of the User who created the DraftPayment.
     *
     * @var LabelUser
     */
    protected $userAliasCreated;

    /**
     * All responses to this draft payment.
     *
     * @var DraftPaymentResponse[]
     */
    protected $responses;

    /**
     * The status of the DraftPayment.
     *
     * @var string
     */
    protected $status;

    /**
     * The type of the DraftPayment.
     *
     * @var string
     */
    protected $type;

    /**
     * The entries in the DraftPayment.
     *
     * @var DraftPaymentEntry[]
     */
    protected $entries;

    /**
     * The Payment or PaymentBatch. This will only be present after the
     * DraftPayment has been accepted.
     *
     * @var DraftPaymentAnchorObject
     */
    protected $object;

    /**
     * Create a new DraftPayment.
     *
     * @param ApiContext $apiContext
     * @param mixed[] $requestMap
     * @param int $userId
     * @param int $monetaryAccountId
     * @param string[] $customHeaders
     *
     * @return BunqResponseInt
     */
    public static function create(ApiContext $apiContext, array $requestMap, int $userId, int $monetaryAccountId, array $customHeaders = []): BunqResponseInt
    {
        $apiClient = new ApiClient($apiContext);
        $responseRaw = $apiClient->post(
            vsprintf(
                self::ENDPOINT_URL_CREATE,
                [$userId, $monetaryAccountId]
            ),
            $requestMap,
            $customHeaders
        );

        return BunqResponseInt::castFromBunqResponse(
            static::processForId($responseRaw)
        );
    }

    /**
     * Update a DraftPayment.
     *
     * @param ApiContext $apiContext
     * @param mixed[] $requestMap
     * @param int $userId
     * @param int $monetaryAccountId
     * @param int $draftPaymentId
     * @param string[] $customHeaders
     *
     * @return BunqResponseInt
     */
    public static function update(ApiContext $apiContext, array $requestMap, int $userId, int $monetaryAccountId, int $draftPaymentId, array $customHeaders = []): BunqResponseInt
    {
        $apiClient = new ApiClient($apiContext);
        $responseRaw = $apiClient->put(
            vsprintf(
                self::ENDPOINT_URL_UPDATE,
                [$userId, $monetaryAccountId, $draftPaymentId]
            ),
            $requestMap,
            $customHeaders
        );

        return BunqResponseInt::castFromBunqResponse(
            static::processForId($responseRaw)
        );
    }

    /**
     * Get a listing of all DraftPayments from a given MonetaryAccount.
     *
     * This method is called "listing" because "list" is a restricted PHP word
     * and cannot be used as constants, class names, function or method names.
     *
     * @param ApiContext $apiContext
     * @param int $userId
     * @param int $monetaryAccountId
     * @param string[] $params
     * @param string[] $customHeaders
     *
     * @return BunqResponseDraftPaymentList
     */
    public static function listing(ApiContext $apiContext, int $userId, int $monetaryAccountId, array $params = [], array $customHeaders = []): BunqResponseDraftPaymentList
    {
        $apiClient = new ApiClient($apiContext);
        $responseRaw = $apiClient->get(
            vsprintf(
                self::ENDPOINT_URL_LISTING,
                [$userId, $monetaryAccountId]
            ),
            $params,
            $customHeaders
        );

        return BunqResponseDraftPaymentList::castFromBunqResponse(
            static::fromJsonList($responseRaw, self::OBJECT_TYPE)
        );
    }

    /**
     * Get a specific DraftPayment.
     *
     * @param ApiContext $apiContext
     * @param int $userId
     * @param int $monetaryAccountId
     * @param int $draftPaymentId
     * @param string[] $customHeaders
     *
     * @return BunqResponseDraftPayment
     */
    public static function get(ApiContext $apiContext, int $userId, int $monetaryAccountId, int $draftPaymentId, array $customHeaders = []): BunqResponseDraftPayment
    {
        $apiClient = new ApiClient($apiContext);
        $responseRaw = $apiClient->get(
            vsprintf(
                self::ENDPOINT_URL_READ,
                [$userId, $monetaryAccountId, $draftPaymentId]
            ),
            [],
            $customHeaders
        );

        return BunqResponseDraftPayment::castFromBunqResponse(
            static::fromJson($responseRaw, self::OBJECT_TYPE)
        );
    }

    /**
     * The id of the created DrafPayment.
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
     * The id of the MonetaryAccount the DraftPayment applies to.
     *
     * @return int
     */
    public function getMonetaryAccountId()
    {
        return $this->monetaryAccountId;
    }

    /**
     * @param int $monetaryAccountId
     */
    public function setMonetaryAccountId($monetaryAccountId)
    {
        $this->monetaryAccountId = $monetaryAccountId;
    }

    /**
     * The label of the User who created the DraftPayment.
     *
     * @return LabelUser
     */
    public function getUserAliasCreated()
    {
        return $this->userAliasCreated;
    }

    /**
     * @param LabelUser $userAliasCreated
     */
    public function setUserAliasCreated($userAliasCreated)
    {
        $this->userAliasCreated = $userAliasCreated;
    }

    /**
     * All responses to this draft payment.
     *
     * @return DraftPaymentResponse[]
     */
    public function getResponses()
    {
        return $this->responses;
    }

    /**
     * @param DraftPaymentResponse[] $responses
     */
    public function setResponses($responses)
    {
        $this->responses = $responses;
    }

    /**
     * The status of the DraftPayment.
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
     * The type of the DraftPayment.
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
     * The entries in the DraftPayment.
     *
     * @return DraftPaymentEntry[]
     */
    public function getEntries()
    {
        return $this->entries;
    }

    /**
     * @param DraftPaymentEntry[] $entries
     */
    public function setEntries($entries)
    {
        $this->entries = $entries;
    }

    /**
     * The Payment or PaymentBatch. This will only be present after the
     * DraftPayment has been accepted.
     *
     * @return DraftPaymentAnchorObject
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param DraftPaymentAnchorObject $object
     */
    public function setObject($object)
    {
        $this->object = $object;
    }

    /**
     * @return bool
     */
    public function isAllFieldNull()
    {
        if (!is_null($this->id)) {
            return false;
        }

        if (!is_null($this->monetaryAccountId)) {
            return false;
        }

        if (!is_null($this->userAliasCreated)) {
            return false;
        }

        if (!is_null($this->responses)) {
            return false;
        }

        if (!is_null($this->status)) {
            return false;
        }

        if (!is_null($this->type)) {
            return false;
        }

        if (!is_null($this->entries)) {
            return false;
        }

        if (!is_null($this->object)) {
            return false;
        }

        return true;
    }
}
