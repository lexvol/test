<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staff".
 *
 * @property int $id
 * @property string $first_name
 * @property string|null $patronymic
 * @property string $last_name
 * @property int $phone_number
 * @property string|null $email
 * @property string|null $address
 *
 * @property Dependency[] $dependency
 */
class Staff extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staff';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'phone_number'], 'required'],
            [['phone_number'], 'integer'],
            ['phone_number', 'match', 'pattern' => '^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$^'],
            [['first_name', 'patronymic', 'last_name'], 'string', 'max' => 50],
            ['email', 'email'],
            [['address'], 'string', 'max' => 255],
            [['department'], 'string', 'max' => 255]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификатор',
            'first_name' => 'Имя',
            'patronymic' => 'Отчество',
            'last_name' => 'Фамилия',
            'phone_number' => 'Телефон',
            'email' => 'Email',
            'address' => 'Адрес',
            'department' => 'Отдел'
        ];
    }

    /**
     * Gets query for [[Dependency]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDependency()
    {
        return $this->hasMany(Dependency::className(), ['id_staff' => 'id']);
    }

    public function getDepartment()
    {
        return $this->hasMany(Department::className(), ['id' => 'id_department'])
            ->via('dependency');
    }
}
