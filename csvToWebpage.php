<?php
/*
Plugin Name: CSV to Responsive Tables
Plugin URI: http://pearlbells.co.uk/
Description:  Display Excel files to Wordpress Website 
Version:  5.1
Author:Pearlbells
Author URI: https://www.pearlbells.co.uk/csv-to-webpage/
License: GPL2
*/
/*
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version. 

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details. 

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.

*/
namespace csvpearlbells;
include_once 'includes/form.php';
include_once 'includes/data.php';
include_once 'includes/optionsValues.php';
include_once 'includes/functions.php';
include_once 'includes/style.php';

class cvsToWebpage extends \WP_Widget {
   
     private $objOptions;
     private $objData;
   
     public function __construct() {
         add_action( 'admin_menu', array( $this, 'menu' ) );
         $this->objOptions = new optionsValues;
         $this->objOptions->add_options();
         $this->objData = new data;
         new styleData();
         register_deactivation_hook(__FILE__, array( $this, 'pearl_uninstall' ));
         $params = array( 
                    'description' => 'Display Excel file in table format',
                    'name' => 'CSV to Responsive Tables');
        parent::__construct('cvsToWebpage','',$params);
     }
     
     public function pearl_uninstall() {
         $this->objOptions->delete_options();
     }
     
     public function menu() {
        add_options_page('CSV to Webpage','CSV to Webpage','manage_options',__FILE__,array($this,'opt_page')); 
         
     }
  
     public function opt_page() {
        
         $this->postData();
     }
     
     public function postData() {
         
        $objFunc = new func();
        
        if($_REQUEST['upload']) {
            $objFunc->uploadFile();
        }
        if($_REQUEST['submit']) {
            $this->objOptions->update_options();
           
        }
        
         new displayForm;
    }
    
    public function form($instance)
    {
        extract($instance);
        ?>
         <p>
            <label for="<?php echo $this->get_field_id('title')?>"> Title : </label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>"
                   name="<?php echo $this->get_field_name('title');?>"
                   value="<?php if(isset($title)) echo esc_attr($title);?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('filename')?>"> Filename : </label>
            <input class="widefat" id="<?php echo $this->get_field_id('filename');?>"
                   name="<?php echo $this->get_field_name('filename');?>"
                   value="<?php if(isset($filename)) echo esc_attr($filename);?>"/>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('sort')?>"> Sort : </label>
            <input class="widefat" id="<?php echo $this->get_field_id('sort');?>"
                   name="<?php echo $this->get_field_name('sort');?>"
                   value="<?php if(isset($sort)) echo esc_attr($sort);?>"/>
        </p>
       
        <?php
        
    }
    
    public function widget($args , $instance)
    {
        extract($args);
        extract($instance);
        echo $before_title . $title . $after_title;  
        if(!empty($filename))
            $csv = $this->objData->csv_to_webpage ($instance);
        echo $csv;
    }
     
}
//new cvsToWebpage;
add_action('widgets_init',function ()
{
    register_widget('csvpearlbells\cvsToWebpage');
});
?>
