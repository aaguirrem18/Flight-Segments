<?php

namespace App\Application\DTO;

use App\Application\DTO\SegmentDTO;
use App\Domain\Entity\Segment\Segment;
use App\Domain\Segment\ValueObject\End;
use App\Domain\Segment\ValueObject\Start;
use App\Domain\Segment\ValueObject\OriginCode;
use App\Domain\Segment\ValueObject\OriginName;
use App\Domain\Segment\ValueObject\CompanyCode;
use App\Domain\Segment\ValueObject\CompanyName;
use App\Domain\Segment\ValueObject\DestinationCode;
use App\Domain\Segment\ValueObject\DestinationName;
use App\Domain\Segment\ValueObject\TransportNumber;

/**
 * Class SegmentMapper
 * @package App\Application\DTO
 */
final class SegmentMapper
{
    /**
     * @param SegmentDTO $segmentDTO
     * @return Segment
     */
    public function createEntity(SegmentDTO $segmentDTO): Segment
    {
        $segment = new Segment();
        $segment->setOriginCode($segmentDTO->getOriginCode());
        $segment->setOriginName($segmentDTO->getOriginName());
        $segment->setDestinationCode($segmentDTO->getDestinationCode());
        $segment->setDestinationName($segmentDTO->getDestinationName());
        $segment->setStart($segmentDTO->getStart());
        $segment->setEnd($segmentDTO->getEnd());
        $segment->setTransportNumber($segmentDTO->getTransportNumber());
        $segment->setCompanyCode($segmentDTO->getCompanyCode());
        $segment->setCompanyName($segmentDTO->getCompanyName());

        return $segment;
    }

    /**
     * @param Segment $segment
     * @return SegmentDTO
     */
    public function createDTO(Segment $segment): SegmentDTO
    {
        return new SegmentDTO(
            $segment->getOriginCode(),
            $segment->getOriginName(),
            $segment->getDestinationCode(),
            $segment->getDestinationName(),
            $segment->getStart(),
            $segment->getEnd(),
            $segment->getTransportNumber(),
            $segment->getCompanyName(),
            $segment->getCompanyCode(),
        );
    }
}
