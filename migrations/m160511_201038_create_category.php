<?php

use yii\db\Migration;

class m160511_201038_create_category extends Migration
{
    public function up()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' =>$this->string()
        ]);
    }

    public function down()
    {
        $this->dropTable('category');
    }
}
