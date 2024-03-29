<?php
    // ADDING 1 NEW COLUMNS WITH THEIR TITLES (before "Total" and "Actions" columns)
    add_filter( 'manage_edit-shop_order_columns', 'add_admin_order_list_custom_column', 20 );
    function add_admin_order_list_custom_column($columns)
    {
        $reordered_columns = array();
        
        // Inserting columns to a specific location
        foreach( $columns as $key => $column){
            $reordered_columns[$key] = $column;
            if( $key ==  'order_status' ){
                // Inserting after "Status" column
                $reordered_columns['sconto'] = __( 'Sconto','gd');
            }
        }
        return $reordered_columns;
    }

    // Adding custom fields meta data for each new column (example)
    add_action( 'manage_shop_order_posts_custom_column' , 'display_admin_order_list_custom_column_content', 20, 2 );
    function display_admin_order_list_custom_column_content( $column, $post_id )
    {
        global $the_order;

        switch ( $column )
        {
            case 'sconto' :
                $total = (float) $the_order->get_total();
                $discount = (float) $the_order->get_discount_total();
                $discount_percentage = round($discount*100/$total);
                $refund = (float) $the_order->get_total_refunded();
                
                if ( ! empty($total) && ($total-$refund>0)) {
                    echo ($discount_percentage) . '% (pari a € '. $discount .')';
                }
                else {
                    echo '<small><em>0</em></small>';
                }
                break;
        }
    }


    /**
    * Delete all images and gallery on product delete
    */
    function delete_product_images( $post_id )
    {
        $product = wc_get_product( $post_id );

        if ( !$product ) {
            return;
        }

        $featured_image_id = $product->get_image_id();
        $image_galleries_id = $product->get_gallery_image_ids();

        if( !empty( $featured_image_id ) ) {
            wp_delete_post( $featured_image_id );
        }

        if( !empty( $image_galleries_id ) ) {
            foreach( $image_galleries_id as $single_image_id ) {
                wp_delete_post( $single_image_id );
            }
        }
    }

?>