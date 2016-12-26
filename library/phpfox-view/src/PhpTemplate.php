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
    protected $prefers = [];

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
        if (empty($themes)) {
            $this->prefers = [];
        } elseif (is_string($themes)) {
            $this->prefers = array_map(function ($v) {
                return trim($v) . '@';
            }, explode(',', $themes));
        } else {
            $this->prefers = array_map(function ($v) {
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

        foreach ($this->prefers as $k) {
            if (isset($this->map[$k . $name])) {
                return $this->cached[$name] = $this->map[$k . $name];
            }
        }

        if (isset($this->map[$name])) {
            return $this->cached[$name] = $this->map[$name];
        }

        if (PHPFOX_ENV == 'development') {
            throw new InvalidArgumentException("template not found '{$name}'");
        }
    }
}