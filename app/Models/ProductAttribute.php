<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attribute;

class ProductAttribute extends Model
{
    use HasFactory;
        protected $fillable =([
            'product_id',
            'attribute_id',
            'attribute_value_id',
        ]);
        public function attribute()
        {
            return $this->belongsTo(Attribute::class);
        }
    
        public function attributeValue()
        {
            return $this->belongsTo(AttributeValue::class, 'attribute_value_id', 'id');
        }
    }
