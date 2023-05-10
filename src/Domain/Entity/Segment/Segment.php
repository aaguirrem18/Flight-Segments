<?php

declare(strict_types=1);

namespace  App\Domain\Entity\Segment;

use DateTimeImmutable;

/**
 * Class Segment
 * @package App\Domain\Entity\Segment
 */
class Segment
{

    /**
     * Origin IATA code, for example PMI
     * @example PMI
     */
    private string $originCode;

    /**
     * Origin name, for example Palma de Mallorca
     * @example Palma de Mallorca
     */
    private string $originName;

    /**
     * Destination IATA code, for example MAD
     * @example MAD
     */
    private string $destinationCode;

    /**
     * Destination IATA code, for example MAD
     * @example Madrid Adolfo Suárez Barajas
     */
    private string $destinationName;

    /**
     * Departure date time
     */
    private ?DateTimeImmutable $start;

    /**
     * Arrival date time
     */
    private ?DateTimeImmutable $end;

    /**
     * Transport or flight number
     * @example 3975
     */
    private string $transportNumber;

    /**
     * Company / airline code
     * @example IB
     */
    private string $companyCode;

    /**
     * Company / airline name
     * @example Iberia
     */
    private string $companyName;

    /**
     * @return string
     */
    public function getOriginCode(): string
    {
        return $this->originCode;
    }

    /**
     * @param string $originCode
     * @return Segment
     */
    public function setOriginCode(string $originCode): Segment
    {
        $this->originCode = $originCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginName(): string
    {
        return $this->originName;
    }

    /**
     * @param string $originName
     * @return Segment
     */
    public function setOriginName(string $originName): Segment
    {
        $this->originName = $originName;
        return $this;
    }

    /**
     * @return string
     */
    public function getDestinationCode(): string
    {
        return $this->destinationCode;
    }

    /**
     * @param string $destinationCode
     * @return Segment
     */
    public function setDestinationCode(string $destinationCode): Segment
    {
        $this->destinationCode = $destinationCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getDestinationName(): string
    {
        return $this->destinationName;
    }

    /**
     * @param string $destinationName
     * @return Segment
     */
    public function setDestinationName(string $destinationName): Segment
    {
        $this->destinationName = $destinationName;
        return $this;
    }

    /**
     * @return ?DateTimeImmutable
     */
    public function getStart(): ?DateTimeImmutable
    {
        return $this->start;
    }

    /**
     * @param ?DateTimeImmutable $start
     * @return Segment
     */
    public function setStart(?DateTimeImmutable $start): Segment
    {
        $this->start = $start;
        return $this;
    }

    /**
     * @return ?DateTimeImmutable
     */
    public function getEnd(): ?DateTimeImmutable
    {
        return $this->end;
    }

    /**
     * @param ?DateTimeImmutable $end
     * @return Segment
     */
    public function setEnd(?DateTimeImmutable $end): Segment
    {
        $this->end = $end;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransportNumber(): string
    {
        return $this->transportNumber;
    }

    /**
     * @param string $transportNumber
     * @return Segment
     */
    public function setTransportNumber(string $transportNumber): Segment
    {
        $this->transportNumber = $transportNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyCode(): string
    {
        return $this->companyCode;
    }

    /**
     * @param string $companyCode
     * @return Segment
     */
    public function setCompanyCode(string $companyCode): Segment
    {
        $this->companyCode = $companyCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    /**
     * @param string $companyName
     * @return Segment
     */
    public function setCompanyName(string $companyName): Segment
    {
        $this->companyName = $companyName;
        return $this;
    }
    
}
