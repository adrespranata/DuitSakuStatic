<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incomes extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'date', 'amount', 'description'];

    public function category()
    {
        return $this->belongsTo(IncomeCategory::class, 'category_id');
    }
}
