<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TasksFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'project_id',
        'status',
    ];

    public function project(){
        return $this->belongsTo(Project::class);
    }

    protected function deadline(): Attribute
    {
        return Attribute::make(
            get: fn ($date) => Carbon::parse($date)->format('m/d/y'),
        );
    }
}
