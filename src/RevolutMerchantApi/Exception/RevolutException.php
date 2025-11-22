<?php
namespace RevolutMerchantApi\Exception;

use Exception;

class RevolutException extends Exception {

    /** @var string|null Revolut error code, např. "bad_request" */
    public ?string $errorCode;

    /** @var int|null HTTP status code, např. 400 */
    public ?int $httpStatus;

    public function __construct(
        string $message,
        ?string $errorCode = null,
        ?int $httpStatus = null,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, 0, $previous);

        $this->errorCode = $errorCode;
        $this->httpStatus = $httpStatus;
    }
}
