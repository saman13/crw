<?php

use yii\db\Migration;

class m160513_131914_create_users extends Migration
{
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username'=>$this->string()->notNull()->unique(),
            'password'=>$this->string()->notNull(),
            'email'=>$this->string(),
            'name'=>$this->string(),
            'family'=>$this->string(),
            'mobile'=>$this->string(),
            'password_reset'=>$this->string(),
            'superuser'=>$this->integer()->defaultValue(0),
            'status'=>$this->integer()->defaultValue(1),
        ]);

        $this->createIndex(
            'idx_users_user_name',
            'users',
            'username'
        );

        $this->createIndex(
            'idx_users_email',
            'users',
            'email'
        );

        $this->createIndex(
            'idx_users_mobile',
            'users',
            'mobile'
        );

    }

    public function down()
    {
        $this->dropTable('users');
    }
}
