<?php
// dynamic table
// dynamic rows
// dynamic columns
// check if gender of user == m ==> male
// check if gender of user == f ==> female

$users = [
    (object)[
        'id' => 1,
        'name' => 'ahmed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'football', 'swimming', 'running'
        ],
        'activities' => [
            "school" => 'drawing',
            'home' => 'painting'
        ],
        
        'nti 2' => 'php',
    ],
    (object)[
        'id' => 2,
        'name' => 'mohamed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'swimming', 'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ],
        'nti 2' => 'php',
    ],
    (object)[
        'id' => 3,
        'name' => 'menna',
        "gender" => (object)[
            'gender' => 'f'
        ],
        'hobbies' => [
            'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ],
        'nti 2' => 'php',
    ],  
    (object)[
        'id' => 3,
        'name' => 'koty',
        "gender" => (object)[
            'gender' => 'f'
        ],
        'hobbies' => [
            'running',"ay","hoo"
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing',
            'nti' => 'php',
        ],
        'nti 2' => 'php',
    ],  
];

?>