<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'Fr localization handling',
    'description' => 'Use hooks to enforce TYPO3 fallbackType: free for tt_content records.',
    'category' => 'be',
    'state' => 'beta',
    'author' => 'familie redlich:digital',
    'author_email' => 'v.falcon@familie-redlich.de',
    'author_company' => 'familie redlich digital',
    'version' => '0.2.0',
    'constraints' =>
        [
            'depends' =>
                [
                    'typo3' => '10.4.1-10.4.99',
                ],
            'conflicts' =>
                [
                ],
            'suggests' =>
                [
                ],
        ]
];
