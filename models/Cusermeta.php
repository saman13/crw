<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Cusermeta".
 *
 * @property string $umeta_id
 * @property string $user_id
 * @property string $meta_key
 * @property string $meta_value
 */
class Cusermeta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Cusermeta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
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
            'umeta_id' => 'Umeta ID',
            'user_id' => 'User ID',
            'meta_key' => 'Meta Key',
            'meta_value' => 'Meta Value',
        ];
    }
}
