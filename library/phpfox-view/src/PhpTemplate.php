<?php
namespace Phpfox\View;


/**
 * Class PhpTemplate
 *
 * @package Phpfox\Mvc
 */
class PhpTemplate implements ViewTemplateInterface
{
    /**
     * @var array
     */
    protected $map = [];

    /**
     * @var array
     */
    protected $fallback = [];

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
        $this->preferThemes(\Phpfox::getParam('views', 'prefer_themes'));
        $this->reset();
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

        include PHPFOX_PACKAGE_DIR . DS . $__template_ . '.phtml';

        return ob_get_clean();

    }

    /**
     * @param  array|string $themes
     *
     * @return $this
     */
    public function preferThemes($themes)
    {
        $this->cached = [];
        if (empty($themes)) {
            $this->fallback = [];
        } elseif (is_string($themes)) {
            $this->fallback = array_map(function ($v) {
                return trim($v) . '@';
            }, explode(',', $themes));
        } else {
            $this->fallback = array_map(function ($v) {
                return $v . '@';
            }, $themes);
        }

        return $this;
    }

    public function reset()
    {
        $this->map = \Phpfox::getParam('templates');
        $this->cached = [];
    }

    public function load($name)
    {
        if (isset($this->cached[$name])) {
            return $this->cached[$name];
        }

        foreach ($this->fallback as $k) {
            if (isset($this->map[$k . $name])) {
                return $this->cached[$name] = $this->map[$k . $name];
            }
        }

        if (isset($this->map[$name])) {
            return $this->cached[$name] = $this->map[$name];
        }

        trigger_error("template not found '{$name}'");
        return null;
    }
}