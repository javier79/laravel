<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class DeletedAdminScope implements Scope
{
    public function apply(Builder $builder, Model $model)//the call is registered at BlogPost.php
    {   //below checks if user in logged in and if user is an admin
        if(Auth::check() && Auth::user()->is_admin){
            //$builder->withTrashed();//also show deleted(softdeleted) models
            $builder->withoutGlobalScope('Illuminate\Database\Eloquent\SoftDeletingScope');/*this will have the same effect
            as the line before, as soft deletion is not taking place blog post are showed and the line across */
        }
    }
}