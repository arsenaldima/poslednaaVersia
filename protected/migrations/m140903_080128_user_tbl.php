<?php

class m140903_080128_user_tbl extends CDbMigration
{
    public function up()
    {
        $this->createTable('cms_user', array(
            'id' => 'int pk',
            'username' => 'string NOT NULL',
            'password' => 'string',
            'created'=>'int',
            'ban'=>'int',
            'role'=>'int',
            'email'=>'string',
            'prigl_id'=>'int',
            'picture'=>'string',
            'data_avtor'=>'int',
            'podpis'=>'int',

        ));
    }

    public function down()
    {
        $this->dropTable('cms_user');
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