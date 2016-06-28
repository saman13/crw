<?php

use yii\db\Migration;

class m160511_201144_create_agancy extends Migration
{
    public function up()
    {
        $this->createTable('agency', [
            'id' => $this->primaryKey(),
            'name' =>$this->string()
        ]);
    }

    public function down()
    {
        $this->dropTable('agency');
    }
}
