# Events

Events are treated in a special way: they describe the structure of the event participations associated to them. This allows for a very flexible system in which events can have customizable properties, which can make the final price change, using the `data` field.

## data

`data` is just a json array. Each object in this array MUST contain a `name` and a `type`. The type allows to render the element differently on the client. There are currently 3 types.

### Type: string

#### Description

This just stores a string. It only has the `type` and `name` in the `data` of the event.

#### Example

```json
{
    "type": "string",
    "name": "username"
}
```

### Type: boolean

#### Description

This field stores a boolean (either `true` or `false`). It has 4 properties :
 - `name` : Name of the field
 - `type` : `"boolean"`
 - `price` : Positive or negative number. Will be added to the final price of the event, if the person registering for the event isn't a member
 - `price_member`: Positive or negative number. Will be added to the final price of the event, if the person registering for the event is a member

#### Example

```json
{
    "name": "restaurant",
    "type": "boolean",
    "price": 14,
    "price_member": 12
}
```

### Type : numeric

#### Description

This field stores an integer. It has 4 properties :
 - `name` : Name of the field
 - `type` : `"numeric"`
 - `price` : Positive or negative number. Will be added to the final price of the event, if the person registering for the event isn't a member
 - `price_member`: Positive or negative number. Will be added to the final price of the event, if the person registering for the event is a member

#### Example

```json
{
    "name": "Saucisson",
    "type": "numeric",
    "price": 3,
    "price_member": 2
}
```
### Type: select

#### Description

This types allows for a selector. It contains `name` and `type`, plus an array of objects, named `values`. These objects are values which can be selected. Their structure is as follow:
 - `name` : Name of the element
 - `price` : Positive or negative number. Will be added to the final price of the event, if the person registering for the event isn't a member
 - `price_member`: Positive or negative number. Will be added to the final price of the event, if the person registering for the event is a member

#### Example

```json
{
    "name": "Pizza",
    "type": "select",
    "values": [{
        "name": "Reine",
        "price": 8,
        "price_member": 7.5
    },{
        "name": "Savoyarde",
        "price": 9,
        "price_member": 8.5
    }]
}
```

## Relation to event participation

An "event participation" model (storing the event id, the person id, the transaction id) will also have an `data` field, storing a JSON object. The keys of this object are the name in the event's `data`, the values are the provided values (provided string for string type, true/false for the boolean, selected value for select).
