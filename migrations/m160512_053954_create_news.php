<?php

use yii\db\Migration;

class m160512_053954_create_news extends Migration
{
    public function up()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'rss_id' => $this->integer(),
            'news_id' => $this->string(),
            'category_id' => $this->integer(),
            'agency_id' => $this->integer(),
            'title' => $this->string(),
            'description' => $this->string(2048),
            'link' =>$this->string(2048),
            'news_date' => $this->string(),
            'view' => $this->integer()->defaultValue(0),
            'status' => $this->smallInteger()->defaultValue(1)
        ]);

        $this->createIndex(
            'idx_news_news_id',
            'news',
            'news_id'
        );

    }

    public function down()
    {
        $this->dropTable('news');
    }
}
