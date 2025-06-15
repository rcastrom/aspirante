<?php

namespace App\Services;

use Exception;
use Illuminate\Http\UploadedFile;

final class MaxUploadSizeService
{
    const BYTES = 'B';
    const KILOBYTES = 'KB';
    const MEGABYTES = 'MB';
    const GIGABYTES = 'GB';

    private static array $sizeTypes = [
        self::BYTES,
        self::KILOBYTES,
        self::MEGABYTES,
        self::GIGABYTES,
    ];

    /**
     * @throws Exception
     */
    public static function getMaxUploadSize(string $desired = '2M', string $sizeType = 'MB'): int|float
    {
        if (! in_array($sizeType, self::$sizeTypes))
        {
            throw new Exception('Size type not found!');
        }

        $desiredMaxSize = ini_parse_quantity($desired);

        $phpIniMaxSize = UploadedFile::getMaxFilesize();

        $maxSize = min($desiredMaxSize, $phpIniMaxSize);

        return self::convert($maxSize, $sizeType);
    }

    private static function convert(int $bytes, string $sizeType): int|float
    {
        $divisor = pow(1024, array_search($sizeType, self::$sizeTypes));

        return $bytes / $divisor;
    }

}
