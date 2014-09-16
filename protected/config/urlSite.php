<?php
return array(
	'' => 'look/list',

	'my/stream' => 'look/listStream',

	'my/messages/<type:sent>' => 'message/list',
	'my/messages' => 'message/list',
	'user/<userId:\d+>/message' => 'message/send',

	'user/<userId:\d+>/follows' => 'follow/getByUser',
	'user/<userId:\d+>/followers' => 'follow/getByUserFollowers',
	'my/follows' => 'follow/getMy',
	'my/followers' => 'follow/getMyFollowers',

	'user/<userId:\d+>/comments' => 'comment/getByUser',
	'my/comments' => 'comment/getMy',

	'user/<userId:\d+>/<controller>s' => '<controller>/getByUser',
	'my/<controller>s' => '<controller>/getMy',


	'user/<userId:\d+>' => 'user/index',

	'signup' => 'user/signup',
	'auth' => 'user/auth',

	'my/<action>' => 'user/<action>',
	'look/<lookId:\d+>' => 'look/index',
	'user/<userd:\d+>' => 'user/index',

	'<page:\w+>.html' => 'page/index'
);