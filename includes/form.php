<?php
namespace csvpearlbells;
class displayForm {
    
    public function __construct() {
        $this->uploadForm();
        $this->optionsForm();
        $this->authorDetails();
    }
    
    public function uploadForm() {
        $html = '<h2>CSV to Webpage Settings</h2>
                 <form enctype="multipart/form-data" action="" method="POST">
                 <input type="hidden" name="picture" value="" />
                 Choose a file to upload: <input name="uploadedfile" type="file" /><br />
                 <input type="submit" value="upload" name="upload" />
                 </form>';
         echo  $html;
    }
    
    public function optionsForm() {
        
          $bg_color = get_option('pearl_csv_to_webpage_bg_color');
          $alt_bg_color = get_option('pearl_csv_to_webpage_alt_bg_color');
	  $font_color = get_option('pearl_csv_to_webpage_font_color');
	  $alt_font_color = get_option('pearl_csv_to_webpage_alt_font_color');
          $border_width = get_option('pearl_csv_to_webpage_border_width');
	  $border_color = get_option('pearl_csv_to_webpage_border_color');
	  $padding = get_option('pearl_csv_to_webpage_padding');	  
	  $fontsize = get_option('pearl_csv_to_webpage_fontsize');
	  $mouseover_color = get_option('pearl_csv_to_webpage_mouseover_color');
	  $alt_mouseover_color = get_option('pearl_csv_to_webpage_alt_mouseover_color');
          $pg_color = get_option('pearl_csv_to_webpage_pg_color');
	  $pg_hover_color = get_option('pearl_csv_to_webpage_pg_hover_color');
          
          $displayOptionsForm = '
                
            <form method="post" action="'.$PHP_SELF.'">

                <label for="pearl_csv_to_webpage_bg_color">Bg Color :</label>
                <input type="text" name="pearl_csv_to_webpage_bg_color" value="'.$bg_color.'"/>
                <label for="pearl_csv_to_webpage_alt_bg_color">Alt Bg Color :</label>
                <input type="text" name="pearl_csv_to_webpage_alt_bg_color" value="'.$alt_bg_color.'"/><br/>
                <label for="pearl_csv_to_webpage_font_color">Font Color :</label>
                <input type="text" name="pearl_csv_to_webpage_font_color" value="'.$font_color.'"/>
                <label for="pearl_csv_to_webpage_alt_font_color">Alt Font Color :</label>
                <input type="text" name="pearl_csv_to_webpage_alt_font_color" value="'.$alt_font_color.'"/><br/>
                <label for="pearl_csv_to_webpage_border_width">Border Width :</label>
                <input type="text" name="pearl_csv_to_webpage_border_width" value="'.$border_width.'"/>
                <label for="pearl_csv_to_webpage_border_color">Border Color :</label>
                <input type="text" name="pearl_csv_to_webpage_border_color" value="'.$border_color.'"/>   <br/> 
                <label for="pearl_csv_to_webpage_padding">Padding :</label>
                <input type="text" name="pearl_csv_to_webpage_padding" value="'.$padding.'"/>
                <label for="pearl_csv_to_webpage_fontsize">Font Size :</label>
                <input type="text" name="pearl_csv_to_webpage_fontsize" value="'.$fontsize.'"/>
                <label for="pearl_csv_to_webpage_mouseover_color">Mousehover Color :</label>
                <input type="text" name="pearl_csv_to_webpage_mouseover_color" value="'.$mouseover_color.'"/><br/> 
                <label for="pearl_csv_to_webpage_alt_mouseover_color">Mousehover(Font) Color :</label>
                <input type="text" name="pearl_csv_to_webpage_alt_mouseover_color" value="'.$alt_mouseover_color.'"/>
                <label for="pearl_csv_to_webpage_width">Width (in %) :</label>
                <input type="text" name="pearl_csv_to_webpage_width" value="'.get_option('pearl_csv_to_webpage_width').'"/><br/>
                <label for="pearl_csv_to_webpage_pg_color">Pagination Color :</label>
                <input type="text" name="pearl_csv_to_webpage_pg_color" value="'.$pg_color.'"/><br/> 
                <label for="pearl_csv_to_webpage_pg_hover_color">Pagination Bg Hover :</label>
                <input type="text" name="pearl_csv_to_webpage_pg_hover_color" value="'.$pg_hover_color.'"/>
                <input type="submit" name="submit" value="Submit"/>

            </form> ';

          echo $displayOptionsForm;

        
    }
    
    public function authorDetails() {
        
        $details = ' <p>Created by <a href="http://pearlbells.co.uk/" target="_blank">Pearlbells</a><br/> Follow me : <a href="http://twitter.com/#!/pearlbells" target="_blank">Twitter</a><br/>Please Donate : <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=W884YAWEDPA9U" target="_blank">Click Here</a></p>
         <p>Feel free to email me lizeipe@gmail.com for any advice or suggestion.</p>';
        echo $details;
        
    }
    
}
?>
