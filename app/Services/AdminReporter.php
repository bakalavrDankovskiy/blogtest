<?php

namespace App\Services;

use App\Exports\AdminReportExport;
use App\Mail\AdminReportMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class AdminReporter
{
    public static function send(?array $tables)
    {
        if (is_null($tables)) {
            return;
        }

        $fileName = now()->timestamp . '_report.xlsx';

        Excel::store(new AdminReportExport($tables), $fileName, 'tmp');

        Mail::to(User::admin())->send(new AdminReportMail(\Storage::disk('tmp')->path($fileName)));

        \Storage::disk('tmp')->delete($fileName);
    }
}
