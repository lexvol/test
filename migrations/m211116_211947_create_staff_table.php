<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%staff}}`.
 */
class m211116_211947_create_staff_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%staff}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(50)->notNull(),
            'patronymic' => $this->string(50)->defaultValue(null),
            'last_name' => $this->string(50)->notNull(),
            'phone_number' => $this->bigInteger(11)->notNull(),
            'email' => $this->string(50)->defaultValue(null),
            'address' => $this->string(255),
        ]);

        $this->insert('{{%staff}}', [
            'first_name' => 'Семен',
            'patronymic' => 'Федорович',
            'last_name' => 'Ручин',
            'phone_number' => '79124442211',
            'address' => 'Москва, ул.Калинина, д. 5, кв. 89'
        ]);

        $this->insert('{{%staff}}', [
            'first_name' => 'Алла',
            'patronymic' => 'Викторовна',
            'last_name' => 'Коркина',
            'phone_number' => '79995002010',
            'email' => 'allo@mail.ru',
            'address' => 'Москва, ул.Кожемякина, д. 118, кв. 12'
        ]);

        $this->insert('{{%staff}}', [
            'first_name' => 'Павел',
            'patronymic' => 'Максимович',
            'last_name' => 'Агапов',
            'phone_number' => '79196006600',
            'email' => 'pma@ya.ru',
            'address' => 'Москва, ул.Жукова, д. 303, кв. 101'
        ]);

        $this->insert('{{%staff}}', [
            'first_name' => 'Edgar',
            'last_name' => 'Brown',
            'phone_number' => '17136602343',
            'email' => 'BrownE87@gmail.com',
            'address' => 'Brooklyn, NY 11311, 155 Main Street, apt. 17B'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%staff}}');
    }
}
