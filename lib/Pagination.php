<?php
/**
 * Pathways
 *
 * @Author: Stefan Sjönnebring
 * 
 */
class Pagination
{

	public function __construct(){	

	}

	public function generatePagination($arr) 
	{
		$html = "";
		$start = 0;
        $limit = 4;
        $page = 1;
		$rows = count($arr);
        $total = ceil($rows/$limit);

        
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
            $start = ($page-1) * $limit;
        }

        if($page > 1) {
            $html .= "<a href='{$caturl}?page=".($page-1)."' class='pagination'>PREVIOUS</a>";
        }
        if($page != $total) {
            $html .= "<a href='{$caturl}?page=".($page+1)."' class='pagination'>NEXT</a>";
        }

        for($i=1; $i<=$total; $i++) {
            if($i==$page) {
                $html .= "<span class='pagination-current'>".$i."</span>";
            } else {
                $html .= "<a href='{$caturl}?page=".$i."' class='pagination'>".$i."</a>";
            }
        }

        echo $html;
	}

}
