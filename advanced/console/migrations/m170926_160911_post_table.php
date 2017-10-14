<?php

use console\migrations\Migration;

class m170926_160911_post_table extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey()->unsigned(),
            'title' => $this->string(255)->notNull(),
            'slug' => $this->string(255)->notNull()->unique(),
            'description' => $this->text()->notNull(),
            'draft' => $this->boolean()->unsigned()->notNull()->defaultValue(true),
            'user_id' => $this->integer()->unsigned()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ], $this->tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%post}}');
    }

}
