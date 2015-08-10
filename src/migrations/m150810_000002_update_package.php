<?php

use yii\db\Migration;
use yii\db\Schema;

class m150810_000002_update_package extends Migration
{
    const TABLE = '{{%package}}';

    public function up()
    {
        $this->dropColumn(self::TABLE, 'screenshot');
        $this->addColumn(self::TABLE, 'screenshots', Schema::TYPE_TEXT);
        $this->addColumn(self::TABLE, 'authors', Schema::TYPE_TEXT);
        $this->addColumn(self::TABLE, 'license', Schema::TYPE_TEXT);
    }

    public function down()
    {
        $this->addColumn(self::TABLE, 'screenshot', Schema::TYPE_STRING);
        $this->dropColumn(self::TABLE, 'authors');
        $this->dropColumn(self::TABLE, 'screenshots');
        $this->dropColumn(self::TABLE, 'license');
    }
}