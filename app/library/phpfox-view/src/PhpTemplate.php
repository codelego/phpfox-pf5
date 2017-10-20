<?php

namespace Phpfox\View;

class PhpTemplate implements ViewTemplateInterface
{
    /**
     * @var array
     */
    protected $map = [];

    /**
     * @var array
     */
    protected $prefers = ['default:'];

    /**
     * @var array
     */
    protected $cached = [];

    /**
     * PhpTemplate constructor.
     *
     * @ignore
     */
    public function __construct()
    {
        $this->map = \Phpfox::get('package.loader')->getViewParameters();
        $this->cached = [];
    }

    public function render($__name_, $__vars_)
    {
        $__template_ = $this->load($__name_);

        if (!$__template_) {
            return '';
        }

        ob_start();

        extract($__vars_, EXTR_OVERWRITE);

        unset($__vars_);

        include PHPFOX_APP_DIR . $__template_ . '.phtml';

        return ob_get_clean();

    }

    /**
     * <code>
     *  $template->preferThemes([galaxy,default]);
     * </code>
     *
     * @param  array|string $themes
     *
     * @return $this
     */
    public function preferThemes($themes)
    {
        $this->cached = [];

        if (is_string($themes)) {
            $themes = ['themes'];
        }

        if (empty($themes)) {
            $themes = ['default'];
        } else {
            $themes[] = 'default';
        }

        $this->prefers = array_map(function ($v) {
            return $v . ':';
        }, $themes);

        return $this;
    }

    public function load($name)
    {
        if (isset($this->cached[$name])) {
            return $this->cached[$name];
        }

        foreach ($this->prefers as $prefer) {
            if ($this->map->has($key = $prefer . $name)) {
                return $this->cached[$name] = $this->map->get($key);
            }
        }

        if (PHPFOX_ENV == 'development') {
            throw new InvalidArgumentException("template not found '{$name}'");
        }

        return null;
    }
}