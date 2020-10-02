<?php
/**
 * WP-Reactivate
 *
 *
 * @package   WP-Reactivate
 * @author    Pangolin
 * @license   GPL-3.0
 * @link      https://gopangolin.com
 * @copyright 2017 Pangolin (Pty) Ltd
 */

namespace Pangolin\WPR\Endpoint;
use Pangolin\WPR;

/**
 * @subpackage REST_Controller
 */
class Example {
    /**
	 * Instance of this class.
	 *
	 * @since    0.8.1
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since     0.8.1
	 */
	private function __construct() {
        $plugin = WPR\Plugin::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();
	}

    /**
     * Set up WordPress hooks and filters
     *
     * @return void
     */
    public function do_hooks() {
        add_action( 'rest_api_init', array( $this, 'register_routes' ) );
    }

	/**
	 * Return an instance of this class.
	 *
	 * @since     0.8.1
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
			self::$instance->do_hooks();
		}

		return self::$instance;
	}

    /**
     * Register the routes for the objects of the controller.
     */
    public function register_routes() {
        $version = '1';
        $namespace = $this->plugin_slug . '/v' . $version;
        $endpoint = '/example/';

        register_rest_route( $namespace, $endpoint, array(
            array(
                'methods'               => \WP_REST_Server::READABLE,
                'callback'              => array( $this, 'get_example' ),
                'permission_callback'   => array( $this, 'example_permissions_check' ),
                'args'                  => array(),
            ),
        ) );

        register_rest_route( $namespace, $endpoint, array(
            array(
                'methods'               => \WP_REST_Server::CREATABLE,
                'callback'              => array( $this, 'update_example' ),
                'permission_callback'   => array( $this, 'example_permissions_check' ),
                'args'                  => array(),
            ),
        ) );

        register_rest_route( $namespace, $endpoint, array(
            array(
                'methods'               => \WP_REST_Server::EDITABLE,
                'callback'              => array( $this, 'update_example' ),
                'permission_callback'   => array( $this, 'example_permissions_check' ),
                'args'                  => array(),
            ),
        ) );

        register_rest_route( $namespace, $endpoint, array(
            array(
                'methods'               => \WP_REST_Server::DELETABLE,
                'callback'              => array( $this, 'delete_example' ),
                'permission_callback'   => array( $this, 'example_permissions_check' ),
                'args'                  => array(),
            ),
        ) );


	  //	$version2 = '1';
      //  $namespace2 = $this->plugin_slug . '/v' . $version2;
	  //  $endpoint2 = '/myslider/';
	  
	  

	  register_rest_route( $namespace, '/slider_meta/', array(
		array(
			'methods'               => \WP_REST_Server::CREATABLE,
			'callback'              => array( $this, 'get_slider_meta' ),
			'permission_callback'   => array( $this, 'example_permissions_check' ),
			'args'                  => array(),
		),
	  ));

	  register_rest_route( $namespace, '/slider_meta/', array(
		array(
			'methods'               => \WP_REST_Server::EDITABLE,
			'callback'              => array( $this, 'update_slider_meta' ),
			'permission_callback'   => array( $this, 'example_permissions_check' ),
			'args'                  => array(),
		),
	  ));



	  register_rest_route( $namespace, '/ex_place/', array(
		array(
			'methods'               => \WP_REST_Server::READABLE,
			'callback'              => array( $this, 'get_ex_place' ),
			'permission_callback'   => array( $this, 'example_permissions_check' ),
			'args'                  => array(),
		),
	  ));
	  register_rest_route( $namespace, '/ex_place/', array(
		array(
			'methods'               => \WP_REST_Server::CREATABLE,
			'callback'              => array( $this, 'add_ex_place' ),
			'permission_callback'   => array( $this, 'example_permissions_check' ),
			'args'                  => array(),
		),
	  ));
	  register_rest_route( $namespace, '/ex_place/', array(
		array(
			'methods'               => \WP_REST_Server::EDITABLE,
			'callback'              => array( $this, 'update_ex_place' ),
			'permission_callback'   => array( $this, 'example_permissions_check' ),
			'args'                  => array(),
		),
	  ));
	  register_rest_route( $namespace, '/ex_place/', array(
		array(
			'methods'               => \WP_REST_Server::DELETABLE,
			'callback'              => array( $this, 'del_ex_place' ),
			'permission_callback'   => array( $this, 'example_permissions_check' ),
			'args'                  => array(),
		),
	) );




	  register_rest_route( $namespace, '/ex1_method/', array(
		array(
			'methods'               => \WP_REST_Server::READABLE,
			'callback'              => array( $this, 'get_ex1_method' ),
			'permission_callback'   => array( $this, 'example_permissions_check' ),
			'args'                  => array(),
		),
	  ));
	  register_rest_route( $namespace, '/ex1_method/', array(
		array(
			'methods'               => \WP_REST_Server::CREATABLE,
			'callback'              => array( $this, 'add_ex1_method' ),
			'permission_callback'   => array( $this, 'example_permissions_check' ),
			'args'                  => array(),
		),
	  ));
	  register_rest_route( $namespace, '/ex1_method/', array(
		array(
			'methods'               => \WP_REST_Server::EDITABLE,
			'callback'              => array( $this, 'update_ex1_method' ),
			'permission_callback'   => array( $this, 'example_permissions_check' ),
			'args'                  => array(),
		),
	  ));	  
	  register_rest_route( $namespace, '/ex1_method/', array(
		array(
			'methods'               => \WP_REST_Server::DELETABLE,
			'callback'              => array( $this, 'del_ex1_method' ),
			'permission_callback'   => array( $this, 'example_permissions_check' ),
			'args'                  => array(),
		),
	) );





	  register_rest_route( $namespace, '/ex_type/', array(
		array(
			'methods'               => \WP_REST_Server::READABLE,
			'callback'              => array( $this, 'get_ex_type' ),
			'permission_callback'   => array( $this, 'example_permissions_check' ),
			'args'                  => array(),
		),
	  ));


	  register_rest_route( $namespace, '/ex_type/', array(
		array(
			'methods'               => \WP_REST_Server::CREATABLE,
			'callback'              => array( $this, 'add_ex_type' ),
			'permission_callback'   => array( $this, 'example_permissions_check' ),
			'args'                  => array(),
		),
	  ));

	  register_rest_route( $namespace, '/ex_type/', array(
		array(
			'methods'               => \WP_REST_Server::EDITABLE,
			'callback'              => array( $this, 'update_ex_type' ),
			'permission_callback'   => array( $this, 'example_permissions_check' ),
			'args'                  => array(),
		),
	  ));	  

	  register_rest_route( $namespace, '/ex_type/', array(
		array(
			'methods'               => \WP_REST_Server::DELETABLE,
			'callback'              => array( $this, 'del_ex_type' ),
			'permission_callback'   => array( $this, 'example_permissions_check' ),
			'args'                  => array(),
		),
	  ));




	  register_rest_route( $namespace, '/ex_type1/', array(
		array(
			'methods'               => \WP_REST_Server::READABLE,
			'callback'              => array( $this, 'get_ex_type1' ),
			'permission_callback'   => array( $this, 'example_permissions_check' ),
			'args'                  => array(),
		),
	  ));


	  register_rest_route( $namespace, '/ex_type1/', array(
		array(
			'methods'               => \WP_REST_Server::CREATABLE,
			'callback'              => array( $this, 'add_ex_type1' ),
			'permission_callback'   => array( $this, 'example_permissions_check' ),
			'args'                  => array(),
		),
	  ));

	  register_rest_route( $namespace, '/ex_type1/', array(
		array(
			'methods'               => \WP_REST_Server::EDITABLE,
			'callback'              => array( $this, 'update_ex_type1' ),
			'permission_callback'   => array( $this, 'example_permissions_check' ),
			'args'                  => array(),
		),
	  ));	  

	  register_rest_route( $namespace, '/ex_type1/', array(
		array(
			'methods'               => \WP_REST_Server::DELETABLE,
			'callback'              => array( $this, 'del_ex_type1' ),
			'permission_callback'   => array( $this, 'example_permissions_check' ),
			'args'                  => array(),
		),
	  ));







	  register_rest_route( $namespace, '/ex_status/', array(
		array(
			'methods'               => \WP_REST_Server::READABLE,
			'callback'              => array( $this, 'get_ex_status' ),
			'permission_callback'   => array( $this, 'example_permissions_check' ),
			'args'                  => array(),
		),
	  ));


	  register_rest_route( $namespace, '/ex_status/', array(
		array(
			'methods'               => \WP_REST_Server::CREATABLE,
			'callback'              => array( $this, 'add_ex_status' ),
			'permission_callback'   => array( $this, 'example_permissions_check' ),
			'args'                  => array(),
		),
	  ));


	  register_rest_route( $namespace, '/ex_status/', array(
		array(
			'methods'               => \WP_REST_Server::EDITABLE,
			'callback'              => array( $this, 'update_ex_status' ),
			'permission_callback'   => array( $this, 'example_permissions_check' ),
			'args'                  => array(),
		),
	  ));	  

	  register_rest_route( $namespace, '/ex_status/', array(
		array(
			'methods'               => \WP_REST_Server::DELETABLE,
			'callback'              => array( $this, 'del_ex_status' ),
			'permission_callback'   => array( $this, 'example_permissions_check' ),
			'args'                  => array(),
		),
	  ));











	  register_rest_route( $namespace, '/slideItemOrder/', array(
		array(
			'methods'               => \WP_REST_Server::EDITABLE,
			'callback'              => array( $this, 'slideItemOrder' ),
			'permission_callback'   => array( $this, 'example_permissions_check' ),
			'args'                  => array(),
		),
	 ) );




	  







		register_rest_route( $namespace, '/myslider/', array(
            array(
                'methods'               => \WP_REST_Server::READABLE,
                'callback'              => array( $this, 'get_all_slider' ),
                'permission_callback'   => array( $this, 'example_permissions_check' ),
                'args'                  => array(),
            ),
        ) );

				register_rest_route( $namespace, '/myslider/', array(
            array(
                'methods'               => \WP_REST_Server::CREATABLE,
                'callback'              => array( $this, 'add_slider_box' ),
                'permission_callback'   => array( $this, 'example_permissions_check' ),
                'args'                  => array(),
            ),
        ) );

				register_rest_route( $namespace, '/myslider/', array(
            array(
                'methods'               => \WP_REST_Server::DELETABLE,
                'callback'              => array( $this, 'del_slider_box' ),
                'permission_callback'   => array( $this, 'example_permissions_check' ),
                'args'                  => array(),
            ),
        ) );

				register_rest_route( $namespace, '/myslider/', array(
            array(
                'methods'               => \WP_REST_Server::EDITABLE,
                'callback'              => array( $this, 'edit_slider_box_name' ),
                'permission_callback'   => array( $this, 'example_permissions_check' ),
                'args'                  => array(),
            ),
        ) );




			/*  Slide CRUD  */

			
			register_rest_route( $namespace, '/cloneslide/', array(
				array(
					'methods'               => \WP_REST_Server::CREATABLE,
					'callback'              => array( $this, 'cloneslide_fun' ),
					'permission_callback'   => array( $this, 'example_permissions_check' ),
					'args'                  => array(),
				),
			) );

			register_rest_route( $namespace, '/myslide/', array(
				array(
					'methods'               => \WP_REST_Server::CREATABLE,
					'callback'              => array( $this, 'add_slide' ),
					'permission_callback'   => array( $this, 'example_permissions_check' ),
					'args'                  => array(),
				),
			) );

			register_rest_route( $namespace, '/myslide/', array(
				array(
					'methods'               => \WP_REST_Server::DELETABLE,
					'callback'              => array( $this, 'del_slide' ),
					'permission_callback'   => array( $this, 'example_permissions_check' ),
					'args'                  => array(),
				),
			));

				register_rest_route( $namespace, '/myslide/', array(
						array(
								'methods'               => \WP_REST_Server::EDITABLE,
								'callback'              => array( $this, 'edit_slide' ),
								'permission_callback'   => array( $this, 'example_permissions_check' ),
								'args'                  => array(),
						),
				) );

				register_rest_route( $namespace, '/myslide_oid/', array(
						array(
								'methods'               => \WP_REST_Server::EDITABLE,
								'callback'              => array( $this, 'edit_slide_oid' ),
								'permission_callback'   => array( $this, 'example_permissions_check' ),
								'args'                  => array(),
						),
				) );

			

				



				
			
				register_rest_route( $namespace, '/location1/', array(
					array(
							'methods'               => \WP_REST_Server::READABLE,
							'callback'              => array( $this, 'read_location1_post' ),
							'permission_callback'   => array( $this, 'example_permissions_check' ),
							'args'                  => array(),
					),
				) );

				register_rest_route( $namespace, '/location1/', array(
					array(
							'methods'               => \WP_REST_Server::EDITABLE,
							'callback'              => array( $this, 'read_location1_update' ),
							'permission_callback'   => array( $this, 'example_permissions_check' ),
							'args'                  => array(),
					),
				) );

				register_rest_route( $namespace, '/location2/', array(
					array(
							'methods'               => \WP_REST_Server::READABLE,
							'callback'              => array( $this, 'read_location2_post' ),
							'permission_callback'   => array( $this, 'example_permissions_check' ),
							'args'                  => array(),
					),
				) );

				register_rest_route( $namespace, '/location2/', array(
					array(
							'methods'               => \WP_REST_Server::EDITABLE,
							'callback'              => array( $this, 'read_location2_update' ),
							'permission_callback'   => array( $this, 'example_permissions_check' ),
							'args'                  => array(),
					),
				) );
				
				register_rest_route( $namespace, '/location3/', array(
					array(
							'methods'               => \WP_REST_Server::READABLE,
							'callback'              => array( $this, 'read_location3_post' ),
							'permission_callback'   => array( $this, 'example_permissions_check' ),
							'args'                  => array(),
					),
				) );

				register_rest_route( $namespace, '/location3/', array(
					array(
							'methods'               => \WP_REST_Server::EDITABLE,
							'callback'              => array( $this, 'read_location3_update' ),
							'permission_callback'   => array( $this, 'example_permissions_check' ),
							'args'                  => array(),
					),
				) );		
				
				
				register_rest_route( $namespace, '/location3/', array(
					array(
							'methods'               => \WP_REST_Server::EDITABLE,
							'callback'              => array( $this, 'read_location3_update' ),
							'permission_callback'   => array( $this, 'example_permissions_check' ),
							'args'                  => array(),
					),
				) );	


				register_rest_route( $namespace, '/tabletitle/', array(
					array(
							'methods'               => \WP_REST_Server::CREATABLE,
							'callback'              => array( $this, 'table_title_update' ),
							'permission_callback'   => array( $this, 'example_permissions_check' ),
							'args'                  => array(),
					),
				) );	
			


				

				
	}
	




	/* ========================== RESTFUL FUNCTIOM ===================== */

	public function get_slider_meta($req){
		global $wpdb;

		$custom_db_name = $wpdb->prefix . 'SliderTool';

		$tb  = $req->get_param('tb');
		$sql = "SELECT * FROM ".$custom_db_name." WHERE id=".$tb;
		$mylink = $wpdb->get_results($sql);

		return new \WP_REST_Response( array(
			'success' => true,
			'value' => $mylink 
		), 200 );	
	}



	public function update_slider_meta($req){

		global $wpdb;
		$tb  = $req->get_param('tb');
		$name = $req->get_param('name');
		$column  = $req->get_param('column');
		$custom_db_name = $wpdb->prefix . 'SliderTool';

		$data = '';
		switch($column){
			case 'text_404':
				$data = array('text_404'=>$name);
			break;

			case 'btn_text1':
				$data = array('btn_text1'=>$name);
			break;

			case 'btn_text2':
				$data = array('btn_text2'=>$name);
			break;
		}
		

		$result = $wpdb->update(
			$custom_db_name,
					$data,
					array( 'id' => $tb)
				);


		
		return new \WP_REST_Response( array(
			'success' => true,
			'value' => $result
		), 200 );	
	}





	
	public function table_title_update($req){


		global $wpdb;		
		$custom_db_name = $wpdb->prefix . 'SliderTool';

		$tb1 = $allpost = $req->get_param('tb1');
		$tb2 = $allpost = $req->get_param('tb2');
		$tb3 = $allpost = $req->get_param('tb3');
		$tb4 = $allpost = $req->get_param('tb4');
		$tb5 = $allpost = $req->get_param('tb5');
		$tb6 = $allpost = $req->get_param('tb6');
		$kid = $allpost = $req->get_param('kid');

		$wpdb->update(
			$custom_db_name,
					array(
						'tb1'=> $tb1,    
						'tb2'=> $tb2,          
						'tb3'=> $tb3,   
						'tb4'=> $tb4,   
						'tb5'=> $tb5,
						'tb6'=> $tb6      
					),
					array( 'id' => $kid)
				);


		
		return new \WP_REST_Response( array(
			'success' => true,
			'value' =>''
		), 200 );
	}



	public function read_location1_post($req){
		$out  = array();		
	
		$posts = get_posts([
			'post_type' => 'location1',
			'post_status' => 'publish',
			'numberposts' => -1
			// 'order'    => 'ASC'
		  ]);
	
		  global $wpdb;
		  $custom_db_name = $wpdb->prefix . 'location_meta';

		foreach($posts as $post){
			
			$term = get_the_terms($post->ID,'region');
			
			$sql = "SELECT * FROM ".$custom_db_name." WHERE post=".$post->ID;
			$mylink = $wpdb->get_results($sql);
			if (count($mylink )>0){
				$post->oid = $mylink[0]->order;
				$post->termid = $term[0]->term_id;
				$post->term_name = $term[0]->name;
			}
			
		}  



		 
		 // update_post_meta( 21368, '_location_order_key', 1 );

		return new \WP_REST_Response( array(
			'success' => true,
			'value' =>$posts
		), 200 );
	}





	public function read_location1_update($req){
		
		global $wpdb;

		$allpost = $req->get_param('allpost');
		$custom_db_name = $wpdb->prefix . 'location_meta';


		foreach($allpost as $post){
			// update_post_meta( $post->ID, '_mylocation_order_key',$post->oid);
			
			
			$sql = "SELECT * FROM ".$custom_db_name." WHERE post=".$post['ID'];
	
			$mylink = $wpdb->get_results($sql);
			if (count($mylink )>0){
				$wpdb->update(
					$custom_db_name,
					array(
						'order'=> $post['oid'],                   
					),
					array( 'post' => $post['ID'] )
				);
			}else{
				$wpdb->insert(
					$custom_db_name,
					array(
						'post' => $post['ID'],
					  'order' => $post['oid'],      
					)
				);
			}	

		}

		return new \WP_REST_Response( array(
			'success' => true,
			'value' => $allpost
		), 200 );
	}



	public function read_location2_post($req){
		$out  = array();
		
	
		$posts = get_posts([
			'post_type' => 'location2',
			'post_status' => 'publish',
			'numberposts' => -1
			// 'order'    => 'ASC'
		  ]);
	
		  global $wpdb;
		  $custom_db_name = $wpdb->prefix . 'location_meta';
		foreach($posts as $post){
						
			$term2 = get_the_terms($post->ID,'region2');
			
			$sql = "SELECT * FROM ".$custom_db_name." WHERE post=".$post->ID;
			$mylink = $wpdb->get_results($sql);
			if (count($mylink )>0){
				$post->oid = $mylink[0]->order;
				$post->termid = $term2[0]->term_id;
				$post->term_name = $term2[0]->name;
			}
			
		}  



		 
		 // update_post_meta( 21368, '_location_order_key', 1 );

		return new \WP_REST_Response( array(
			'success' => true,
			'value' =>$posts
		), 200 );
	}





	public function read_location2_update($req){
		
		global $wpdb;

		$allpost = $req->get_param('allpost');
		$custom_db_name = $wpdb->prefix . 'location_meta';


		foreach($allpost as $post){
			// update_post_meta( $post->ID, '_mylocation_order_key',$post->oid);
			
			
			$sql = "SELECT * FROM ".$custom_db_name." WHERE post=".$post['ID'];
	
			$mylink = $wpdb->get_results($sql);
			if (count($mylink )>0){
				$wpdb->update(
					$custom_db_name,
					array(
						'order'=> $post['oid'],                   
					),
					array( 'post' => $post['ID'] )
				);
			}else{
				$wpdb->insert(
					$custom_db_name,
					array(
						'post' => $post['ID'],
					  'order' => $post['oid'],      
					)
				);
			}	

		}

		return new \WP_REST_Response( array(
			'success' => true,
			'value' => $allpost
		), 200 );
	}






	public function read_location3_post($req){
		$out  = array();
		
	
		$posts = get_posts([
			'post_type' => 'location3',
			'post_status' => 'publish',
			'numberposts' => -1
			// 'order'    => 'ASC'
		  ]);
	
		  global $wpdb;
		  $custom_db_name = $wpdb->prefix . 'location_meta';
		foreach($posts as $post){
						
			$term3 = get_the_terms($post->ID,'region3');
			
			$sql = "SELECT * FROM ".$custom_db_name." WHERE post=".$post->ID;
			$mylink = $wpdb->get_results($sql);
			if (count($mylink )>0){
				$post->oid = $mylink[0]->order;
				$post->termid = $term3[0]->term_id;
				$post->term_name = $term3[0]->name;
			}
			
		}  



		 
		 // update_post_meta( 21368, '_location_order_key', 1 );

		return new \WP_REST_Response( array(
			'success' => true,
			'value' =>$posts
		), 200 );
	}





	public function read_location3_update($req){
		
		global $wpdb;

		$allpost = $req->get_param('allpost');
		$custom_db_name = $wpdb->prefix . 'location_meta';


		foreach($allpost as $post){
			// update_post_meta( $post->ID, '_mylocation_order_key',$post->oid);
			
			
			$sql = "SELECT * FROM ".$custom_db_name." WHERE post=".$post['ID'];
	
			$mylink = $wpdb->get_results($sql);
			if (count($mylink )>0){
				$wpdb->update(
					$custom_db_name,
					array(
						'order'=> $post['oid'],     
						              
					),
					array( 'post' => $post['ID'] )
				);
			}else{
				$wpdb->insert(
					$custom_db_name,
					array(
						'post' => $post['ID'],
					  'order' => $post['oid'],      
					)
				);
			}	

		}

		return new \WP_REST_Response( array(
			'success' => true,
			'value' => $allpost
		), 200 );
	}
	









	public function slideItemOrder($req){

		global $wpdb;

		$slider= $req->get_param('slider');
	

		$my_table = $wpdb->prefix."SliderTool_slide";

		foreach($slider['xslide'] as $it){
			print_r($it);
			$result1 = $wpdb->update(
				$my_table,
				array(
					'oid' => 	$it['oid'],				
				),
				array( 
						'id' => 	$it['id'],						
					)
			);
		}
		
		return new \WP_REST_Response( array(
			'success' => true,
			'value' =>  $result1
	), 200 );
	}









	/*  =============================   考試類型 data_type=0 / 考試組別  data_type=1  =============================  */

		public function get_ex_type($req){
			global $wpdb;
			$my_table = $wpdb->prefix."aloha_exam_type";
			$sql = "SELECT * FROM ".$my_table." order by id";
			$results = $wpdb->get_results($sql);

			// json_encode($results)

			return new \WP_REST_Response( array(
					'success' => true,
					'value' =>  $results
			), 200 );
		}



		public function add_ex_type($req){

			global $wpdb;
			$my_table = $wpdb->prefix."aloha_exam_type";


				$data = array(
					'tname' => $req->get_param('name'),					
					'tb' => $req->get_param('tb')
				);



		
			$results = $wpdb->insert($my_table,$data);

			return new \WP_REST_Response( array(
					'success' => true,
					'value' =>  $results
			), 200 );
		}

		public function update_ex_type($req){			
			global $wpdb;
			$my_table = $wpdb->prefix."aloha_exam_type";

			
				$data = array(
					'tname' => $req->get_param('name'),								
				);


			$where  = array(
				'id' => $req->get_param('id'),								
			);
			$results = $wpdb->update($my_table, $data,$where );
					

			return new \WP_REST_Response( array(
					'success' => true,
					'value' =>  $results
			), 200 );
		}	



		public function del_ex_type($req){
			global $wpdb;
			$my_table = $wpdb->prefix."aloha_exam_type";

			$data = array(
				'id' => $req->get_param('id'),								
			);
			$results = $wpdb->delete( $my_table, $data);

			return new \WP_REST_Response( array(
				'success' => true,
				'value' =>  $results
			), 200 );
		}




		/*  =============================   / 考試組別   =============================  */



		public function get_ex_type1($req){
			global $wpdb;
			$my_table = $wpdb->prefix."aloha_exam_type1";
			$sql = "SELECT * FROM ".$my_table." order by id";
			$results = $wpdb->get_results($sql);

			// json_encode($results)

			return new \WP_REST_Response( array(
					'success' => true,
					'value' =>  $results
			), 200 );
		}



		public function add_ex_type1($req){

			global $wpdb;
			$my_table = $wpdb->prefix."aloha_exam_type1";

			$data = array(
				't1name' => $req->get_param('name'),					
				'tb' => $req->get_param('tb')
			);

		
			$results = $wpdb->insert($my_table,$data);

			return new \WP_REST_Response( array(
					'success' => true,
					'value' =>  $results
			), 200 );
		}

		public function update_ex_type1($req){			
			global $wpdb;
			$my_table = $wpdb->prefix."aloha_exam_type1";


				$data = array(
					't1name' => $req->get_param('name'),								
				);


			$where  = array(
				'id' => $req->get_param('id'),								
			);
			$results = $wpdb->update($my_table, $data,$where );
					

			return new \WP_REST_Response( array(
					'success' => true,
					'value' =>  $results
			), 200 );
		}	



		public function del_ex_type1($req){
			global $wpdb;
			$my_table = $wpdb->prefix."aloha_exam_type1";

			$data = array(
				'id' => $req->get_param('id'),								
			);
			$results = $wpdb->delete( $my_table, $data);

			return new \WP_REST_Response( array(
				'success' => true,
				'value' =>  $results
			), 200 );
		}





	/*  =============================   聽力測驗形式  =============================  */	

		/*   考試地點  */
		public function get_ex_place($req){

			global $wpdb;
			$my_table = $wpdb->prefix."aloha_exam_place";
			$sql = "SELECT * FROM ".$my_table." order by id";
			$results = $wpdb->get_results($sql);

			// json_encode($results)

			return new \WP_REST_Response( array(
					'success' => true,
					'value' =>  $results
			), 200 );
		}

		public function add_ex_place($req){
			
			global $wpdb;
			$my_table = $wpdb->prefix."aloha_exam_place";

			$data = array(
				'pname' => $req->get_param('name'),				
				'tb' => $req->get_param('tb')
			);

		
			$results = $wpdb->insert($my_table,$data);

			return new \WP_REST_Response( array(
					'success' => true,
					'value' =>  $results
			), 200 );
		}	


		public function update_ex_place($req){
			
			global $wpdb;
			$my_table = $wpdb->prefix."aloha_exam_place";

			$data = array(
				'pname' => $req->get_param('name'),								
			);

			$where  = array(
				'id' => $req->get_param('id'),								
			);
			$results = $wpdb->update($my_table, $data,$where );
					

			return new \WP_REST_Response( array(
					'success' => true,
					'value' =>  $results
			), 200 );
		}	


		
		public function del_ex_place($req){
			global $wpdb;
			$my_table = $wpdb->prefix."aloha_exam_place";

			$data = array(
				'id' => $req->get_param('id'),								
			);
			$results = $wpdb->delete($my_table, $data);

			return new \WP_REST_Response( array(
				'success' => true,
				'value' =>  $results
			), 200 );
		}			








		/*   聽力測驗的方式  */
		public function get_ex1_method($req){

			global $wpdb;
			$my_table = $wpdb->prefix."aloha_exam_method";
			$sql = "SELECT * FROM ".$my_table." order by id";
			$results = $wpdb->get_results($sql);

			// json_encode($results)

			return new \WP_REST_Response( array(
					'success' => true,
					'value' =>  $results
			), 200 );
		}



		public function add_ex1_method($req){
			
			global $wpdb;
			$my_table = $wpdb->prefix."aloha_exam_method";

			$data = array(
				'mname' => $req->get_param('name'),				
				'tb' => $req->get_param('tb')
			);

		
			$results = $wpdb->insert($my_table,$data);

			return new \WP_REST_Response( array(
					'success' => true,
					'value' =>  $results
			), 200 );
		}	

		public function update_ex1_method($req){
			
			global $wpdb;
			$my_table = $wpdb->prefix."aloha_exam_method";

			$data = array(
				'mname' => $req->get_param('name'),								
			);

			$where  = array(
				'id' => $req->get_param('id'),								
			);
			$results = $wpdb->update($my_table, $data,$where );
					

			return new \WP_REST_Response( array(
					'success' => true,
					'value' =>  $results
			), 200 );
		}			

		public function del_ex1_method($req){
			global $wpdb;
			$my_table = $wpdb->prefix."aloha_exam_method";

			$data = array(
				'id' => $req->get_param('id'),								
			);
			$results = $wpdb->delete($my_table, $data);

			return new \WP_REST_Response( array(
				'success' => true,
				'value' =>  $results
			), 200 );
		}	

		

	/*  =============================   考試狀態  =============================  */	
		
		public function get_ex_status(){
			global $wpdb;
			$my_table = $wpdb->prefix."aloha_exam_status";
			$sql = "SELECT * FROM ".$my_table." order by id";
			$results = $wpdb->get_results($sql);

			// json_encode($results)

			return new \WP_REST_Response( array(
					'success' => true,
					'value' =>  $results
			), 200 );
		}


		public function add_ex_status($req){
			global $wpdb;
			$my_table = $wpdb->prefix."aloha_exam_status";

			$data = array(
				'sname' => $req->get_param('name'),				
				'tb' => $req->get_param('tb')
			);

		
			$results = $wpdb->insert($my_table,$data);

			return new \WP_REST_Response( array(
				'success' => true,
				'value' =>  $results
			), 200 );
		}

		public function update_ex_status($req){
			
			global $wpdb;
			$my_table = $wpdb->prefix."aloha_exam_status";

			$data = array(
				'sname' => $req->get_param('name'),								
			);

			$where  = array(
				'id' => $req->get_param('id'),								
			);
			$results = $wpdb->update($my_table, $data,$where );
					

			return new \WP_REST_Response( array(
					'success' => true,
					'value' =>  $results
			), 200 );
		}			


		public function del_ex_status($req){
			
			global $wpdb;
			$my_table = $wpdb->prefix."aloha_exam_status";

			$data = array(
				'id' => $req->get_param('id'),								
			);
			$results = $wpdb->delete( $my_table, $data);

			return new \WP_REST_Response( array(
				'success' => true,
				'value' =>  $req->get_param('id')
			), 200 );
					
		}




		public function cloneslide_fun($req){
			$slide = $req->get_param('slide');
			$slider = $req->get_param('slider');
			

			global $wpdb;
			
			$my_table2 = $wpdb->prefix."SliderTool_slide";
			$sql2 = "SELECT * FROM ".$my_table2." WHERE  slider=".$slider .' AND id='.$slide;
			$results2 = $wpdb->get_results($sql2);
			
			
			$del_value = 'id';
			$idata = array();
			foreach ($results2[0] as $key => $value) { 
				if ($key != $del_value) {
					$idata[$key] = $value;
				}				
			}
			
			/*
			$my_table = $wpdb->prefix."SliderTool_slide";

			$data = array(				
				'slider'=> $req->get_param('slider'),
				'oid'=>999
			);
			$format = array('%s');
			*/

			 $result = $wpdb->insert($my_table2,$idata);


			 $my_table = $wpdb->prefix."SliderTool";
			 $sql = "SELECT * FROM ".$my_table." order by id";
			 $results = $wpdb->get_results($sql);
 
 
			 foreach($results as $item){
					 $my_table = $wpdb->prefix."SliderTool_slide";
					 $sql = "SELECT * FROM ".$my_table." WHERE  slider=".$item->id;
					 $results_slide = $wpdb->get_results($sql);
					 $item->xslide = $results_slide;
			 }



			return new \WP_REST_Response( array(
				'success' => $result,
				'value' => $results
			), 200 );
		}











		public function edit_slide($req){

			global $wpdb;
			$my_table = $wpdb->prefix."SliderTool_slide";

			$slide = $req->get_param('slider');

			$result = $wpdb->update(
				$my_table,
				array(
					// 'title' => $slide['title'],
					// 'url' => $slide['url'],
					// 'descx' => $slide['descx'],	
					'ex1_location' => $slide['ex1_location'],
					'ex1_date' => $slide['ex1_date'],
					'ex1_time' => $slide['ex1_time'],
					'ex1_img' => $slide['ex1_img'],
					'ex1_method'=> $slide['ex1_method'],

					'ex2_location' => $slide['ex2_location'],
					 'ex2_date' => $slide['ex2_date'],
					'ex2_time' => $slide['ex2_time'],
					'ex2_img' => $slide['ex2_img'],
					'ex2_method'=> $slide['ex2_method'],	
					
					'ex_type1' => $slide['ex_type1'],
					'ex_type2' => $slide['ex_type2'],
				

					'ex_result_date' => $slide['ex_result_date'],
					'ex_status' => $slide['ex_status'],
					'ex_city' => $slide['ex_city'],	
					'url' => $slide['ex_link'],					
				),
				array( 'id' => 	$slide['id'] )
			);

			return new \WP_REST_Response( array(
					'success' => $result,
					'value' =>  $slide
			), 200 );
		}



		public function del_slide($req){

			global $wpdb;
			$my_table = $wpdb->prefix."SliderTool_slide";
			$wpdb->delete( $my_table, array( 'id' => $req->get_param('slide') ));



			$my_table2 = $wpdb->prefix."SliderTool_slide";
			$sql2 = "SELECT * FROM ".$my_table2." WHERE  slider=".$req->get_param('slider');
			$results2 = $wpdb->get_results($sql2);
			$i=1;
			/*
			foreach($results2 as $item){
				$wpdb->update(
					$my_table,
					array('oid' => $i),
				  array('id' => $item->id)
				);
				$i = $i+1;
			}
			*/


			$my_table = $wpdb->prefix."SliderTool";
			$sql = "SELECT * FROM ".$my_table." order by id";
			$results = $wpdb->get_results($sql);

			foreach($results as $item){
					$my_table = $wpdb->prefix."SliderTool_slide";
					$sql = "SELECT * FROM ".$my_table." WHERE  slider=".$item->id;
					$results_slide = $wpdb->get_results($sql);
					$item->xslide = $results_slide;
			}


			return new \WP_REST_Response( array(
					'success' => true,
					'value' =>  $results
			), 200 );
		}





		public function edit_slider_box_name($req){
			global $wpdb;
			$my_table = $wpdb->prefix."SliderTool";

			$wpdb->update(
				$my_table,
				array(
					'name' => $req->get_param('name'),	// string
				),
				array( 'id' => $req->get_param('sboxid') )
			);


			$my_table = $wpdb->prefix."SliderTool";
			$sql = "SELECT * FROM ".$my_table." order by id";
			$results = $wpdb->get_results($sql);


			foreach($results as $item){
					$my_table = $wpdb->prefix."SliderTool_slide";
					$sql = "SELECT * FROM ".$my_table." WHERE  slider=".$item->id;
					$results_slide = $wpdb->get_results($sql);
					$item->xslide = $results_slide;
			}



			return new \WP_REST_Response( array(
					'success' => true,
					'value' =>  $results
			), 200 );
		}



		public function add_slide($req){
			global $wpdb;
			$my_table = $wpdb->prefix."SliderTool_slide";

			$data = array(				
				'slider'=> $req->get_param('slider'),
				'oid'=>999
			);
			$format = array('%s');
			$wpdb->insert($my_table,$data,$format);



			$my_table2 = $wpdb->prefix."SliderTool_slide";
			$sql2 = "SELECT * FROM ".$my_table2." WHERE  slider=".$req->get_param('slider');
			$results2 = $wpdb->get_results($sql2);
			$i=1;
			/*
			foreach($results2 as $item){
				$wpdb->update(
					$my_table,
					array('oid' => $i),
				  array('id' => $item->id)
				);
				$i = $i+1;
			}
			*/



			$my_table = $wpdb->prefix."SliderTool";
			$sql = "SELECT * FROM ".$my_table." order by id";
			$results = $wpdb->get_results($sql);


			foreach($results as $item){
					$my_table = $wpdb->prefix."SliderTool_slide";
					$sql = "SELECT * FROM ".$my_table." WHERE  slider=".$item->id;
					$results_slide = $wpdb->get_results($sql);
					$item->xslide = $results_slide;
			}


			return new \WP_REST_Response( array(
					'success' => true,
					'value' =>  $results
			), 200 );
		}



		public function del_slider_box($req){

			global $wpdb;
			$my_table = $wpdb->prefix."SliderTool";
			$wpdb->delete( $my_table, array( 'id' => $req->get_param('datakey') ));

			$slide_table = $wpdb->prefix."SliderTool_slide";
			$sql = "DELETE FROM ".$slide_table." WHERE slider=".$req->get_param('datakey');
			$wpdb->get_results( $sql );



			$sql = "SELECT * FROM ".$my_table." order by id";
			$results = $wpdb->get_results($sql);

			foreach($results as $item){
					$my_table = $wpdb->prefix."SliderTool_slide";
					$sql = "SELECT * FROM ".$my_table." WHERE  slider=".$item->id;
					$results_slide = $wpdb->get_results($sql);

					$item->xslide = $results_slide;
			}

			return new \WP_REST_Response( array(
					'success' => true,
					'value' =>  $results
			), 200 );
		}




		public function get_all_slider($req){

			global $wpdb;
			$my_table = $wpdb->prefix."SliderTool";
			$sql = "SELECT * FROM ".$my_table." order by id";
			$results = $wpdb->get_results($sql);

			foreach($results as $item){
					$my_table = $wpdb->prefix."SliderTool_slide";
					$sql = "SELECT * FROM ".$my_table." WHERE  slider=".$item->id;
					$results_slide = $wpdb->get_results($sql);

					$item->xslide  =$results_slide ;
			}
			// json_encode($results)

			return new \WP_REST_Response( array(
					'success' => true,
					'value' =>  $results
			), 200 );
		}


		public function add_slider_box($req){

			global $wpdb;
			$my_table = $wpdb->prefix."SliderTool";

			$data = array('name' => $req->get_param('name'));
			$format = array('%s');
			$wpdb->insert($my_table,$data,$format);

			$sql = "SELECT * FROM ".$my_table." order by id";
			$results = $wpdb->get_results($sql);


			foreach($results as $item){
					$my_table = $wpdb->prefix."SliderTool_slide";
					$sql = "SELECT * FROM ".$my_table." WHERE  slider=".$item->id;
					$results_slide = $wpdb->get_results($sql);
					$item->xslide = $results_slide;
			}
			

			return new \WP_REST_Response( array(
					'success' => true,
					'value' =>  $results
			), 200 );
		}







	/*
    public function get_example( $request ) {
        $example_option = get_option( 'wpr_example_setting' );

        // Don't return false if there is no option
        if ( ! $example_option ) {
            return new \WP_REST_Response( array(
                'success' => true,
                'value' => ''
            ), 200 );
        }

        return new \WP_REST_Response( array(
            'success' => true,
            'value' => $example_option
        ), 200 );
    }

   
    public function update_example( $request ) {
        $updated = update_option( 'wpr_example_setting', $request->get_param( 'exampleSetting' ) );

        return new \WP_REST_Response( array(
            'success'   => $updated,
            'value'     => $request->get_param( 'exampleSetting' )
        ), 200 );
    }


    public function delete_example( $request ) {
        $deleted = delete_option( 'wpr_example_setting' );

        return new \WP_REST_Response( array(
            'success'   => $deleted,
            'value'     => ''
        ), 200 );
	}
	*/


    /**
     * Check if a given request has access to update a setting
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|bool
     */
    public function example_permissions_check( $request ) {
        return current_user_can( 'manage_options' );
    }
}
