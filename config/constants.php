<?php

return [
    // Backend
    "ITEM_PER_PAGE" => 10,
    "SUPERADMIN_ROLE_ID" => 1,
    "NONE_AUTHORIZE_ACTIONS" => [
    	'login',
    	'register',
    	'logout',
    	'password.email',
    	'password.reset',
    	'home',
        'postChangePassword',
    	'getChangePassword',
    	'password.request',
        'test.*',
        'debugbar.*',
    ]
];
