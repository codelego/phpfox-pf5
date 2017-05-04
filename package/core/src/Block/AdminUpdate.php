<?php

namespace Neutron\Core\Block;

use Phpfox\Layout\Component;
use Phpfox\View\ViewModel;

class AdminUpdate extends Component
{
    public function run()
    {
        $limit = $this->get('limit', 6);

        $news = \Phpfox::get('cache.local')
            ->with('admincp.news', 600, function () use ($limit) {
                $remoteUrl = 'http://feeds.feedburner.com/phpfox';
                $content = \Phpfox::get('curl')->factory($remoteUrl)
                    ->getString();

                $dom = simplexml_load_string($content);
                $items = $dom->xpath('//channel/item');
                $news = [];
                foreach ($items as $item) {
                    $news[] = [
                        'title'       => $item->title->__toString(),
                        'description' => substr(strip_tags($item->description->__toString()),
                                0, 120) . '...',
                        'link'        => $item->link->__toString(),
                        'date'        => date('Y-m-d',
                            strtotime($item->pubDate->__toString())),
                    ];
                    if (count($news) >= $limit) {
                        break;
                    }
                }
                return $news;
            });

        return new ViewModel([
            'items' => $news,
        ], 'core/block/admin-update');
    }
}