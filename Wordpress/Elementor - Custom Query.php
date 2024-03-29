<?php 

function mostra_progetti_chiusi( $query ) {
	$query->set( 'post_parent', 123 );
}
add_action( 'elementor/query/mostra_progetti_chiusi', 'mostra_progetti_chiusi' );


function mostra_progetti_aperti( $query ) {
	$query->set( 'post_parent', 28 );
}
add_action( 'elementor/query/mostra_progetti_aperti', 'mostra_progetti_aperti' );


?>