<?php
namespace csvpearlbells;
class optionsValues {
   
    public function add_options()
    {
            add_option('pearl_csv_to_webpage_bg_color','#ffffff','','yes');
            add_option('pearl_csv_to_webpage_alt_bg_color','#cccccc','','yes');
            add_option('pearl_csv_to_webpage_font_color','#000000','','yes');
            add_option('pearl_csv_to_webpage_alt_font_color','#000000','','yes');		
            add_option('pearl_csv_to_webpage_border_color','#000000','','yes');
            add_option('pearl_csv_to_webpage_border_width','1px','','yes');
            add_option('pearl_csv_to_webpage_padding','5px','','yes');
            add_option('pearl_csv_to_webpage_fontsize','12px','','yes');
            add_option('pearl_csv_to_webpage_mouseover_color','#eeeeee','','yes');
            add_option('pearl_csv_to_webpage_alt_mouseover_color','#999999','','yes');
            add_option('pearl_csv_to_webpage_width','90%','','yes');
            add_option('pearl_csv_to_webpage_pg_color','#cccccc','','yes');
            add_option('pearl_csv_to_webpage_pg_hover_color','#999999','','yes');
    }
    
    public function update_options() {
        
        $ok = false;
        $message = '';
        $optionValues = $_POST;
   
        foreach($optionValues as $key => $value){
            
          if ( get_option( $key ) !== false ) {
            update_option($key,$value);
			$ok = true;
          }
            
        }
        
        if($ok)
            $message = '<div id="message" class="updated fade"><p>Options Saved</p></div>';
        else
            $message = '<div id="message" class="error fade"><p>Failed to save options</p></div> ';
        echo $message;
       
        
    }
    
    public function delete_options()
    {
            delete_option('pearl_csv_to_webpage_bg_color');
            delete_option('pearl_csv_to_webpage_alt_bg_color');
            delete_option('pearl_csv_to_webpage_font_color');
            delete_option('pearl_csv_to_webpage_alt_font_color');
            delete_option('pearl_csv_to_webpage_border_width');
            delete_option('pearl_csv_to_webpage_border_color');
            delete_option('pearl_csv_to_webpage_padding');
            delete_option('pearl_csv_to_webpage_fontsize');
            delete_option('pearl_csv_to_webpage_mouseover_color');
            delete_option('pearl_csv_to_webpage_alt_mouseover_color');
            delete_option('pearl_csv_to_webpage_width');
            delete_option('pearl_csv_to_webpage_pg_color');
            delete_option('pearl_csv_to_webpage_pg_hover_color');
    }
   
}
?>
