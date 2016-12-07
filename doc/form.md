# Support

### add multiple field set how to.

FieldSet 

How to the list in changes.

```php
schools[](
    + name: string
    + start:  int
    + end: int
    + level: int
    + current: bool
)

// events.
 
 schools[](
     + name: string
     + start:  int
     + end: int
     + level: int
     + current: bool
     + friends: string[] 
 )
```

There are no key=>value pair in this list. how to correct the collection.
Choose the way to describe item in link list.
All elements should have attribue isMulti<bool>, max_length to correct the selection.


Whenever we need a multiple values? we create a collection instead.

```php
    + Repeater: (repeat=5, show = 3, ...)
        +group: (name=schools)
            + name: text
            + start: text
            + end : text,
            + current: checkbox,
            + repeater (name = friend, repeate=5, show=3)
                + name: string
        loved_place: text
html structure

form
    schools[0][name]: text
    schools[0][start]:text
    schools[0][end]: text
    schools[0][current]: checkbox
    schools[0][friend][0]: text
    schools[0][friend][1]: text
    schools[0][friend][2]: text
    schools[0][friend][3]: text
    schools[0][friend][4]: text
    
signup
 + first_name: text
 + last_name:  text
 + looking_for: select
 + skills: multiple text values.
 
 first_name: text
 last_name: text
 looking_for: select
 fieldset: skill
 repeater: (repeat=5)
 skill[0]
 skill[1]
 




```

then focus on collection with the same attribute
> Fieldset is muted, we should not use fielset.
> We can control multiple value in sections and how to put theme.