<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Product::all();
    }

    public function headings(): array
    {
        return [
            'id', 'name', 'slug', 'tagline', 'short_description', 'description', 
            'thumbnail', 'demo_url', 'docs_url', 'github_url', 'category', 
            'tech_stack', 'is_active', 'is_featured', 'sort_order', 
            'meta_title', 'meta_description', 'created_at', 'updated_at'
        ];
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            $product->slug,
            $product->tagline,
            $product->short_description,
            $product->description,
            $product->thumbnail,
            $product->demo_url,
            $product->docs_url,
            $product->github_url,
            $product->category,
            is_array($product->tech_stack) ? implode(',', $product->tech_stack) : $product->tech_stack,
            $product->is_active ? 1 : 0,
            $product->is_featured ? 1 : 0,
            $product->sort_order,
            $product->meta_title,
            $product->meta_description,
            $product->created_at,
            $product->updated_at,
        ];
    }
}
