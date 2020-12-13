<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckExamStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exam:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update exams status every minutes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $exams = DB::table('exams')->select('id', 'start_at', 'duration')->get();
        try
        {
            foreach($exams as $exam)
            {
                $hours = Carbon::parse($exam->duration)->format('H');
                $minutes = Carbon::parse($exam->duration)->format('i');
                $exam_expired_time = Carbon::parse($exam->start_at)->addDay(0)->addHour($hours)->addMinutes($minutes);
                if( (strtotime(now()) - strtotime($exam_expired_time)) > 1)
                {
                    DB::table('exams')->where('id', $exam->id)->update(['status' => '3']);
                }
            }
        }catch(\Exception $e)
        {
            Log::error($e);
        }


    }
}
