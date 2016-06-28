<?php

use yii\db\Migration;

class m160512_074623_create_rss_link extends Migration
{
    public function up()
    {
        $this->createTable('rss_links', [
            'id' => $this->primaryKey(),
            'rss_link' => $this->string(),
            'category_id' => $this->integer(),
            'agency_id' => $this->integer(),
            'status' => $this->smallInteger()
        ]);

        $this->createIndex(
            'idx_rss_links_catehgory_id',
            'rss_links',
            'category_id'
        );
    }

    public function down()
    {
        $this->dropTable('rss_link');
    }
}
