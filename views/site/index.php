<?php
use \app\models\FlightVehicle;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="site-index">
    <?= Html::label('Оберіть БПЛА'); ?>
    <?= Html::dropDownList('vehicle', '', FlightVehicle::getVehiclesList(), [
        'class' => 'form-control',
        'id' => 'flightvehicle-id',
    ]); ?>

    <div class="flights"></div>
    <div class="map" style="height: 500px"></div>
</div>
