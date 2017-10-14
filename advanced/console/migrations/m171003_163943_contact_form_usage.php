<?php

use console\migrations\Migration;

class m171003_163943_contact_form_usage extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%contact_form_usage}}', [
            'id' => $this->primaryKey()->unsigned(),
            'first_name' => $this->string(255)->notNull(),
            'last_name' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'subject' => $this->string(255)->notNull(),
            'body' => $this->text()->notNull(),
            'read' => $this->boolean()->unsigned()->defaultValue(false),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ], $this->tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%contact_form_usage}}');
        return false;
    }

}
