<?php

use yii\db\Migration;
use yii\db\Schema;

class m150809_000001_update_package extends Migration
{
    const TABLE = '{{%package}}';

    public function up()
    {
        $this->addColumn(self::TABLE, 'readme', Schema::TYPE_TEXT);
    }

    public function down()
    {
        $this->dropColumn(self::TABLE, 'readme');
    }
}