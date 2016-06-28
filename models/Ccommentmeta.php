<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Ccommentmeta".
 *
 * @property string $meta_id
 * @property string $comment_id
 * @property string $meta_key
 * @property string $meta_value
 */
class Ccommentmeta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ccommentmeta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment_id'], 'integer'],
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
            'comment_id' => 'Comment ID',
            'meta_key' => 'Meta Key',
            'meta_value' => 'Meta Value',
        ];
    }
}
