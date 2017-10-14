<?php

namespace console\migrations;

use yii\db\Migration as BaseMigration;

class Migration extends BaseMigration
{

    protected $tableOptions;

    public function __construct(array $config = [])
    {
        parent::__construct($config);

        if ($this->db->driverName === 'mysql') {
            $this->tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
    }

}