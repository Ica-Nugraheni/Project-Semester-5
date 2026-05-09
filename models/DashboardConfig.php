<?php
namespace app\models;

use yii\db\ActiveRecord;

    /**
     * DashboardConfig ActiveRecord
     *
     * Columns:
     * - id int
     * - key string unique identifier for widget
     * - label string human readable label
     * - value text value to display (could be number/string)
     * - note text additional note
     * - meta text JSON metadata
     * - sort int ordering
     * - visible tinyint
     */
class DashboardConfig extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%dashboard_config}}';
    }

    public function rules()
    {
        return [
            [['key','label'],'required'],
            [['value','note','meta'],'safe'],
            [['sort'],'integer'],
            [['visible'],'boolean'],
            [['key','label'], 'string', 'max' => 255],
            ['key','unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'key' => 'Key',
            'label' => 'Label',
            'value' => 'Value',
            'note' => 'Note',
            'meta' => 'Meta (json)',
            'sort' => 'Sort Order',
            'visible' => 'Visible',
        ];
    }
}
