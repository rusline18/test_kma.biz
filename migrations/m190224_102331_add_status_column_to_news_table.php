<?php

use yii\db\Migration;

/**
 * Handles adding status to table `{{%news}}`.
 */
class m190224_102331_add_status_column_to_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('news', 'status', $this->integer());
        $this->addColumn('news', 'user_id', $this->integer());

        $this->addForeignKey(
            'fk-news-user_id',
            'news', 'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
