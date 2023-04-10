<?php

namespace Jiker\SimpleExport\Exception;

class FileNotGeneratedException extends \Exception
{
    public function __construct($message = "File not generated yet", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
