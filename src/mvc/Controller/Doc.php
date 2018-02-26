<?php

namespace Controller;

use Core\Controller\Controller;
use Core\Controller\GetInterface;
use Core\View\ViewInterface;
use View\JsonView;

/**
 * Class Doc
 *
 * @package Controller
 */
class Doc extends Controller implements GetInterface {

    /** @var array */
    private $documentation;

    /**
     * @return void
     */
    public function get() {
        $this->documentation = [
            'paths' => [
                '/api/' => [
                    'get' => [
                        'description' => 'Returns the sum of each event over the last 7 days by country for the top 5 countries of all times.',
                        'parameters' => [
                            [
                                'name' => 'format',
                                'in' => 'query',
                                'type' => 'string',
                                'enum' => ['json', 'xml', 'csv'],
                                'default' => 'json'
                            ]
                        ],
                        'responses' => [
                            '200' => [
                                'description' => 'OK',
                                'body' => [
                                    'format' => ['json', 'xml', 'csv']
                                ]
                            ],
                            '400' => ['description' => 'Bad request'],
                            '404' => ['description' => 'Not found'],
                            '500' => ['description' => 'Server error']
                        ]
                    ],
                    'post' => [
                        'description' => 'Stores json formatted data (namely, event counts by day and country).',
                        'format' => 'json',
                        'parameters' => [
                            [
                                'name' => 'date',
                                'in' => 'body',
                                'type' => 'date',
                                'format' => 'YYYY-MM-DD'
                            ],
                            [
                                'name' => 'country',
                                'in' => 'body',
                                'type' => 'string',
                                'max-length' => 2
                            ],
                            [
                                'name' => 'event',
                                'in' => 'body',
                                'type' => 'string',
                                'enum' => ['view', 'play', 'click']
                            ]
                        ],
                        'responses' => [
                            '200' => ['description' => 'OK'],
                            '400' => ['description' => 'Bad request'],
                            '404' => ['description' => 'Not found'],
                            '500' => ['description' => 'Server error']
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * @return ViewInterface
     */
    public function getView() {
        $view = new JsonView($this->documentation);
        return $view;
    }

}