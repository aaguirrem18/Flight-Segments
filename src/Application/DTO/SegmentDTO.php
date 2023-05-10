<?php

namespace App\Application\DTO;

use DateTimeImmutable;

/**
 * Class SegmentDTO
 * @package App\Application\DTO
 */
final class SegmentDTO
{
    private string $originCode;
    private string $originName;
    private string $destinationCode;
    private string $destinationName;
    private ?DateTimeImmutable $start;
    private ?DateTimeImmutable $end;
    private string $transportNumber;
    private string $companyCode;
    private string $companyName;

    public function __construct(
        $originCode = '',
        $originName = '',
        $destinationCode = '',
        $destinationName = '',
        $start = null,
        $end = null,
        $transportNumber = '',
        $companyCode = '',
        $companyName = ''
    ) {
        $this->originCode = $originCode;
        $this->originName = $originName;
        $this->destinationCode = $destinationCode;
        $this->destinationName = $destinationName;
        $this->start = $start;
        $this->end = $end;
        $this->transportNumber = $transportNumber;
        $this->companyCode = $companyCode;
        $this->companyName = $companyName;
    }

    public function getOriginCode(): string
    {
        return $this->originCode;
    }

    public function getOriginName(): string
    {
        return $this->originName;
    }

    public function getDestinationCode(): string
    {
        return $this->destinationCode;
    }

    public function getDestinationName(): string
    {
        return $this->destinationName;
    }

    public function getStart(): ?DateTimeImmutable
    {
        return $this->start;
    }

    public function getEnd(): ?DateTimeImmutable
    {
        return $this->end;
    }

    public function getTransportNumber(): string
    {
        return $this->transportNumber;
    }

    public function getCompanyCode(): string
    {
        return $this->companyCode;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }


    public function formattedArray()
    {
        $segment = get_object_vars($this);

        $formattedArray = array_map(function ($item) {
            if ($item instanceof DateTimeImmutable) {
                return $item->format('Y-m-d H:i:s');
            }
            return $item;
        }, $segment);

        return $formattedArray;
    }
}
