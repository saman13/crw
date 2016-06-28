<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Cterm_relationships".
 *
 * @property string $object_id
 * @property string $term_taxonomy_id
 * @property integer $term_order
 */
class CtermRelationships extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Cterm_relationships';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_id', 'term_taxonomy_id'], 'required'],
            [['object_id', 'term_taxonomy_id', 'term_order'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'object_id' => 'Object ID',
            'term_taxonomy_id' => 'Term Taxonomy ID',
            'term_order' => 'Term Order',
        ];
    }
}
