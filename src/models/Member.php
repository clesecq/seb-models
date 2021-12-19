<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Member extends Model
{
    use HasFactory;

    protected $casts = [
        'paid' => 'boolean'
    ];

    protected $fillable = [
        'person_id'
    ];

    protected $appends = ['paid'];

    public function getPaidAttribute()
    {
        return $this->transaction_id != null;
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    // phpcs:ignore
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function pay()
    {
        if ($this->transaction_id == null) {
            $message = Config::format(
                "members.contribution.transaction",
                ["member" => $this->person->attributesToArray()]
            );

            $this->transaction_id = Transaction::create([
                'name' => $message,
                'amount' => Config::number('members.contribution.amount'),
                'rectification' => false,
                'user_id' => Auth::id() ?? 1,
                'account_id' => Config::integer('members.contribution.account'),
                'category_id' => Config::integer('members.contribution.category')
            ])->id;
            $this->save();
        }
    }

    public static function archive(...$params)
    {
        if (count($params) >= 1) {
            $year = $params[0];
        } else {
            $year = now()->year;
        }

        // We archive everything and empty the table
        foreach (Member::all() as $member) {
            ArchivedMember::create([
                'person_id' => $member->person_id,
                'transaction_id' => $member->transaction_id,
                'created_at' => $member->created_at,
                'updated_at' => $member->updated_at,
                'year' => $year
            ]);
        }
        Member::truncate();
    }
}
