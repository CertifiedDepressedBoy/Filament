<?php

namespace App\Models;

use Log;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Department extends Model
{

    protected $fillable = [
        'name'
    ];

    public function employee(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

}
