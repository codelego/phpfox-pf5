# Router

Requirements
- Performance
- 2 ways map `url` <-> `action controller`.
- Url friendly
- Simple integration

Concepts
- Route
- Token
- Filter
- Group
- Target

Example a groups has following role match assertion '.profiles';

namnv
profile/1
pages/2
pages/google-api

# Groups masters

event/:name
events/:name
groups/:name
pages/:name
:name/

is consistent in group `profile`

in group profile
we can continue run a routing to test (after strip matched part)

members
blogs
pages
groups
photos
albums
videos
jobs
=> will fill action or profile to theme.
=> if not match any, it will fill to groups.

= how to implements

```php
    '<type>/<name>?'=> filter profile in events,
    'groups/<name>?'=> filter profile in events,
    'events/<name>?'=> filter profile in events,
    'profile/<name>?'=> filter profile in events,
    '<name>'
```

process using all in RouteChain, 

Chains = [
    ''=>[RouteLogin,RouteBlog, EventEdit, ]
    'profile'=>[],
    'Blog'=>[],
]

Chain in list of rule/match/exits.


#Route naming convention

By simple

package.controller.action
`user.auth.login`

By Group for Chain

`group:features`

profile:event_home => [
    'events/<name>/*'=>['event.profile','home'],
]

'events/*' =[search,edit,delete, create,manage,delete,...]
'event/<action>/<id>/*'=>[view, edit,delete,invite, etc....]

events:search,

events:edit


admincp=module/controller/action

event: =>[
    'chains'=>['route'=>'event/<action>/<id>',]
    'children'=>[
        'edit'=>'
    ]
]

\Phpfox::get('router')->getUrl('edit:event',[id=>1]);