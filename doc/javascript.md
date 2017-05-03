# Javascript Components

### Dropdown

Add `data-cmd="dropdown"` to element

With TD/Div that can contain UL tag

```html
<td class="dropdown" data-cmd="dropdown">
    <ul>
        <li><a href="">... </a></li>
        <li><a href="">... </a></li>
        ...
    </ul>
</td>
```

Or UL is not been included, add `data-target="{selector}"`

```html
<a data-cmd="dropdown" data-target="ul#example">...</a>
<ul id="example" class="hide">
    <li><a href="">... </a></li>
    <li><a href="">... </a></li>
    ...
</ul> 
```

Or load from remote

```html
<a data-cmd="dropdown" data-url="remote-list.html">...</a>
```

### Dialog Modal

Add `data-cmd="dialog"` to element

Load content from remote, add `href={url}` or `data-url="{url}"` to element

```html
<a href="remote.html" data-cmd="modal">...</a>
<button data-url="remote.html" data-cmd="modal">...</button>
```

Load content from inline, add `data-target={selector}` to element

```html
<a href="remote.html" data-cmd="modal" data-target="#target">...</a>
<div id="target">
    content of modal here
</div>
```

#### Confirm message
Add confirm message, `aria-confirm="{Message}"`


### Query XTarget

We could not control each class/id is global unique but we can do it from a locally by 
related to triggered element.

`data-target=":li/ul/li:first/span"`

Multiple query like Xpath way

> `:` meaning query $(current).closets('li')

> escape to body by `//`

Example: find all `.item_checked`
 
 ```text
 data-target="//.item_checked"
 ```
 

### Dialog
Open dialog

```text
Core.dialog.open({
    url:false, // string, false, optional,
    target: false, // string, false, optional,
});
```
Open Confirm

```text
Core.dialog.confirm({
    title: '', // string, default: false
    message:'', // string, false, optional,
    yes: 'Ok', // yes button label
    no: 'Cancel', // No button label,
}, yes_callback);
```