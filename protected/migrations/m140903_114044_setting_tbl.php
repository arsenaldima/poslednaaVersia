<?php

class m140903_114044_setting_tbl extends CDbMigration
{
    public function up()
    {
        $this->createTable('cms_setting', array(

            'id' => 'int pk',
            'ct_page' => 'int',
            'time'=>'int',
            'podtv_email'=>'int',
            'poblicazia_com'=>'int',
            'poblicazia_stat'=>'int',
            'gost_com'=>'int',

        ));
    }


    public function down()
    {
        $this->dropTable('cms_setting');
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