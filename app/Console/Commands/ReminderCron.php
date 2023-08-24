<?php

namespace App\Console\Commands;

use App\Http\Controllers\ReminderController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ReminderCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:crom';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info("Cron is working fine!");
        Items::all();

    }
}
