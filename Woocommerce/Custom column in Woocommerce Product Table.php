<?php

/** AGGIUNGE UNA NUOVA COLONNA PER I PRODOTTI */
add_filter( 'manage_edit-product_columns', 'misha_new_column', 20 );
function gd_new_column( $columns_array ) {

	// I want to display a new column just after the product name column
	return array_slice( $columns_array, 0, 3, true )
	+ array( 'sconto' => 'Sconto' )
	+ array_slice( $columns_array, 3, NULL, true );


}

add_action( 'manage_posts_custom_column', 'gd_populate_new_columns' );
function gd_populate_new_columns( $column_name ) {

	if( $column_name  == 'sconto' ) {
		// if you suppose to display multiple brands, use foreach();
		if(get_the_terms( get_the_ID(), 'pa_brand')) {
			$x = get_the_terms( get_the_ID(), 'pa_brand'); // taxonomy name
			echo $x[0]->name;
		}
	}

}

?>