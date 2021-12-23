<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Event extends Model
{
    use HasFactory;

    protected $casts = [
        'data' => 'array',
        'inscriptions_closed_at' => 'datetime',
        'start' => 'datetime',
        'end' => 'datetime'
    ];

    protected $fillable = [
        'name',
        'location',
        'inscriptions_closed_at',
        'start',
        'end',
        'max_people',
        'price',
        'price_member',
        'data',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(TransactionCategory::class);
    }

    // phpcs:ignore
    public function persons()
    {
        return $this->belongsToMany(Person::class, 'event_person', 'event_id', 'person_id')
            ->using(EventPerson::class)->withTimestamps();
    }

    public function price($data, Person $person) {
        $member = $person->member()->exists();
        $price = $member ? $this->price_member : $this->price;

        foreach($this->data as $dat) {
            if ($dat["type"] == "boolean") {
                if ($data[$dat["name"]] == true) {
                    $price += $member ? $dat["price_member"] : $dat["price"];
                }
            } else if ($dat["type"] == "select") {
                $good = false;
                foreach($dat["values"] as $val) {
                    if ($data[$dat["name"]] == $val["name"]) {
                        $price += $member ? $val["price_member"] : $val["price"];
                        $good = true;
                        break;
                    }
                }
                if (!$good)
                    abort(400);
            }
        }
        
        return $price;
    }

    public function validator($sometimes = false)
    {
        $output = [];
        $keys = [];
        foreach ($this->data as $element) {
            switch ($element["type"]) {
                case "string":
                    $output['data.' . $element["name"]] = ['required', 'string'];
                    break;
                case "boolean":
                    $output['data.' . $element["name"]] = ['required', 'boolean'];
                    break;
                case "select":
                    $values = [];
                    foreach($element["values"] as $val) {
                        $values[] = $val["name"];
                    }
                    $output['data.' . $element["name"]] = ['required', Rule::in($values)];
                    break;
            }
            if ($sometimes) {
                $output['data.' . $element["name"]][] = 'sometimes';
            }
            $keys[] = $element["name"];
        }
        $output["data"] = ['required', 'array:' . join(",", $keys)];
        return $output;
    }
}
