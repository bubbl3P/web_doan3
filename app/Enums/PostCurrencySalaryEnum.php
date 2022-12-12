<?php

    namespace App\Enums;

    use BenSampo\Enum\Enum;

    /**
     * @method static static OptionOne()
     * @method static static OptionTwo()
     * @method static static OptionThree()
     */
    final class PostCurrencySalaryEnum extends Enum
    {
        public const VND = '1';
        public const USD = '2';
        public const EUR = '3';
        public const JPY = '4';
        public const KRW = '5';
        public const CNY = '6';
        public const RUB = '7';
        public const GBP = '8';

    }
