<?php

declare(strict_types=1);

namespace League\Flysystem\Ftp;

use RuntimeException;

final class UnableToFtpPath extends RuntimeException implements FtpConnectionException
{
    public static function forPath(string $path): UnableToFtpPath
    {
        return new UnableToFtpPath("FTP path $path not found.");
    }
}
