<?php

namespace App\Jobs;

use App\Exports\AdminReport;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class AdminReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $report;

    public function __construct($report)
    {
        $this->report = $report;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        UploadedFile::
//      ->EXPORT TO STORAGE::save~  Excel::download(new AdminReport(['first', 'second'], collect([1,2,3])), 'admin_report.xlsx', 'xlsx');
//        User::admin()->notify(Mail:: headers - table.xlsx)
    }

}
