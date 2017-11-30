<?php
use \app\models\FlightVehicle;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $flightModel app\models\Flight */
/* @var $coordinatePairs app\models\FlightDetail[] */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="flight-form">

    <?php $form = ActiveForm::begin([
        'id' => 'flight-form',
        'layout' => 'horizontal'
    ]); ?>

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

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row" style="display: flex; align-items: center">
                <div class="col-xs-10"><b>Координати</b></div>
                <div class="col-xs-2">
                    <?= Html::button('+', [
                        'class' => 'btn btn-success',
                        'id' => 'add-coordinate',
                        'data-counter' => count($coordinatePairs),
                    ])?>
                </div>
            </div>
        </div>
        <div class="panel-body coordinates-block">
            <?php foreach ($coordinatePairs as $key => $coordinatePair): ?>
                <div class="row" id="coordinate-row-<?= $key ?>">
                    <?php if ($coordinatePair->isNewRecord === false): ?>
                        <?= $form->field($coordinatePair, "[$key]id")->hiddenInput() ?>
                    <?php endif; ?>
                    <div class="col-xs-5">
                        <?= $form->field($coordinatePair, "[$key]latitude")->textInput(['type' => 'number']); ?>
                    </div>
                    <div class="col-xs-5">
                        <?= $form->field($coordinatePair, "[$key]longitude")->textInput(['type' => 'number']); ?>
                    </div>
                    <?php if ($key): ?>
                        <div class="col-xs-2">
                            <?= Html::button('-', [
                                'class' => 'btn btn-danger delete-coordinate',
                                'data-row' => "coordinate-row-{$key}",
                                'data-number' => $key,
                                'data-id' => $coordinatePair->id,
                            ])?>
                        </div>
                    <?php endif;?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($flightModel->isNewRecord ? 'Додати' : 'Редагувати', ['class' => $flightModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
