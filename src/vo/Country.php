<?php
declare(strict_types=1);

namespace dmitridad\oksm\vo;

use dmitridad\oksm\OKSM;

final class Country implements \JsonSerializable
{
    /**
     * @param string $code
     * @param string|null $name
     * @param string|null $shortName
     * @param string|null $alfa2
     * @param string|null $alfa3
     */
    public function __construct(
        private string $code,
        private ?string $name = null,
        private ?string $shortName = null,
        private ?string $alfa2 = null,
        private ?string $alfa3 = null
    )
    {
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    /**
     * @return string|null
     */
    public function getAlfa2(): ?string
    {
        return $this->alfa2;
    }

    /**
     * @return string|null
     */
    public function getAlfa3(): ?string
    {
        return $this->alfa3;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}