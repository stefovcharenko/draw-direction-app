<?php

use yii\helpers\Html;

/* @var int $counter */
/* @var \app\models\FlightDetail $coordinateModel */
?>

<div class="row" id="coordinate-row-<?= $counter ?>">
    <div class="col-xs-5">
        <?= $form->field($coordinateModel, "[$counter]latitude")->textInput(['type' => 'number']); ?>
    </div>
    <div class="col-xs-5">
        <?= $form->field($coordinateModel, "[$counter]longitude")->textInput(['type' => 'number']); ?>
    </div>
    <div class="col-xs-2">
        <?= Html::button('-', [
            'class' => 'btn btn-danger delete-coordinate',
            'data-row' => "coordinate-row-{$counter}",
            'data-id' => $counter,
        ])?>
    </div>
</div>