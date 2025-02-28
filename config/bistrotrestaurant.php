<?php

return [
    'macro_categories_default' => [
        [
            'name' => 'Menu',
            'description' => 'Menu principale',
            'categories' => [
                'Menu' => [
                    [
                        'name' => 'CRUDI',
                        'description' => '',
                        'dishes' => [
                            [
                                'name' => 'Plateau Magnum (per due)',
                                'description' => 'Scampi e gamberi di Terrasini, ostriche fine de la Claire, tartare e carpacci dalla pescheria',
                                'price' => 80.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Plateau Royal (per due)',
                                'description' => 'Scampi e gamberi di Terrasini, ostriche special, aragosta delle Egadi,tartare e carpacci dalla pescheria',
                                'price' => 100.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Selezione di crudi',
                                'description' => 'Pesce e crostacei',
                                'price' => 34.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Le tre tartare',
                                'description' => 'tonno rosso del mediterraneo su salsa di avocado, salmone red king e cream fresh, pesce bianco dalla pescheria e caviale di acciughe',
                                'price' => 24.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Tartare di tonno rosso siciliano',
                                'description' => 'con soffice di novella e agretto agli agrumi di Sicilia',
                                'price' => 22.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'I carpacci',
                                'description' => 'Ricciola mediterranea con nocciole e marmellata di cipolla rossa, aguglia imperiale marinata, pesce spada',
                                'price' => 22.00,
                                'is_visible' => true,
                            ]
                        ],
                        'sub_categories' => [
                            [
                                'name' => 'Frutti di mare',
                                'dishes' => [
                                    [
                                        'name' => 'Ostriche fine Claire',
                                        'description' => '',
                                        'price' => 6.00,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'Ostriche special',
                                        'description' => '',
                                        'price' => 7.00,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'Gamberi di Terrasini (etto)',
                                        'description' => '',
                                        'price' => 12.00,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'Scampi Sicilia (etto)',
                                        'description' => '',
                                        'price' => 12.00,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'Bruschetta ricci di mare siciliani',
                                        'description' => '',
                                        'price' => 7.00,
                                        'is_visible' => true,
                                    ],
                                ]
                            ]
                        ],

                    ],
                    [
                        'name' => 'CALDI',
                        'description' => '',
                        'dishes' => [
                            [
                                'name' => 'Carosello di caldi',
                                'description' => 'degustazione dei nostri piatti cotti',
                                'price' => 26.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Polpo alla Eoliana',
                                'description' => 'Pomodorini, olive,  capperi e patate',
                                'price' => 20.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Polpettine di tonno rosso',
                                'description' => 'In salsa di pomodoro con pinoli e menta',
                                'price' => 18.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Caponata siciliana di ricciola',
                                'description' => 'Con lamelle di mandorle d’avola tostate',
                                'price' => 18.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Trancio di baccalà lomo',
                                'description' => 'Allo sfincione palermitano ',
                                'price' => 26.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Tempura',
                                'description' => 'di gamberoni di Terrasini',
                                'price' => 26.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Frittura dalla pescheria',
                                'description' => 'Calamari, gamberi, pesce bianco e paranza',
                                'price' => 24.00,
                                'is_visible' => true,
                            ],

                        ]
                    ],
                    [
                        'name' => 'PASTE | RISI',
                        'description' => '',
                        'dishes' => [
                            [
                                'name' => 'Tonarello',
                                'description' => 'Cacio e pepe, tartare di gamberi di Terrasini e tartufo di stagione',
                                'price' => 34.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Tagliolino',
                                'description' => 'Al caviale di tartufo, burro affumicato e tartare di gambero',
                                'price' => 34.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Paccheri',
                                'description' => 'Gamberone, mollica tostata, datterino e finocchietto selvatico',
                                'price' => 36.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Risotto',
                                'description' => 'Mediterraneo, cozze, vongole, calamaro, gambero, pomodoro fresco',
                                'price' => 34.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Fettuccine',
                                'description' => 'All’aragosta delle Egadi',
                                'price' => 13.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Linguine',
                                'description' => 'Calamari, sparacelli e crumble di pane al limone',
                                'price' => 22.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Busiate',
                                'description' => 'Trapanesi, concessè di pomodoro fresco, finocchietto, mandorle d’avola tostate e tartare di scampi',
                                'price' => 26.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Gnocchetti',
                                'description' => 'Ricciola, crema di melanzane perline, pinoli e mentuccia',
                                'price' => 22.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Pilaf',
                                'description' => 'Di riso croccante con gamberi di Terrasini e curry',
                                'price' => 26.00,
                                'is_visible' => true,
                            ],
                        ]
                    ],
                    [
                        'name' => 'DALLA PESCHERIA',
                        'description' => '',
                        'dishes' =>
                        [
                            [
                                'name' => 'Gran zuppa di mare (per due)',
                                'description' => 'Crostacei e frutti di mare con crostoni di pane caldo al timo limonato',
                                'price' => 68.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Mare al fuoco (per due)',
                                'description' => 'Scampi, gamberoni, calamaro e pescato del giorno',
                                'price' => 68.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Crostacei alla Catalana',
                                'description' => 'Novella, pomodorini, olive, capperi, cipolla rossa di Tropea',
                                'price' => 38.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Trilogia di tonno rosso del Mediterraneo',
                                'description' => 'In crosta di pistacchio, tataki scottato e in agrodolce',
                                'price' => 22.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Rollino di spada',
                                'description' => 'caciocavallo ragusano e pomodorino secco',
                                'price' => 22.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Trancio di ricciola alla lipariota',
                                'description' => 'Pomodorini, olive, capperi e patate',
                                'price' => 24.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Trancio di mupa all’acqua pazza',
                                'description' => 'Pomodorini e patate',
                                'price' => 24.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Tagliata di tonno rosso',
                                'description' => 'Rucola, pomodorini e aceto balsamico',
                                'price' => 20.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Trancio di spada alla palermitana',
                                'description' => 'Panatura al lime',
                                'price' => 26.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Dalla pescheria (etto)',
                                'description' => '',
                                'price' => 8.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Aragoste Egadi (etto)',
                                'description' => '',
                                'price' => 13.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Gamberoni rossi di terrasini (etto)',
                                'description' => '',
                                'price' => 12.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Scampi Sicilia',
                                'description' => '',
                                'price' => 12.00,
                                'is_visible' => true,
                            ],
                        ]
                    ],
                    [
                        'name' => 'ALTERNATIVE AL PESCE',
                        'description' => '',
                        'dishes' =>
                        [
                            [
                                'name' => 'Soufflè di melanzane',
                                'description' => 'cuor di bufala, petali di grana e coulise al pomodoro',
                                'price' => 14.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Battuta di Fassona',
                                'description' => 'capperi, pomodorini, rucola e lime',
                                'price' => 18.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Crudo e bufala',
                                'description' => 'San Daniele 36 mesi e mozzarella campana dopo',
                                'price' => 16.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Tonnarello',
                                'description' => 'Cacio e pepe e tartufo di stagione',
                                'price' => 20.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Fettuccine',
                                'description' => 'Al ragù di cinghiale',
                                'price' => 22.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Tagliatelle',
                                'description' => 'porcini e petali di grana',
                                'price' => 20.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Gnocchetti alla sorrentina',
                                'description' => 'Pomodoro e mozzarella',
                                'price' => 14.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Tagliata di manzo',
                                'description' => 'rucola, pomodorino e aceto balsamico',
                                'price' => 20.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Angus',
                                'description' => 'con patate al forno',
                                'price' => 26.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Tournedos',
                                'description' => 'Porcini e tartufo',
                                'price' => 32.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Filetto',
                                'description' => 'al pepe verde',
                                'price' => 24.00,
                                'is_visible' => true,
                            ],
                        ]
                    ],
                    [
                        'name' => 'CONTORNI',
                        'description' => '',
                        'dishes' => [
                            [
                                'name' => 'Verdure di campo in padella',
                                'description' => '',
                                'price' => 8.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Patate al rosmarino',
                                'description' => '',
                                'price' => 8.00,
                                'is_visible' => true,
                            ],
                            [
                                'name' => 'Purea di patate al lime e zenzero',
                                'description' => '',
                                'price' => 8.00,
                                'is_visible' => true,
                            ],
                        ]
                    ],
                    [
                        'name' => 'MENU DEGUSTAZIONE',
                        'description' => '',
                        'dishes' =>
                        [
                            [
                                'name' => 'Degustazione',
                                'description' => 'Carosello di caldi e crudi
                                          Battuto di primi con crostacei e pescato
                                          Mare al fuoco ( vini esclusi )',
                                'price' => 78,
                                'is_visible' => true,
                            ],
                        ]
                    ]
                ],
            ]
        ],
        [
            'name' => 'Vini',
            'description' => 'I nostri vini',
            'categories' => [
                'Vini' => [
                    [
                        'name' => 'Le Bollicine',
                        'description' => '',
                        'dishes' => [],
                        'sub_categories' => [
                            [
                                'name' => 'Francia',
                                'dishes' => [
                                    [
                                        'name' => 'DOM PERIGNON BRUT',
                                        'description' => 'Chardonnay/Pinot Nero',
                                        'price' => 440,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'DOM PERIGNON BRUT ROSè',
                                        'description' => 'Chardonnay/Pinot Nero',
                                        'price' => 590,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'MOET & CHANDON BRUT RESERVE IMPERIALE',
                                        'description' => 'Pinot nero/ Chardonnay / Pinot Meunier',
                                        'price' => 90,
                                        'is_visible' => true,
                                        'partial_prices' => [
                                            [
                                                'label' => '1/2',
                                                'price' => 55.00,
                                                'is_visible' => true,
                                            ],
                                        ],
                                    ],
                                    [
                                        'name' => 'VEUVE CLIQUOT BRUT YELLOW LABEL',
                                        'description' => 'Pinot nero/ Chardonnay / Pinot Meunier',
                                        'price' => 110,
                                        'is_visible' => true,
                                        'partial_prices' => [
                                            [
                                                'label' => '1/2',
                                                'price' => 58.00,
                                                'is_visible' => true,
                                            ],
                                        ],

                                    ],
                                    [
                                        'name' => 'VEUVE CLIQUOT BRUT ROSè',
                                        'description' => 'Pinot nero/ Chardonnay / Pinot Meunier',
                                        'price' => 110,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'RUINART BRUT BLANC DE BLANC',
                                        'description' => 'Chardonnay',
                                        'price' => 150,
                                        'is_visible' => true,
                                        'partial_prices' => [
                                            [
                                                'label' => '1/2',
                                                'price' => 80.00,
                                                'is_visible' => true,
                                            ],
                                        ],
                                    ],
                                    [
                                        'name' => 'RUINART BRUT ROSè',
                                        'description' => 'Chardonnay',
                                        'price' => 160,
                                        'is_visible' => true,
                                        'partial_prices' => [
                                            [
                                                'label' => '1/2',
                                                'price' => 88.00,
                                                'is_visible' => true,
                                            ],
                                        ],
                                    ],
                                    [
                                        'name' => 'LOUIS RODERER BRUT COLLECTION',
                                        'description' => 'Pinot nero/ Chardonnay / Pinot Meunier',
                                        'price' => 90,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'LOUIS RODERER CRISTAL',
                                        'description' => 'Chardonnay Pinot nero',
                                        'price' => 550,
                                        'is_visible' => true,
                                    ],
                                ]
                            ],
                            [
                                'name' => 'Franciacorta',
                                'dishes' => [
                                    [
                                        'name' => 'BELLAVISTA ALMA BRUT',
                                        'description' => 'Chardonnay / Pinot Bianco / Pinot nero',
                                        'price' => 54,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'BELLAVISTA ROSè',
                                        'description' => 'Chardonnay / Pinot nero',
                                        'price' => 68,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'CA DEL BOSCO CUVEE PRESTIGE',
                                        'description' => 'Chardonnay / Pinot nero / Pinot Bianco',
                                        'price' => 58,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'CA DEL BOSCO SATEN',
                                        'description' => 'Chardonnay/Pinot Bianco',
                                        'price' => 78,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'CA DEL BOSCO ANNAMARIA CLEMENTI',
                                        'description' => 'Chardonnay / Pinot nero / Pinot bianco',
                                        'price' => 240,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'VEZZOLI CHARDONNAY',
                                        'description' => '',
                                        'price' => 32,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'BERLUCCHI BRUT 61',
                                        'description' => 'Chardonnay Pinot nero',
                                        'price' => 38,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'MARCHESE ANTINORI BLANC DE BLANCS',
                                        'description' => 'Chardonnay Pinot bianco',
                                        'price' => 44,
                                        'is_visible' => true,
                                    ],
                                ]
                            ],
                            [
                                'name' => 'Trentino Alto Adige',
                                'dishes' => [
                                    [
                                        'name' => 'FERRARI MAXIMUM BRUT',
                                        'description' => 'Chardonnay',
                                        'price' => 38,
                                        'is_visible' => true,
                                    ]
                                ]
                            ],
                            [
                                'name' => 'Veneto',
                                'dishes' => [
                                    [
                                        'name' => 'NINO FRANCO PROSECCO RUSTICO',
                                        'description' => 'Glera',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ]
                                ]
                            ],
                            [
                                'name' => 'Sicilia',
                                'dishes' => [
                                    [
                                        'name' => 'MILAZZO METODO CLASSICO',
                                        'description' => 'Chardonnay Inzolia',
                                        'price' => 42,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'CUSUMANO 700 BRUT',
                                        'description' => 'Chardonnay Pinot nero',
                                        'price' => 42,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'TASCA ALMERITA BRUT',
                                        'description' => 'Chardonnay',
                                        'price' => 46,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'DONNAFUGATA BRUT',
                                        'description' => 'Chardonnay Pinot nero',
                                        'price' => 38,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'DONNAFUGATA ROSè',
                                        'description' => 'Pinot nero',
                                        'price' => 42,
                                        'is_visible' => true,
                                    ],
                                ]
                            ],
                            [
                                'name' => 'Etna',
                                'dishes' => [
                                    [
                                        'name' => 'PLANETA BRUT CARRICANTE',
                                        'description' => '',
                                        'price' => 38,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'FIRRIATO GAUDENSIUS BLANC DE NOIRS',
                                        'description' => 'Nerello mascalese',
                                        'price' => 42,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'TERRAZZE DELL\'ETNA CUVèE BRUT',
                                        'description' => 'Chardonnay',
                                        'price' => 42,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'TERRAZZE DELL\'ETNA ROSè',
                                        'description' => 'Pinot nero/ Nerello Mascalese',
                                        'price' => 44,
                                        'is_visible' => true,
                                    ],
                                ]
                            ]
                        ]
                    ],
                    [
                        'name' => 'Bianchi e Rosati',
                        'description' => '',
                        'dishes' => [],
                        'sub_categories' => [
                            [
                                'name' => 'Trentino Alto Adige',
                                'dishes' => [
                                    [
                                        'name' => 'HOFSTATTER JOSEPH',
                                        'description' => 'Gewurztraminer',
                                        'price' => 30,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'SAINT MICHAEL EPPAN SANCT VALENTIN SAUVIGNON',
                                        'description' => '',
                                        'price' => 40,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'SAINT MICHAEL EPPAN SANCT VALENTIN PINOT GRIGIO',
                                        'description' => '',
                                        'price' => 40,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'SAINT MICHAEL EPPAN RIESLING',
                                        'description' => '',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'TRAMIN GEWURZTRAMINER',
                                        'description' => '',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'TRAMIN MULLER THURGAU',
                                        'description' => '',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'TRAMIN PINOT BIANCO',
                                        'description' => '',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                ]
                            ],
                            [
                                'name' => 'Friuli Venezia Giulia',
                                'dishes' => [
                                    [
                                        'name' => 'JERMANN VINTAGE TUNINA',
                                        'description' => 'Chardonnay/Malvasia/Picolit/RibollaGialla/Sauvignon',
                                        'price' => 80,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'JERMANN CHARDONNAY',
                                        'description' => '',
                                        'price' => 34,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'JERMANN SAVUGINON',
                                        'description' => '',
                                        'price' => 34,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'JERMANN PINOT GRIGIO',
                                        'description' => '',
                                        'price' => 34,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'LIVIO FELLUGA RIBOLLA GIALLA',
                                        'description' => '',
                                        'price' => 30,
                                        'is_visible' => true,
                                    ],
                                ]
                            ],
                            [
                                'name' => 'Piemonte',
                                'dishes' => [
                                    [
                                        'name' => 'GAJA ROSSJ BASS',
                                        'description' => 'Chardonnay',
                                        'price' => 110,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'GAJA & REJ',
                                        'description' => 'Chardonnay',
                                        'price' => 440,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'CERETTO BLANGè',
                                        'description' => 'Arneis',
                                        'price' => 34,
                                        'is_visible' => true,
                                    ],
                                ]
                            ],
                            [
                                'name' => 'Toscana',
                                'dishes' => [
                                    [
                                        'name' => 'GAJA VISTAMARE',
                                        'description' => 'Vermentino/Viognier/Chardonnay/Sauvognon Blanc',
                                        'price' => 68,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'ANTINORI GUADO AL TASSO',
                                        'description' => 'Vermentino',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'ANTINORI GUADO AL TASSO SCALABRONE ROSè',
                                        'description' => 'Merlot/syrah',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                ]
                            ],
                            [
                                'name' => 'Umbria',
                                'dishes' => [
                                    [
                                        'name' => 'ANTINORI BRAMITO DELLA SALA',
                                        'description' => 'Chardonnay',
                                        'price' => 34,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'ANTINORI CONTE DELLA VIPERA',
                                        'description' => 'Sauvignon',
                                        'price' => 38,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'ANTINORI CERVARO DELLA SALA',
                                        'description' => 'Chardonnay/Grechetto',
                                        'price' => 80,
                                        'is_visible' => true,
                                    ],
                                ]

                            ],
                            [
                                'name' => 'Abruzzo',
                                'dishes' => [
                                    [
                                        'name' => 'MASCIARELLI TREBBIANO D\'ABBRUZZO',
                                        'description' => 'Trebbiano',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'MASCIARELLI CASTELLO DI SEMIVICOLI',
                                        'description' => 'Pecorino',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                ]
                            ],
                            [
                                'name' => 'Campania',
                                'dishes' => [
                                    [
                                        'name' => 'FEUDI SAN GREGORIO SERRO CIELO',
                                        'description' => 'Falanghina',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'FEUDI SAN GREGORIO PIETRA CALDA',
                                        'description' => 'Fiano',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'FEUDI SAN GREGORIO CUTIZZI',
                                        'description' => 'Greco di Tufo',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                ]
                            ],
                            [
                                'name' => 'Sicilia',
                                'dishes' => [
                                    [
                                        'name' => 'DONNAFUGATA VIGNA DI GABRI',
                                        'description' => 'Ansonica/Catarratto/Chardonnay/Sauvignon/Viognier',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'DONNAFUGATA PASSI PERDUTI',
                                        'description' => 'Grillo',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'DONNAFUGATA CHIARANDà',
                                        'description' => 'Chardonnay',
                                        'price' => 48,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'TASCA LEONE',
                                        'description' => 'Catarratto/Pinot bianco / Sauvignon / Traminer Aromatico',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'TASCA GRILLO DI MOZIA',
                                        'description' => '',
                                        'price' => 34,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'TASCA NOZZE D\'ORO',
                                        'description' => 'Inzolia / Sauvignon',
                                        'price' => 38,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'TASCA VIGNE SAN FRANCESCO',
                                        'description' => 'Chardonnay',
                                        'price' => 58,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'FEUDO MONTONI GRILLO DI TIMPA',
                                        'description' => '',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'FEUDO MONTONI CATARRATTO DEL MASSO',
                                        'description' => '',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'FEUDO MONTONI INZOLIA',
                                        'description' => '',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'PLANETA CHARDONNAY',
                                        'description' => '',
                                        'price' => 40,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'MARCO DE BARTOLI GRAPPOLI DEL GRILLO',
                                        'description' => '',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'MARCO DE BARTOLI PIETRA NERA',
                                        'description' => 'Zibibbo',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'FIRRIATO CHARME',
                                        'description' => 'Grillo Zibibbo',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'FIRRIATO QUATER VITIS',
                                        'description' => 'Carricante/Catarratto/Inzolia/Zibibbo',
                                        'price' => 30,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'FIRRIATO SANT\'AGOSTINO',
                                        'description' => 'Chardonnay / Catarratto',
                                        'price' => 30,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'FIRRIATO CHARME ROSè',
                                        'description' => 'Nero d\'avola/ Nerello mascalese',
                                        'price' => 30,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'GORGHI TONDI BABBIO',
                                        'description' => 'Grillo/Zibibbo/Daimaschino',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'PELLEGRINO GIBELè',
                                        'description' => 'Zibibbo',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'FINA KIKè',
                                        'description' => 'Traminer',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'FINA MAMARì',
                                        'description' => 'Sauvignon',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'FINA HANAM ROSè',
                                        'description' => 'Merlot',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'CUSUMANO ANGIMBè',
                                        'description' => 'Inzolia Chardonnay',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'CUSUMANO RAMUSA ROSè',
                                        'description' => 'Pinot Nero',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'MILAZZO ROSE DI ROSA ROSè',
                                        'description' => 'Inzolia Rosa / Chardonnay',
                                        'price' => 32,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'MILAZZO BIANCO DI NERA',
                                        'description' => 'Nero cappuccio / Chardonnay / Inzolia',
                                        'price' => 30,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'MILAZZO MARIA COSTANZA',
                                        'description' => 'Inzolia / Chardonnay',
                                        'price' => 36,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'MILAZZO SELEZIONE DI FAMIGLIA',
                                        'description' => 'Chardonnay',
                                        'price' => 42,
                                        'is_visible' => true,
                                    ],
                                ]
                            ],
                            [
                                'name' => 'Etna',
                                'dishes' => [
                                    [
                                        'name' => 'FIRRIATO LE SABBIE DELL\'ETNA',
                                        'description' => 'Carricante/Catarratto',
                                        'price' => 29,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'TERRAZZE DELL\'ETNA CIURI',
                                        'description' => 'Carricante/Nerello Mascalese',
                                        'price' => 30,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'CUSUMANO ALTAMORA',
                                        'description' => 'Carricante',
                                        'price' => 38,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'TASCA TACANTE BUONORA',
                                        'description' => 'Carricante',
                                        'price' => 32,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'PLANETA ERUZIONE 1614',
                                        'description' => 'Carricante',
                                        'price' => 30,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'DONNAFUGATA SUL VULCANO',
                                        'description' => 'Carricante',
                                        'price' => 34,
                                        'is_visible' => true,
                                    ],
                                ]
                            ],
                            [
                                'name' => 'Francia',
                                'dishes' => [
                                    [
                                        'name' => 'DAMPT CHABLIS',
                                        'description' => 'Chardonnay',
                                        'price' => 40,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'ALBERT PIC CHABLIS SAINT PIERRE',
                                        'description' => 'Chardonnay',
                                        'price' => 48,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'BARON DE LADOUCETTE SANCERRE COMTE LAFOND',
                                        'description' => 'Sauvignon',
                                        'price' => 48,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'BARON DE LADOUCETTE POUILLY FUMè',
                                        'description' => 'Sauvignon',
                                        'price' => 50,
                                        'is_visible' => true,
                                    ],
                                ]
                            ],
                            [
                                'name' => 'Israele',
                                'dishes' => [
                                    [
                                        'name' => 'YARDEN GEWURZTRAMINER',
                                        'description' => '',
                                        'price' => 30,
                                        'is_visible' => true,
                                    ],

                                ]
                            ],
                            [
                                'name' => 'Nuova Zelanda',
                                'dishes' => [
                                    [
                                        'name' => 'CLOUDY BAY SAUVIGNON',
                                        'description' => '',
                                        'price' => 58,
                                        'is_visible' => true,
                                    ],

                                ]
                            ]
                        ]
                    ],
                    [
                        'name' => 'Rossi',
                        'description' => '',
                        'dishes' => [],
                        'sub_categories' => [
                            [
                                'name' => 'Trentino Alto Adige',
                                'dishes' => [
                                    [
                                        'name' => 'TRAMIN PINOT NERO',
                                        'description' => 'Pinot nero',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'HOFSTATTER MECZAN',
                                        'description' => 'Pinot nero',
                                        'price' => 32,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'HOFSTATTER LAGREIN',
                                        'description' => '',
                                        'price' => 34,
                                        'is_visible' => true,
                                    ],
                                ]
                            ],
                            [
                                'name' => 'Friuli Venezia Giulia',
                                'dishes' => [
                                    [
                                        'name' => 'LIVIO FELLUGA VERTIGO',
                                        'description' => 'Merlot Cabernet',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ]
                                ]
                            ],
                            [
                                'name' => 'Veneto',
                                'dishes' => [
                                    [
                                        'name' => 'BERTANI LE MINIERE',
                                        'description' => 'Valpolicella classico',
                                        'price' => 30,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'BERTANI AMARONE VALPANTENA',
                                        'description' => 'Corvina Veronese/ Rondinella',
                                        'price' => 68,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'BERTANI AMARONE VALPOLICELLA RISERVA',
                                        'description' => 'Corvina Veronese/ Rondinella',
                                        'price' => 160,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'MASI COSTANERA AMARONE',
                                        'description' => 'Corvina/Rondinella/Molinara',
                                        'price' => 80,
                                        'is_visible' => true,
                                    ],
                                ]
                            ],
                            [
                                'name' => 'Piemonte',
                                'dishes' => [
                                    [
                                        'name' => 'CERETTO DOLCETTO D\'ALBA ROSSANA',
                                        'description' => '',
                                        'price' => 30,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'CERETTO BAROLO',
                                        'description' => '',
                                        'price' => 100,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'GAJA SITO MORESCO',
                                        'description' => 'Nebbiolo',
                                        'price' => 78,
                                        'is_visible' => true,
                                    ]
                                ]
                            ],
                            [
                                'name' => 'Toscana',
                                'dishes' => [
                                    [
                                        'name' => 'FRESCOBALDI NIPOZZANO RISERVA CHIANTI RUFINA',
                                        'description' => '',
                                        'price' => 30,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'FRESCOBALDI CASTELGIOCONDO',
                                        'description' => 'Brunello di Montalcini',
                                        'price' => 70,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'ANTINORI TIGNANELLO',
                                        'description' => 'Sangiovese/Cabernet Sauvignon/ Cabernet Franc',
                                        'price' => 350,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'ANTINORI SOLAIA',
                                        'description' => 'Cabernet Sauvignon, Cabernet Franc e Sangiovese',
                                        'price' => 520,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'GAJA PIEVE SANTA RESTITUITA',
                                        'description' => 'Brunello di Montalcino',
                                        'price' => 140,
                                        'is_visible' => true,
                                    ],
                                ]
                            ],
                            [
                                'name' => 'Campania',
                                'dishes' => [
                                    [
                                        'name' => 'FEUDI SAN GREGORIO DAL RE',
                                        'description' => 'Aglianico',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                ]
                            ],
                            [
                                'name' => 'Sicilia',
                                'dishes' => [
                                    [
                                        'name' => 'DONNAFUGATA BELL\'ASSAI',
                                        'description' => 'Frappato',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'DONNAFUGATA TANCREDI',
                                        'description' => 'Cabernet Sauvignon, Nero d\'Avola, Tannat',
                                        'price' => 48,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'DONNAFUGATA FLORAMUNDI',
                                        'description' => 'Cerasuolo',
                                        'price' => 32,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'DONNAFUGATA MILLE E UNA NOTTE',
                                        'description' => 'Nero d\'Avola/Petit Verdot/ Sirah',
                                        'price' => 98,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'FEUDO MONTONI PERRICONE',
                                        'description' => '',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'FIRRIATO SANT AGOSTINO',
                                        'description' => 'Nero d\'Avola, Sirah',
                                        'price' => 30,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'FEUDO MONTONI QUATER',
                                        'description' => 'Nero d\'Avola/ Perricone / Frappato / Nerello Cappuccio',
                                        'price' => 30,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'FINA SIRAH',
                                        'description' => '',
                                        'price' => 28,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'MILAZZO MARIA COSTANZA',
                                        'description' => 'Nero d\'Avola',
                                        'price' => 48,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'PELLEGRINO GAZZEROTTA',
                                        'description' => 'Malbec',
                                        'price' => 32,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'TASCA ROSSO DEL CONTE',
                                        'description' => 'Perricone, Nero d\'Avola',
                                        'price' => 88,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'TASCA VIGNE SAN FRANCESCO',
                                        'description' => 'Cabernet Sauvignon',
                                        'price' => 70,
                                        'is_visible' => true,
                                    ],
                                ]
                            ],
                            [
                                'name' => 'Etna',
                                'dishes' => [
                                    [
                                        'name' => 'DONNAFUGATA SUL VULCANO',
                                        'description' => 'Nerello Mascalese',
                                        'price' => 30,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'CUSUMANO ALTAMORA GUARDIOLA',
                                        'description' => 'Nerello Mascalese',
                                        'price' => 70,
                                        'is_visible' => true,
                                    ],
                                    [
                                        'name' => 'TERRAZZE DELL\'ETNA CARUSO',
                                        'description' => 'Nerello Mascalese / Nerello Cappuccio',
                                        'price' => 36,
                                        'is_visible' => true,
                                    ],
                                ]
                            ],
                            [
                                'name' => 'Nuova Zelanda',
                                'dishes' => [
                                    [
                                        'name' => 'CLOUDY BAY',
                                        'description' => 'Pinot Nero',
                                        'price' => 60,
                                        'is_visible' => true,
                                    ],
                                ]
                            ]
                        ]
                    ],
                ]
            ]
        ]
    ]
];
