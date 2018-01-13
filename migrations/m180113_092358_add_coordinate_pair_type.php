<?php

use yii\db\Migration;

/**
 * Class m180113_092358_add_coordinate_pair_type
 */
class m180113_092358_add_coordinate_pair_type extends Migration
{
    public function up()
    {
        $this->addColumn('flight_details', 'type', 'string');

        return true;

    }

    public function down()
    {
        $this->dropColumn('flight_details', 'type');

        return true;
    }
}
