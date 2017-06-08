<?php


class Path extends ArrayObject
{
    /**
     * @param BoardingCard[] $boardingCards
     */
    public function __construct(array $boardingCards = [])
    {
        parent::__construct($boardingCards);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $parts = [];
        foreach ($this as $card) {
            /** @var BoardingCard $card */
            $str = '';
            switch ($card->getType()) {
                case BoardingCard::TYPE_BUS:
                    $str = $this->makeStringForBus($card);
                    break;
                case BoardingCard::TYPE_FLIGHT:
                    $str = $this->makeStringForFlight($card);
                    break;
                case BoardingCard::TYPE_TRAIN:
                    $str = $this->makeStringForTrain($card);
                    break;
            }
            $parts[] = $str;
            $baggage = $this->specifyBaggage($card);
            if ($baggage) {
                $parts[] = $baggage;
            }
        }

        $parts[] = 'You have arrived at your final destination.';

        return implode("\n", $parts);
    }

    /**
     * @param BoardingCard $card
     * @return string
     */
    private function makeStringForBus(BoardingCard $card): string
    {
        $str = "Take ";
        if ($card->getNumber() === 'airport') {
            $str .= 'the airport bus ';
        } else {
            $str .= "bus {$card->getNumber()} ";
        }

        return $str . "from {$card->getStartPoint()} to {$card->getStopPoint()}. " . $this->specifySeat($card);
    }

    /**
     * @param BoardingCard $card
     * @return string
     */
    private function makeStringForFlight(BoardingCard $card): string
    {
        return "From {$card->getStartPoint()}, take flight {$card->getNumber()} to {$card->getStopPoint()}. "
            . "Gate {$card->getGate()}, seat {$card->getSeat()}.";
    }

    /**
     * @param BoardingCard $card
     * @return string
     */
    private function makeStringForTrain(BoardingCard $card): string
    {
        return "Take train {$card->getNumber()} from {$card->getStartPoint()} to {$card->getStopPoint()}. "
            . $this->specifySeat($card);
    }

    /**
     * @param BoardingCard $card
     * @return string
     */
    private function specifySeat(BoardingCard $card): string
    {
        if ($card->getSeat()) {
            return "Sit in seat {$card->getSeat()}.";
        } else {
            return 'No seat assignment.';
        }
    }

    /**
     * @param BoardingCard $card
     * @return string
     */
    private function specifyBaggage(BoardingCard $card): string
    {
        if ($card->getBaggage()) {
            return "Baggage drop at ticket counter {$card->getBaggage()}.";
        } elseif ($card->isBaggageAuto()) {
            return "Baggage will we automatically transferred from your last leg.";
        } else {
            return '';
        }
    }
}
