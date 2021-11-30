<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property int $id
 * @property string $name
 *
 * @property Dependency[] $dependencies
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'staff'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификатор',
            'name' => 'Отдел',
            'staff' => 'Сотрудники'
        ];
    }

    /**
     * Gets query for [[Dependency]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDependency()
    {
        return $this->hasMany(Dependency::className(), ['id_department' => 'id']);
    }

    public function getStaff()
    {
        return $this->hasMany(Staff::className(), ['id' => 'id_staff'])
            ->via('dependency');
    }
}
