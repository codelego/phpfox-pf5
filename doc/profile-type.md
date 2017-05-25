# Profile - Profile Questions.

### What's profile type mean?

When a member create account on social network, there are various information about them, named profile. Each profile type 
has the same information type they need to fulfill.

### How profile describe.

Object has attributes/properties describe theme, some attributes is common, some attribute is specific for a profile type only.
let's start by listing all properties.


Describe all properties line by line is not good solutions, just group theme to sections. some sections are popular, but some section are specific.
so we must define relation about `profile type` - `profile attribute` - `profile section` which included and how they ordering.

When a profile are display in creation - editing - viewing process. each profile type has difference type, so let put 
so we add relation about `process`.

Profile type is a group in formation and how they display.
Processes contain information about where profile type are using.
Section is the way information is grouping in a process.


mock-up.


=======================================
    (select profile)   (select process)
=======================================

section 01 ----------------------------

    question 01 -----------------------
    question 02 -----------------------
    question 03 -----------------------
    ........... -----------------------
    
---------------------------------------


section 02 ----------------------------

    question 04 -----------------------
    question 05 -----------------------
    question 06 -----------------------
    ........... -----------------------
    
---------------------------------------

=======================================
    (select profile)   (select process)
=======================================

step 01 -------------------------------

    section 01 ------------------------
    section 02 ------------------------
    section 03 ------------------------
    ........... -----------------------
    
---------------------------------------


step 02 -------------------------------

    section 04 ------------------------
    section 05 ------------------------
    section 06 ------------------------
    .......... ------------------------
    
---------------------------------------

