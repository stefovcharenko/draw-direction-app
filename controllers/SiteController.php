<?php

namespace app\controllers;

use app\models\FlightVehicle;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $params = [
            'vehicleModel' => new FlightVehicle,
        ];
        return $this->render('index', $params);
    }
}
