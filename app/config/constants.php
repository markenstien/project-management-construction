<?php

    #################################################
	##             THIRD-PARTY APPS                ##
    #################################################

    define('DEFAULT_REPLY_TO' , 'reply@mapuasms.live');

    const MAILER_AUTH = [
        'username' => 'info@paintmanconstruction.com',
        'password' => ';(*pDWHQA%[^',
        'host'     => 'paintmanconstruction.com',
        'name'     => 'paintman',
        'replyTo'  => 'info@paintmanconstruction.com',
        'replyToName' => 'paintman'
    ];

    const ITEXMO = [
        'key' => 'ST-MARKA387451_MMZLK',
        'pwd' => '6b9nxyynwt'
    ];

    #################################################
	##             EXTENDED APPS                   ##
	#################################################
	const APP_EXTENSIONS = [
		'cxbook' => [
			'base_controller' => 'Accounts',
			'base_method'     => 'index'
        ]
    ];

    define('APP_EXTENSIONS_PATH' , APPROOT.DS.'softwares');

	#################################################
	##             SYSTEM CONFIG                ##
    #################################################


    define('GLOBALS' , APPROOT.DS.'classes/globals');

    define('SITE_NAME' , 'paintmanconstruction.com');

    define('COMPANY_NAME' , 'PROJECT_MANAGEMENT');

    define('KEY_WORDS' , '#############');


    define('DESCRIPTION' , '#############');

    define('AUTHOR' , SITE_NAME);

?>
