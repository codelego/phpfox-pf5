<?php

namespace Neutron\Core\Block;

use Phpfox\Layout\LayoutBlock;
use Phpfox\View\ViewModel;

class AdminUpdate extends LayoutBlock
{
    public function run()
    {
        $remoteUrl = 'http://feeds.feedburner.com/phpfox';
        $content = \Phpfox::get('curl')->factory($remoteUrl)->getString();

        $dom = simplexml_load_string($content);

        $items = $dom->xpath('//channel/item');

        $news = [];
        foreach ($items as $item) {
            $news[] = [
                'title'       => $item->title->__toString(),
                'description' => substr(strip_tags($item->description->__toString()),
                    0,120) .'...',
                'link'        => $item->link->__toString(),
                'date'        => date('Y-m-d', strtotime($item->pubDate->__toString())),
            ];
            
        }

        $limit = $this->get('limit',6);

        return new ViewModel([
            'items' => array_slice($news, 0, $limit),
        ], 'core/block/admin-update');
    }
}