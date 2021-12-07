<?php
declare(strict_types=1);

namespace dmitridad\oksm;

use dmitridad\oksm\vo\Country;

final class OKSM implements \dmitridad\oksm\contracts\OKSM, \JsonSerializable
{
    private const PATH_TO_COUNTRIES = __DIR__ . '/data/data-20160921T0100.json';

    /** @var OKSM|null */
    private static ?OKSM $instance = null;

    /** @var Country[] */
    private array $countries;

    private function __construct()
    {
        $countries = $this->parseJson();

        foreach ($countries as $country) {
            $this->countries[$country['CODE']] = new Country(
                $country['CODE'],
                $country['FULLNAME'] ?? null,
                $country['SHORTNAME'] ?? null,
                $country['ALFA2'] ?? null,
                $country['ALFA3'] ?? null
            );
        }

        ksort($this->countries);
    }

    private function __clone()
    {
    }

    /**
     * @throws \Exception
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }

    /**
     * @return array
     */
    private function parseJson(): array
    {
        return json_decode(file_get_contents(self::PATH_TO_COUNTRIES), true);
    }

    /**
     * @return OKSM|null
     */
    public static function getInstance(): ?OKSM
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param string $code
     * @return bool
     */
    public function isCodeValid(string $code): bool
    {
        return array_key_exists($code, $this->countries);
    }

    /**
     * @return Country[]
     */
    public function getCountries(): array
    {
        return $this->countries;
    }

    /**
     * @param string $code
     * @return Country|null
     */
    public function getCountryByCode(string $code): ?Country
    {
        if (!$this->isCodeValid($code)) {
            return null;
        }

        return $this->countries[$code];
    }

    /**
     * @return Country[]
     */
    public function jsonSerialize(): array
    {
        return $this->countries;
    }
}