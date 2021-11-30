<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%department}}`.
 */
class m211116_214920_create_department_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%department}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->defaultValue(''),
        ]);

        $this->insert('{{%department}}', [
            'name' => 'Информационные технологии',
        ]);

        $this->insert('{{%department}}', [
            'name' => 'Юридический',
        ]);

        $this->insert('{{%department}}', [
            'name' => 'Маркетинговый',
        ]);

        $this->insert('{{%department}}', [
            'name' => 'Отдел продаж',
        ]);

        $this->insert('{{%department}}', [
            'name' => 'Рекламма и PR',
        ]);

        $this->insert('{{%department}}', [
            'name' => 'Управление по логистике',
        ]);

        $this->insert('{{%department}}', [
            'name' => 'Транспортный',
        ]);

        $this->insert('{{%department}}', [
            'name' => 'Отдел закупок',
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%department}}');
    }
}
