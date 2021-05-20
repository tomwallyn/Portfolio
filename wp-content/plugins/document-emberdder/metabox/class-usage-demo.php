<?php
//include the main class file
require_once("meta-box-class/my-meta-box-class.php");
if (is_admin()){
  /* 
   * prefix of meta keys, optional
   * use underscore (_) at the beginning to make keys hidden, for example $prefix = '_ba_';
   *  you also can make prefix empty to disable it
   * 
   */
  $prefix = 'ppt_';
  /* 
   * configure your meta box
   */
  $config = array(
    'id'             => 'demo_meta_box',          // meta box id, unique per meta box
    'title'          => 'Viewer Settings (Optional)',          // meta box title
    'pages'          => array('ppt_viewer'),      // post types, accept custom post types as well, default is array('post'); optional
    'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'       => '',            // order of meta box: high (default), low; optional
    'fields'         => array(),            // list of meta fields (can be added by field arrays)
    'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
   * Initiate your meta box
   */
  $my_meta =  new AT_Meta_Box($config);
  
  /*
   * Add fields to your meta box
   */

 /* $my_meta->addRadio($prefix.'ppv_type',array('googledocs'=>'Google Doc Viewer','officeapps'=>'Microsoft Office 365 Viewer'),array('name'=> 'Viewer Type', 'std'=> array('googledocs'))); 
 */
  $my_meta->addNumber($prefix.'ppv_width',array('name'=> 'Width','std' => '','desc' =>' Leave blank if you want to use viewer default width (100%)'));    
  $my_meta->addNumber($prefix.'ppv_height',array('name'=> 'Height','std' => '','desc' =>'Leave blank if you want to use viewer default height (600px)'));
  $my_meta->addCheckbox($prefix.'ppv_file_name',array('name'=> 'Show File Name ','std' => '','desc' =>'Check if you want to show File name on top.'));
  /*
   * Don't Forget to Close up the meta box Declaration 
   */
  //Finish Meta Box Declaration 
  $my_meta->Finish();


$prefix = "_groupped_";
  $config3 = array(
    'id'             => 'demo_meta_box3',          // meta box id, unique per meta box
    'title'          => 'File Selection - Either select a document from Library or Paste a external file link. ',          // meta box title
    'pages'          => array('ppt_viewer'),      // post types, accept custom post types as well, default is array('post'); optional
    'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'       => 'high',            // order of meta box: high (default), low; optional
    'fields'         => array(),            // list of meta fields (can be added by field arrays)
    'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
   * Initiate your 3rd meta box
   */
  $my_meta3 =  new AT_Meta_Box($config3);
  //first field of the group has 'group' => 'start' and last field has 'group' => 'end'
  
  //text field
  $my_meta3->addFile($prefix.'ppv_file_url',array('name'=> 'Select From Media Library','desc' =>"&#9632; File Size cannot be more than 20 MB. <br/>&#9632; <a target='_blank' href='https://drive.google.com/file/d/1LcQ0SNibQsBnwhBOOpDm-dZxcfRM_1uh/view'> List Of Supported Document",'group' => 'start'));
  //Text field
  $my_meta3->addText($prefix.'ppv_ext_url',array('name'=> 'External Link', 'desc' =>"&#9632; Linked File Size cannot be more than 20 MB, <br/>&#9632; <a target='_blank' href='https://drive.google.com/file/d/1LcQ0SNibQsBnwhBOOpDm-dZxcfRM_1uh/view'> List Of Supported Document",'group' => 'end')); 
  $my_meta3->Finish();
}