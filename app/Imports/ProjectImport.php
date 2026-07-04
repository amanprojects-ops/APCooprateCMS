<?php

namespace App\Imports;

use App\Models\Project;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class ProjectImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (empty($row['title'])) {
                continue;
            }
            
            $techStack = !empty($row['tech_stack']) 
                         ? array_map('trim', explode(',', $row['tech_stack'])) 
                         : null;

            Project::updateOrCreate(
                ['slug' => $row['slug'] ?? Str::slug($row['title'])],
                [
                    'title'         => $row['title'],
                    'client_name'   => $row['client_name'] ?? null,
                    'description'   => $row['description'] ?? null,
                    'thumbnail'     => $row['thumbnail'] ?? null,
                    'demo_url'      => $row['demo_url'] ?? null,
                    'github_url'    => $row['github_url'] ?? null,
                    'tech_stack'    => $techStack,
                    'category'      => $row['category'] ?? null,
                    'is_featured'   => isset($row['is_featured']) ? (bool) $row['is_featured'] : false,
                    'is_active'     => isset($row['is_active']) ? (bool) $row['is_active'] : true,
                    'completed_at'  => $row['completed_at'] ?? null,
                    'sort_order'    => $row['sort_order'] ?? 0,
                ]
            );
        }
    }
}
