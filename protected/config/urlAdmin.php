<?php
return array(
	'admin'												=> 'admin/user/events',

	'admin/user/<userId:\d+>/<action:\w+>'				=> 'admin/user/<action>',
	'admin/comment/<commentId:\d+>/<action:\w+>'		=> 'admin/comment/<action>',
	'admin/look/<lookId:\d+>/<action:\w+>'				=> 'admin/look/<action>',
	'admin/complain/<complainId:\d+>/<action:\w+>'		=> 'admin/complain/<action>',
	'admin/page/<pageId:\d+>/<action:\w+>'				=> 'admin/page/<action>',
	'admin/banner/<bannerId:\d+>/<action:\w+>'			=> 'admin/banner/<action>',

	'admin/<controller:\w+>s/<action:\w+>'				=> 'admin/<controller>/list<action>',
	'admin/<controller:\w+>s'							=> 'admin/<controller>/list',
	'admin/<controller:\w+>/<action:\w+>'				=> 'admin/<controller>/<action>',
);