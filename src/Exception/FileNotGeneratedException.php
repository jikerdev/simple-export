<?php
declare(strict_types=1);

namespace Jikerdev\SimpleExport\Exception;

class FileNotGeneratedException extends \Exception
{
    public function __construct($message = "File not generated yet", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
