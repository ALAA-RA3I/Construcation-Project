<?php


return [
    'docusign' => [
        'accountId' => env('DOCUSIGN_ACCOUNT_ID',''),
        'integrationKey' => env('DOCUSIGN_INTEGRATION_KEY',''),
        'clientSecret' => env('DOCUSIGN_CLIENT_SECRET',''),
        'userId' =>env('DOCUSIGN_USER_ID',''),
        'privateKeyPath' =>env('DOCUSIGN_PRIVATE_KEY_PATH',''),
        'baseURI' =>env('DOCUSIGN_BASE_URI',''),
        'authBaseURI' =>env('DOCUSIGN_AUTH_BASE_URI',''),
    ]
];