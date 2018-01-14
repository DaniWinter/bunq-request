<?php
namespace bunq\sdk\examples;

use bunq\Context\ApiContext;
use bunq\Http\ApiClient;
use bunq\Model\Generated\Endpoint\AttachmentPublic;
use bunq\Model\Generated\Endpoint\AttachmentPublicContent;

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Example constants.
 */
const FILENAME_RESULT_ATTACHMENT = '/result_attachment.jpg';
const FILENAME_EXAMPLE_ATTACHMENT = '/example_attachment.jpg';
const CONTENT_TYPE_IMAGE_JPEG = 'image/jpeg';
const ATTACHMENT_DESCRIPTION = 'My awesome image';

// Restore the API context.
$apiContext = ApiContext::restore(ApiContext::FILENAME_CONFIG_DEFAULT);

// Create public attachment request map.
$attachmentPublicBytes = file_get_contents(__DIR__ . FILENAME_EXAMPLE_ATTACHMENT);
$attachmentPublicHeadersMap = [
    ApiClient::HEADER_CONTENT_TYPE => CONTENT_TYPE_IMAGE_JPEG,
    ApiClient::HEADER_ATTACHMENT_DESCRIPTION => ATTACHMENT_DESCRIPTION,
];

// Create public attachment.
$attachmentPublicUuid = AttachmentPublic::create($apiContext, $attachmentPublicBytes, $attachmentPublicHeadersMap)
    ->getValue();

// Download the attachment again.
$attachmentFile = AttachmentPublicContent::listing($apiContext, $attachmentPublicUuid)->getValue();

file_put_contents(__DIR__ . FILENAME_RESULT_ATTACHMENT, $attachmentFile);
