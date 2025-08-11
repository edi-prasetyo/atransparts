<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

trait HasTranslations
{
    /**
     * Get translated field safely.
     *
     * @param string $field
     * @param string|null $relationName
     * @return string
     */
    public function getTranslatedField(string $field, ?string $relationName = null): string
    {
        $locale = App::getLocale();
        $fallbackLocales = ['id', 'en']; // fallback order
        $relationName = $relationName ?? $this->guessTranslationRelation();

        if (!method_exists($this, $relationName)) {
            return '';
        }

        $translations = $this->$relationName;

        // Try current locale
        $translation = $translations->where('locale', $locale)->first();

        // Try fallback locales
        foreach ($fallbackLocales as $fallback) {
            if (!$translation) {
                $translation = $translations->where('locale', $fallback)->first();
            }
        }

        return optional($translation)->$field ?? '';
    }

    /**
     * Guess the name of the translation relation based on model name.
     * e.g. "About" => "aboutTranslations"
     *
     * @return string
     */
    protected function guessTranslationRelation(): string
    {
        return Str::camel(class_basename($this)) . 'Translations';
    }
}
