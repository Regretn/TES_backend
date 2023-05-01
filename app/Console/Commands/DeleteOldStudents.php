<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Student;

class DeleteOldStudents extends Command
{
    protected $signature = 'students:delete-old';

    protected $description = 'Delete students whose records are older than one year';

    public function handle()
    {
        $oneYearAgo = Carbon::now()->subYear();
        Student::where('created_at', '<', $oneYearAgo)->delete();
        $this->info('Old student records deleted successfully.');
    }
}
