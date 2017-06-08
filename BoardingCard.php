<?php


class BoardingCard
{
    const TYPE_BUS = 1;
    const TYPE_FLIGHT = 2;
    const TYPE_TRAIN = 3;

    /** @var int Means of transportation */
    private $type;

    /** @var string [Optional] */
    private $number = '';

    /** @var string [Optional] */
    private $seat = '';

    /** @var string */
    private $startPoint;

    /** @var string */
    private $stopPoint;

    /** @var string [Optional] */
    private $gate = '';

    /** @var string [Optional] Place to drop a baggage */
    private $baggage = '';

    /** @var bool If true, baggage will be automatically transferred from previous location */
    private $baggageAuto = false;

    public function __construct(array $initialData = [])
    {
        foreach ($initialData as $key => $value) {
            if (!property_exists(static::class, $key)) {
                throw new UnexpectedValueException("Property '$key' doesn't exist in '" . static::class . "' class");
            }
            $this->{$key} = $value;
        }
    }


    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return BoardingCard
     */
    public function setType(int $type): BoardingCard
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getSeat(): string
    {
        return $this->seat;
    }

    /**
     * @param string $seat
     * @return BoardingCard
     */
    public function setSeat(string $seat): BoardingCard
    {
        $this->seat = $seat;
        return $this;
    }

    /**
     * @return string
     */
    public function getStartPoint(): string
    {
        return $this->startPoint;
    }

    /**
     * @param string $startPoint
     * @return BoardingCard
     */
    public function setStartPoint(string $startPoint): BoardingCard
    {
        $this->startPoint = $startPoint;
        return $this;
    }

    /**
     * @return string
     */
    public function getStopPoint(): string
    {
        return $this->stopPoint;
    }

    /**
     * @param string $stopPoint
     * @return BoardingCard
     */
    public function setStopPoint(string $stopPoint): BoardingCard
    {
        $this->stopPoint = $stopPoint;
        return $this;
    }

    /**
     * @return string
     */
    public function getGate(): string
    {
        return $this->gate;
    }

    /**
     * @param string $gate
     * @return BoardingCard
     */
    public function setGate($gate): BoardingCard
    {
        $this->gate = $gate;
        return $this;
    }

    /**
     * @return string
     */
    public function getBaggage(): string
    {
        return $this->baggage;
    }

    /**
     * @param string $baggage
     * @return BoardingCard
     */
    public function setBaggage(string $baggage): BoardingCard
    {
        $this->baggage = $baggage;
        return $this;
    }

    /**
     * @return bool
     */
    public function isBaggageAuto(): bool
    {
        return $this->baggageAuto;
    }

    /**
     * @param bool $baggageAuto
     * @return BoardingCard
     */
    public function setBaggageAuto(bool $baggageAuto): BoardingCard
    {
        $this->baggageAuto = $baggageAuto;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return BoardingCard
     */
    public function setNumber(string $number): BoardingCard
    {
        $this->number = $number;
        return $this;
    }
}
