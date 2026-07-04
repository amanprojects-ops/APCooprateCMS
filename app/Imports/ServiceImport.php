<?php

namespace App\Imports;

use App\Models\Service;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class ServiceImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (empty($row['title'])) {
                continue;
            }

            Service::updateOrCreate(
                ['slug' => $row['slug'] ?? Str::slug($row['title'])],
                [
                    'title'             => $row['title'],
                    'icon'              => $row['icon'] ?? null,
                    'short_description' => $row['short_description'] ?? null,
                    'description'       => $row['description'] ?? null,
                    'is_active'         => isset($row['is_active']) ? (bool) $row['is_active'] : true,
                    'sort_order'        => $row['sort_order'] ?? 0,
                    'meta_title'        => $row['meta_title'] ?? null,
                    'meta_description'  => $row['meta_description'] ?? null,
                ]
            );
        }
    }
}
