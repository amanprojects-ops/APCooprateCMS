<?php

namespace App\Imports;

use App\Models\Testimonial;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TestimonialImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (empty($row['client_name']) || empty($row['review'])) {
                continue;
            }

            Testimonial::updateOrCreate(
                [
                    'client_name' => $row['client_name'],
                    'review'      => $row['review']
                ],
                [
                    'client_designation' => $row['client_designation'] ?? null,
                    'client_company'     => $row['client_company'] ?? null,
                    'client_avatar'      => $row['client_avatar'] ?? null,
                    'rating'             => $row['rating'] ?? 5,
                    'is_active'          => isset($row['is_active']) ? (bool) $row['is_active'] : true,
                    'is_featured'        => isset($row['is_featured']) ? (bool) $row['is_featured'] : false,
                    'sort_order'         => $row['sort_order'] ?? 0,
                ]
            );
        }
    }
}
