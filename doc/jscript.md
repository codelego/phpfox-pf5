# JavaScript Guide

## Add stylesheets dependencies

```js
main.styles(['file1','file2']);
```

Example 

````js
main.styles(['package/core/style/main','package/user/style/main']);
````


## add javascript dependencies

```js
require(['file1','file2'],function(){});
```

Example

```js
require(['package/core/sha1'],function(){
    // on complete callback
});
```


## Add new js file

```js
define([],function(){
    // code here
});
```


## Add onclick method

```html
<a data-cmd="command-name" data-message="Hello!">Alert</a>
<a data-cmd="toggle-div1">Toggle #Div1</a>
<div id="div1" class="hide">
    Hello!
</div> 
```

```js
define(['core'],function(){
    var Core = require('core');
    
    Core.cmd('command-name',function(ele){
       alert(ele.data('message')); 
       // alert "Hello!" 
    })
});
```

### Best practices

command-name should be "package.feature.command" etc: photo.theater.show, ...

admin command should has prefix, etc admin.photo.edit

### Support Command

#### toggle

```html
<div>
    <div class="hide alert">
        Alet Message
    </div>
    <button data-cmd="toggle" data-rel="div|.alert">
</div>
```

data-cmd="hide-div1" will toggle class "hide" by finding from clicked item.

```js
Core.cmd('toggle-div1', function (btn) {
    $('#div').toggleClass('hide');
    console.log(btn);
});
```

## Using ajax

### Use jquery ajax method

```js
$.ajax(url, data, options)
    .before()
    .always(function(){})
    .done(function(){})
    .error(function (){});
```


### Use ajax to post a form data

```js
$.submit(url, form)
    .always(function(){})
    .done(function(){})
    .error(function(){});
```

### XTarget element

> A strong way to select dom, allow front-end developer modify html structure without update javascript code.


format `data-target="target string from current"`.
in almost case we can not unique id for all item, it's hard to maintenance and control
we add a method Core.xtarget to help you control where to find
item from current.

query is split by `/`
query closest element by `:`
query global scope by `//`


```javascript
Core.xtarget(element, ':form/input[type=hidden]');
// Equal: $(element).closest('form').find('input[type=hidden]')

Core.xtarget(element, ':div/.blog-closed');
// Equal to $(element').closest('div').find('.blog-closed')

Core.xtarget(element, '//body/.blog-closed');
Core.xtarget(element, '//.blog-closed');
// Equal to $('body').find('.blog-closed')
```

### Built-in data-cmd

#### data-cmd="toggle"

Togle element class name
syntax data-cmd="toggle" data-target="xtarget;class_name"
 
 Example toggle class `.hide` for menu in this article.
```html
<article>
    <a data-cmd="toggle" data-target=":article/ul;.hide"></a>
    <ul class="hide">
        ...    
    </ul>
</article>
```

When wrap ul on a div structure.

```html
<div>
    <a data-cmd="toggle" data-target=":div/ul;.in"></a>
    <ul class="fade in">
        ...    
    </ul>
</div>
```

Or move `ul` to another section

```html
<div>
    <article>
        <a data-cmd="toggle" data-target=":div/ul;.hide"></a>
    </article>
    <ul class="hide">
        ...    
    </ul>
</div>
```

Or change `ul` to another html structure


```html
<div>
    <article>
        <a data-cmd="toggle" data-target=":div/article + div:first;.hide"></a>
    </article>
    <div class="hide">
        // wrap link list    
    </ul>
</div>
```

before submit form will be add method 'ajax'

