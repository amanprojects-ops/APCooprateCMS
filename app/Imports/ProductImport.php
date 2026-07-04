<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class ProductImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (empty($row['name'])) {
                continue;
            }
            
            $techStack = !empty($row['tech_stack']) 
                         ? array_map('trim', explode(',', $row['tech_stack'])) 
                         : null;

            Product::updateOrCreate(
                ['slug' => $row['slug'] ?? Str::slug($row['name'])],
                [
                    'name'              => $row['name'],
                    'tagline'           => $row['tagline'] ?? null,
                    'short_description' => $row['short_description'] ?? null,
                    'description'       => $row['description'] ?? null,
                    'thumbnail'         => $row['thumbnail'] ?? null,
                    'demo_url'          => $row['demo_url'] ?? null,
                    'docs_url'          => $row['docs_url'] ?? null,
                    'github_url'        => $row['github_url'] ?? null,
                    'category'          => $row['category'] ?? null,
                    'tech_stack'        => $techStack,
                    'is_active'         => isset($row['is_active']) ? (bool) $row['is_active'] : true,
                    'is_featured'       => isset($row['is_featured']) ? (bool) $row['is_featured'] : false,
                    'sort_order'        => $row['sort_order'] ?? 0,
                    'meta_title'        => $row['meta_title'] ?? null,
                    'meta_description'  => $row['meta_description'] ?? null,
                ]
            );
        }
    }
}
