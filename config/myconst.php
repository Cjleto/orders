<?php

return [
    'dish_description_can_be_empty' => true,
    'dish_min_length_description' => 2,
    'dish_max_length_description' => 550,
    'unique_dish_name' => false,
    'max_partial_prices' => 2,
    'initial_role_permissions' => [
        'admin' => [
            'manage_users',
            'manage_roles',
            'manage_menu',
            'manage_companies',
        ],
        'manager' => [
            'manage_menu',
            'manage_macro_categories',
        ]
    ],
    'macro_categories_default' => [
        [
            'name' => 'Menu',
            'description' => 'Menu principale',
        ],
        [
            'name' => 'Vini',
            'description' => 'La nostra selezione di vini',
        ]
    ],
    'categories_default' => [
        'Menu' => [
            [
                'name' => 'Antipasti',
                'description' => 'Antipasti vari',
            ],
            [
                'name' => 'Primi',
                'description' => 'Primi piatti',
            ],
            [
                'name' => 'Secondi',
                'description' => 'Secondi piatti',
            ],
            [
                'name' => 'Contorni',
                'description' => 'Contorni vari',
            ],
            [
                'name' => 'Dolci',
                'description' => 'Dolci vari',
            ],
        ],
        'Vini' => [
            [
                'name' => 'Bianchi',
                'description' => 'Vini bianchi',
            ],
            [
                'name' => 'Rossi',
                'description' => 'Vini rossi',
            ],
            [
                'name' => 'Rosati',
                'description' => 'Vini rosati',
            ],
            [
                'name' => 'Spumanti',
                'description' => 'Vini spumanti',
            ]
        ]
    ],
    'sub_categories_default' => [
        'Antipasti' => [
            [
                'name' => 'Siciliano'
            ],
            [
                'name' => 'Fritti',
            ]
        ],
        'Secondi' => [
            [
                'name' => 'Pesce'
            ],
            [
                'name' => 'Carne',
            ]
        ],
        'Primi' => [
            [
                'name' => 'Pesce'
            ],
            [
                'name' => 'Carne',
            ]
        ],
        'Dolci' => [
            [
                'name' => 'Siciliano',
            ],
            [
                'name' => 'Internzaionale',
            ]
        ],
        'Bianchi' => [
            [
                'name' => 'Siciliani',
            ],
            [
                'name' => 'Lombaardi',
            ],
            [
                'name' => 'Veneti',
            ],
        ],
        'Rossi' => [
            [
                'name' => 'Siciliani',
            ],
            [
                'name' => 'Toscani',
            ],
            [
                'name' => 'Veneti',
            ],
        ],
    ],
    'dish_default' => [
        'Antipasti' => [
            [
                'name' => 'Bruschetta',
                'description' => 'Pane tostato con pomodoro e basilico',
                'price' => 5.00,
                'is_visible' => true,
            ],
            [
                'name' => 'Caponata',
                'description' => 'Caponata siciliana',
                'price' => 6.00,
                'is_visible' => true,
            ],
            [
                'name' => 'Insalata di mare',
                'description' => 'Insalata di mare',
                'price' => 7.00,
                'is_visible' => true,
            ]
        ],
        'Primi' => [
            [
                'name' => 'Pasta al pomodoro',
                'description' => 'Pasta al pomodoro',
                'price' => 8.00,
                'is_visible' => true,
            ],
            [
                'name' => 'Pasta alla norma',
                'description' => 'Pasta alla norma',
                'price' => 9.00,
                'is_visible' => true,
                /* 'sub_category' => 'Carne' */
            ],
            [
                'name' => 'Pasta alla carbonara',
                'description' => 'Pasta alla carbonara',
                'price' => 10.00,
                'is_visible' => true,
            ]
        ],
        'Secondi' => [
            [
                'name' => 'Pesce spada alla griglia',
                'description' => 'Pesce spada alla griglia',
                'price' => 12.00,
                'is_visible' => true,
            ],
            [
                'name' => 'Tonno alla griglia',
                'description' => 'Tonno alla griglia',
                'price' => 13.00,
                'is_visible' => true,
            ],
            [
                'name' => 'Pollo alla griglia',
                'description' => 'Pollo alla griglia',
                'price' => 14.00,
                'is_visible' => true,
            ]
        ],
        'Contorni' => [
            [
                'name' => 'Patate al forno',
                'description' => 'Patate al forno',
                'price' => 4.00,
                'is_visible' => true,
            ],
            [
                'name' => 'Insalata mista',
                'description' => 'Insalata mista',
                'price' => 3.00,
                'is_visible' => true,
            ],
            [
                'name' => 'Verdure grigliate',
                'description' => 'Verdure grigliate',
                'price' => 5.00,
                'is_visible' => true,
            ]
        ],
        'Dolci' => [
            [
                'name' => 'Cannoli',
                'description' => 'Cannoli siciliani',
                'price' => 6.00,
                'is_visible' => true,
            ],
            [
                'name' => 'Tiramisù',
                'description' => 'Tiramisù',
                'price' => 7.00,
                'is_visible' => true,
            ],
            [
                'name' => 'Panna cotta',
                'description' => 'Panna cotta',
                'price' => 5.00,
                'is_visible' => true,
            ]
        ],

        'Bianchi' => [
            [
                'name' => 'Grillo',
                'description' => 'Grillo',
                'price' => 15.00,
                'is_visible' => true,
            ],
            [
                'name' => 'Catarratto',
                'description' => 'Catarratto',
                'price' => 16.00,
                'is_visible' => true,
            ],
            [
                'name' => 'Inzolia',
                'description' => 'Inzolia',
                'price' => 17.00,
                'is_visible' => true,
            ]
        ],
        'Rossi' => [
            [
                'name' => 'Nero d\'avola',
                'description' => 'Nero d\'avola',
                'price' => 18.00,
                'is_visible' => true,
            ],
            [
                'name' => 'Frappato',
                'description' => 'Frappato',
                'price' => 19.00,
                'is_visible' => true,
            ],
            [
                'name' => 'Cerasuolo di Vittoria',
                'description' => 'Cerasuolo di Vittoria',
                'price' => 20.00,
                'is_visible' => true,
            ]
        ],
        'Rosati' => [
            [
                'name' => 'Rosato',
                'description' => 'Rosato',
                'price' => 21.00,
                'is_visible' => true,
            ],
            [
                'name' => 'Rosato',
                'description' => 'Rosato',
                'price' => 22.00,
                'is_visible' => true,
            ],
            [
                'name' => 'Rosato',
                'description' => 'Rosato',
                'price' => 23.00,
                'is_visible' => true,
            ]
        ],
        'Spumanti' => [
            [
                'name' => 'Spumante',
                'description' => 'Spumante',
                'price' => 24.00,
                'is_visible' => true,
            ],
            [
                'name' => 'Spumante',
                'description' => 'Spumante',
                'price' => 25.00,
                'is_visible' => true,
            ]
        ]
    ],
    'max_prezzi_frazionati' => 2,
    'partial_price_default' => [
        'Caponata' => [
            [
                'price' => 10.00,
                'label' => 'x 2 persone',
            ],

            [
                'price' => 3.00,
                'label' => 'assaggio',
            ]

        ],
        'Bruschetta' => [
            [
                'price' => 3.00,
                'label' => 'x 1 persona',
            ],

            [
                'price' => 5.00,
                'label' => 'x 2 persone',
            ]

        ],
    ],
    'initial_allergens' => [
        [
            'name' => 'Cereali',
            "description" => "Cereali contenenti glutine, cioè: grano, segale, orzo, avena, farro, kamut o i loro ceppi ibridati e prodotti derivati",
            'icon' => 'wheat-awn'
        ],
        [
            'name' => 'Crostacei',
            "description" => "Crostacei  e prodotti a base di crostacei",
            'icon' => 'bacon'
        ],
        [
            'name' => 'Uova',
            "description" => "Può contenere Uova e prodotti a base di uova",
            'icon' => 'egg'
        ],
        [
            'name' => 'Pesce',
            "description" => "Può contenere Pesce",
            'icon' => 'fish'
        ],
        [
            'name' => 'Arachidi',
            "description" => "Può contenere Arachidi",
            'icon' => 'braille'
        ],
        [
            'name' => 'Soia',
            "description" => "Può contenere Soia",
            'icon' => 'leaf'
        ],
        [
            'name' => 'Latte',
            "description" => "Latte  e prodotti a base di latte (incluso lattosio)",
            'icon' => 'cow'
        ],
        [
            'name' => 'Frutta a guscio',
            "description" => "Può contenere Frutta a guscio",
            'icon' => 'shield'
        ],
        [
            'name' => 'Sedano',
            "description" => "Può contenere Sedano",
            'icon' => 'spa'
        ],
        [
            'name' => 'Senape',
            "description" => "Può contenere Senape",
            'icon' => 'bottle-droplet'
        ],
        [
            'name' => 'Semi di sesamo',
            "description" => "Può contenere Semi di sesamo",
            'icon' => 'seedling'
        ],
        [
            'name' => 'Anidride solforosa e solfiti',
            "description" => "Anidride solforosa e solfiti  in concentrazioni superiori a 10 mg/kg o 10 mg/litro in termini di SO2 totale da calcolarsi per i prodotti così come proposti pronti al consumo o ricostituiti conformemente alle istruzioni dei fabbricanti",
            'icon' => 'smog'
        ],
        [
            'name' => 'Lupini',
            "description" => "Può contenere Lupini",
            'icon' => 'circle-dot'
        ],
        [
            'name' => 'Molluschi',
            "description" => "Può contenere Molluschi",
            'icon' => 'shrimp'
        ],
    ],
    'initial_peculiarities' => [
        [
            'name' => 'Vegetariano',
            'icon' => 'leaf'
        ],
        [
            'name' => 'Vegano',
            'icon' => 'seedling'
        ],
        [
            'name' => 'Piccante',
            'icon' => 'fire'
        ],
        [
            'name' => 'Senza glutine',
            'icon' => 'wheat-awn'
        ],
        [
            'name' => 'Congelato',
            'icon' => 'snowflake'
        ]
        ],
    'translate_enabled' => env('TRANSLATE_ENABLED', false),
    'translate_from' => env('TRANSLATE_FROM', 'it'),
];
