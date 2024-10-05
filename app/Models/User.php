<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'CreateTime',
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

    public static function createData(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:App\Models\User,email',
            'username' => 'required|unique:App\Models\User,username',
            'name' => 'required|string',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:54',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
            ],
        ], [
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters long.',
            'password.regex' => 'Password must contain uppercase letters, lowercase letters, and numbers.',
        ]);

        User::create([
            'username' => strtoupper($request->username),
            'name' => strtoupper($request->name),
            'email' => strtoupper($request->email),
            'password' => Hash::make($request->password),
        ]);
    }

    public static function destroy($id)
    {
        try {
            DB::beginTransaction();
            $usage = self::find($id);
            $usage->delete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
