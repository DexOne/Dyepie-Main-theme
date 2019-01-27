<section class="random">	
	<?php	
	$terms = get_terms( array( 
		'taxonomy' => 'prod',
        'parent'   => 0,
        'number'   => 5,
	) );	
	if ( $terms ) {		
		echo '<h3 class="rand_head">You Can Also Take A Look AT :</h3>';
		echo '<div class ="randomposts">';	
			foreach( $terms as $term ) {		
                echo '
                    <h3>
                        <a href="'. get_term_link($term->slug, 'prod') .'">'. $term->name . 
                        '</a>
                    </h3>';
            }
        echo '</div>';
        }
	?>	
</section>