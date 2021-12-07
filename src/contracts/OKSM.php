<?php
declare(strict_types=1);

namespace dmitridad\oksm\contracts;

use dmitridad\oksm\vo\Country;

interface OKSM
{
    public function isCodeValid(string $code): bool;

    public function getCountries(): array;

    public function getCountryByCode(string $code): ?Country;
}