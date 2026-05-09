<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * PageSetting ActiveRecord
 * 
 * Menyimpan konfigurasi tampilan untuk frontend dan backend
 *
 * Columns:
 * - id int
 * - setting_key string unique identifier
 * - setting_type string (frontend/backend)
 * - setting_group string (general/theme/header/footer/etc)
 * - label string human readable label
 * - value text value/configuration
 * - description text deskripsi setting
 * - updated_at datetime
 */
class PageSetting extends ActiveRecord
{
    const TYPE_FRONTEND = 'frontend';
    const TYPE_BACKEND = 'backend';
    
    const GROUP_GENERAL = 'general';
    const GROUP_THEME = 'theme';
    const GROUP_HEADER = 'header';
    const GROUP_FOOTER = 'footer';
    const GROUP_BRAND = 'brand';
    const GROUP_COLOR = 'color';

    public static function tableName()
    {
        return '{{%page_settings}}';
    }

    public function rules()
    {
        return [
            [['setting_key', 'setting_type', 'setting_group', 'label'], 'required'],
            [['value', 'description'], 'safe'],
            [['setting_key'], 'string', 'max' => 100],
            [['setting_type', 'setting_group'], 'string', 'max' => 50],
            [['label'], 'string', 'max' => 255],
            [['setting_key'], 'unique'],
            [['setting_type'], 'in', 'range' => [self::TYPE_FRONTEND, self::TYPE_BACKEND]],
            [['updated_at'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'setting_key' => 'Setting Key',
            'setting_type' => 'Tipe',
            'setting_group' => 'Group',
            'label' => 'Label',
            'value' => 'Value',
            'description' => 'Deskripsi',
            'updated_at' => 'Updated At',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->updated_at = date('Y-m-d H:i:s');
            return true;
        }
        return false;
    }

    /**
     * Get setting value by key
     * @param string $key
     * @param string $type
     * @param mixed $default
     * @return mixed
     */
    public static function getValue($key, $type = null, $default = null)
    {
        $query = static::find()->where(['setting_key' => $key]);
        if ($type) {
            $query->andWhere(['setting_type' => $type]);
        }
        $setting = $query->one();
        return $setting ? $setting->value : $default;
    }

    /**
     * Set setting value
     * @param string $key
     * @param mixed $value
     * @param string $type
     * @return bool
     */
    public static function setValue($key, $value, $type = self::TYPE_BACKEND)
    {
        $setting = static::findOne(['setting_key' => $key, 'setting_type' => $type]);
        if (!$setting) {
            $setting = new static();
            $setting->setting_key = $key;
            $setting->setting_type = $type;
        }
        $setting->value = $value;
        return $setting->save();
    }
}

