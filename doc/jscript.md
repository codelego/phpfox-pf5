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
<a data-cmd="toggle-div" data-rel="#div1" data-classes="hide">Toggle #Div1</a>
<div id="div1" class="hide">
    Hello!
</div> 
```

```js
define(['main'],function(main){
    main.cmd('command-name',function(ele){
       alert(ele.data('message')); 
       // alert "Hello!" 
    }).cmd('toggle-div',function(ele){
        // toggle class hide
        $(ele.data('rel')).toggleClass(ele.data('classes'));
    });
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

data-cmd="toggle" will toggle class "hide" by finding from clicked item.

```js
main.cmd('toggle', function (btn) {
    var rel = btn.data('rel'),
        selector = btn.split('|');

    btn.closest(selector[0])
        .find(selector[1])
        .toggleClass('hide');

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

before submit form will be add method 'ajax'

