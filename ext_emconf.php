<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'Fr localization handling',
    'description' => 'Use hooks to enforce TYPO3 fallbackType: free for tt_content records.',
    'category' => 'be',
    'state' => 'stable',
    'author' => 'familie redlich:digital',
    'author_email' => 'v.falcon@familie-redlich.de',
    'author_company' => 'familie redlich digital',
    'version' => '2.0.2',
    'constraints' =>
        [
            'depends' =>
                [
                    'typo3' => '10.4.0-11.99.99',
                ],
            'conflicts' =>
                [
                ],
            'suggests' =>
                [
                ],
        ]
];
