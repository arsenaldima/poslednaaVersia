<?php

class m140903_114032_comment_tbl extends CDbMigration
{
    public function up()
    {
        $this->createTable('cms_comment', array(

            'id' => 'int pk',
            'content' => 'text NOT NULL',
            'created'=>'int',
            'status'=>'int',
            'parent_id'=>'int',
            'user_id'=>'int',
            'page_id'=>'int',
            'guest'=>'string',
        ));
    }


    public function down()
    {
        $this->dropTable('cms_comment');
    }

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}