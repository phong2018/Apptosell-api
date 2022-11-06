<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Hash;

trait HasPassword
{
    /**
     * Boot the trait
     *
     * @return void
     */
    public static function bootHasPassword()
    {
        static::creating(function ($model) {
            $model->generatePassword();
        });

        static::updating(function ($model) {
            $model->generatePassword();
        });
    }

    /**
     * Encrypted password
     *
     * @return void
     */
    protected function generatePassword()
    {
        if ($this->isDirty('password')) {
            $this->attributes['password'] = Hash::make($this->attributes['password'] ?? rand());
        }
    }
}
