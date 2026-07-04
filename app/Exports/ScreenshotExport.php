<?php

namespace App\Exports;

use App\Models\ProductScreenshot;
use App\Models\ProjectScreenshot;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ScreenshotExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $products = ProductScreenshot::all()->map(function ($s) {
            return [
                'id'          => $s->id,
                'target_type' => 'product',
                'target_id'   => $s->product_id,
                'image_path'  => $s->image_path,
                'caption'     => $s->caption,
                'sort_order'  => $s->sort_order,
            ];
        });

        $projects = ProjectScreenshot::all()->map(function ($s) {
            return [
                'id'          => $s->id,
                'target_type' => 'project',
                'target_id'   => $s->project_id,
                'image_path'  => $s->image_path,
                'caption'     => $s->caption,
                'sort_order'  => $s->sort_order,
            ];
        });

        return $products->concat($projects);
    }

    public function headings(): array
    {
        return [
            'id', 'target_type', 'target_id', 'image_path', 'caption', 'sort_order'
        ];
    }
}
