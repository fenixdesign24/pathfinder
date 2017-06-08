<?php

class PathfinderTester
{
    /**
     * Runs all tests.
     */
    public static function run()
    {
        $tester = new static();
        $results = [];
        foreach (get_class_methods(static::class) as $method) {
            if (strpos($method, 'test') === 0) {
                $results[$method] = $tester->{$method}();
            }
        }

        static::renderResults($results);
    }

    /**
     * Displays results for finished tests.
     *
     * @param array $results
     */
    private static function renderResults(array $results)
    {
        foreach ($results as $testName => $result) {
            echo "$testName: " . ($result ? 'passed' : 'failed') . "\n";
        }
    }

    /**
     * Generates an ordered array of boarding cards.
     *
     * @return BoardingCard[]
     */
    private function getSortedCards(): array
    {
        /*
         * Take train 78A from Madrid to Barcelona. Sit in seat 45B.
         * Take the airport bus from Barcelona to Gerona Airport. No seat assignment.
         * From Gerona Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A.
         * Baggage drop at ticket counter 344.
         * From Stockholm, take flight SK22 to New York JFK. Gate 22, seat 7B.
         * Baggage will we automatically transferred from your last leg.
         * You have arrived at your final destination.
         */
        return [
            /* Take train 78A from Madrid to Barcelona. Sit in seat 45B. */
            new BoardingCard([
                'type' => BoardingCard::TYPE_TRAIN,
                'number' => '78A',
                'startPoint' => 'Madrid',
                'stopPoint' => 'Barcelona',
                'seat' => '45B',
            ]),
            /* Take the airport bus from Barcelona to Gerona Airport. No seat assignment. */
            new BoardingCard([
                'type' => BoardingCard::TYPE_BUS,
                'number' => 'airport',
                'startPoint' => 'Barcelona',
                'stopPoint' => 'Gerona Airport',
            ]),
            /* From Gerona Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A.
               Baggage drop at ticket counter 344. */
            new BoardingCard([
                'type' => BoardingCard::TYPE_FLIGHT,
                'number' => 'SK455',
                'startPoint' => 'Gerona Airport',
                'stopPoint' => 'Stockholm',
                'gate' => '45B',
                'seat' => '3A',
                'baggage' => '344',
            ]),
            /* From Stockholm, take flight SK22 to New York JFK. Gate 22, seat 7B.
               Baggage will we automatically transferred from your last leg. */
            new BoardingCard([
                'type' => BoardingCard::TYPE_FLIGHT,
                'number' => 'SK22',
                'startPoint' => 'Stockholm',
                'stopPoint' => 'New York JFK',
                'gate' => '22',
                'seat' => '7B',
                'baggageAuto' => true,
            ]),
        ];
    }

    private function testSort()
    {
        $sortedCards = $this->getSortedCards();
        $unorderedCards = $sortedCards;
        shuffle($unorderedCards);

        foreach (Pathfinder::sortCards($unorderedCards) as $i => $card) {
            if ($card !== $sortedCards[$i]) {
                return false;
            }
        }

        return true;
    }

    private function testGeneral()
    {
        $predefinedString = implode("\n", [
            'Take train 78A from Madrid to Barcelona. Sit in seat 45B.',
            'Take the airport bus from Barcelona to Gerona Airport. No seat assignment.',
            'From Gerona Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A.',
            'Baggage drop at ticket counter 344.',
            'From Stockholm, take flight SK22 to New York JFK. Gate 22, seat 7B.',
            'Baggage will we automatically transferred from your last leg.',
            'You have arrived at your final destination.',
        ]);

        $sortedCards = $this->getSortedCards();
        $unorderedCards = $sortedCards;
        shuffle($unorderedCards);

        $path = Pathfinder::findPath($unorderedCards);
        return $predefinedString === (string)$path;
    }
}
