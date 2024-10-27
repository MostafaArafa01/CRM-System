<?php

namespace App\Models;

use App\Models\Scopes\ActiveClientsScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ScopedBy([ActiveClientsScope::class])]
class Client extends Model
{
    /** @use HasFactory<\Database\Factories\ClientsFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'company',
        'address',
        'vat',
    ];

    public function projects(){
        return $this->hasMany(Project::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveClientsScope);
    }
}
