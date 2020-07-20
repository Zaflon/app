<?php

namespace App\Helpers;

use InvalidArgumentException;

/**
 * Class responsible for managing the javacript chart class.
 *
 * The official documentation for the Javascript library can be found at:
 *
 * @see <https://www.chartjs.org>
 */
class Graph
{
    /** @var string */
    public const __X_AXIS_LABEL = "@X-AXIS-LABEL@";

    /** @var string */
    public const __Y_AXIS_LABEL = "@Y-AXIS-LABEL@";

    /** @var string */
    public const __TITLE = "@__TITLE@";

    /** @var string */
    public const __CHOSEN_TYPE = "@CHOSEN_TYPE@";

    /** @var string */
    public const __DATASET = "@DATASET@";

    /** @var string */
    public const __LABELS = "@LABELS@";

    /** @var array */
    public $OPTIONS = [
        self::__X_AXIS_LABEL => NULL,
        self::__Y_AXIS_LABEL => NULL,
        self::__TITLE => NULL,
        self::__CHOSEN_TYPE => NULL,
        self::__DATASET => [],
        self::__LABELS => []
    ];

    /**
     * Array containing all types of graphics possible to be rendered...
     *
     * There cannot be any types outside of that array in use, otherwise validation will not work correctly.
     *
     * @var array
     */
    private const TYPES = [
        'bar' => 'bar',
        'bubble' => 'bubble',
        'doughnut' => 'doughnut',
        'horizontalBar' => 'horizontalBar',
        'line' => 'line',
        'pie' => 'pie',
        'radar' => 'radar',
        'polarArea' => 'polarArea',
    ];

    /**
     * Method responsible for returning the options array.
     * 
     * @param void
     * 
     * @return array
     */
    private function makeOptions(): array
    {
        return [
            'scales' => [
                'xAxes' => [[
                    'scaleLabel' => [
                        'display' => true,
                        'labelString' => $this->get(self::__X_AXIS_LABEL),
                    ],

                ]],
                'yAxes' => [[
                    'scaleLabel' => [
                        'display' => true,
                        'labelString' => $this->get(self::__Y_AXIS_LABEL),
                    ],
                    'ticks' => [
                        'beginAtZero' => true
                    ]
                ]],
            ],
            'title' => [
                'display' => true,
                'text' => $this->get(self::__TITLE),
            ],
        ];
    }

    /**
     * Chart Type Getter.
     *
     * @param void
     * 
     * @return array
     */
    protected function getTypes(): array
    {
        return self::TYPES;
    }

    /**
     * Set Parameter.
     * 
     * @param string $index
     * @param mixed $arg
     * 
     * @return true|InvalidArgumentException
     */
    public function set(
        string $index,
        $arg
    ): bool {
        if (in_array($index, $this->OPTIONS())) {
            $this->OPTIONS[$index] = $arg;

            return true;
        }

        throw new InvalidArgumentException("The attribute :{$arg} does not belong to this class!");
    }

    /**
     * Getter Method.
     * 
     * @param string $arg
     * 
     * @return mixed|InvalidArgumentException
     */
    public function get(
        string $arg
    ) {
        if (in_array($arg, $this->OPTIONS())) {
            return $this->OPTIONS[$arg];
        }

        throw new InvalidArgumentException("The attribute :{$arg} does not belong to this class!");
    }

    /**
     * Options Getter.
     * 
     * @param void
     * 
     * @return array
     */
    public function OPTIONS(): array
    {
        return [
            self::__X_AXIS_LABEL,
            self::__Y_AXIS_LABEL,
            self::__TITLE,
            self::__CHOSEN_TYPE,
            self::__DATASET,
            self::__LABELS
        ];
    }

    /**
     * Render Method.
     * 
     * @param void
     * 
     * @return array
     */
    public function render(): array
    {
        return [
            'type' => $this->OPTIONS[self::__CHOSEN_TYPE],
            'data' => $this->data(),
            'options' => $this->makeOptions()
        ];
    }

    /**
     * Get Data.
     * 
     * @param void
     * 
     * @return array
     */
    private function data(): array
    {
        switch ($this->get(self::__CHOSEN_TYPE)) {
            case "bar":
                return $this->bar();
        }
    }

    /**
     * Bar Method.
     * 
     * @param void
     * 
     * @return array
     */
    private function bar(): array
    {
        $BandyArr = [];

        foreach ($this->get(self::__LABELS) as $key => $data) {
            $BandyArr[] = [
                "label" => $key,
                "backgroundColor" => \App\Helpers\Utils::getArrayOfHexColors(
                    $this->count(self::__LABELS)
                ),
                "data" => array_values($data)
            ];
        }

        return [
            "labels" => $this->label(),
            "datasets" => $BandyArr
        ];
    }

    /**
     * Counter Method.
     * 
     * @param void
     * 
     * @return int|InvalidArgumentException
     */
    public function count(
        string $arg
    ): int {
        switch ($arg) {
            case self::__DATASET:
                return count($this->get(self::__LABELS));

            case self::__LABELS:
                return count($this->label());
        }

        throw new InvalidArgumentException("The attribute :{$arg} does not belong to this class!");
    }

    /**
     * Labels Getter.
     * 
     * @param void
     * 
     * @return array
     */
    public function label(): array
    {
        return array_keys(
            $this->get(self::__LABELS)[array_key_first(
                $this->get(self::__LABELS)
            )]
        );
    }
}
