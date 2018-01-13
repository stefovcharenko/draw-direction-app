<?php

use yii\db\Migration;

/**
 * Class m180113_102235_change_coordinates_data_type
 */
class m180113_102235_change_coordinates_data_type extends Migration
{
    public function up()
    {
        $this->alterColumn('flight_details', 'longitude', 'string');
        $this->alterColumn('flight_details', 'latitude', 'string');

        return true;
    }

    public function down()
    {
        $this->alterColumn('flight_details', 'longitude', 'float');
        $this->alterColumn('flight_details', 'latitude', 'float');

        return true;
    }
}
