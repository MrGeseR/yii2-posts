<?php

use yii\db\Migration;

class m170426_141605_create_base_tables extends Migration
{
    public function up()
    {
        $this->createTable('post',[
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createTable('comment',[
            'id' => $this->primaryKey(),
            'text' => $this->text()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'post_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createTable('tag',[
           'id' => $this->primaryKey(),
            'name' => $this->string()->unique()->notNull()
        ]);

        $this->createTable('post_tag',[
            'post_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull(),
            'PRIMARY KEY (`post_id`, `tag_id`)'
        ]);

        $this->createIndex('index_author','post','author_id');

        $this->addForeignKey('post_user_id', 'post', 'author_id', 'user','id','cascade');

        $this->addForeignKey('post_comment_id', 'comment', 'post_id', 'post','id','cascade');
        $this->addForeignKey('comment_user_id', 'comment', 'user_id', 'user','id','cascade');

        $this->addForeignKey('post_tag_post_id', 'post_tag', 'post_id', 'post','id','cascade');
        $this->addForeignKey('post_tag_tag_id', 'post_tag', 'tag_id', 'tag','id','cascade');

    }

    public function down()
    {
        $this->dropTable('post');
        $this->dropTable('comment');
        $this->dropTable('tag');
        $this->dropTable('post_tag');

        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
