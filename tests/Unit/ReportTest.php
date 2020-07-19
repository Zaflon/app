<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ReportTest extends TestCase
{
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
}
