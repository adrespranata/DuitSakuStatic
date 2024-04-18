<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;

    protected $table = 'payment_types';

    protected $fillable = [
        'category_id',
        'name',
        'description'
    ];

    public function expenses()
    {
        return $this->hasMany(Expenses::class, 'payment_type_id');
    }

    public function expenseCategory()
    {
        return $this->belongsTo(ExpenseCategory::class, 'category_id');
    }
}
