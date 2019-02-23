<?php

use yii\db\Migration;

/**
 * Handles adding auth_date to table `{{%user}}`.
 */
class m190223_111156_add_auth_date_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'auth_date', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'auth_date');
    }
}
