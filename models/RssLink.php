<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rss_links".
 *
 * @property integer $id
 * @property string $rss_link
 * @property integer $category_id
 * @property integer $agency_id
 * @property integer $status
 */
class RssLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rss_links';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'agency_id', 'status'], 'integer'],
            [['rss_link'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rss_link' => 'Rss Link',
            'category_id' => 'Category ID',
            'agency_id' => 'Agency ID',
            'status' => 'Status',
        ];
    }
}
