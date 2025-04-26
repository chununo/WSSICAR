<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

	protected $appends = [
		'store_id'
	];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

	/**
	 * The attributes that should be appended.
	 *
	 * @return Store
	 */
	public function Store(): HasOneThrough
	{
		return $this->hasOneThrough(Store::class, StoreUser::class, 'user_id', 'id', 'id', 'store_id');
	}

	/**
	 * Get the store_id attribute.
	 *
	 * @return int|null
	 */
	public function getStoreIdAttribute(){
		try {
			 return $this->Store->id;
		} catch (\Throwable $th) {
			 return null;
		}
		 
	 }
}
