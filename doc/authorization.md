>
> Roles conceptually represent a named collection of permissions.
>

Resource: blog item, blog category, video_item, site_admin id....

Roles: admin, moderator, friend, friend_of_friends, members, community.

Action:  read, write, delete.

Call pattern

```php
$adapter->hasPermission($resource, $user, $action)?
$adapter->getRoles($resource, $user): return array of roles set
$adapter->allowRoles($resource): return array of allowing role.
```

=> put access to detail.

How to search on a listing base.

```php
$adapter->getRoles();
```

```database table
perm_item ($resource, $actions, $role01)
```




