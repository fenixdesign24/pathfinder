<?php


class Pathfinder
{
    /**
     * Sorts cards and creates an instance of the `Path` class.
     *
     * @param BoardingCard[] $boardingCards
     * @return Path
     */
    public static function findPath(array $boardingCards): Path
    {
        $sortedCards = static::sortCards($boardingCards);
        return new Path($sortedCards);
    }

    /**
     * @param BoardingCard[] $unorderedCards
     * @return BoardingCard[] Sorted boarding cards
     */
    public static function sortCards(array $unorderedCards): array
    {
        if (!$unorderedCards) {
            return [];
        }

        # Prepare data for sorting
        $startPoints = [];
        $stopPoints = [];
        $markedCards = [];
        foreach ($unorderedCards as $i => $card) {
            $markedCards[$card->getStartPoint()] = $card;
            $startPoints[] = $card->getStartPoint();
            $stopPoints[] = $card->getStopPoint();
        }

        # Point where we should start
        $startPoint = array_values(array_diff($startPoints, $stopPoints))[0];

        # Place cards in proper places
        $sortedCards = [];
        do {
            $card = $markedCards[$startPoint];
            $sortedCards[] = $card;
            $startPoint = $card->getStopPoint();
        } while (isset($markedCards[$startPoint]));

        return $sortedCards;
    }
}
