<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdminReport implements
    FromCollection,
    ShouldAutoSize, WithHeadings
{
    private $headings = [];
    private $data;

    public function __construct(array $headings, $data)
    {
        $this->headings = $headings;
        $this->data = $data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect(['1','2','3']);
    }

    public function headings(): array
    {
        return ['headings', 'some'];
    }
}
