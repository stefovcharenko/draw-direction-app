<?php
use \app\models\FlightVehicle;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $flightModel app\models\Flight */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="flight-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($flightModel, 'begin_time')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Введіть час початку польоту'],
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]); ?>

    <?= $form->field($flightModel, 'end_time')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Введіть час кінця польоту'],
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]) ?>

    <?= $form->field($flightModel, 'vehicle_id')
        ->dropDownList(FlightVehicle::getVehiclesList())
        ->label('БПЛА'); ?>

    <div class="form-group">
        <?= Html::submitButton($flightModel->isNewRecord ? 'Додати' : 'Редагувати', ['class' => $flightModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
