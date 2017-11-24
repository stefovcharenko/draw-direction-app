<?php

use yii\helpers\Html;
use app\models\Flight;

/* @var $vehicle */
?>

<?= Html::label('Оберіть політ'); ?>
<?= Html::dropDownList('flight', '', Flight::getAvailableFlightsForVehicle($vehicle), [
    'class' => 'form-control',
    'id' => 'flight-id',
]); ?>