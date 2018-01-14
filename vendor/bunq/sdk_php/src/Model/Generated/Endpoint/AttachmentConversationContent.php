<?php
namespace bunq\Model\Generated\Endpoint;

use bunq\Context\ApiContext;
use bunq\Http\ApiClient;
use bunq\Http\BunqResponse;
use bunq\Model\Core\BunqModel;

/**
 * Fetch the raw content of an attachment with given ID. The raw content is
 * the base64 of a file, without any JSON wrapping.
 *
 * @generated
 */
class AttachmentConversationContent extends BunqModel
{
    /**
     * Endpoint constants.
     */
    const ENDPOINT_URL_LISTING = 'user/%s/chat-conversation/%s/attachment/%s/content';

    /**
     * Object type.
     */
    const OBJECT_TYPE = 'AttachmentConversationContent';

    /**
     * Get the raw content of a specific attachment.
     *
     * This method is called "listing" because "list" is a restricted PHP word
     * and cannot be used as constants, class names, function or method names.
     *
     * @param ApiContext $apiContext
     * @param int $userId
     * @param int $chatConversationId
     * @param int $attachmentId
     * @param string[] $customHeaders
     *
     * @return BunqResponseString
     */
    public static function listing(ApiContext $apiContext, int $userId, int $chatConversationId, int $attachmentId, array $customHeaders = []): BunqResponseString
    {
        $apiClient = new ApiClient($apiContext);
        $responseRaw = $apiClient->get(
            vsprintf(
                self::ENDPOINT_URL_LISTING,
                [$userId, $chatConversationId, $attachmentId]
            ),
            [],
            $customHeaders
        );

        return BunqResponseString::castFromBunqResponse(
            new BunqResponse($responseRaw->getBodyString(), $responseRaw->getHeaders())
        );
    }

    /**
     * @return bool
     */
    public function isAllFieldNull()
    {
        return true;
    }
}
