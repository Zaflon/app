<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ReportTest extends TestCase
{
    /** @var int */
    private const WIDTH = 200;

    /**
     * Test Width Sum.
     * 
     * @param void
     */
    public function testReportWidth()
    {
        $stub = new \stdClass();

        $stub->{'a'} = new \stdClass();

        $stub->{'a'}->{\App\Report\Report::WIDTH} = 10;
        $stub->{'a'}->{\App\Report\Report::ACTIVE} = true;

        $stub->{'b'} = new \stdClass();

        $stub->{'b'}->{\App\Report\Report::WIDTH} = 30;
        $stub->{'b'}->{\App\Report\Report::ACTIVE} = true;

        $stub->{'c'} = new \stdClass();

        $stub->{'c'}->{\App\Report\Report::WIDTH} = 50;
        $stub->{'c'}->{\App\Report\Report::ACTIVE} = true;

        $stub->{'d'} = new \stdClass();

        $stub->{'d'}->{\App\Report\Report::WIDTH} = 30;
        $stub->{'d'}->{\App\Report\Report::ACTIVE} = true;

        $this->assertSame(120, \App\Report\Report::width($stub));
    }

    /**
     * Get an Instance of \App\Report\Report.
     * 
     * @param void
     */
    public function testInstanceofReport()
    {
        $this->assertTrue(\App\Report\Report::create() instanceof \App\Report\Report);
    }

    /**
     * Test case to verify that all reports are the same width.
     * 
     * @param void
     */
    public function testAllReportsMustToHaveTheSameWidth()
    {
        foreach (\App\Http\Controllers\GenericPDFReportController::all() as $pdf) {
            $config = \App\Helpers\Utils::ctrlr2model($pdf)::REPORT;


            $WIDTH = \App\Report\Report::width(
                \App\Helpers\Utils::arr2obj($config)->{\App\Report\Report::FIELDS}
            );

            $this->assertEquals($WIDTH, self::WIDTH);
        }
    }
}
