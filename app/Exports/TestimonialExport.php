<?php

namespace App\Exports;

use App\Models\Testimonial;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TestimonialExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Testimonial::all();
    }

    public function headings(): array
    {
        return [
            'id', 'client_name', 'client_designation', 'client_company', 
            'client_avatar', 'review', 'rating', 'is_active', 'is_featured', 
            'sort_order', 'created_at', 'updated_at'
        ];
    }
}
