<?php

namespace App\Traits;

//use App\Http\Controllers\NotificationsController;

use App\Models\Notifiable;

trait Common
{
    public function getCurrentPage($current_page,$model)
    {
        $count = $model::all()->count();

        $count = ceil($count / $this->paginate);
        if ($current_page > $count) {
            $current_page = $count;
        }

        return $current_page;
    }
}