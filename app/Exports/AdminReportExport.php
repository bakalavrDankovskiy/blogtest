<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;

class AdminReportExport implements FromArray
{
    public function __construct(private readonly array $tables)
    {

    }

    public function array(): array
    {
        foreach ($this->tables as $table) {
            $data[] =
                [
                    'table' => $table,
                    'count' => DB::table($table)->count(),
                ];
        }
        return $data;
    }
}
