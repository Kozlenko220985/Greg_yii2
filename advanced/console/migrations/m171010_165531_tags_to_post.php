<?php

use console\migrations\Migration;

class m171010_165531_tags_to_post extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%tags_to_post}}', [
            'id' => $this->primaryKey()->unsigned(),
            'post_id' => $this->integer()->unsigned()->notNull(),
            'tag_id' => $this->integer()->unsigned()->notNull()
        ], $this->tableOptions);

        $this->addForeignKey(
            'tags_to_post-post_id-post-id',
            '{{%tags_to_post}}', 'post_id',
            '{{%post}}', 'id'
        );

        $this->addForeignKey(
            'tags_to_post-tag_id-tag-id',
            '{{%tags_to_post}}', 'tag_id',
            '{{%tag}}', 'id'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('tags_to_post-post_id-post-id', '{{%tags_to_post}}');
        $this->dropForeignKey('tags_to_post-tag_id-tag-id', '{{%tags_to_post}}');
        $this->dropTable('{{%tags_to_post}}');
    }

}
