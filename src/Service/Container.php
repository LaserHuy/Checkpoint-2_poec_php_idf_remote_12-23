<?php

namespace App\Service;

class Container
{
    public const SMALL = 2;
    public const MEDIUM = 5;
    public const LARGE = 8;

    public function inbox($numberCake): array
    {
        // Calculate the number of containers for each size
        $numLarge = (int) ($numberCake / self::LARGE);
        $remainingCupcakes = $numberCake % self::LARGE;

        $numMedium = (int) ($remainingCupcakes / self::MEDIUM);
        $remainingCupcakes %= self::MEDIUM;

        $numSmall = (int) ceil($remainingCupcakes / self::SMALL);

        // If there are more than 2 small boxes, fill medium boxes first
        if ($numSmall >= 2) {
            $numMedium += (int) ($numSmall / 2);
            $numSmall %= 2;
        }

        // If there are both small and medium boxes, fill large boxes
        if ($numSmall > 0 && $numMedium > 0) {
            $numLarge += min($numSmall, $numMedium);
            $numMedium -= min($numSmall, $numMedium);
            $numSmall = 0;
        }

        return [$numLarge, $numMedium, max(0, $numSmall)];
    }
}
