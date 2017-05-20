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
_allow(): check only privacy
```

AS you see in `_pass` method, there are convention rules between permission `action_name` and privacy `privacy_name` (comment, view, like, share ...)
the better way is by $resource_type, a blog post has type "blog_post", and the permission must be `view_blog_post`=> can view blog :D.

If we don't like very detail level,  should be `view_entire`, it's ok. 'item' meaning it is all content.

How to store privacy ?
 * each privacy name has its' column => hum, it's not good pattern.
 * serialize all to one column => hum, how to filter view permission.
 * only view  privacy, and serialize others -> YES, just correct.


=> put access to detail.

How to search on a listing base.

```php
$adapter->getRoles();
```

```database table
perm_item ($resource, $actions, $role01)
```




