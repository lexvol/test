<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dependency".
 *
 * @property int $id
 * @property int|null $id_staff
 * @property int|null $id_department
 *
 * @property Department $department
 * @property Staff $staff
 */
class Dependency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dependency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_department'], 'required'],
            [['id_staff'], 'integer'],
            [['id_department'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['id_department' => 'id']],
            [['id_staff'], 'exist', 'skipOnError' => true, 'targetClass' => Staff::className(), 'targetAttribute' => ['id_staff' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_staff' => 'Сотрудник',
            'id_department' => 'Отдел',
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'id_department']);
    }

    /**
     * Gets query for [[Staff]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasOne(Staff::className(), ['id' => 'id_staff']);
    }
}
