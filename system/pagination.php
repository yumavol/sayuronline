<?php

function pagination($baseUrl, $totalResults, $resultsPerPage, $currentPage, $queryStringArray=[]) {
    $totalPages = ceil($totalResults/$resultsPerPage);
    
    if($totalPages <=1 )
    return '';
 
    $queryString = '';
    if($queryStringArray) {
        unset($queryStringArray['page']);
        $queryString = '&'.http_build_query($queryStringArray);
    }
    
    $rightLinks = $currentPage+3;
    $previousLinks = $currentPage-3;
    ob_start();
    
    ?>
    <nav aria-label="Page navigation" class="text-center">
    <ul class="pagination  pagination-sm no-margin pull-right">
        <?php
        
        if($previousLinks>1) {
            ?>
            <li>
                <a href="<?php echo $baseUrl.'?page=1'.$queryString; ?>" aria-label="First">
                    <span aria-hidden="true">&laquo;&laquo;</span>
                </a>
            </li>
            <?php
        }
    
        //disable previous button when first page
        if($currentPage == 1) {
            ?>
            <li class="disabled">
                <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php 
        }
        
        //if current page > 1 only then show previous page
        if($currentPage > 1) {
            ?>
            <li>
                <a href="<?php echo $baseUrl.'?page='.($currentPage-1).$queryString; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php 
        }
        
        //left side links        
        for($i = $previousLinks; $i <= $currentPage; $i++){ //Create left-hand side links
            if($i>0) {
                if($i==$currentPage) { ?>
                    <li class="active"><a href="#"><?php echo $i; ?></a></li>
                <?php }
                else { ?>
                    <li>
                        <a href="<?php echo $baseUrl.'?page='.$i.$queryString; ?>"><?php echo $i; ?></a>
                    </li>
                <?php }    
            }            
        }
        
        //middle pages
        if(false)
        for($i=1; $i<=$totalPages; $i++) {
            if($i==$currentPage) { ?>
                <li class="active"><a href="#"><?php echo $i; ?></a></li>
            <?php }
            else { ?>
                <li>
                    <a href="<?php echo $baseUrl.'?page='.$i.$queryString; ?>"><?php echo $i; ?></a>
                </li>
        <?php }
        }
        
        //right side links
        for($i = $currentPage+1; $i < $rightLinks ; $i++){ //create right-hand side links
            if($i<=$totalPages){
                if($i==$currentPage) { ?>
                    <li class="active"><a href="#"><?php echo $i; ?></a></li>
                <?php }
                else { ?>
                    <li>
                        <a href="<?php echo $baseUrl.'?page='.$i.$queryString; ?>"><?php echo $i; ?></a>
                    </li>
                    <?php
                }
            }
        }
        
        //if current page is not last page then only show next page link
        if($currentPage != $totalPages) { ?>
             <li>
                <a href="<?php echo $baseUrl.'?page='.($currentPage+1).$queryString; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <?php 
        }
        
        //if current page is last page then show next page link disabled
        if($currentPage == $totalPages) { ?>
              <li class="disabled">
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <?php 
        }
        
        if($rightLinks<$totalPages) {
            ?>
            <li>
                <a href="<?php echo $baseUrl.'?page='.$totalPages.$queryString; ?>" aria-label="First">
                    <span aria-hidden="true">&raquo;&raquo;</span>
                </a>
            </li>
            <?php
        }
    ?>
    </ul>
    </nav>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}