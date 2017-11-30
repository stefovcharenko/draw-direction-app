<?php

namespace app\controllers;

use Yii;
use app\models\FlightDetail;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap\ActiveForm;

/**
 * DetailController implements the CRUD actions for FlightDetail model.
 */
class DetailController extends Controller
{
    /**
     * Deletes an existing FlightDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
    }

    /**
     * Finds the FlightDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FlightDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FlightDetail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetCoordinatesTemplate()
    {
        if (Yii::$app->request->isAjax) {
            if ($counter = Yii::$app->request->post('counter')) {
                echo $this->renderPartial('_coordinates_set', [
                    'counter' => (int)$counter,
                    'coordinateModel' => new FlightDetail,
                    'form' => $this->form(),
                ]);
            }
            Yii::$app->end();
        }
    }

    private function form()
    {
        $form = new ActiveForm;
        $form->id = 'flight-form';
        $form->layout = 'horizontal';

        return $form;
    }
}
