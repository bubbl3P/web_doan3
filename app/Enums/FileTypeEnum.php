<?php

    namespace App\Enums;

    use BenSampo\Enum\Enum;

    /**
     */
    final class FileTypeEnum extends Enum
    {
        public const JD = '1';
        public const CV = '2';

        public static function getFileTypeKey(): array
        {

           return self::asArray();
        }
    }
