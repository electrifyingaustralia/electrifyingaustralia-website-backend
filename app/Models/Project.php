<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_solution' => 'boolean',
        'category' => 'string',
    ];

    public function media()
    {
        return $this->belongsTo(MediaLibrary::class, 'media_id');
    }

    public function images()
    {
        return $this->belongsToMany(MediaLibrary::class, 'project_images', 'project_id', 'media_id')
            ->withTimestamps();
    }

    public function type()
    {
        return $this->belongsTo(ProjectType::class, 'project_type_id');
    }

    // public function category()
    // {
    //     return $this->belongsTo(ProjectCategory::class, 'project_category_id');
    // }
}
