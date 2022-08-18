<?php

class Pagination
{
    protected $baseURL        = '';
    protected $totalRows      = '';
    protected $perPage        = 10;
    protected $numLinks       = 2;
    protected $currentPage    =  0;
    protected $firstLink      = 'First';
    protected $nextLink       = '<i class="fas fa-angle-right"></i>';
    protected $prevLink       = '<i class="fas fa-angle-left"></i>';

    protected $lastLink       = 'Last';
    protected $fullTagOpen    = '<ul class="pagination justify-content-end font-weight-semi-bold mb-0">';
    protected $fullTagClose   = '</ul>';
    protected $firstTagOpen   = '';
    protected $firstTagClose  = '&nbsp;';
    protected $lastTagOpen    = '&nbsp;';
    protected $lastTagClose    = '';
    protected $curTagOpen    = '<li class="page-item d-none d-md-block">';
    protected $curTagClose    = '</li>';
    protected $nextTagOpen    = '<li class="page-item">';
    protected $nextTagClose    = '</li>';
    protected $prevTagOpen    = '<li class="page-item">';
    protected $prevTagClose    = '</li>';
    protected $numTagOpen    = '<li class="page-item d-none d-md-block">';
    protected $numTagClose    = '</li>';
    protected $showCount    = true;
    protected $currentOffset = 0;
    protected $queryStringSegment = 'p';

    function __construct($params = array())
    {
        if (count($params) > 0) {
            $this->initialize($params);
        }
    }

    function initialize($params = array())
    {
        if (count($params) > 0) {
            foreach ($params as $key => $val) {
                if (isset($this->$key)) {
                    $this->$key = $val;
                }
            }
        }
    }

    function createdShowing(){
        // If total number of rows is zero, do not need to continue
        if ($this->totalRows == 0 or $this->perPage == 0) {
            return '';
        }
        // Calculate the total number of pages
        $numPages = ceil($this->totalRows / $this->perPage);
        // Is there only one page? will not need to continue
        if ($numPages == 1) {
            if ($this->showCount) {
                $info = '<div class="d-flex mb-2 mb-md-0">Showing '. $this->totalRows.'</div>';
                return $info;
            } else {
                return '';
            }
        }
        // Determine query string
        $query_string_sep = (strpos($this->baseURL, '?') === FALSE) ? '&p=' : '&amp;p=';
        $this->baseURL = $this->baseURL . $query_string_sep;

        // Determine the current page
        $this->currentPage = isset($_GET[$this->queryStringSegment]) ? $_GET[$this->queryStringSegment] : 0;

        if (!is_numeric($this->currentPage) || $this->currentPage == 0) {
            $this->currentPage = 1;
        }

        // Links content string variable
        $output = '';

        // Showing links notification
        if ($this->showCount) {
            $currentOffset = ($this->currentPage > 1) ? ($this->currentPage - 1) * $this->perPage : $this->currentPage;
            $info = '<div class="d-flex mb-2 mb-md-0">Showing ' . $currentOffset . ' to ';

            if (($currentOffset + $this->perPage) <= $this->totalRows)
                $info .= $this->currentPage * $this->perPage;
            else
                $info .= $this->totalRows;

            $info .= ' of ' . $this->totalRows . ' Entries </div>';

            $output .= $info;
        }

        return $output;
    }
    /**
     * Generate the pagination links
     */
    function createLinks()
    {
        // If total number of rows is zero, do not need to continue
        if ($this->totalRows == 0 or $this->perPage == 0) {
            return '';
        }
        // Calculate the total number of pages
        $numPages = ceil($this->totalRows / $this->perPage);
        // Is there only one page? will not need to continue
        // if ($numPages == 1) {
        //     if ($this->showCount) {
        //         $info = 'Showing : ' . $this->totalRows;
        //         return $info;
        //     } else {
        //         return '';
        //     }
        // }
        // Determine query string
        $query_string_sep = (strpos($this->baseURL, '?') === FALSE) ? '&p=' : '&amp;p=';
        $this->baseURL = $this->baseURL . $query_string_sep;

        // Determine the current page
        $this->currentPage = isset($_GET[$this->queryStringSegment]) ? $_GET[$this->queryStringSegment] : 0;

        if (!is_numeric($this->currentPage) || $this->currentPage == 0) {
            $this->currentPage = 1;
        }

        // Links content string variable
        $output = '';

        // Showing links notification
        // if ($this->showCount) {
        //     $currentOffset = ($this->currentPage > 1) ? ($this->currentPage - 1) * $this->perPage : $this->currentPage;
        //     $info = 'Showing ' . $currentOffset . ' to ';

        //     if (($currentOffset + $this->perPage) <= $this->totalRows)
        //         $info .= $this->currentPage * $this->perPage;
        //     else
        //         $info .= $this->totalRows;

        //     $info .= ' of ' . $this->totalRows . ' ';

        //     $output .= $info;
        // }

        $this->numLinks = (int)$this->numLinks;

        // Is the page number beyond the result range? the last page will show
        if ($this->currentPage > $this->totalRows) {
            $this->currentPage = $numPages;
        }

        $uriPageNum = $this->currentPage;

        // Calculate the start and end numbers. 
        $start = (($this->currentPage - $this->numLinks) > 0) ? $this->currentPage - ($this->numLinks - 1) : 1;
        $end   = (($this->currentPage + $this->numLinks) < $numPages) ? $this->currentPage + $this->numLinks : $numPages;

        // Render the "First" link
        if ($this->currentPage > $this->numLinks) {
            $firstPageURL = str_replace($query_string_sep, '', $this->baseURL);
            $output .= $this->firstTagOpen . '<a href="' . $firstPageURL . '">' . $this->firstLink . '</a>' . $this->firstTagClose;
        }
        // Render the "previous" link
        if ($this->currentPage != 1) {
            $i = ($uriPageNum - 1);
            if ($i == 0) $i = '';
            $output .= $this->prevTagOpen . '<a id="datatablePaginationPrev" class="page-link"  aria-label="Previous" href="' . $this->baseURL . $i . '">' . $this->prevLink . '</a>' . $this->prevTagClose;
        }
        // Write the digit links
        for ($loop = $start - 1; $loop <= $end; $loop++) {
            $i = $loop;
            if ($i >= 1) {
                if ($this->currentPage == $loop) {
                    $output .= $this->curTagOpen.'<a id="datatablePaginationPage'.$loop.'" class="page-link active" href="'.$this->baseURL.$i.'" data-dt-page-to="0">'.$loop.'</a>'. $this->curTagClose;
                } else {
                    $output .= $this->numTagOpen . '<a id="datatablePagination'.$i.'" class="page-link" data-dt-page-to="'.$i.'" href="' . $this->baseURL . $i . '">' . $loop . '</a>' . $this->numTagClose;
                }
            }
        }
        // Render the "next" link
        if ($this->currentPage < $numPages) {
            $i = ($this->currentPage + 1);
            $output .= $this->nextTagOpen . '<a class="page-link" aria-label="Next" href="' . $this->baseURL . $i . '">' . $this->nextLink . '</a>' . $this->nextTagClose;
        }
        // Render the "Last" link
        if (($this->currentPage + $this->numLinks) < $numPages) {
            $i = $numPages;
            $output .= $this->lastTagOpen . '<a id="datatablePaginationPage'.$i.'" class="page-link" data-dt-page-to="'.$i.'" href="' . $this->baseURL . $i . '">' . $this->lastLink . '</a>' . $this->lastTagClose;
        }
        // Remove double slashes
        $output = preg_replace("#([^:])//+#", "\\1/", $output);
        // Add the wrapper HTML if exists
        $output = $this->fullTagOpen . $output . $this->fullTagClose;

        return $output;
    }
}
