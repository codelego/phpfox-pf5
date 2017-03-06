## FEED DESCRIBES
FILTERING FEED
- feed_id
- privacy_uid (a large number indicate whom can view it)
- parent_uid (a large number indicate where it's post)
- poster_uid (a large number indicate who post this)
- type_id (a small number indicate type of feed)
- about_id tell us what object is talked about.

SORTING FEED
- updated_time:  important activity
- creation_time: recent activity

### SOLUTION 01: PULL.

#### WALL

```sql
SELECT * from :feed
  WHERE
    parent_uid = ? 
    and type_id in (?) 
    and privacy_uid in (?)
```

#### WHAT'S NEWS
The criteria to filter is by 
```sql
SELECT * from :feed
  WHERE
    poster_uid in (?) 
    and poster_uid in (?) 
    and privacy_uid in (?)
```

cons:
- performance
pros: 
- easy to maintenance

SOLUTION O2: PUSH

#### WALL
as same as solution 01

#### WHAT'S NEWS

Calculate list of feed_id and keep them in `database` or `flash_cache`, at any time we can do it's by procedure the items faster.

cons: 
- hard to maintenance
- it's not suitable for keeping all available feed for all user, it's helpful for `suggesion` solution.
pros:
- fast
- performance

THE SWITCHABLE SOLUTIONS:
01: create 3 tables:
- action (storage all action)
- stream (storage all deliver)
- feed (calculate push feed action), a working queue handle push data to stream from action.
