# Router

Requirements
- Performance
- 2 ways map `url` <-> `action controller`.
- Url friendly
- Simple integration

Route, RouteGroups

admincp=> router
admincp.events=>router
admincp.events.blogs=>routes

profile
profile
profile 
if one match=>return profiles.

return uri path?
how about host?
how about conditions?

only the first group has host.

router
   router
      router
          router 
   router
         router
             router
             
             
events.edit
events.delete
events.blogs
events.data
profile.events

profiles
=> match all data in the facy terms.


admincp:test the database
admincp. => group
admincp.events.browse
admincp.events.blogs
admincp.events.blogs => admincp/events/blogs


domain.com/groups/1/members ~ group-1.domain.com/members
domain.com/store/1/products ~ group-1.domain.com/members

// tuy chinh cau hinh de dang,
// tich hop de dang hon voi nhieu dieu kien linh hoat hon
// qua nhieu thu yeu cau nhung rat co ban

-> Database Driven Routing DDR.

! match first ( one ~ many rule)
! only the first group may have custom host.
! any providing data must have the root cause urls.

    match seconds
        match thirds
        

store1.domain.com/products
even domain.com/store1/products 


how to remove the scope from down?

each page has separate domain. 
never check it out of rules.
??


=> generate site 01
 load domain 01
 load data 01
 load module & theme from 01 settings
 load configuration of theme 01.
 there are no orther contents.
 
 :D
 
Filter match profiles.

// custom router match
// any of theme may have another custom rules.

_url('store.products',[store=>1, product=>1], ['q'=>1])
    may have may of many contents.
    
stores.blogs.many-terms/ so what her said ?
there are two many items in custom rule in this case.

RouteGroup: 
    admincp.blog.edit
    admincp.events.manage
    admincp.blogs.manages
    admin.blog.edit
moderation mode?
how to separate content of themes in the city
can build multi site system easier?
N site?
How to build x sites?


RouteCallback
RouteReg:

=> compiler
=> filter


