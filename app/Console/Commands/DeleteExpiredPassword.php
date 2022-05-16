<?php

namespace App\Console\Commands;

use App\Models\AksesEditNilai;
use Illuminate\Console\Command;
use Carbon\Carbon;

class DeleteExpiredPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'akses_edit_nilais:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete akses password after 1 day';

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
        AksesEditNilai::where('created_at', '<', Carbon::now()->subDay())->each(function ($akses) {
            $akses->delete();
        });
    }
}
