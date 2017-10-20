>
> Levels conceptually represent a named collection of permissions.(configure by admin)
> Permission value define which action is allowed on actions. (configure by admin)
> Privacy define which relationship may do which action. (configure by members)

- Check prototype on specific action
  * get user level, return false if they has no permission
  * get relation between user and owner/parent (defined no_relation=0, friend=1, ...)
  * check available between (user_id, owner_id, relations, and action) then get result.

Resource: blog item, blog category, video_item, site_admin id....

Levels: admin, moderator, friend, friend_of_friends, members, community.

Actions:  C (add,edit) U (update) R (read, view) D (delete) B (browse, search, listing) M (moderator)

Call pattern

```php
_can($roleId, $actionId): check permission only
_pass($resource, $user, $action): check permission + privacy
\Phpfox::allow(): check only privacy
```

AS you see in `_pass` method, there are convention rules between permission `action_name` and privacy `privacy_name` (comment, view, like, share ...)
the better way is by $resource_type, a blog post has type "blog_post", and the permission must be `view_blog_post`=> can view blog :D.

If we don't like very detail level,  should be `view_entire`, it's ok. 'item' meaning it is all content.

How to store privacy ?
 * each privacy name has its' column => hum, it's not good pattern.
 * serialize all to one column => hum, how to filter view permission.
 * only view  privacy, and serialize others -> YES, just correct.



> Core of permission system is `ItemInterface`+ `UserInterface`

Concepts
- permission: action name and level id
- privacy: privacy name, privacy level and privacy value
- owner: who is owner of item
- poster: who post item
- parent: which item belong to (apply when item is posted to pages, groups, events)
- parent's owner: 
 
 Examples below describe how permission work, when visitor view a blog post.
 
 1, Case 01.
 
 user `user 1` -> `post` on `user 2` profile
 user `user 3` would like to view `post`
 
 permission: action = view
 privacy: name = view_post
 owner: `user 2`
 poster: `user 1`
 parent: `user 2`
 owner of parent: `user 2`
 
 Result:
 
 Privacy is checked between relations of `user 1` and `user 3` (OK).
 Privacy is control by `user 2`
 
 2, Case 02
 
 user `user 1` -> `post` on a pages `page 1` posted by `user 2` 
 user `user 3` would like to view `post`
  
 permission: action = view
 privacy: name = view_post
 owner: `user 2`
 poster: `user 1`
 parent: `page 1`
 owner of parent: `user 2`
  
 Result:
  
 Privacy is checked between relations of `user 1` and `page 1` and `user 3` (OK).
 Privacy is control by `user 2` and `page 1`
 
 model `page 1` decide how to check relations by implement method `getRelationship(UserInterface $user)`.
 
 Annotation:
 owner, parent and poster has all item privacy.
 implement an engine to getRelationship for items instead of implements for all class getRelationship, how to ?
 
 `getRelationships` should return a subset of `owner`, `parent`, `owner_parent`, `poster` and loader engine will load all
 relationship between objects and current viewer, then we allow admin control the result.
 
 how to load relationship between of an `object` and an user.
 
 each object have relationship dependent on its business models, so we define a which relations type should load by which service.
 
+ event => members => 'event.members'
+ user => friends => 'friend.friend'
+ blog _ no, it's should not implement as UserInterface
+ pages => members => 'pages.members'
+ groups => members => 'group.members'

The service has correct item types.

```php
class ExamplePages {
    function getRelationships(){
        return ['parent'=> 'self','admin'=>'pages.admin'];
    }
}
 ```
 