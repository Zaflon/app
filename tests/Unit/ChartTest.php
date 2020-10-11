<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ChartTest extends TestCase
{
    /** @var string */
    private const HEXADECIMAL_COLOR_REGEX = '/#[\d\w+]{6}/';

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testBarChart()
    {
        $expected = [
            "type" => "bar",
            "data" => [
                "labels" => [
                    0 => "Africa",
                    1 => "Asia",
                    2 => "Europe",
                    3 => "Latin America",
                    4 => "North America"
                ],
                "datasets" => [
                    0 => [
                        "label" => "First Dataset",
                        "backgroundColor" => [
                            0 => "#669623",
                            1 => "#9c17e5",
                            2 => "#2e2637",
                            3 => "#cc1095",
                            4 => "#1de3e8"
                        ],
                        "data" => [
                            0 => 2500,
                            1 => 3500,
                            2 => 1000,
                            3 => 950,
                            4 => 500,
                        ]
                    ],
                    1 => [
                        "label" => "Second Dataset",
                        "backgroundColor" => [
                            0 => "#d2062f",
                            1 => "#f5d149",
                            2 => "#69f649",
                            3 => "#1f6611",
                            4 => "#9d7c78",
                        ],
                        "data" => [
                            0 => 3000,
                            1 => 2500,
                            2 => 2000,
                            3 => 4000,
                            4 => 1500,
                        ]
                    ]
                ]
            ],
            "options" => [
                "scales" => [
                    "xAxes" => [
                        0 => [
                            "scaleLabel" => [
                                "display" => true,
                                "labelString" => "Continent"
                            ]
                        ]
                    ],
                    "yAxes" => [
                        0 => [
                            "scaleLabel" => [
                                "display" => true,
                                "labelString" => "World Population (Millions) in 2050"
                            ],
                            "ticks" => [
                                "beginAtZero" => true
                            ]
                        ]
                    ]
                ],
                "title" => [
                    "display" => true,
                    "text" => "Predicted World Population (millions) in 2050"
                ]
            ]
        ];

        $Chart = new \App\Helpers\Graph();

        $Chart->set(\App\Helpers\Graph::__CHOSEN_TYPE, "bar");

        $Chart->set(\App\Helpers\Graph::__LABELS, [
            "First Dataset" => [
                "Africa" => 2500,
                "Asia" => 3500,
                "Europe" => 1000,
                "Latin America" => 950,
                "North America" => 500
            ],
            "Second Dataset" => [
                "Africa" => 3000,
                "Asia" => 2500,
                "Europe" => 2000,
                "Latin America" => 4000,
                "North America" => 1500
            ]
        ]);

        $Chart->set(\App\Helpers\Graph::__TITLE, "Predicted World Population (millions) in 2050");

        $Chart->set(\App\Helpers\Graph::__Y_AXIS_LABEL, "World Population (Millions) in 2050");

        $Chart->set(\App\Helpers\Graph::__X_AXIS_LABEL, "Continent");

        $this->assertEquals(
            preg_replace(self::HEXADECIMAL_COLOR_REGEX, NULL, json_encode($expected, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)),
            preg_replace(self::HEXADECIMAL_COLOR_REGEX, NULL, json_encode($Chart->render(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        );
    }
}
