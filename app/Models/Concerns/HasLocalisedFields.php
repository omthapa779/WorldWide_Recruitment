<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\App;

/**
 * Lets a model carry a Japanese variant of a text column alongside the
 * English one, e.g. `title` and `title_ja`.
 *
 * The Japanese field is optional everywhere: if the admin has not filled it
 * in, the English value is shown instead. That way switching the site to
 * Japanese never produces a blank page — the worst case is untranslated
 * content, which is what the client had before.
 */
trait HasLocalisedFields
{
    /**
     * Return the field in the active locale, falling back to the base column.
     */
    public function localised(string $field): ?string
    {
        if (App::getLocale() === 'ja') {
            $japanese = $this->{$field.'_ja'} ?? null;

            if (filled($japanese)) {
                return $japanese;
            }
        }

        return $this->{$field};
    }
}
