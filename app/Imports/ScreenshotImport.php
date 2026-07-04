<?php

namespace App\Imports;

use App\Models\ProductScreenshot;
use App\Models\ProjectScreenshot;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ScreenshotImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (empty($row['target_type']) || empty($row['target_id']) || empty($row['image_path'])) {
                continue;
            }

            $targetType = strtolower($row['target_type']);

            if ($targetType === 'product') {
                ProductScreenshot::updateOrCreate(
                    [
                        'product_id' => $row['target_id'],
                        'image_path' => $row['image_path'],
                    ],
                    [
                        'caption'    => $row['caption'] ?? null,
                        'sort_order' => $row['sort_order'] ?? 0,
                    ]
                );
            } elseif ($targetType === 'project') {
                ProjectScreenshot::updateOrCreate(
                    [
                        'project_id' => $row['target_id'],
                        'image_path' => $row['image_path'],
                    ],
                    [
                        'caption'    => $row['caption'] ?? null,
                        'sort_order' => $row['sort_order'] ?? 0,
                    ]
                );
            }
        }
    }
}
