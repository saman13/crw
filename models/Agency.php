<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "agency".
 *
 * @property integer $id
 * @property string $name
 */
class Agency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }
}
