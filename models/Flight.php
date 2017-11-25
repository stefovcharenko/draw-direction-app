<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "flights".
 *
 * @property integer $id
 * @property string $begin_time
 * @property string $end_time
 * @property integer $vehicle_id
 *
 * @property FlightDetail[] $flightDetails
 * @property FlightVehicle $vehicle
 */
class Flight extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'flights';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['begin_time', 'end_time', 'vehicle_id'], 'required'],
            [['begin_time', 'end_time'], 'safe'],
            ['begin_time', 'validateDates'],
            [['vehicle_id'], 'integer'],
            [['vehicle_id'], 'exist', 'skipOnError' => true, 'targetClass' => FlightVehicle::className(), 'targetAttribute' => ['vehicle_id' => 'id']],
        ];
    }

    /**
     * @param $attribute
     */
    public function validateDates($attribute){
        if(strtotime($this->begin_time) >= strtotime($this->end_time)){
            $this->addError(
                $attribute,
                'Дата та час початку польоту не можуть бути більшими або дорівнювати даті та часу кінця польоту'
            );
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'begin_time' => 'Час початку',
            'end_time' => 'Час кінця',
            'vehicle_id' => 'ID БПЛА',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlightDetails()
    {
        return $this->hasMany(FlightDetail::className(), ['flight_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicle()
    {
        return $this->hasOne(FlightVehicle::className(), ['id' => 'vehicle_id']);
    }

    /**
     * @param $vehicleId
     * @return array
     */
    public static function getAvailableFlightsForVehicle($vehicleId)
    {
        $result = [
            '' => '--- Оберіть політ ---'
        ];
        $flights = self::findAll([
            'vehicle_id' => $vehicleId
        ]);
        foreach ($flights as $flight) {
            $result[$flight->id] = $flight->begin_time . ' - ' . $flight->end_time;
        }

        return $result;
    }
}
