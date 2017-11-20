<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FlightVehicle */

$this->title = 'Додати новий БПЛА';
$this->params['breadcrumbs'][] = ['label' => 'БПЛА', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flight-vehicle-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
