<?php
/**
 * Class FlightHelper
 *
 * Represents additional logic for flights.
 */

namespace app\helpers;

use app\models\FlightDetail;

class FlightHelper
{
    /**
     * Returns coordinate types list.
     *
     * @return array
     */
    public static function getCoordinateTypesList()
    {
        return [
            FlightDetail::TYPE_PREFERRED => 'Реальна',
            FlightDetail::TYPE_REAL => 'Виміряна',
            FlightDetail::TYPE_APPROXIMATED => 'Апроксимована',
        ];
    }
}