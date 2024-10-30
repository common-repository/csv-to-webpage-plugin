<?php
namespace csvpearlbells;
class data {
    
        public function __construct() {
           add_shortcode('pearl_csv_to_webpage_display', array($this,'csv_to_webpage'));
        }
    
	public function csv_to_webpage($atts ,$content = null )
	{           
		extract( shortcode_atts( array(
		'filename' => 'score.csv',
                'sort' => '',
                'pagination' => 'no',
                'pagesize' => '100',
		), $atts ) );
		
		$dir = plugin_dir_path(dirname(__FILE__));
                $filepath = $dir."upload/".$filename;
                $filename = $filename;
		$pagination = ( $pagination == 'yes') ? 1 : 0;
               
                try {
                    if(file_exists($filepath)) {

                        if (($handle = fopen($dir."/upload/".$filename, "r")) !== FALSE)
                        {
                            $row =0;
                            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
                            {
                                $data = array_map("utf8_encode", $data); 
                                $read_csv_content[$row] = $data;
                                $row++;		
                            }

                            $display_csv_file_content = $this->DisplayData($read_csv_content, $sort, $pagination, $pagesize );

                            fclose($handle);
                        }
                    }
                    else {
                        echo 'File not found';
                    }
                }
                catch (Exception $e) {
                    echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
                }
		
		return $display_csv_file_content;		
	}
	// Arrange Data in a Table
	
	public function DisplayData($arrdat, $sort, $pagination , $pageSize )
	{
            $num = count($arrdat);
            $numinside = count($arrdat[0]);
            $colsSort = (!empty($sort)) ? explode(',',$sort) : array();
          
            $html .= '<div class="pearl-container">';
            if( $pagination ){
                $html .= ' <div class="pager">
                    <form>
                        <span class="first btn">First</span>
                        <span class="prev btn">Prev</span>
                        <input type="text" class="pagedisplay"/>
                        <span class="next btn">Next</span>
                        <span class="last btn">Last</span>
                        <select class="pagesize">
                            <option selected="selected"  value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="30">30</option>
                            <option  value="40">40</option>
                            <option  value="50">50</option>
                            <option  value="100">100</option>
                        </select>
                        <ul class="goTo">

                        </ul>
                    </form>
                </div>';
            }
            $html .= '<table class="tablesorter pearl_tblstyle" page-size ="'.$pageSize.'" pagination="'.$pagination.'"><thead>';
            for( $i=0; $i<$num; $i++ )
            {
                $html .= '<tr>';

                for( $j=0; $j<$numinside; $j++ )
                {
                    if( $i == 0 )
                    {
                        $sortHtml = '';
                        $sortHtml = (in_array( $j+1, $colsSort)) ? 'header' : 'sorter-false';
                       
                        $html .= '<th  class="'.$sortHtml.'" data-content="'.$arrdat[$i][$j].'">'.$arrdat[$i][$j].'</th>';
                        $head[$j] = $arrdat[$i][$j];
                    }
                    else
                    $html .=  '<td data-content="'.$head[$j].'">'.$arrdat[$i][$j].'</td>';
                }
                $html .= '</tr>';
                if ($i == 0 ) $html .= '</thead><tbody>';
            }

            $html .=  '</tbody></table></div>';

            return $html;
	}      
}
?>
