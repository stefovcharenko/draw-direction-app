<?php

use yii\helpers\Html;
use \app\helpers\FlightHelper;

/* @var int $counter */
/* @var \app\models\FlightDetail $coordinateModel */
?>

<div class="row" id="coordinate-row-<?= $counter ?>">
    <div class="col-xs-3">
        <?= $form->field($coordinateModel, "[$counter]latitude")->textInput(); ?>
    </div>
    <div class="col-xs-3">
        <?= $form->field($coordinateModel, "[$counter]longitude")->textInput(); ?>
    </div>
    <div class="col-xs-3">
        <?= $form->field($coordinateModel, "[$counter]type")->dropDownList(FlightHelper::getCoordinateTypesList()); ?>
    </div>
    <div class="col-xs-3">
        <?= Html::button('-', [
            'class' => 'btn btn-danger delete-coordinate',
            'data-row' => "coordinate-row-{$counter}",
            'data-number' => $counter,
            'data-id' => '',
        ])?>
    </div>
</div>