<?php

use yii\db\Migration;

class m170926_162304_post_table_to_user_fk extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey(
            'post-user_id-user-id',
            '{{%post}}', 'user_id',
            '{{%user}}', 'id'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('post-user_id-user-id', '{{%post}}');
    }
}
