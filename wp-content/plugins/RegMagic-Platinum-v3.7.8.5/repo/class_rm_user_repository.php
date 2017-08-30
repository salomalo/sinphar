<?php
/**
 * Centralizing User related database operations
 * Still many functions are in DBManager class. Eventually all the User related db operations will be performed from this class.
 */
class RM_User_Repository {
     
     /**
      * 
      * @param type $options (array with form_id and group by clause)
      * @return array (list of users)
      */                
     public function get_users_for_front($options)
     {        
        global $wpdb;
        
        $table_name = RM_Table_Tech::get_table_name_for('SUBMISSIONS');
        $wp_user_table = RM_Table_Tech::get_table_name_for('WP_USERS');
        $qry = "";
        $users = array();
        $limit= 12;
         
        //First filter list wp users
        if (!empty($options['timerange']))
            $time_interval = $options['timerange'];
        else
             $time_interval = 'all';
       
        $wp_users =    $this->get_user_ids_from_wp($time_interval);
        
        $Uid_list = "('".implode("','",$wp_users)."')";
        $form_query="";
        //check if form_id given
        if(isset($options['form_id']) && !empty($options['form_id'])):
            $form_query= " AND form_id=". (int) $options['form_id'];
        endif;

        // Limit result set
        $limit_query= " limit $limit ";
        if(!empty($options['page_number'])):
            $offset = $limit*$options['page_number'];
            $limit_query .= " OFFSET $offset";
        endif;

        // Order by clause
        $order_by = " ORDER BY `submitted_on` ";
        
        $qry = "SELECT distinct `user_email` from $table_name WHERE";
        
        $wp_user_constraint = " user_email IN (SELECT user_email FROM `$wp_user_table` WHERE `ID` IN $Uid_list)";
        $qry = $qry.$wp_user_constraint.$form_query.$order_by.$limit_query; 

        $emails = $wpdb->get_col($qry);
        if (is_array($emails))
        {
            foreach ($emails as $email)
            {
                $user = get_user_by('email', $email);
                 
                if ($user)
                    $users[] = $user;                             
            }
            return $users;
        }
                 
         return null;
     }
     
     private function get_user_ids_from_wp($interval)
    {
        $args = array('fields' => 'ID', 'role__not_in' => array('administrator'));
     
        switch ($interval)
        {
            case 'today':
                $args['date_query'] = array(array('after' => date('Y-m-d', strtotime('today')), 'inclusive' => true));
                break;

            case 'week':
                $args['date_query'] = array(array('after' => date('Y-m-d', strtotime('this week')), 'inclusive' => true));
                break;

            case 'month':
                $args['date_query'] = array(array('after' => 'first day of this month', 'inclusive' => true));
                break;

            case 'year':
                $args['date_query'] = array(array('year' => date('Y'), 'inclusive' => true));
                break;
        }
        
        $users = get_users($args); //var_dump($users);
        return $users;
    }

}

?>