<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;

class ReportGenerator
{
    private $data = [];
    private $format = [];

    public function initData($data, $format)
    {
        $this->data = $data;
        $this->format = $format;
    }

    public function generateCsv(Excel $instance)
    {
        $excel = new
    }
}
