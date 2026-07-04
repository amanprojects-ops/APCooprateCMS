<?php

namespace App\Imports;

use App\Models\TechStack;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TechStackImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (empty($row['name'])) {
                continue;
            }

            TechStack::updateOrCreate(
                ['name' => $row['name']],
                [
                    'logo'       => $row['logo'] ?? null,
                    'category'   => $row['category'] ?? null,
                    'is_active'  => isset($row['is_active']) ? (bool) $row['is_active'] : true,
                    'sort_order' => $row['sort_order'] ?? 0,
                ]
            );
        }
    }
}
