<?php
if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class CnCustomFormTable extends WP_List_Table {
  
       function __construct(){
          global $status, $page;

              parent::__construct( array(
                  'singular'  => __( 'form', 'mylisttable' ),     //singular name of the listed records
                  'plural'    => __( 'forms', 'mylisttable' ),   //plural name of the listed records
                  'ajax'      => false        //does this table support ajax?

          ) );

          add_action( 'admin_head', array( &$this, 'admin_header' ) );     

          
            /*echo '<pre>';
            print_r($example_data);
            echo '</pre>';*/
       }

    function admin_header() {
        $page = ( isset($_GET['page'] ) ) ? esc_attr( $_GET['page'] ) : false;
        if( 'my_list_test' != $page )
        return;
        echo '<style type="text/css">';
        // echo '.wp-list-table .column-id { width: 15%; }';
        echo '.wp-list-table .column-eventtitle { width: 15%; }';
        echo '.wp-list-table .column-personname { width: 15%; }';
        echo '.wp-list-table .column-emailid { width: 15%;}';
        echo '.wp-list-table .column-phoneno { width: 15%; }';
        echo '.wp-list-table .column-totalticket { width: 15%;}';
        echo '.wp-list-table .column-reservationid { width: 15%; }';
        echo '</style>';
    }

    function no_items() {
        _e( 'No log founds' );
    }

    function column_default( $item, $column_name ) {
      switch( $column_name ) { 
          // case 'id':
          case 'eventtitle':
          case 'personname':
          case 'emailid':
          case 'phoneno':
          case 'totalticket':
          case 'reservationid':
          case 'reservationdateandtime':
              return $item[ $column_name ];
          default:
              return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
      }
    }

    function get_sortable_columns() {
      $sortable_columns = array(
        // 'id'             => array('id',false),
        'eventtitle'     => array('eventtitle',false),
        'personname'     => array('personname',false),
        'emailid'        => array('emailid',false),
        'phoneno'        => array('phoneno',false),
        'totalticket'    => array('totalticket',false),
        'reservationid'  => array('reservationid',false),
        'reservationdateandtime'  => array('reservationdateandtime',false)

      );
      return $sortable_columns;
    }

    function get_columns(){
      $columns = array(
          // 'cb'            => '<input type="checkbox" />',
          // 'id'    => __( 'Sr No.', 'mylisttable' ),
          'eventtitle'    => __( 'Event Title', 'mylisttable' ),
          'personname'    => __( 'Person Name', 'mylisttable' ),
          'emailid'       => __( 'Email-id', 'mylisttable' ),
          'phoneno'       => __( 'Phone No', 'mylisttable' ),
          'totalticket'   => __( 'Total Ticket', 'mylisttable' ),
          'reservationid' => __( 'Reservation Id', 'mylisttable' ),
          'reservationdateandtime' => __( 'Reservation Date & Time', 'mylisttable' )
      );
       return $columns;
    }

    function usort_reorder( $a, $b ) {
        // If no sort, default to title
        $orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'eventtitle';
        // If no order, default to asc
        $order = ( ! empty($_GET['order'] ) ) ? $_GET['order'] : 'desc';
        // Determine sort order
        $result = strcmp( $a[$orderby], $b[$orderby] );
        // Send final sort direction to usort
        return ( $order === 'desc' ) ? $result : -$result;
    }
    function column_eventtitle($item){
        $actions = array(
                  'view'      => sprintf('<a href="?post_type=events_booking&page=reservationlist&action=view&eventid='.$item['id'].'">View</a>',$_REQUEST['page'],'edit',$item['ID']),
                  'delete'      => sprintf('<a href="?post_type=events_booking&page=reservationlist&action=delete&reserve_ID='.$item['reservationid'].'&eventid='.$item['id'].'">Delete</a>',$_REQUEST['page'],'edit',$item['ID']),
                 // 'delete'    => sprintf('<a href="?page=%s&action=delete&formid='.$item['id'].'">Delete</a>',$_REQUEST['page'],'delete',$item['ID']),
              );

        return sprintf('%1$s %2$s', $item['eventtitle'], $this->row_actions($actions) );
    }
    function column_cb($item) {
          return sprintf(
              '<input type="checkbox" name="form[]" value="%s" />', $item['id']
          );    
    }

    function prepare_items($evntid='' , $search_res='' ) {
        global $wpdb, $example_data;

         
          $records = $wpdb->get_results("SELECT * FROM wp_ticketreservation ORDER BY id DESC");

           
      /* If the value is not NULL, do a search for it. */
      if( $search_res != NULL ){
                        
              /* Notice how you can search multiple columns for your search term easily, and return one data set */
  $records = $wpdb->get_results("SELECT * FROM wp_ticketreservation WHERE `ticketregno` LIKE '%".$search_res."%'" );
       
      }
            if(count($records)>0){
                foreach ($records as $Form) {
                  $reservationdetails = unserialize($Form->reservationinfo);
                  if($evntid!=''){
                    if($reservationdetails['eventid']==$evntid){
                      $arr['id']            = $Form->id;
                      $arr['eventtitle']    = $reservationdetails['eventtitle'];
                      $arr['personname']    = $reservationdetails['firstname'].' '.$reservationdetails['lastname'];
                      $arr['emailid']       = $reservationdetails['email'];
                      $arr['phoneno']       = $reservationdetails['phone'];
                      $arr['totalticket']   = $reservationdetails['total-ticket_no_text'];
                      $arr['reservationid'] = $Form->ticketregno;
                      $arr['reservationdateandtime'] = $Form->reservationtime;
                      $example_data[] = $arr;
                    }
                  }
                  else{
                    $arr['id']            = $Form->id;
                    $arr['eventtitle']    = $reservationdetails['eventtitle'];
                    $arr['personname']    = $reservationdetails['firstname'].' '.$reservationdetails['lastname'];
                    $arr['emailid']       = $reservationdetails['email'];
                    $arr['phoneno']       = $reservationdetails['phone'];
                    $arr['totalticket']   = $reservationdetails['total-ticket_no_text'];
                    $arr['reservationid'] = $Form->ticketregno;
                    $arr['reservationdateandtime'] = $Form->reservationtime;
                    $example_data[] = $arr;
                  }
              }       
           }
        
        $columns  = $this->get_columns();
        $hidden   = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array( $columns, $hidden, $sortable );
        //usort( $example_data, array( &$this, 'usort_reorder' ) );

        $per_page = 10;
        $current_page = $this->get_pagenum();
        $total_items = count( $example_data );

        // only ncessary because we have sample data
        $this->found_data = array_slice( $example_data,( ( $current_page-1 )* $per_page ), $per_page );

        $this->set_pagination_args( array(
          'total_items' => $total_items,                  //WE have to calculate the total number of items
          'per_page'    => $per_page                     //WE have to determine how many items to show on a page
        ) );
        $this->items = $this->found_data;
    }



}

