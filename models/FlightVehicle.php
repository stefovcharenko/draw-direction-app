<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "flight_vehicles".
 *
 * @property integer $id
 * @property string $name
 *
 * @property FlightDetail[] $flightDetails
 * @property Flight[] $flights
 */
class FlightVehicle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'flight_vehicles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Назва',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlightDetails()
    {
        return $this->hasMany(FlightDetail::className(), ['vehicle_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlights()
    {
        return $this->hasMany(Flight::className(), ['vehicle_id' => 'id']);
    }
}
