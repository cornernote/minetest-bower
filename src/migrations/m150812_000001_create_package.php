<?php

use yii\db\Migration;
use yii\db\Schema;

class m150812_000001_create_package extends Migration
{
    const TABLE = '{{%package}}';

    public function up()
    {
        $this->dropTable(self::TABLE);
        $this->createTable(self::TABLE, [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(50) NOT NULL',
            'url' => Schema::TYPE_STRING . '(255) NOT NULL',
            'hits' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'bower' => Schema::TYPE_BINARY,
            'readme' => Schema::TYPE_BINARY,
            'readme_format' => Schema::TYPE_STRING . '(8)',
            'homepage' => Schema::TYPE_STRING . '(255)',
            'forum' => Schema::TYPE_STRING . '(255)',
            'description' => Schema::TYPE_STRING . '(140)',
            'keywords' => Schema::TYPE_STRING . '(255)',
            'screenshots' => Schema::TYPE_BINARY,
            'authors' => Schema::TYPE_BINARY,
            'license' => Schema::TYPE_BINARY,
            'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'updated_at' => Schema::TYPE_DATETIME . ' NOT NULL',
        ], ($this->db->driverName === 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB' : null));

        $this->createIndex('idx_name', self::TABLE, ['name'], true);
        $this->createIndex('idx_url', self::TABLE, ['url'], true);
    }

    public function down()
    {
    }
}