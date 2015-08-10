<?php

use yii\db\Migration;
use yii\db\Schema;

class m150810_000003_update_package extends Migration
{
    const TABLE = '{{%package}}';

    public function up()
    {
        $this->dropColumn(self::TABLE, 'bower');
        $this->dropColumn(self::TABLE, 'readme');
        $this->dropColumn(self::TABLE, 'screenshots');
        $this->dropColumn(self::TABLE, 'authors');
        $this->dropColumn(self::TABLE, 'license');
        $this->addColumn(self::TABLE, 'bower', Schema::TYPE_BINARY);
        $this->addColumn(self::TABLE, 'readme', Schema::TYPE_BINARY);
        $this->addColumn(self::TABLE, 'screenshots', Schema::TYPE_BINARY);
        $this->addColumn(self::TABLE, 'authors', Schema::TYPE_BINARY);
        $this->addColumn(self::TABLE, 'license', Schema::TYPE_BINARY);
    }

    public function down()
    {
        $this->dropColumn(self::TABLE, 'bower');
        $this->dropColumn(self::TABLE, 'readme');
        $this->dropColumn(self::TABLE, 'screenshots');
        $this->dropColumn(self::TABLE, 'authors');
        $this->dropColumn(self::TABLE, 'license');
        $this->addColumn(self::TABLE, 'bower', Schema::TYPE_TEXT);
        $this->addColumn(self::TABLE, 'readme', Schema::TYPE_TEXT);
        $this->addColumn(self::TABLE, 'screenshots', Schema::TYPE_TEXT);
        $this->addColumn(self::TABLE, 'authors', Schema::TYPE_TEXT);
        $this->addColumn(self::TABLE, 'license', Schema::TYPE_TEXT);
    }
}