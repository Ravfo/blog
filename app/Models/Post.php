<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];
    //Relacion con usuarios,uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

    
    //Relacion con categorias,uno a muchos inversa
    public function category(){
        return $this->belongsTo(Category::class);
    }

    //Relacion muchos a muchos con Tag
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    //Relacion Polimorfica con imagenes
    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }
}
