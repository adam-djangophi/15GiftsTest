<?php

namespace App\Console\Commands;

use App\Helpers\NumberHelper;
use App\Services\NumberConvertor;
use Illuminate\Console\Command;

class NumberToString extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '15gifts:numberToString:range {--start=1} {--end=1000000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct(private NumberConvertor $convertor)
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $start = NumberHelper::stripCommasFromNumericInt((string) $this->option('start'));
        $end = NumberHelper::stripCommasFromNumericInt((string) $this->option('end'));

        if ($end < $start) {
            $this->output->error('End number must be greater than start');
        }

        while ($start <= $end) {
            $this->output->writeln([$this->convertor->convert($start)]);
            $start++;
        }
    }
}
