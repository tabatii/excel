<?php

namespace App\Exports;

use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Licence;


class LicencesExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
        return Licence::all();
    }

    public function headings(): array
    {
        return Schema::getColumnListing('licences');
    }
}
