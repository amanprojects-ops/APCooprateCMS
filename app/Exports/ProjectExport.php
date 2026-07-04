<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProjectExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Project::all();
    }

    public function headings(): array
    {
        return [
            'id', 'title', 'slug', 'client_name', 'description', 'thumbnail', 
            'demo_url', 'github_url', 'tech_stack', 'category', 'is_featured', 
            'is_active', 'completed_at', 'sort_order', 'created_at', 'updated_at'
        ];
    }

    public function map($project): array
    {
        return [
            $project->id,
            $project->title,
            $project->slug,
            $project->client_name,
            $project->description,
            $project->thumbnail,
            $project->demo_url,
            $project->github_url,
            is_array($project->tech_stack) ? implode(',', $project->tech_stack) : $project->tech_stack,
            $project->category,
            $project->is_featured ? 1 : 0,
            $project->is_active ? 1 : 0,
            $project->completed_at ? $project->completed_at->format('Y-m-d') : null,
            $project->sort_order,
            $project->created_at,
            $project->updated_at,
        ];
    }
}
