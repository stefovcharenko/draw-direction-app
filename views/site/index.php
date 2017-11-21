<?php
use \app\models\FlightVehicle;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $vehicleModel app\models\FlightVehicle */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="site-index">
    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal'
    ]); ?>
    <?= $form->field($vehicleModel, 'id')
        ->dropDownList(FlightVehicle::getVehiclesList())
        ->label('Оберіть БПЛА'); ?>

    <div class="flights"></div>
    <div class="map"></div>
    <?php $form::end(); ?>
</div>
