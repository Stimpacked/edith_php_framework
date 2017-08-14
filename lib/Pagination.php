<?php
/**
 * A class to generate pagination
 *
 * @Author Stefan Sjönnebring
 * 
 */
class Pagination
{

	public function __construct(){	

	}

	public function generatePagination($rows, $limit) 
	{
		$html = "";
		$start = 0;
        $page = 1;
        $total = ceil($rows/$limit);
        
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
            $start = ($page-1) * $limit;
        }

        // Previous Page
        if($page > 1) {
            $html .= "<a href='?page=".($page-1)."'>PREVIOUS</a>";
        }

        // Page numbers
        for($i=1; $i<=$total; $i++)
        {
            if($i==$page) {
                $html .= "<span>".$i."</span>";
            } else {
                $html .= "<a href='?page=".$i."'>".$i."</a>";
            }
        }

        // Next Page
        if($page != $total) {
            $html .= "<a href='?page=".($page+1)."'>NEXT</a>";
        }

        return $html;
	}

}
