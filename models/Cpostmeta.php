<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Cpostmeta".
 *
 * @property string $meta_id
 * @property string $post_id
 * @property string $meta_key
 * @property string $meta_value
 */
class Cpostmeta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Cpostmeta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id'], 'integer'],
            [['meta_value'], 'string'],
            [['meta_key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'meta_id' => 'Meta ID',
            'post_id' => 'Post ID',
            'meta_key' => 'Meta Key',
            'meta_value' => 'Meta Value',
        ];
    }
}
