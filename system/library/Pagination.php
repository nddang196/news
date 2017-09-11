<?php

/**
 * Created by PhpStorm.
 * User: nddan
 * Date: 05-07-2017
 * Time: 9:40 SA
 */
class Pagination
{
    private $_start;
    private $_html;
    private $_limit;

    public function __construct($link, $total_records, $current_page, $limit = 10)
    {
        $this->_limit = $limit;
        $this->_html = "";
        $total_page = ceil($total_records / $limit);
        //Giới hạn trang hiện tại từ 1-->tổng số trang
        $this->setCurrentPage($current_page, $total_page);
        $this->_start = ($current_page - 1) * $limit;

        if($total_page > 1)
        {
            $this->_html .= "<ul class='pagination'>";
            if($current_page > 1)
            {
                $this->_html .= "<li><a href='" . str_replace("{page}", 1, $link) . "'>Đầu</a></li>";
                $this->_html .= "<li><a href='" . str_replace("{page}", $current_page-1, $link) . "'>&laquo;</a></li>";
            }
            for($i = 1; $i <= $total_page; $i++)
            {
                if($i == $current_page)
                {
                    $this->_html .= "<li class='active'><span>$i</span></li>";
                }
                else
                {
                    $this->_html .= "<li><a href='" . str_replace("{page}", $i, $link) . "'>$i</a></li>";
                }
            }
            if($current_page < $total_page)
            {
                $this->_html .= "<li><a href='" . str_replace("{page}", $current_page+1, $link) . "'>&raquo;</a></li>";
                $this->_html .= "<li><a href='" . str_replace("{page}", $total_page, $link) . "'>Cuối</a></li>";
            }
            $this->_html .= "</ul>";
        }
    }

    public function getHtml()
    {
        return $this->_html;
    }

    public function getLimit()
    {
        return $this->_limit;
    }

    public function getStart()
    {
        return $this->_start;
    }

    public function setCurrentPage(&$current_page, $total_page)
    {
        if($current_page > $total_page)
        {
            $current_page = $total_page;
        }
        elseif($current_page < 1)
        {
            $current_page = 1;
        }
    }
}