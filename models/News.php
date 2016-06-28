<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property integer $rss_id
 * @property string $news_id
 * @property integer $category_id
 * @property integer $agency_id
 * @property string $title
 * @property string $description
 * @property string $link
 * @property string $news_date
 * @property integer $view
 * @property integer $status
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rss_id', 'category_id', 'agency_id', 'view', 'status'], 'integer'],
            [['news_id', 'title', 'news_date'], 'string', 'max' => 255],
            [['description', 'link'], 'string', 'max' => 2048]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rss_id' => 'Rss ID',
            'news_id' => 'News ID',
            'category_id' => 'Category ID',
            'agency_id' => 'Agency ID',
            'title' => 'Title',
            'description' => 'Description',
            'link' => 'Link',
            'news_date' => 'News Date',
            'view' => 'View',
            'status' => 'Status',
        ];
    }
}
