<?php

namespace app\controllers;

use app\helpers\FlightHelper;
use app\models\FlightDetail;
use Yii;
use app\models\Flight;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * FlightController implements the CRUD actions for Flight model.
 */
class FlightController extends Controller
{
    /**
     * Lists all Flight models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Flight::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Flight model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $coordinates = '';
        $coordinateModels = $model->flightDetails;
        $coordinateTypeNames = FlightHelper::getCoordinateTypesList();

        foreach ($coordinateModels as $coordinateModel) {
            $coordinates .= $coordinateModel->latitude . ', ' . $coordinateModel->longitude .
                ' -> ' . $coordinateTypeNames[$coordinateModel->type] . "<br>";
        }

        return $this->render('view', [
            'model' => $model,
            'coordinates' => $coordinates,
        ]);
    }

    /**
     * Creates a new Flight model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Flight();
        $coordinatePairs = [new FlightDetail];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $flightId = $model->id;
            $vehicleId = $model->vehicle_id;
            if (($flightCoordinatesSets = Yii::$app->request->post('FlightDetail')) !== null) {
                foreach ($flightCoordinatesSets as $flightCoordinatesSet) {
                    $flightCoordinatesModel = new FlightDetail();
                    $flightCoordinatesModel->attributes = $flightCoordinatesSet;
                    $flightCoordinatesModel->vehicle_id = $vehicleId;
                    $flightCoordinatesModel->flight_id = $flightId;

                    if ($flightCoordinatesModel->validate()) {
                        $flightCoordinatesModel->save(false);
                    }
                }
                $this->redirect('index');
            }
        } else {
            return $this->render('create', [
                'flightModel' => $model,
                'coordinatePairs' => $coordinatePairs
            ]);
        }
    }

    /**
     * Updates an existing Flight model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $coordinatePairs = $model->flightDetails;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $flightId = $model->id;
            $vehicleId = $model->vehicle_id;
            if (($flightCoordinatesSets = Yii::$app->request->post('FlightDetail')) !== null) {
                foreach ($flightCoordinatesSets as $flightCoordinatesSet) {
                    if (isset($flightCoordinatesSet['id'])) {
                        $flightCoordinatesModel = FlightDetail::findOne($flightCoordinatesSet['id']);
                    } else {
                        $flightCoordinatesModel = new FlightDetail();
                        $flightCoordinatesModel->flight_id = $flightId;
                    }
                    $flightCoordinatesModel->attributes = $flightCoordinatesSet;
                    $flightCoordinatesModel->vehicle_id = $vehicleId;

                    if ($flightCoordinatesModel->validate()) {
                        $flightCoordinatesModel->save(false);
                    }
                }
                $this->redirect('index');
            }
        } else {
            return $this->render('update', [
                'flightModel' => $model,
                'coordinatePairs' => $coordinatePairs
            ]);
        }
    }

    /**
     * Deletes an existing Flight model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    /**
     * Finds the Flight model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Flight the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Flight::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /**
     * Returns dropdown with available flights.
     *
     * @throws \yii\base\ExitException
     */
    public function actionGetAvailableFlights()
    {
        if (Yii::$app->request->isAjax) {
            if ($vehicle = Yii::$app->request->post('vehicle')) {
                echo $this->renderPartial('_flights_dropdown', ['vehicle' => $vehicle]);
            }
            Yii::$app->end();
        }
    }

    public function actionGetFlightMap()
    {
        if (Yii::$app->request->isAjax) {
            if ($flight = Yii::$app->request->post('flight')) {
                $coordinates = [
                    'preferable' => [],
                    'real' => [],
                    'approximated' => [],
                ];

                $flightCoordinatesModels = FlightDetail::find()
                    ->where([
                        'flight_id' => (int)$flight
                    ])
                    ->all();

                if (!empty($flightCoordinatesModels)) {
                    foreach ($flightCoordinatesModels as $flightCoordinatesModel) {
                        $coordinatePair = [
                            'lat' => $flightCoordinatesModel->latitude,
                            'lng' => $flightCoordinatesModel->longitude,
                        ];
                        switch ($flightCoordinatesModel->type) {
                            case FlightDetail::TYPE_PREFERRED:
                                $coordinates['preferable'][] = $coordinatePair;
                                break;
                            case FlightDetail::TYPE_REAL:
                                $coordinates['real'][] = $coordinatePair;
                                break;
                            case FlightDetail::TYPE_APPROXIMATED:
                                $coordinates['approximated'][] = $coordinatePair;
                                break;
                        }
                    }
                }
                echo $this->renderPartial('_flight_map', $coordinates);
            }
            Yii::$app->end();
        }
    }


}
