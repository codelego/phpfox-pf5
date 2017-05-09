<?php

namespace Phpfox\Paging;

class SlidingDecorator extends AbstractDecorator
{
    public function render(PagingInterface $paging)
    {
        if ($paging->getPageCount() < 2) {
            return '';
        }

        $width = (int)$this->get('width', 5);
        $start = $paging->getPageNumber() - ceil($width / 2);

        if ($start < 1) {
            $start = 1;
        }

        $end = $start + $width -1 ;

        if ($end > $paging->getPageCount()) {
            $end = $paging->getPageCount();
        }

        $range = range($start, $end, 1);
        $pages = [];

        if ($start > 1) {
            $pages[] = _sprintf('<li><a aria-label="Previous" href="{0}">{1}</a></li>', [
                $paging->getPageUrl(1),
                '<span aria-hidden="true">&laquo;</span>',
            ]);
        }

        foreach ($range as $pageNumber) {
            $pages[] = _sprintf('<li><a href="{0}">{1}</a></li>', [
                $paging->getPageUrl($pageNumber),
                $pageNumber,
            ]);
        }

        if ($end < $paging->getPageCount()) {
            $pages[] = _sprintf('<li><a aria-label="Next" href="{0}">{1}</a></li>', [
                $paging->getPageUrl($paging->getPageCount()),
                '<span aria-hidden="true">&raquo;</span>',
            ]);
        }

        return '<div class="pagination-sliding"><ul class="pagination">' . implode('', $pages) . '</ul></div>';
    }
}