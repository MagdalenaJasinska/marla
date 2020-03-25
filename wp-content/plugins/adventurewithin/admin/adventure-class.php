<?php 
/**
 * In this part you are going to define custom table list class,
 * that will display your database records in nice looking table
 *
 * http://codex.wordpress.org/Class_Reference/WP_List_Table
 * http://wordpress.org/extend/plugins/custom-list-table-example/
 */


if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

/**
 * Custom_Table_Example_List_Table class that will display our custom table
 * records in nice table
 */

class AdventureList extends WP_List_Table
{
    public $notify='';
    public $messclass = '';
    public $user_prefix=1000;

    /**
     * [REQUIRED] You must declare constructor and give some basic params
     */

    function __construct()
    {
        global $status, $page;
        parent::__construct(array(
            'singular' => 'id',
            'plural' => 'ids',
            'ajax'   => false
        ));

    }


    /**
     * [REQUIRED] this is a default column renderer
     *
     * @param $item - row (key, value array)
     * @param $column_name - string (key)
     * @return HTML
     */

    function column_default($item, $column_name)
    {
        switch( $column_name ) {
            case 'id':
            case 'up_name':
            case 'up_email':
            case 'up_date_of_birth':
            case 'hm_phone':
            case 'up_signature':
                return $item->$column_name;
            default:
                return print_r( $item, true ) ;

        }
    }


    /**
     * [OPTIONAL] this is example, how to render column with actions,
     * when you hover row "Edit | Delete" links showed
     *
     * @param $item - row (key, value array)
     * @return HTML
     */

    function column_up_name($item)
    {
        // links going to /admin.php?page=[your_plugin_page][&other_params]
        // notice how we used $_REQUEST['page'], so action will be done on curren page
        // also notice how we use $this->_args['singular'] so in this example it will
        // be something like &person=2
        $actions = array(
            'edit'      => sprintf('<a href="'.home_url().'/personal-profile/?id=%s">Edit</a>',$item->id),
            //'delete'    => sprintf('<a href="?page=%s&action=%s&id=%s">Delete</a>',$_REQUEST['page'],'delete',$item->id),
        );
        return sprintf('%1$s %2$s', $item->up_name, $this->row_actions($actions) );

    }



    /**
     * [REQUIRED] this is how checkbox column renders
     *
     * @param $item - row (key, value array)
     * @return HTML
     */

    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />', $this->_args['singular'], $item->id
        );
    }



    /**
     * [REQUIRED] This method return columns to display in table
     * you can skip columns that you do not want to show
     * like content, or description
     *
     * @return array
     */

    function get_columns()
    {
        $columns = array(
            'cb'            => '<input type="checkbox" />', //Render a checkbox instead of text
            'up_name'          => __('Name', 'adventurewithin'),
            'up_email'         => __('Email', 'adventurewithin'),
            'up_date_of_birth' => __('Date of Birthday', 'adventurewithin'),
            'hm_phone'         => __('Phone', 'adventurewithin'),
            'up_signature'     => __('Signature', 'adventurewithin')
        );
        return $columns;
    }



    /**
     * [OPTIONAL] This method return columns that may be used to sort table
     * all strings in array - is column names
     * notice that true on name column means that its default sort
     *
     * @return array
     */

    function get_sortable_columns()
    {
        $sortable_columns = array(
            'up_name'         => array('user_name', true)
        );
        return $sortable_columns;
    }



    /**
     * [OPTIONAL] Return array of bult actions if has any
     *
     * @return array
     */

    function get_bulk_actions()
    {
        $actions = array(
            'delete' => 'Delete'
            //'edit' =>'Edit'
        );
        return $actions;
    }



    /**
     * [OPTIONAL] This method processes bulk actions
     * it can be outside of class
     * it can not use wp_redirect coz there is output already
     * in this example we are processing delete action
     * message about successful deletion will be shown on page in next part
     */

    function process_bulk_action()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'certification'; // do not forget about tables prefix
        if ('delete' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if(!empty($ids)){
                if (is_array($ids)) $ids = implode(',', $ids);
                if (!empty($ids)) {
                    $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
                }

                if(array_key_exists('id', $_GET)){
                    wp_redirect(admin_url('?page=certifications'));
                }else{
                    wp_redirect($_REQUEST['_wp_referrer']);
                }

                $this->messclass = 'updated';
                $this->notify = 'Deleted Successfully';
            }else{
                wp_redirect($_REQUEST['_wp_referrer']);
                $this->notify = 'Please select atleast one document!';
                $this->messclass = 'error';
            }

        }

    }


    /**
     * [REQUIRED] This is the most important method
     *
     * It will get rows from database and prepare them to be showed in table
     */

    function prepare_items()
    {
        global $wpdb;
        $per_page = 20; // constant, how much records will be shown per page
        $current_page = $this->get_pagenum(); 
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();

        // here we configure table headers, defined in our methods
        $this->_column_headers = array($columns, $hidden, $sortable);

        // [OPTIONAL] process bulk action if any
        //$this->process_bulk_action();

        // will be used in pagination settings
        $users = get_users();
        $total_items = count($users);

        // prepare query params, as usual current page, order by and order direction
        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;

        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'id';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'desc';


        if($orderby == 'user_name'){
            $orderby = 'user_id';
        }

        // [REQUIRED] define $items array
        // notice that last argument is ARRAY_A, so we will retrieve array

        $this->items = $users;
        foreach ($this->items as $key => $item) {
            $item->up_name = get_user_meta($item->ID, 'first_name', true);
            $item->up_email = get_user_meta($item->ID, '_personal_profile_email', true);
            $date_of_birth = get_user_meta($item->ID, '_personal_profile_date_of_birth', true);

            $item->up_date_of_birth = !empty($date_of_birth)?date('d F, Y', strtotime($date_of_birth)):'';
            $item->hm_phone = get_user_meta($item->ID, '_personal_profile_phone', true);
            $item->up_signature = get_user_meta($item->ID, '_personal_profile_signature', true);
        }
        //die;
        $this->items = array_slice($this->items,(($current_page-1)*$per_page),$per_page);

        // [REQUIRED] configure pagination
        $this->set_pagination_args(array(
            'total_items' => $total_items, // total items defined above
            'per_page' => $per_page, // per page constant defined at top of method
            'total_pages' => ceil($total_items / $per_page) // calculate pages count
        ));
    }

}

?>