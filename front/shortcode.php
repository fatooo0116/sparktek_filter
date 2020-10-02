<?php

// [bartag foo="foo-value"]
function exam_table_func( $atts ) {
	$a = shortcode_atts( array(
    'id' => 0,		
    'f1'=>'',
    'f2'=>'',
    'f3'=>'',
    'f4'=>'',
  ), $atts );
  

  wp_enqueue_style('ielts-modal-css', plugins_url('/exam-location/post-type-location1/js/fancybox3/dist/jquery.fancybox.min.css'), '', '20151219');
  wp_enqueue_script('ielts-modal-js', plugins_url('/exam-location/post-type-location1/js/fancybox3/dist/jquery.fancybox.min.js'), array('jquery'), '20151219', true);


    wp_enqueue_style( 'table_css', plugins_url( 'css/basictable.css', __FILE__ ), '', rand(0,9999),  'all' );
    wp_enqueue_script( 'table_js',plugins_url( 'js/jquery.basictable.js', __FILE__ ), array('jquery'), '1.1.9' );
    wp_enqueue_script( 'table_main',plugins_url( 'js/script.js', __FILE__ ), array('jquery'), '1.1.9' );
   
  
    /* 
        [exam_table id="1"  f1="03"]  ->  月份  
        [exam_table id="1"  f2="北部地區"]  -> 地區
        [exam_table id="1"  f3="考試類型"]  -> 考試類型         
        [exam_table id="1"  f4="考試組別"]  -> 考試組別
    
    */


    ob_start();


    global $wpdb;
    $my_table = $wpdb->prefix."SliderTool";
    $sql = "SELECT * FROM ".$my_table." where id=".$atts['id'];
    $tb = $wpdb->get_results($sql);


    $my_table = $wpdb->prefix."aloha_exam_place";
    $sql2 = "SELECT * FROM ".$my_table." where tb=".$atts['id'];
    $place = $wpdb->get_results($sql2);



    // print_r($tb);
    // print_r($place );

  
    ?>


  <div id="aloha_search">
    <form id="aloha_search" action="" method="get">

      <div class="searchbox js_search_item">
     
          <select name="ex_date" id="slk2">
          <?php  if(!isset($atts['f1'])){ ?>
            <option value=""><?php echo  $tb[0]->tb1; ?></option>
            <?php 
              global $wpdb;
              $my_table = $wpdb->prefix."SliderTool_slide";
              // $sql = "SELECT MONTH(ex1_date) as month FROM ".$my_table." WHERE slider=".$atts['id'];
              $sql = "SELECT ex1_date as month FROM ".$my_table." WHERE slider=".$atts['id'];
              $results_date = $wpdb->get_results($sql);   
              
              // print_r($results_date);

              $moption = array();
              foreach($results_date as $item){
                 $moption[] = substr($item->month, 0, 7);
              }
             
              $moption = array_unique($moption);
              asort($moption);

              foreach($moption as $mon){
                $data = $mon.'-01';;
                $v = $mon.'-01';
                $slk = ($_GET['ex_date']==$v)? 'selected':'';
                echo '<option  '.$slk.'   value="'.$v.'">'.$data.'</option>';
              }

            ?>            

            <?php }else{    ?>         
             <option  value="" ><?php echo date("Y")."-".$atts['f1']; ?></option>;
            <?php } ?>
          </select>


      </div>

      

      <div class="searchbox js_search_item">
 
        <select id="slk1" name="ex_city"  value="<?php  echo $_GET['ex_city']; ?>">
              <?php  if(!isset($atts['f2'])){ ?>
              <option value=""><?php echo  $tb[0]->tb2; ?></option>  
                <?php 
                  foreach($place as $item){
                    $slk = ($_GET['ex_city']==$item->id)? 'selected' : '';
                    echo '<option '.$slk.' value="'.$item->id.'" >'.$item->pname.'</option>';
                  }
                ?>  
            <?php }else{    ?>         
             <option  value="" ><?php echo $atts['f2']; ?></option>;
            <?php } ?>              
        </select>

      </div>
      
   


      <div class="searchbox js_search_item">
        <?php 
        			$my_table = $wpdb->prefix."aloha_exam_type";
              $sql = "SELECT * FROM ".$my_table." WHERE  tb=".$atts['id'];
              $results = $wpdb->get_results($sql);             
        ?>


        <select id="slk4" name="ex_type1">         
          <?php  if(!isset($atts['f3'])){ ?>
          <option value=""><?php echo  $tb[0]->tb3; ?></option>          
          <?php 
            foreach($results as $item){
              $slk = ($_GET['ex_type1']==$item->id)? 'selected' : '';
              echo '<option '.$slk.' value="'.$item->id.'" >'.$item->tname.'</option>';
            }             
          ?>    
            <?php }else{    ?>         
             <option  value="" ><?php echo $atts['f3']; ?></option>;
            <?php } ?>                   
        </select>
      </div> 



      <div class="searchbox js_search_item">
      <?php 
        			$my_table = $wpdb->prefix."aloha_exam_type1";
              $sql = "SELECT * FROM ".$my_table." WHERE  tb=".$atts['id'];
              $results = $wpdb->get_results($sql);                  
        ?>
    
        <select id="slk3" name="ex_type2">   
            <?php  if(!isset($atts['f4'])){ ?>         
            <option value=""><?php echo  $tb[0]->tb4; ?></option>
            <?php             
              foreach($results as $item){
                $slk = ($_GET['ex_type2']==$item->id)? 'selected' : '';
                echo '<option '.$slk.' value="'.$item->id.'" >'.$item->t1name.'</option>';
              }            
            ?>
            <?php }else{    ?>         
             <option  value="" ><?php echo $atts['f4']; ?></option>;
            <?php } ?>              
        </select>
      </div>
   

      <div class="searchbox js_search_item">
      <?php 
        			$my_table = $wpdb->prefix."aloha_exam_method";
              $sql = "SELECT * FROM ".$my_table." WHERE  tb=".$atts['id'];
              $results = $wpdb->get_results($sql);                  
        ?>
    
        <select id="slk3" name="ex_method">   
            <?php  if(!isset($atts['f5'])){ ?>         
            <option value=""><?php echo  $tb[0]->tb6; ?></option>
            <?php             
              foreach($results as $item){
                $slk = ($_GET['ex_method']==$item->id)? 'selected' : '';
                echo '<option '.$slk.' value="'.$item->id.'" >'.$item->mname.'</option>';
              }            
            ?>
            <?php }else{    ?>         
             <option  value="" ><?php echo $atts['f5']; ?></option>;
            <?php } ?>              
        </select>
      </div>



      <div class="js_search_item">
          <button type="submit" class="search_btn cmsmasters_button" ><?php echo $tb[0]->btn_text1; ?></button >
      </div>        
      <div class="js_search_item">
        <a href="<?php echo  get_the_permalink(get_the_ID()); ?>"  class="reset_btn cmsmasters_button" ><?php echo $tb[0]->btn_text2; ?></a>
      </div>  
    </form>       
  </div>








      <?php 
            $my_table = $wpdb->prefix."aloha_exam_type";
            $sqlt = "SELECT * FROM ".$my_table." where tb=".$atts['id'];
            $result_t = $wpdb->get_results($sqlt);
            // print_r($result_t);
              /*
            $match_name = array();
            foreach($result_t as $item){
              $match_name[$item->id] = $item->tname;
            }
            */

           // print_r($match_name);
           // echo $atts['f1'];
           // echo isset($atts['f1']);
           
            $my_table = $wpdb->prefix."SliderTool_slide";        
            $my_type = $wpdb->prefix."aloha_exam_type";
            $my_type1 = $wpdb->prefix."aloha_exam_type1";
            $my_method = $wpdb->prefix."aloha_exam_method";
            $my_place = $wpdb->prefix."aloha_exam_place";
            $my_status = $wpdb->prefix."aloha_exam_status";

            $sql = "SELECT * FROM ".$my_table." table_a  left join ".$my_method." table_b  on  table_a.ex1_method=table_b.id  left join ".
                  $my_type." table_c  on  table_a.ex_type1 = table_c.id   left join ".
                  $my_type1." table_d  on  table_a.ex_type2 = table_d.id   left join ".
                  $my_status." table_e  on  table_a.ex_status=table_e.id  left join ".
                  $my_place." table_f  on  table_a.ex_city=table_f.id WHERE  table_a.slider=".$atts['id'];;

            $where = '';
            if(isset($_GET['ex_city'])&& $_GET['ex_city']!=''){
              // echo "city".$_GET['city'];
              $where .=" AND table_a.ex_city=".$_GET['ex_city'];             
            }
            

            if(isset($_GET['ex_date']) && $_GET['ex_date']!=''){                            
              $time=strtotime($_GET['ex_date']);
              $month=date("m",$time);
              $year=date("Y",$time);
              $where .=" AND MONTH(table_a.ex1_date)=".$month." AND YEAR(table_a.ex1_date)=".$year;
            }

            if(isset($_GET['ex_type1']) && $_GET['ex_type1']!=''){                
              $where .=" AND table_a.ex_type1='".$_GET['ex_type1']."'";
            }






            if(isset($_GET['ex_type2']) && $_GET['ex_type2']!=''){                
              $where .=" AND table_a.ex_type2='".$_GET['ex_type2']."'";
            }


            if(isset($_GET['ex_method']) && $_GET['ex_method']!=''){                
              $where .=" AND table_a.ex1_method='".$_GET['ex_method']."'";
            }




            /*  Shortcode 參數區  */
            if(isset($atts['f1'])&& $atts['f1']!=''){
              $where .=" AND MONTH(table_a.ex1_date)=".$atts['f1'];
            }

            if(isset($atts['f2'])&& $atts['f2']!=''){
              $where .=" AND table_f.pname like '".$atts['f2']."'";  
            }

            if(isset($atts['f3'])&& $atts['f3']!=''){
              $where .=" AND table_c.tname like '".$atts['f3']."'";  
            }

            if(isset($atts['f4'])&& $atts['f4']!=''){
              $where .=" AND table_d.t1name like '".$atts['f4']."'";  
            }

            if(isset($atts['f5'])&& $atts['f5']!=''){
              $where .=" AND table_b.mname like '".$atts['f5']."'";  
            }
           

            $sql =  $sql . $where;
            $sql =  $sql." order by table_a.oid asc";

            // echo $sql;
            
            $results_slide = $wpdb->get_results($sql);

            if(!$results_slide){ 
              echo "<div class='msg404'>".$tb[0]->text_404."</div>";
             }else{

           ?>

<table id="table">
        <thead>
              <tr>
                <th><?php echo $tb[0]->tb1; ?></th>
                <th><?php echo $tb[0]->tb2; ?></th>
                <th><?php echo $tb[0]->tb3; ?></th>
                <th><?php echo $tb[0]->tb4; ?></th>
                <th><?php echo $tb[0]->tb6; ?></th>
                <th><?php echo $tb[0]->tb5; ?></th>
              </tr>
            </thead>
            <tbody>           

           <?php


            foreach($results_slide as $item){

            // print_r($item);

            ?>

            <tr>
              <td>
                <div class="ex1_date">
                  <?php                    
                     echo  date('Y/m/d ',strtotime($item->ex1_date))." ";
                   
                  ?>
                </div>
                <div class="ex1_time"><?php echo $item->ex1_time; ?></div>
              </td>
              <td>
                <div class="flex_row">
                  <a href="<?php echo $item->ex1_img; ?>" target="_blank"  data-fancybox="gallery" >
                    <img src="<?php echo esc_url( plugins_url( 'img/location.svg', __FILE__ ) )  ?>" />
                    <span class="ex_city"><?php echo $item->pname; ?></span>
                    <span class="ex_loc"><?php echo $item->ex1_location; ?></span>
                  </a>
                </div>                
              </td>


              <td>      
                <?php //  print_r($match_name);  ?>         
                <?php  echo $item->tname; ?>
              </td>

              <td>               
                <?php echo   $item->t1name;; ?>
              </td>

              <td>
                <?php                    
                    echo $item->mname;
                  ?>                                 
              </td>
              <?php 
              $class="";
              if(strpos($item->sname,'即將')>-1){ $class="redme"; }
              if(strpos($item->sname,'即将')>-1){ $class="redme"; }
              if(strpos($item->sname,'Last')>-1){ $class="redme"; }
               // echo strpos($item->sname,'即將');
              ?>
              
              <td class="ordernow <?php echo $class; ?>"> <?php if($item->url==''){ echo '<span>'.$item->sname.'</span>'; }else{ echo '<a href="'.$item->url.'" target="_blank"   >'.$item->sname.'</a>'; }; ?></td>
            </tr>

            <?php
            }
          }

      ?>
      
    </tbody>
  </table>
  <style>
    td.ordernow a{color:#009fa8;}
    td.ordernow.redme a{ color:#df504b;}
  </style>


    <?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
	
}
add_shortcode( 'exam_table', 'exam_table_func' );