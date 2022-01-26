<?php

declare(strict_types=1);

namespace Logiek\GoogleLighthouse\Exceptions;

use Exception;
use Throwable;

class AuditFailedException extends Exception implements GoogleLighthouseException
{
    public function __construct($message = 'Audit of the URL that you requested failed.', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
