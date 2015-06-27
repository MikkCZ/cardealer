<?php

/**
 * Cardealer_Shortcode contains all functions neccessary to handle the shortcodes.
 * 
 * @author Michal Stanke <michal.stanke@mikk.cz>
 */
class Cardealer_Shortcode {

	private static $instance = NULL;

	public function display_car( $atts ) {
		self::enqueue_cardealer_stylesheet();
		$car = new Cardealer_Car( get_the_ID() );
		$additional = $car->getAdditional();
		if ( $additional != "" ) {
			$additional = sprintf('
				<div class="additional">
					<span class="title">%1$s: </span>%2$s
				</div>',
				ADDITIONAL,
				$additional
			);
		}
		return '
			<div class="cardealer_post">
				<div class="price">' . PRICE . ': <span class="price">' . $car->getPrice() . '</span></div>
				<div class="car_details">
					<table class="car_details_table">
						<tr>
							<th>' . YEAR . '</th>
							<td>' . $car->getYear() . '</td>
							<th>' . ODOMETER . '</th>
							<td>' . $car->getOdometer() . '</td>
						</tr>
						<tr class="even_row">
							<th>' . CATEGORY . '</th>
							<td>' . $car->getCategory() . '</td>
							<th>' . FUEL . '</th>
							<td>' . $car->getFuel() . '</td>
						</tr>
						<tr>
							<th>' . ENGINELITERS . '</th>
							<td>' . $car->getEngineLiters() . '</td>
							<th>' . ENGINEPOWER . '</th>
							<td>' . $car->getEnginePower() . '</td>
						</tr>
						<tr class="even_row">
							<th>' . TRANSMISSION . '</th>
							<td>' . $car->getTransmission() . '</td>
							<th>' . ECOLOR . '</th>
							<td>' . $car->getEcolor() . '</td>
						</tr>
						<tr>
							<th>' . STK . '</th>
							<td>' . $car->getSTK() . '</td>
							<th>' . METALLIC . '</th>
							<td>' . $car->getMetallic() . '</td>
						</tr>
						<tr class="even_row">
							<th>' . ECOTAX . '</th>
							<td>' . $car->getECOTax() . '</td>
							<th>' . CRASHED . '</th>
							<td>' . $car->getCrashed() . '</td>
						</tr>
					</table>
				</div>
				<div class="car_features">'.
						$car->getComfort() . $car->getInterior() . $car->getMedia() .
						$car->getExterior() . $car->getSafety() . '
				</div>
				' . $additional . '
			</div>';
	}

	public function display_list ( $atts ) {
		$atts = shortcode_atts(
			array(
				'category' => NULL,
				'limit'    => NULL,
			),
			$atts
		);
		if ( $atts['category'] == NULL ) {
			return '<!-- No category specified. -->';
		}
		self::enqueue_cardealer_stylesheet();
	
		$query_args = array(
			'category_name' => $atts['category'],
			'orderby'       => 'title',
			'order'         => 'ASC',
		);
		if ( $atts['limit'] != NULL ) {
			$query_args['posts_per_page'] = $atts['limit'];
		}
	
		$query = new WP_Query( $query_args );
	
		$table = '
			<table class="car_list_table">
				<thead>
					<tr>
						<th><!--VEHICLE--></th>
						<th>' . YEAR . '</th>
						<th>' . ODOMETER . '</th>
						<th>' . PRICE . '</th>
						<th>' . FUEL . '</th>
						<th>' . ECOLOR . '</th>
					</tr>
				</thead>
				<tbody>';
				$i = 0;
				while ( $query->have_posts() ) {
					$query->the_post();
					$i++;
					if ( $i%2 == 0 ) {
						$table .= '<tr class="even_row">';
					} else {
						$table .= '<tr>';
					}
				
					if ( has_post_thumbnail() ) {
						$image = get_the_post_thumbnail( $page->ID, 'cardealer_thumbnail' );
					} else {
						$image = NULL;
						$images = get_posts(
							array(
								'post_type'      => 'attachment',
								'post_mime_type' => 'image',
								'post_parent'    => get_the_ID(),
								'posts_per_page' => 1,
							)
						);
						if ( $images ) {
							$image = wp_get_attachment_image( $images[0]->ID, 'cardealer_thumbnail' );
						}
					}
					if ( $image ) {
						$table .= '
							<th>
								<div class="car_thumbnail"><a href="' . get_permalink() . '">' . $image . '</a></div>
								<div class="car_name"><a href="' . get_permalink() . '">' . get_the_title() . '</a></div>
							</th>';
					} else {
						$table .= '
							<th>
								<div class="car_thumbnail"></div>
								<div class="car_name"><a href="' . get_permalink() . '">' . get_the_title() . '</a></div>
							</th>';
					}
					$car = new Cardealer_Car( get_the_ID() );
					$table .= '
						<td>' . $car->getYear() . '</td>
						<td>' . $car->getOdometer() . '</td>
						<td>' . $car->getPrice() . '</td>
						<td>' . $car->getFuel() . '</td>
						<td>' . $car->getEcolor() . '</td>
					</tr>';
					$image = '';
				}
		$table .= '
				</tbody>
			</table>';
	
		wp_reset_query();
	
		return sprintf('
			<div class="cardealer_post">
				<div class="car_list">%s</div>
			</div>',
			$table
		);
	}

	public function display_new( $atts ) {
		$atts = shortcode_atts(
			array(
				'category'   => NULL,
				'limit'      => 4,
				'buttonlink' => NULL,
			),
			$atts
		);
		if ( $atts['category'] == NULL ) {
			return '<!-- No category specified. -->';
		}
		self::enqueue_cardealer_stylesheet();
	
		$query_args = array(
			'category_name'  => $atts['category'],
			'orderby'        => 'date',
			'order'          => 'DESC',
			'posts_per_page' => $atts['limit']
		);
	
		$query = new WP_Query( $query_args );
	
		while ( $query->have_posts() ) {
			$query->the_post();
		
			$new_list = '<div class="car">';
		
			if ( has_post_thumbnail() ) {
				$image = get_the_post_thumbnail( $page->ID, 'cardealer_thumbnail' );
			} else {
				$image = NULL;
				$images = get_posts(
					array(
						'post_type'      => 'attachment',
						'post_mime_type' => 'image',
						'post_parent'    => get_the_ID(),
						'posts_per_page' => 1,
					)
				);
				if ( $images ) {
					$image = wp_get_attachment_image( $images[0]->ID, 'cardealer_thumbnail' );
				}
			}
			if ( $image ) {
				$new_list .= '
					<div class="car_thumbnail"><a href="' . get_permalink() . '">' . $image . '</a></div>
					<h5 class="car_name"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h5>';
			} else {
				$new_list .= '
					<div class="car_thumbnail"></div>
					<h5 class="car_name"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h5>';
			}
			$car = new Cardealer_Car( get_the_ID() );
			$new_list .= 
				'<div class="car_year">' . YEAR . ': ' . $car->getYear() . '</div>' .
				'<div class="car_odometer">' . $car->getOdometer() . '</div>' .
				'<h6 class="car_price">' . $car->getPrice() . '</h6>';
		
			$new_list .= '</div>';
		
			$image = '';
		}

		wp_reset_query();
	
		if ( $atts['buttonlink'] == NULL ) {
			return sprintf('
				<div class="cardealer_post">
					<div class="car_list_new">%s</div>
				</div>',
				$new_list
			);
		} else {
			return sprintf('
				<div class="cardealer_post">
					<div class="car_list_new">%1$s</div>
				<nav><a class="show_car_list" href="%2$s">Show all cars</a></nav>
				</div>',
				$new_list,
				$atts['buttonlink']
			);
		}
	}

	private function enqueue_cardealer_stylesheet() {
		$style_url = plugins_url( 'css/style.css', CARDEALER_PLUGIN_FILE );
		wp_register_style( 'cardealer', $style_url );
		wp_enqueue_style( 'cardealer' );
	}

	/**
	 * Returns the Cardealer_Shortcode singleton instance.
	 */
	private static function getInstance() {
		if ( self::$instance == NULL ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {}

}
