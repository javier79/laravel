<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class LatestScope implements Scope
{
    public function apply(Builder $builder, Model $model)//the call is registered at BlogPost.php
    {
        $builder->orderBy($model::CREATED_AT,  'desc');/*$model::CREATED_AT DEFINES A DEFAULT NAME FOR THE TIMESTAMP
       SO IF SOMEONE WOULD MODIFY THIS FIELD FOR ANY MODEL, WE MAKE SURE THIS WAY THAT IT WILL WORK WITH ANY MODEL.
       This modified by adding to the query on PostController.php read the comments there. */
    }
}