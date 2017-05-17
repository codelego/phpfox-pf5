# How System Bootstrap Work

1. Init libraries
  * Setup autoload (library)   -> read/write to autoload.library.local.php
  * Register autoload (library) 
  * Create require containers (1) 
  * Setup parameters (library) -> read/write to params.library.local.php
  * Init super cache

2. Init packages (heavy task)
  * Setup autoload (package)
  * Register autoload (package)
  * Setup parameters (package)
  
3. Init services
  * Resolve conflict version of bootstrap cache & shared cache (via core.setting_version)
  * Register error handler
  
4. Bootstrap
  * Emit event `bootstrap`, all package will listen to do something.

(1) ServiceManager, ParameterContainer, EventManager

In order to improve performance.
1. Reduce numbers of step
2. Resolve heavy task
  * Merge parameter is heavy, should `assign`.
  * Scan library twice for autoload and parameters is not good, merge to one.