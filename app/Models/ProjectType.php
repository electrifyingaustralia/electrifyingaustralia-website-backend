<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    protected $guarded = [];

    public function projects()
    {
        return $this->hasMany(Project::class, 'project_type_id');
    }
}
