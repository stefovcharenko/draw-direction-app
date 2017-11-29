<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "flight_details".
 *
 * @property integer $id
 * @property integer $flight_id
 * @property integer $vehicle_id
 * @property double $latitude
 * @property double $longitude
 *
 * @property Flight $flight
 * @property FlightVehicle $vehicle
 */
class FlightDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'flight_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['flight_id', 'vehicle_id', 'latitude', 'longitude'], 'required'],
            [['flight_id', 'vehicle_id'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['flight_id'], 'exist', 'skipOnError' => true, 'targetClass' => Flight::className(), 'targetAttribute' => ['flight_id' => 'id']],
            [['vehicle_id'], 'exist', 'skipOnError' => true, 'targetClass' => FlightVehicle::className(), 'targetAttribute' => ['vehicle_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'flight_id' => 'ID польоту',
            'vehicle_id' => 'ID БПЛА',
            'latitude' => 'Широта',
            'longitude' => 'Довгота',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlight()
    {
        return $this->hasOne(Flight::className(), ['id' => 'flight_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicle()
    {
        return $this->hasOne(FlightVehicle::className(), ['id' => 'vehicle_id']);
    }
}
