<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\CoreTheme;

class Themes
{
    /**
     * @param mixed $id
     *
     * @return CoreTheme|null
     */
    public function findById($id)
    {
        return \Phpfox::getModel('core_theme')
            ->findById((string)$id);
    }

    /**
     * @param $id
     * Active a theme
     */
    public function setDefault($id)
    {
        $theme = $this->findById($id);

        if (!$theme) {
            throw new \InvalidArgumentException(_sprintf('Oops! "{0}" is not a valid theme id',
                [$id]));
        }


        \Phpfox::get('db')
            ->update(':core_theme')
            ->values(['is_default' => 0])
            ->execute();

        \Phpfox::get('db')
            ->update(':core_theme')
            ->values([
                'is_default' => 1,
                'is_active'  => 1,
            ])
            ->where('id=?', $id)
            ->execute();
    }

    public function active($id)
    {
        $theme = $this->findById($id);

        if (!$theme) {
            throw new \InvalidArgumentException(_sprintf('Oops! "{0}" is not a valid theme id',
                [$id]));
        }

        \Phpfox::get('db')
            ->update(':core_theme')
            ->values([
                'is_active' => 1,
            ])
            ->where('id=?', $id)
            ->execute();
    }

    public function inactive($id)
    {
        $theme = $this->findById($id);

        if (!$theme) {
            throw new \InvalidArgumentException(_sprintf('Oops! "{0}" is not a valid theme id',
                [$id]));
        }

        \Phpfox::get('db')
            ->update(':core_theme')
            ->values([
                'is_active' => 0,
            ])
            ->where('id=?', $id)
            ->where('is_default=?', 0)
            ->execute();
    }
}