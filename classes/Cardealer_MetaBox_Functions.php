<?php

class Cardealer_MetaBox_Functions {

	private $post_ID;
	private $meta;

	public function __construct( $post_ID ) {
		$this->post_ID = $post_ID;
	}

	public function getSingleMetaString( $meta_name ) {
		$meta = get_post_meta( $this->post_ID, $meta_name, true );
		$vehicle_info_meta = unserialize( VEHICLE_INFO_STRINGS );
		if ( isset( $vehicle_info_meta[ $meta_name ] ) && isset( $vehicle_info_meta[ $meta_name ][ $meta ] ) ) {
			$meta = $vehicle_info_meta[ $meta_name ][ $meta ];
		} else {
			$meta = '';
		}
		if ( $meta == '' ) {
			$meta = DASH;
		}
		return $meta;
	}

	public function getFeature( $meta_name, $headline ) {
		$feature = $this->getFeatureArray( $meta_name );
		$feature_total = count( $feature );
		$feature_count = 0;
		$vehicle_options_meta = unserialize( VEHICLE_OPTIONS );
		$vehicle_options_meta = $vehicle_options_meta[ $meta_name ];
		$feature_display = '';
		while ( $feature_total > $feature_count ) {
			$feature_index = $feature[ $feature_count ];
			$feature_string = $vehicle_options_meta[ $feature_index ];
			if ( isset( $feature_string ) ) {
				$feature_display .= sprintf( '<li>%s</li>', $feature_string );
			} else {
				$feature_total--;
			}
			$feature_count++;
		}
		if ( $feature_total != 0 ) {
			$feature_display = sprintf('
				<div class="feature">
					<h6>%1$s</h6><div class="et-custom-list"><ul>%2$s</ul></div>
				</div>',
				$headline,
				$feature_display
			);
			return $feature_display;
		} else {
			return;
		}
	}

	private function getFeatureArray( $meta_name ) {
		$features = get_post_meta( $this->post_ID, $meta_name, false );
		if ( ! empty ( $features ) ) {
			return $features;
		} else {
			return;
		}
	}

	public function installed_notice() {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( ! is_plugin_active( 'meta-box/meta-box.php' ) ) {
			$plugin_data = get_plugin_data( CARDEALER_PLUGIN_FILE );
			printf( '<div class="error">
						<p>%s: Plugin Meta Box (Author: Rilwis) is not active.</p>
					</div>',
					$plugin_data['Name']
			);
		}
	}

	public function register() {
		$vehicle_info = unserialize( VEHICLE_INFO_STRINGS );
	
		// Main Vehicle Info Box
		$meta_boxes[] = array(
			'id'        => 'vehicle_info',
			'title'    	=> 'Vehicle information',
			'pages'    	=> array( 'post', 'slider' ),
			'context'  	=> 'normal',
			'priority' 	=> 'high',
			'fields'   	=> array(
				array(
					'name'       => YEAR,
					'id'         => 'cardealer_year',
					'desc'       => 'Enter year of manufacture',
					'type'       => 'date',
					'js_options' => array(
						'changeYear'      => true,
						'yearRange'       => '-50:+0',
						'dateFormat'      => __( 'yy', 'meta-box' ),
						'showButtonPanel' => false,
					),
				),
				array(
					'name'       => ODOMETER,
					'id'         => 'cardealer_odometer',
					'type'       => 'number',
					'std'        => 0,
					'desc'       => 'Enter odometer mileage in'.ODO_UNIT,
				),
				array(
					'name'       => CATEGORY,
					'id'         => 'cardealer_category',
					'type'       => 'select',
					'options'    => $vehicle_info['cardealer_category'],
					'multiple'   => false,
					'std'        => array( 'sedan' ),
					'desc'       => 'Choose body type',
				),
				array(
					'name'       => FUEL,
					'id'         => 'cardealer_fuel',
					'type'       => 'select',
					'options'    => $vehicle_info['cardealer_fuel'],
					'multiple'   => false,
					'std'        => array( 'gasoline' ),
					'desc'       => 'Choose fuel',
				),
				array(
					'name'       => ENGINELITERS,
					'id'         => 'cardealer_engineliters',
					'type'       => 'number',
					'std'        => 0,
					'desc'       => 'Enter engine capacity in'.LITERS_UNIT,
				),
				array(
					'name'       => ENGINEPOWER,
					'id'         => 'cardealer_enginepower',
					'type'       => 'number',
					'std'        => 0,
					'desc'       => 'Enter engine power in'.POWER_UNIT,
				),
				array(
					'name'       => TRANSMISSION,
					'id'         => 'cardealer_transmission',
					'type'       => 'select',
					'options'    => $vehicle_info['cardealer_transmission'],
					'multiple'   => false,
					'std'        => array( 'manual' ),
					'desc'       => 'Choose gearbox',
				),
				array(
					'name'       => ECOLOR,
					'id'         => 'cardealer_ecolor',
					'type'       => 'text',
					'desc'       => 'Choose color',
				),
				array(
					'name'       => METALLIC,
					'id'         => 'cardealer_metallic',
					'type'       => 'select',
					'options'    => $vehicle_info['cardealer_metallic'],
					'multiple'   => false,
					'std'        => array( 'other' ),
					'desc'       => 'Choose paint',
				),
				array(
					'name'       => WARRANTY,
					'id'         => 'cardealer_warranty',
					'type'       => 'select',
					'options'    => $vehicle_info['cardealer_warranty'],
					'multiple'   => false,
					'std'        => array( 'other' ),
					'desc'       => 'Choose warranty',
				),
				array(
					'name'       => ECOTAX,
					'id'         => 'cardealer_ecotax',
					'type'       => 'select',
					'options'    => $vehicle_info['cardealer_ecotax'],
					'multiple'   => false,
					'std'        => array( 'no' ),
					'desc'       => 'Ecotax paid already?',
				),
				array(
					'name'       => CRASHED,
					'id'         => 'cardealer_crashed',
					'type'       => 'select',
					'options'    => $vehicle_info['cardealer_crashed'],
					'multiple'   => false,
					'std'        => array( 'no' ),
					'desc'       => 'Choose car condition (crashed)',
				),
				array(
					'name'       => STK,
					'id'         => 'cardealer_stk',
					'desc'       => 'Enter technical inspection valid until (e.g. 2016/08)',
					'type'       => 'date',
					'js_options' => array(
						'changeYear'      => true,
						'yearRange'       => '-4:+4',
						'dateFormat'      => __( 'yy/mm', 'meta-box' ),
						'showButtonPanel' => false,
					),
				),
				array(
					'name'       => PRICE,
					'id'         => 'cardealer_price',
					'type'       => 'number',
					'std'        => 0,
					'desc'       => 'Enter price (0 = '.ASK.')',
				),
			)
		);
	
		// Vehicle Options box
		$meta_boxes[] = array(
			'id'        => 'vehicle_options',
			'title'     => 'Accessories',
			'pages'     => array( 'post', 'slider' ),
			'fields'    => array(
				array(
					'name'       => COMFORT,
					'id'         => 'cardealer_comfort',
					'type'       => 'checkbox_list',
					'options'    => $vehicle_options['cardealer_comfort'],
					'desc'       => 'Choose accessories for comfort',
				),
				array(
					'name'       => INTERIOR,
					'id'         => 'cardealer_interior',
					'type'       => 'checkbox_list',
					'options'    => $vehicle_options['cardealer_interior'],
					'desc'       => 'Choose interior accessories',
				),
				array(
					'name'       => MEDIA,
					'id'         => 'cardealer_media',
					'type'       => 'checkbox_list',
					'options'    => $vehicle_options['cardealer_media'],
					'desc'       => 'Choose media accessories',
				),
				array(
					'name'       => EXTERIOR,
					'id'         => 'cardealer_exterior',
					'type'       => 'checkbox_list',
					'options'    => $vehicle_options['cardealer_exterior'],
					'desc'       => 'Choose exterior accessories',
				),
				array(
					'name'       => SAFETY,
					'id'         => 'cardealer_safety',
					'type'       => 'checkbox_list',
					'options'    => $vehicle_options['cardealer_safety'],
					'desc'       => 'Choose accessories for security and safery',
				),
				array(
					'name'       => ADDITIONAL,
					'id'         => 'cardealer_additional',
					'desc'       => 'Enter additional',
					'type'       => 'text',
					'std'        => '',
				),
			)
		);

		return $meta_boxes;
	}

}
