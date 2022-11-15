<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Validation\Rule;

/**
 * Represent an event in the database
 */
class Event extends Model
{
    use HasFactory;

    protected $casts = [
        'data' => 'array',
        'inscriptions_closed_at' => 'datetime',
        'start' => 'datetime',
        'end' => 'datetime',
        'price' => 'double',
        'price_member' => 'double'
    ];

    protected $fillable = [
        'name',
        'location',
        'inscriptions_closed_at',
        'start',
        'end',
        'price',
        'price_member',
        'data',
        'category_id'
    ];

    /**
     * Get the category associated with this event
     *
     * @return BelongsTo
     */
    public function category() : BelongsTo
    {
        return $this->belongsTo(TransactionCategory::class);
    }

    /**
     * Get the participants associated with this event
     *
     * @return HasMany
     */
    // phpcs:ignore
    public function participations() : HasMany
    {
        return $this->hasMany(EventPerson::class);
    }

    /**
     * Get the price for a participant of this event
     *
     * @param mixed $data data on inscription of the participant
     * @param Person $person the participant to get the price for
     * @return float|int
     */
    public function price(mixed $data, Person $person) : int|float
    {
        $member = $person->member()->exists();
        $price = $member ? $this->price_member : $this->price;

        foreach($this->data as $field) {
            if ($field["type"] == "boolean") {
                if ($data[$field["name"]]) {
                    $price += $member ? $field["price_member"] : $field["price"];
                }
            } else if ($field["type"] == "numeric") {
                $price += ($member ? $field["price_member"] : $field["price"]) * $data[$field["name"]];
            } else if ($field["type"] == "select") {
                $good = false;
                foreach($field["values"] as $val) {
                    if ($data[$field["name"]] == $val["name"]) {
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

    /**
     * Get the validation rules for this event
     *
     * @param bool $sometimes if the data is sometimes valid
     * @return array
     */
    public function validator(bool $sometimes = false) : array
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
                case "numeric":
                    $output['data.' . $element["name"]] = ['required', 'numeric'];
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
