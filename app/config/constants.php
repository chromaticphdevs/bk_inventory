<?php

    #################################################
	##             THIRD-PARTY APPS                ##
    #################################################

    define('DEFAULT_REPLY_TO' , '');

    const MAILER_AUTH = [
        'username' => 'main@medicad.store',
        'password' => 'tmKcD#t3o@Y@',
        'host'     => 'medicad.store',
        'name'     => 'Medicad',
        'replyTo'  => 'main@medicad.store',
        'replyToName' => 'Medicad'
    ];



    const ITEXMO = [
        'key' => '',
        'pwd' => ''
    ];

	#################################################
	##             SYSTEM CONFIG                   ##
    #################################################


    define('GLOBALS' , APPROOT.DS.'classes/globals');

    define('SITE_NAME' , 'medicad.store');

    define('COMPANY_NAME' , 'RMat');

    define('COMPANY_NAME_ABBR', 'Raw Matts');
    define('COMPANY_EMAIL', '--');
    define('COMPANY_TEL', '--');
    define('COMPANY_ADDRESS', ' Guiguinto Bulacan');

    

    define('KEY_WORDS' , 'BreakThrough-E Raw Matts');


    define('DESCRIPTION' , '#############');

    define('AUTHOR' , 'Raw Matts');


    define('APP_KEY' , 'BreakThrough-E-5175140471');
    
?>