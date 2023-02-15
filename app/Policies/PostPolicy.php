<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function author(User $user, Post $post){
        return ($user->id == $post->user_id);
            
    }
    public function published(?User $user,Post $post){ //Con ? indica que el parametro es opcional para que no importe
        return ($post->status == 2);                    //si el usuario está o no autenticado
    }
}
