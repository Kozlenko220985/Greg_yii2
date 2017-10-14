<?php


use console\migrations\Migration;

class m171010_165521_tag extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%tag}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
        ], $this->tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%tag}}');
    }

}
