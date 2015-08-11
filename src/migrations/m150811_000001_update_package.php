<?php

use yii\db\Migration;
use yii\db\Schema;

class m150810_000003_update_package extends Migration
{
    const TABLE = '{{%package}}';

    public function up()
    {
        $this->addColumn(self::TABLE, 'forum', Schema::TYPE_STRING . '(255)');
    }

    public function down()
    {
        $this->dropColumn(self::TABLE, 'forum');
    }
}