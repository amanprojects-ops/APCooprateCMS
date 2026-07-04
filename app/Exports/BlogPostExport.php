<?php

namespace App\Exports;

use App\Models\BlogPost;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BlogPostExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return BlogPost::all();
    }

    public function headings(): array
    {
        return [
            'id', 'title', 'slug', 'excerpt', 'content', 'thumbnail', 
            'category', 'tags', 'is_published', 'is_featured', 'views', 
            'published_at', 'meta_title', 'meta_description', 
            'created_at', 'updated_at'
        ];
    }

    public function map($post): array
    {
        return [
            $post->id,
            $post->title,
            $post->slug,
            $post->excerpt,
            $post->content,
            $post->thumbnail,
            $post->category,
            is_array($post->tags) ? implode(',', $post->tags) : $post->tags,
            $post->is_published ? 1 : 0,
            $post->is_featured ? 1 : 0,
            $post->views,
            $post->published_at ? $post->published_at->format('Y-m-d H:i:s') : null,
            $post->meta_title,
            $post->meta_description,
            $post->created_at,
            $post->updated_at,
        ];
    }
}
