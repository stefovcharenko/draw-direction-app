<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $flightModel app\models\Flight */

$this->title = 'Редагування польоту';
$this->params['breadcrumbs'][] = ['label' => 'Польоти', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flight-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'flightModel' => $flightModel,
    ]) ?>

</div>
