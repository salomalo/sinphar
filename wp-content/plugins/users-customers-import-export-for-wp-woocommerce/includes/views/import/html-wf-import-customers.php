<div class="wf-banner updated below-h2">
    <p class="main">
        <ul>
        <li style='color:red;'><strong><?php _e('Your Business is precious! Go Premium!','wf_customer_import_export'); ?></strong></li>
        <strong>
        <?php _e('HikeForce Import Export Users Plugin Premium version helps you to seamlessly import/export Customer details into your Woocommerce Store.', 'wf_customer_import_export'); ?>
        </strong><br/><br/>
        <?php _e('- Export/Import <strong>WooCommerce Customer</strong> details into a CSV file.', 'wf_customer_import_export'); ?><strong><?php _e('( Basic version supports only WordPress User details )', 'wf_customer_import_export'); ?></strong><br/>
        <?php _e('- Option to choose All Roles or Multiple Roles while export (Basic Supports only single role at a time).', 'wf_customer_import_export'); ?><br/>
        <?php _e('- Various Filter options for exporting Customers.', 'wf_customer_import_export'); ?><br/>
        <?php _e('- Map and Transform fields while Importing Customers.', 'wf_customer_import_export'); ?><br/>
        <?php _e('- Change values while improting Customers using Evaluation Fields.', 'wf_customer_import_export'); ?><br/>
        <?php _e('- Choice to Update or Skip existing imported Customers.', 'wf_customer_import_export'); ?><br/>
        <?php _e('- Choice to Send or Skip Emails for newly imported Customers.', 'wf_customer_import_export'); ?><br/>
        <?php _e('- WPML Supported. French language support Out of the Box.', 'wf_customer_import_export'); ?><br/>
        <?php _e('- Import/Export file from/to a remote server via FTP in Scheduled time interval with Cron Job.', 'wf_customer_import_export'); ?><br/>
        <?php _e('- Excellent Support for setting it up!', 'wf_customer_import_export'); ?><br/>
    </ul>
    </p>
    <p>
        <a href="http://www.xadapter.com/product/wordpress-users-woocommerce-customers-import-export/" target="_blank" class="button button-primary"><?php _e( 'Upgrade to Premium Version', 'wf_customer_import_export'); ?></a>
        <a href="http://userexportimportwoodemo.hikeforce.com/wp-admin/admin.php?page=hf_wordpress_customer_im_ex" target="_blank" class="button"><?php _e( 'Live Demo', 'wf_customer_import_export'); ?></a>
        <a href="http://www.xadapter.com/category/product/wordpress-users-woocommerce-customers-import-export" target="_blank" class="button"><?php _e( 'Documentation', 'wf_customer_import_export' ); ?></a>
        <a href="<?php echo plugins_url( 'Sample_Users.csv', WF_CustomerImpExpCsv_FILE ); ?>" target="_blank" class="button"><?php _e('Sample User CSV', 'wf_customer_import_export'); ?></a>
    </p>
</div>
<style>
    .wf-banner img {
        float: right;
        margin-left: 1em;
        padding: 15px 0
    }
</style>

<div class="tool-box">
    <h3 class="title"><?php _e('Import Users in CSV Format:', 'wf_customer_import_export'); ?></h3>
    <p><?php _e('Import Users in CSV format from your computer', 'wf_customer_import_export'); ?></p>
    <p class="submit">
        <?php $import_url = admin_url('admin.php?import=wordpress_hf_user_csv'); ?>
        <a class="button button-primary" id="mylink" href="<?php echo $import_url; ?>"><?php _e('Import Users', 'wf_customer_import_export'); ?></a>
    </p>
</div>