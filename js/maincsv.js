var $pearlCSV = jQuery.noConflict();
$pearlCSV(document).ready(function() 
    { 
        $pearlCSV('.pearl-container').each(function(i) { 
            var targetDiv = $pearlCSV(this).children(".pearl_tblstyle");
            $pagination = targetDiv.attr('pagination');  
            if( $pagination == 1 )
            {
                $pageSize = targetDiv.attr('page-size');
                $pearlCSV(this).find('.pagesize').val($pageSize);
                targetDiv.tablesorter({widthFixed: true, widgets: ['zebra']});
                targetDiv.tablesorterPager({container: $pearlCSV(this).children(".pager"),size:$pageSize});
            }
            else {
               targetDiv.tablesorter({widthFixed: true, widgets: ['zebra']});
            }
        });
        $pearlCSV(".pearl_tblstyle th.sorter-false").removeClass('header');
    } 
);


