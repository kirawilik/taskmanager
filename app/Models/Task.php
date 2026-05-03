<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable=[
        'titre',
        'description',
        'status',
        'user_id',
        'categorie_id'];
        public function user(){
            return $this->belongsTo(User::class);

        }
        public function category(){
            return $this->belongsTo(Category::class, 'categorie_id');
        }
}
