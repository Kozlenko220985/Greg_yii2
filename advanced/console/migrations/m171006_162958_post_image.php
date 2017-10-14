<?php

use yii\db\Migration;

class m171006_162958_post_image extends Migration
{
    public function safeUp()
    {
        $this->addColumn(
            '{{%post}}',
            'image',
            $this->string(255)->notNull()->defaultValue('')
        );
    }

    public function safeDown()
    {
        $this->dropColumn('{{%post}}', 'image');
    }

}
