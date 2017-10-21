<?php

use yii\db\Migration;

class m171021_175533_create_project_tables extends Migration
{
    public function up()
    {
        $this->createTable('flight_vehicles', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
        ]);

        $this->createTable('flights', [
            'id' => $this->primaryKey(),
            'begin_time' => $this->dateTime()->notNull(),
            'end_time' => $this->dateTime()->notNull(),
            'vehicle_id' => $this->integer()->notNull()
        ]);

        $this->createTable('flight_details', [
            'id' => $this->primaryKey(),
            'flight_id' => $this->integer()->notNull(),
            'vehicle_id' => $this->integer()->notNull(),
            'latitude' => $this->float()->notNull(),
            'longitude' => $this->float()->notNull()
        ]);

        // creates index for column `vehicle_id` on `flights`
        $this->createIndex(
            'idx-flights-vehicle_id',
            'flights',
            'vehicle_id'
        );

        // add foreign key for table `flights`
        $this->addForeignKey(
            'fk-flights-vehicle_id',
            'flights',
            'vehicle_id',
            'flight_vehicles',
            'id',
            'CASCADE'
        );

        // creates index for column `vehicle_id` on `flight_details`
        $this->createIndex(
            'idx-flight_details-vehicle_id',
            'flight_details',
            'vehicle_id'
        );

        // creates index for column `flight_id` on `flight_details`
        $this->createIndex(
            'idx-flight_details-flight_id',
            'flight_details',
            'flight_id'
        );

        // add foreign key for table `flights` for `vehicle_id`
        $this->addForeignKey(
            'fk-flight_details-vehicle_id',
            'flight_details',
            'vehicle_id',
            'flight_vehicles',
            'id',
            'CASCADE'
        );

        // add foreign key for table `flights` for `flight_id`
        $this->addForeignKey(
            'fk-flight_details-flight_id',
            'flight_details',
            'flight_id',
            'flights',
            'id',
            'CASCADE'
        );

        return true;
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-flight_details-flight_id',
            'flight_details'
        );
        $this->dropForeignKey(
            'fk-flight_details-vehicle_id',
            'flight_details'
        );
        $this->dropForeignKey(
            'fk-flights-vehicle_id',
            'flights'
        );

        $this->dropIndex(
            'idx-flight_details-flight_id',
            'flight_details'
        );
        $this->dropIndex(
            'idx-flight_details-vehicle_id',
            'flight_details'
        );
        $this->dropIndex(
            'idx-flights-vehicle_id',
            'flights'
        );

        $this->dropTable('flight_details');
        $this->dropTable('flights');
        $this->dropTable('flight_vehicles');

        return true;
    }
}
