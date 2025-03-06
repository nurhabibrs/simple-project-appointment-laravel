<?php

use Illuminate\Support\Collection;

if (! function_exists('filamentOption')) {
    /**
     * convert option to filament option
     */
    function filamentOption($data): Collection
    {
        return collect($data)->mapWithKeys(function ($item) {
            return [$item['label'] => $item['value']];
        });
    }
}
