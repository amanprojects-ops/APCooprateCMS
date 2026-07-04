<?php

namespace App\Imports;

use App\Models\BlogPost;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BlogPostImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (empty($row['title'])) {
                continue;
            }

            $tags = !empty($row['tags']) 
                    ? array_map('trim', explode(',', $row['tags'])) 
                    : null;

            $publishedAt = null;
            if (!empty($row['published_at'])) {
                try {
                    $publishedAt = Carbon::parse($row['published_at']);
                } catch (\Exception $e) {
                    $publishedAt = null;
                }
            }

            BlogPost::updateOrCreate(
                ['slug' => $row['slug'] ?? Str::slug($row['title'])],
                [
                    'title'             => $row['title'],
                    'excerpt'           => $row['excerpt'] ?? null,
                    'content'           => $row['content'] ?? null,
                    'thumbnail'         => $row['thumbnail'] ?? null,
                    'category'          => $row['category'] ?? null,
                    'tags'              => $tags,
                    'is_published'      => isset($row['is_published']) ? (bool) $row['is_published'] : false,
                    'is_featured'       => isset($row['is_featured']) ? (bool) $row['is_featured'] : false,
                    'views'             => $row['views'] ?? 0,
                    'published_at'      => $publishedAt,
                    'meta_title'        => $row['meta_title'] ?? null,
                    'meta_description'  => $row['meta_description'] ?? null,
                ]
            );
        }
    }
}
