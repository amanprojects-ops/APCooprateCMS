<?php

namespace App\Exports;

use App\Models\Service;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ServiceExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Service::all();
    }

    public function headings(): array
    {
        return [
            'id', 'title', 'slug', 'icon', 'short_description', 'description', 
            'is_active', 'sort_order', 'meta_title', 'meta_description', 
            'created_at', 'updated_at'
        ];
    }
}
