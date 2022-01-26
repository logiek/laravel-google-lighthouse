<?php

declare(strict_types=1);

namespace Logiek\GoogleLighthouse\Exceptions;

use Exception;
use Throwable;

class InvalidFormatException extends Exception implements GoogleLighthouseException
{
    public function __construct($message = 'The provided format is not a valid output type.', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
