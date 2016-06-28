<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Ctermmeta".
 *
 * @property string $meta_id
 * @property string $term_id
 * @property string $meta_key
 * @property string $meta_value
 */
class Ctermmeta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ctermmeta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['term_id'], 'integer'],
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
            'term_id' => 'Term ID',
            'meta_key' => 'Meta Key',
            'meta_value' => 'Meta Value',
        ];
    }
}
