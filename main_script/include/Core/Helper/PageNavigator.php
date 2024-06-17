<?php

namespace Core\Helper;
class PageNavigator
{
    private $currentPage;
    private $linkPrefix;
    private $target;
    private $totalPagesNum;
    private $HTML;

    public function __construct($currentPage, $totalSize, $pageSize, $linkPrefix, $target)
    {
        $this->currentPage = $currentPage;
        $this->linkPrefix = $linkPrefix;
        $this->target = $target;
        $this->totalPagesNum = ceil($totalSize / $pageSize);
        if ($this->totalPagesNum == 0) {
            return NULL;
        }
        if ($this->currentPage > $this->totalPagesNum) {
            $this->currentPage = $this->totalPagesNum;
        }
        if ($this->currentPage <= 0) {
            $this->currentPage = 1;
        }
        $HTML = '<div class="paginator">';
        $HTML .= $this->createFirstNavigator();
        $HTML .= $this->createPreviousNavigator();
        $beforeCount = 1;
        $afterCount = 1;
        if ($this->currentPage == $this->totalPagesNum) {
            $beforeCount = 3;
            $afterCount = 0;
        }
        if ($this->currentPage == 1) {
            $afterCount = 1;
            $beforeCount = 0;
        }
        $HTML .= $this->createPage(1);
        if ($this->currentPage - $beforeCount - 1 > 1) {
            $HTML .= ' ... ';
        }
        for ($i = $this->currentPage - $beforeCount; $i <= $this->currentPage; $i++) {
            if ($i <= 1 || $i >= $this->totalPagesNum) {
                continue;
            }
            $HTML .= $this->createPage($i);
        }
        $HTML .= '<span class="number currentPage">' . $this->currentPage . ' </span>';
        for ($i = $this->currentPage; $i <= $this->currentPage + $afterCount; $i++) {
            if ($i >= $this->totalPagesNum) {
                continue;
            }
            $HTML .= $this->createPage($i);
        }
        if ($this->currentPage + $afterCount + 1 < $this->totalPagesNum) {
            $HTML .= ' ... ';
        }
        if ($this->totalPagesNum > 1) {
            $HTML .= $this->createPage($this->totalPagesNum);
        }
        $HTML .= $this->createNextNavigator();
        $HTML .= $this->createLastNavigator();
        $HTML .= '</div>';
        $this->HTML = $HTML;
    }

    private function createFirstNavigator()
    {
        $HTML = '';
        $disabled = $this->currentPage == 1 || $this->totalPagesNum == 1;
        if (!$disabled) {
            $HTML .= '<a href="' . $this->getUrl(1) . '" class="first">';
        }
        $HTML .= '<img src="img/x.gif" alt="first page" class="first ' . ($disabled ? "disabled" : "") . '"/>';
        if (!$disabled) {
            $HTML .= '</a>';
        }

        return $HTML;
    }

    private function getUrl($page)
    {
        $this->linkPrefix['page'] = $page;

        return $this->target . "?" . http_build_query($this->linkPrefix);
    }

    private function createPreviousNavigator()
    {
        $HTML = '';
        $disabled = ($this->currentPage - 1) < 1;
        if (!$disabled) {
            $HTML .= '<a href="' . $this->getUrl($this->currentPage - 1) . '" class="previous">';
        }
        $HTML .= '<img src="img/x.gif" alt="previous page" class="previous ' . ($disabled ? "disabled" : "") . '"/>';
        if (!$disabled) {
            $HTML .= '</a>';
        }

        return $HTML;
    }

    private function createPage($page)
    {
        if ($page < 1 || $page > $this->totalPagesNum || $page == $this->currentPage) {
            return '';
        }

        return '<a class="number" href="' . $this->getUrl($page) . '">' . $page . ' </a>';
    }

    private function createNextNavigator()
    {
        $HTML = '';
        $disabled = ($this->currentPage + 1) > $this->totalPagesNum;
        if (!$disabled) {
            $HTML .= '<a href="' . $this->getUrl($this->currentPage + 1) . '" class="next">';
        }
        $HTML .= '<img src="img/x.gif" alt="next page" class="next ' . ($disabled ? "disabled" : "") . '"/>';
        if (!$disabled) {
            $HTML .= '</a>';
        }

        return $HTML;
    }

    private function createLastNavigator()
    {
        $HTML = '';
        $disabled = $this->currentPage == $this->totalPagesNum || $this->totalPagesNum == 1;
        if (!$disabled) {
            $HTML .= '<a href="' . $this->getUrl($this->totalPagesNum) . '" class="last">';
        }
        $HTML .= '<img src="img/x.gif" alt="last page" class="last ' . ($disabled ? "disabled" : "") . '"/>';
        if (!$disabled) {
            $HTML .= '</a>';
        }

        return $HTML;
    }

    /**
     * @param bool $no (No navigator div)
     * @return mixed|string
     */
    public function get($no = FALSE)
    {
        if ($no) {
            $HTML = $this->HTML;
            $HTML = str_replace('<div class="paginator">', '', $HTML);
            $HTML = str_replace('</div>', '', $HTML);
            return $HTML;
        }
        return $this->HTML;
    }
}