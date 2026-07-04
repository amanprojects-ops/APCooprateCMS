<?php

namespace App\Exports;

use App\Models\TechStack;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TechStackExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return TechStack::all();
    }

    public function headings(): array
    {
        return [
            'id', 'name', 'logo', 'category', 'is_active', 'sort_order', 
            'created_at', 'updated_at'
        ];
    }
}
