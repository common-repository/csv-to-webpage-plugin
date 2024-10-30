<?php
namespace csvpearlbells;
class styleData {
           
        public function __construct() {
            add_action( 'wp_head', array( $this, 'pearl_script' ) );
            add_action( 'wp_enqueue_scripts', array($this,'safely_add_stylesheet') );
            
        }
    
        public function safely_add_stylesheet() {

             wp_enqueue_style( 'csv-to-webpage', plugins_url('../css/pearl_csv_to_webpage_css.css', __FILE__) );
                 
             $custom_css = '
                .pearl_tblstyle {
                    border-width: '.get_option('pearl_csv_to_webpage_border_width').';
                    border-color: '.get_option('pearl_csv_to_webpage_border_color').';
                    font-size: '.get_option('pearl_csv_to_webpage_fontsize').';
                    width: '.get_option('pearl_csv_to_webpage_width').';
                }
                .pearl_tblstyle tbody tr:nth-of-type(odd) td,
                .pearl_tblstyle tbody tr:nth-of-type(odd) {
                    background-color: '.get_option('pearl_csv_to_webpage_alt_bg_color').';
                    color: '.get_option('pearl_csv_to_webpage_alt_font_color').';
                }
                .pearl_tblstyle tbody tr:nth-of-type(even) td,
                .pearl_tblstyle tbody tr:nth-of-type(even) {
                    background-color: '.get_option('pearl_csv_to_webpage_bg_color').';
                    color: '.get_option('pearl_csv_to_webpage_font_color').';
                }
                .pearl_tblstyle  tr td , .pearl_tblstyle  tr th {
                    text-indent: '.get_option('pearl_csv_to_webpage_padding').';
                }
                .pearl_tblstyle tbody tr:hover {
                    background-color: '.get_option('pearl_csv_to_webpage_mouseover_color').';
                    color: '.get_option('pearl_csv_to_webpage_alt_mouseover_color').';
                }
                
                .pager li, .btn {
                    background-color: '.get_option('pearl_csv_to_webpage_pg_color').';
                }
                
                .pager .goTo li:hover, .pager .goTo li.active {
                    background-color: '.get_option('pearl_csv_to_webpage_pg_hover_color').';
                }
                
                ';
                wp_add_inline_style( 'csv-to-webpage', $custom_css );
         }
         
        public function pearl_script()
        {  
            $scripts = array( 'jquery' => 'js/pagination/jquery-latest.js',
                              'pearlsortmig' => 'js/pagination/jqueryMigrate.js',
                              'pearlsort' => 'js/pagination/jquery.tablesorter.min.js',
                              'pearlpagination' => 'js/pagination/pagertable.js',                             
                              'maincsv' => 'js/maincsv.js');
     
            foreach($scripts as $key => $sc)
            {
               wp_deregister_script( $key );
               wp_register_script( $key, plugin_dir_url(dirname(__FILE__)).$sc  );
               wp_enqueue_script( $key );  
            }

        }
        
       
      
}
?>
