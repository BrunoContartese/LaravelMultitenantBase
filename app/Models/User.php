<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Wildside\Userstamps\Userstamps;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Userstamps, HasRoles;

    protected $guard_name = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'picture'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
    ];

    public static $messages = [
        'first_name.required' => 'Debe ingresar el nombre del usuario.',
        'first_name.max' => 'El nombre no puede tener mas de :max caracteres.',
        'last_name.required' => 'Debe ingresar el apellido del usuario.',
        'last_name.max' => 'El apellido no puede tener mas de :max caracteres.',
        'email.required' => 'Debe ingresar el email del usuario.',
        'email.email' => 'El email ingresado tiene un formato inválido.',
        'email.max' => 'El email no puede tener mas de :max caracteres.',
        'email.unique' => 'El email está siendo utilizado por otro usuario.',
        'password.required' => 'Debe ingresar la contraseña del usuario.',
        'password.min' => 'La contraseña del usuario debe contener como mínimo 6 caracteres.',
        'password.confirmed' => 'Las contraseñas no coinciden.',
    ];

    protected function getDefaultGuardName(): string
    {
        return 'api';
    }
}
