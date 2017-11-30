<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Flight */

$this->params['breadcrumbs'][] = ['label' => 'Польоти', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Перегляд польоту';
?>
<div class="flight-view">
    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви дійсно хочете видалити цей політ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'begin_time',
            'end_time',
            'vehicle.name',
            [
                'label' => 'Координати',
                'value' => $coordinates,
                'format' => 'raw',
            ],
        ],
    ]) ?>

</div>
