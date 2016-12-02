<?php

namespace Phpfox\Navigation;


class VerticalDropDownMenu implements NavigationDecoratorInterface
{
    use NavigationDecoratorTrait;

    public function render()
    {
        /** @var NavigationLoaderInterface $loader */
        $loader = \Phpfox::get('navigation.loader');
        $this->data = $loader->load($this->menu, $this->section);
    }
}