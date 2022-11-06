<?php

namespace App\Filters;

use App\Common\StrReplace;
use Mi\L5Core\Filters\BaseFilter;

class FreewordAdmin extends BaseFilter
{
    /**
     * Apply the filter
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param mixed $input
     * @return mixed
     */
    public static function apply($model, $input)
    {
        $freeword = StrReplace::escapeBeforeSearch(strtolower($input));

        return $model->where(function ($subQuery) use ($freeword) {
            return $subQuery->where('id', 'like', "%{$freeword}%")
                ->orWhereRaw('lower(name) like (?)', "%{$freeword}%")
                ->orWhere('email', 'like', "%{$freeword}%");
        });
    }
}
