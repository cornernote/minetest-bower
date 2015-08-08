<?php

use yii\db\Migration;
use yii\db\Schema;

class m150808_000001_create_package extends Migration
{
    const TABLE = '{{%package}}';

    public function up()
    {
        $this->createTable(self::TABLE, [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(128) NOT NULL',
            'url' => Schema::TYPE_STRING . '(255) NOT NULL',
            'hits' => Schema::TYPE_INTEGER . ' NOT NULL',
            'bower' => Schema::TYPE_TEXT,
            'created_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
            'updated_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
        ], ($this->db->driverName === 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB' : null));

        $this->createIndex('idx_name', self::TABLE, ['name'], true);
        $this->createIndex('idx_url', self::TABLE, ['url'], true);
    }

    public function down()
    {
        $this->dropTable(self::TABLE);
    }
}