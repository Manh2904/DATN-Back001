<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    protected $guarded =[''];
    protected $fillable = [
        'id', 'name', 'provider', 'provider_id', 'email', 'phone', 'address', 'password', 'avatar', 'remember_token', 'created_at', 'updated_at', 'birthday', 'gender'
    ];
 /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }

    public function favourite()
    {
        return $this->belongsToMany(Product::class, 'user_favourite', 'uf_user_id', 'uf_product_id');
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'tst_user_id');
    }

    public function rating()
    {
        return $this->hasMany(Rating::class, 'r_user_id');
    }

    protected static function booted () {
        static::deleting(function(User $user) {
            $user->transaction()->delete();
            $user->favourite()->delete();
            $user->rating()->delete();
        });
    }
}
