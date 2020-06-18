<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function logins()
    {
        return $this->hasMany(Login::class);
    }

    public function lastLogin()
    {
        return $this->belongsTo(Login::class, 'last_login_id');
    }

    public function scopeWithLastLogin(Builder $query)
    {
        return $query->addSelect([
            'last_login_id' => Login::select('id')->whereColumn('user_id', 'users.id')->latest()->take(1)
        ])
            ->with('lastLogin');
    }

    public function scopeSearch(Builder $query, $terms = null)
    {
        collect(str_getcsv($terms, ' ', '"'))
            ->filter()
            ->map(fn($term) => preg_replace('/[^A-Za-z0-9]/', '', $term) . "%")
            ->each(
                fn($term) => $query->where(
                    fn($query) => $query
                        ->WhereIn('id', fn($query) => $query->select('id')->from( // driven table
                            fn($query) => $query->select('id')
                                ->from('users')
                                ->where('name_normalized', 'like', $term)
                                ->orWhere('email_normalized', 'like', $term)
                                ->union(
                                    $query->newQuery()
                                        ->select('users.id')
                                        ->from('users')
                                        ->join('companies', 'companies.id', '=', 'users.company_id')
                                        ->where('companies.name_normalized', 'like', $term)
                                )
                        ))
                )
            );
    }
}
