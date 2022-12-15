<?php

    namespace App\Enums;

    use BenSampo\Enum\Enum;

    /**
     * @method static static OptionOne()
     * @method static static OptionTwo()
     * @method static static OptionThree()
     */
    final class CompanyCountryEnum extends Enum
    {
        public const VN = 'VietNam';
        public const US = 'United States';
        public const UK = 'United Kingdom';
        public const KR = 'Korea';
        public const CN = 'China';
        public const JP = 'Japan';

    }
