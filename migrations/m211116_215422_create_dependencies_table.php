<?php

use yii\db\Migration;

/**
 * Class m211116_215422_create_dependencies_table
 */
class m211116_215422_create_dependencies_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%dependency}}', [
            'id' => $this->primaryKey(),
            'id_staff' => $this->integer(5)->notNull()->defaultValue(null),
            'id_department' => $this->integer(5)->notNull()->defaultValue(null),
        ]);

        $this->addForeignKey(
            'chain_to_staff',
            '{{%dependency}}',
            'id_staff',
            'staff',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'chain_to_department',
            '{{%dependency}}',
            'id_department',
            'department',
            'id',
            'CASCADE'
        );

        $this->insert('{{%dependency}}', [
            'id_staff' => '1',
            'id_department' => '1',
        ]);

        $this->insert('{{%dependency}}', [
            'id_staff' => '1',
            'id_department' => '5',
        ]);

        $this->insert('{{%dependency}}', [
            'id_staff' => '3',
            'id_department' => '4',
        ]);

        $this->insert('{{%dependency}}', [
            'id_staff' => '4',
            'id_department' => '1',
        ]);

        $this->insert('{{%dependency}}', [
            'id_staff' => '2',
            'id_department' => '2',
        ]);

        $this->insert('{{%dependency}}', [
            'id_staff' => '2',
            'id_department' => '4',
        ]);

        $this->insert('{{%dependency}}', [
            'id_staff' => '2',
            'id_department' => '8',
        ]);

        $this->insert('{{%dependency}}', [
            'id_staff' => '3',
            'id_department' => '6',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211116_215422_create_dependencies_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211116_215422_create_dependencies_table cannot be reverted.\n";

        return false;
    }
    */
}
