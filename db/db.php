<?php
function slider_tool_db() {
  global $wpdb;
  $charset_collate = $wpdb->get_charset_collate();
  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );



  $table_name = $wpdb->prefix . 'SliderTool';
  $sql = "CREATE TABLE $table_name (
    id int(9) NOT NULL AUTO_INCREMENT,
    name varchar(150) NOT NULL,
    tb1 varchar(180) NOT NULL,
    tb2 varchar(180) NOT NULL,
    tb3 varchar(180) NOT NULL,
    tb4 varchar(180) NOT NULL,
    tb5 varchar(180) NOT NULL,
    tb6 varchar(180) NOT NULL,
    UNIQUE KEY id (id)
  ) $charset_collate;";
  dbDelta( $sql );
  

 /*  考試類型   考試組別  */
  $table_name = $wpdb->prefix . 'aloha_exam_type';
  $sql = "CREATE TABLE $table_name (
    id int(9) NOT NULL AUTO_INCREMENT,
    tname varchar(150) NOT NULL,
    data_type int(9) NOT NUL,
    tb int(9) NOT NUL
    UNIQUE KEY id (id)
  ) $charset_collate;";
  dbDelta( $sql );


  /* 狀態  */
  $table_name = $wpdb->prefix . 'aloha_exam_status';  
  $sql = "CREATE TABLE $table_name (
    id int(9) NOT NULL AUTO_INCREMENT,
    sname varchar(150) NOT NULL,   
    tb int(9) NOT NUL
    UNIQUE KEY id (id)
  ) $charset_collate;";
  dbDelta( $sql );



/* 聽力測驗形式  */
  $table_name = $wpdb->prefix . 'aloha_exam_method';
  $sql = "CREATE TABLE $table_name (
    id int(9) NOT NULL AUTO_INCREMENT,
    mname varchar(150) NOT NULL,
    tb int(9) NOT NUL
    UNIQUE KEY id (id)
  ) $charset_collate;";
  dbDelta( $sql );



/* 考試地點  */
$table_name = $wpdb->prefix . 'aloha_exam_place';
$sql = "CREATE TABLE $table_name (
  id int(9) NOT NULL AUTO_INCREMENT,
  pname varchar(150) NOT NULL,
  tb int(9) NOT NUL
  UNIQUE KEY id (id)
) $charset_collate;";
dbDelta( $sql );




  $table_name = $wpdb->prefix . 'SliderTool_slide';
  $sql = "CREATE TABLE $table_name (
    id int(9) NOT NULL AUTO_INCREMENT,
    title varchar(150) NOT NULL,  /* unused */

    ex_city varchar(150) NOT NULL,
    ex1_location varchar(220) NOT NULL,
    ex1_date DATE NOT NULL,
    ex1_time varchar(220) NOT NULL,
    ex1_img varchar(220) NOT NULL,
    ex1_method int(10) NOT NULL,

    ex2_location varchar(220) NOT NULL,
    ex2_date DATE NOT NULL,
    ex2_time varchar(220) NOT NULL,
    ex2_img varchar(220) NOT NULL,
    ex2_method int(10) NOT NULL,

    ex_type int(10) NOT NULL,

    ex_result_date DATE NOT NULL,

    ex_status int(10) NOT NULL,
        
    url varchar(200) NOT NULL,  /* unused */
    descx varchar(250) NOT NULL,  /* unused */
    slider int(15) NOT NULL,
    oid int(15) NOT NULL,

    UNIQUE KEY id (id)
  ) $charset_collate;";
  dbDelta( $sql );


}
