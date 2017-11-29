<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $flightModel app\models\Flight */
/* @var $coordinatePairs app\models\FlightDetail[] */

$this->title = 'Додати політ';
$this->params['breadcrumbs'][] = ['label' => 'Польоти', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flight-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'flightModel' => $flightModel,
        'coordinatePairs' => $coordinatePairs
    ]) ?>

</div>
