<?php

class Cardealer_Car {
	
	private $metabox;
	private $post_ID;

	public function __construct( $post_ID ) {
		$this->metabox = new Cardealer_MetaBox_Functions( $post_ID );
		$this->post_ID = $post_ID;
	}

	public function getOdometer() {
		$odometer = $this->metabox->getSingleMetaString( 'cardealer_odometer' );
		if( $odometer == 0 ) {
			$odometer = DASH;
		} else {
			$odometer .= ODO_UNIT;
		}
		return $odometer;
	}

	public function getEngineLiters() {
		$engine_liters = $this->metabox->getSingleMetaString( 'cardealer_engineliters' );
		if( $engine_liters == 0 ) {
			$engine_liters = DASH;
		} else {
			$engine_liters .= LITERS_UNIT;
		}
		return $engine_liters;
	}

	public function getEnginePower() {
		$engine_power = $this->metabox->getSingleMetaString( 'cardealer_enginepower' );
		if( $engine_power == 0 ) {
			$engine_power = DASH;
		} else {
			$engine_power .= POWER_UNIT;
		}
		return $engine_power;
	}

	public function getPrice() {
		$price = $this->metabox->getSingleMetaString( 'cardealer_price' );
		if( $price == 0 ) {
			$price = ASK;
		} else {
			$price .= CURRENCY;
		}
		return $price;
	}

	public function getYear() {
		return $this->metabox->getSingleMetaString( 'cardealer_year' );
	}

	public function getCategory() {
		return $this->metabox->getSingleMetaString( 'cardealer_category' );
	}
	
	public function getFuel() {
		return $this->metabox->getSingleMetaString( 'cardealer_fuel' );
	}

	public function getTransmission(){
		return $this->metabox->getSingleMetaString( 'cardealer_transmission' );
	}
	
	public function getEcolor() {
		return $this->metabox->getSingleMetaString( 'cardealer_ecolor' );
	}
	
	public function getMetallic() {
		return $this->metabox->getSingleMetaString( 'cardealer_metallic' );
	}
	
	public function getCondition() {
		return $this->metabox->getSingleMetaString( 'cardealer_condition' );
	}
	
	public function getWarranty() {
		return $this->metabox->getSingleMetaString( 'cardealer_warranty' );
	}

	public function getECOTax() {
		return $this->metabox->getSingleMetaString( 'cardealer_ecotax' );
	}
	
	public function getCrashed() {
		return $this->metabox->getSingleMetaString( 'cardealer_crashed' );
	}
	
	public function getSTK() {
		return $this->metabox->getSingleMetaString( 'cardealer_stk' );
	}
	
	public function getEmissions() {
		return $this->metabox->getSingleMetaString( 'cardealer_emissions' );
	}

	public function getAdditional() {
		return $this->metabox->getSingleMetaString( 'cardealer_additional' );
	}

	public function getComfort(){
		return $this->metabox->getFeature( 'cardealer_comfort', COMFORT );
	}
	
	public function getInterior(){
		return $this->metabox->getFeature( 'cardealer_interior', INTERIOR );
	}
	
	public function getMedia(){
		return $this->metabox->getFeature( 'cardealer_media', MEDIA );
	}
	
	public function getExterior(){
		return $this->metabox->getFeature( 'cardealer_exterior', EXTERIOR );
	}
	
	public function getSafety(){
		return $this->metabox->getFeature( 'cardealer_safety', SAFETY );
	}

}
