<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'date', 'amount', 'description'];

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'category_id');
    }
}
