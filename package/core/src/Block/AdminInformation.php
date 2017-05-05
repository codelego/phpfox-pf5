<?php

namespace Neutron\Core\Block;

use Phpfox\Layout\Component;
use Phpfox\View\ViewModel;

class AdminInformation extends Component
{
    public function run()
    {
        return new ViewModel([
            'license_email' => 'example@phpfox.com',
            'license_key'   => 'AAAA-BBBB-CCCC-DDDD',
            'license_type'  => 'trial',
            'installed_on'  => time() - 86400 * 30,
            'version'       => PHPFOX_VERSION,
        ], 'core/block/admin-information');
    }
}