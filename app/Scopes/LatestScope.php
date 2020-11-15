<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class LatestScope implements Scope
{
    public function apply(Builder $builder, Model $model)//the call is registered at BlogPost.php
    {
        $builder->orderBy($model::CREATED_AT,  'desc');/*$model::CREATED_AT DEFINES A DEFAULT NAME FOR THE TIMESTAMP OF CREATION,
       SO IF SOMEONE WOULD MODIFY THIS COLUMN NAME(created_at) FOR ANY MODEL, WE MAKE SURE THIS WAY THAT IT WILL 
       AUTOMATHICALLY RECOGNIZE THE CREATION TIMESTAMP(created_at) AND SORT THE MODELS IN DESC ORDER.
        */
    }
}