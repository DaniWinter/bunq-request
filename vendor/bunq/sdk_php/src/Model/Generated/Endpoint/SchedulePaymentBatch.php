<?php
namespace bunq\Model\Generated\Endpoint;

use bunq\Context\ApiContext;
use bunq\Http\ApiClient;
use bunq\Http\BunqResponse;
use bunq\Model\Core\BunqModel;
use bunq\Model\Generated\Object\SchedulePaymentEntry;

/**
 * Endpoint for schedule payment batches.
 *
 * @generated
 */
class SchedulePaymentBatch extends BunqModel
{
    /**
     * Endpoint constants.
     */
    const ENDPOINT_URL_CREATE = 'user/%s/monetary-account/%s/schedule-payment-batch';
    const ENDPOINT_URL_UPDATE = 'user/%s/monetary-account/%s/schedule-payment-batch/%s';
    const ENDPOINT_URL_DELETE = 'user/%s/monetary-account/%s/schedule-payment-batch/%s';

    /**
     * Field constants.
     */
    const FIELD_PAYMENTS = 'payments';
    const FIELD_SCHEDULE = 'schedule';

    /**
     * Object type.
     */
    const OBJECT_TYPE = 'ScheduledPaymentBatch';

    /**
     * The payment details.
     *
     * @var SchedulePaymentEntry[]
     */
    protected $payments;

    /**
     * The schedule details.
     *
     * @var Schedule
     */
    protected $schedule;

    /**
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
     * @param ApiContext $apiContext
     * @param mixed[] $requestMap
     * @param int $userId
     * @param int $monetaryAccountId
     * @param int $schedulePaymentBatchId
     * @param string[] $customHeaders
     *
     * @return BunqResponseSchedulePaymentBatch
     */
    public static function update(ApiContext $apiContext, array $requestMap, int $userId, int $monetaryAccountId, int $schedulePaymentBatchId, array $customHeaders = []): BunqResponseSchedulePaymentBatch
    {
        $apiClient = new ApiClient($apiContext);
        $responseRaw = $apiClient->put(
            vsprintf(
                self::ENDPOINT_URL_UPDATE,
                [$userId, $monetaryAccountId, $schedulePaymentBatchId]
            ),
            $requestMap,
            $customHeaders
        );

        return BunqResponseSchedulePaymentBatch::castFromBunqResponse(
            static::fromJson($responseRaw, self::OBJECT_TYPE)
        );
    }

    /**
     * @param ApiContext $apiContext
     * @param string[] $customHeaders
     * @param int $userId
     * @param int $monetaryAccountId
     * @param int $schedulePaymentBatchId
     *
     * @return BunqResponseNull
     */
    public static function delete(ApiContext $apiContext, int $userId, int $monetaryAccountId, int $schedulePaymentBatchId, array $customHeaders = []): BunqResponseNull
    {
        $apiClient = new ApiClient($apiContext);
        $responseRaw = $apiClient->delete(
            vsprintf(
                self::ENDPOINT_URL_DELETE,
                [$userId, $monetaryAccountId, $schedulePaymentBatchId]
            ),
            $customHeaders
        );

        return BunqResponseNull::castFromBunqResponse(
            new BunqResponse(null, $responseRaw->getHeaders())
        );
    }

    /**
     * The payment details.
     *
     * @return SchedulePaymentEntry[]
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * @param SchedulePaymentEntry[] $payments
     */
    public function setPayments($payments)
    {
        $this->payments = $payments;
    }

    /**
     * The schedule details.
     *
     * @return Schedule
     */
    public function getSchedule()
    {
        return $this->schedule;
    }

    /**
     * @param Schedule $schedule
     */
    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * @return bool
     */
    public function isAllFieldNull()
    {
        if (!is_null($this->payments)) {
            return false;
        }

        if (!is_null($this->schedule)) {
            return false;
        }

        return true;
    }
}
