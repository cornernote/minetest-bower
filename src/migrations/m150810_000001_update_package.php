<?php

use yii\db\Migration;
use yii\db\Schema;

class m150810_000001_update_package extends Migration
{
    const TABLE = '{{%package}}';

    public function up()
    {
        $this->addColumn(self::TABLE, 'readme_format', Schema::TYPE_STRING . '(8)');
    }

    public function down()
    {
        $this->dropColumn(self::TABLE, 'readme_format');
    }
}