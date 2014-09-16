<?php

class m140903_114019_page_tbl extends CDbMigration
{
	public function up()
	{
        $this->createTable('cms_page', array(

            'id' => 'int pk',
            'title' => 'string NOT NULL',
            'content' => 'text NOT NULL',
            'created'=>'int',
            'status'=>'int',
            'category_id'=>'int',
            'user_id'=>'int',
            'path_img'=>'text',

        ));
	}


        public function down()
    {
        $this->dropTable('cms_page');
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