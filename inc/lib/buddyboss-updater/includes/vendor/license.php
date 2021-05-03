<?php
/**
 * Changes only needed wherever @todo is mentioned.
 */

class BBoss_License_Helper {
	/**
	 * @todo: change the values of these fields.
	 *
	 * _product_keys:
	 *      an array of product keys.
	 *      This is important.
	 *      this must be unique across all our products.
	 *      For variable products, create individual products instead of just one product and its variations.
	 *      this variable, in such case, becomes an array
	 */
	protected $_product_keys = array(),
		$_product_name = '',//required
		$_api_host = 'https://jvqo6bncab.execute-api.us-east-2.amazonaws.com/v1/verify',
		$_renew_url = '',//not mandatory

		//dont change the variables below
		$_option_name = '',
		$_product_key_safe = '',
		$_domain_name = '';

	/**
	 * Constructor
	 *
	 * @param array $package_id
	 */
	public function __construct( $package = array() ) {
		$this->_product_name = @$package['name'];

		$this->_product_key_safe = @$package['id'];
		$this->_option_name      = $this->_product_key_safe . '_license_dt';
		$this->_domain_name      = $this->get_domain( $_SERVER['SERVER_NAME'] );

		$this->_api_host = trailingslashit( $this->_api_host );//just to make sure

		if ( isset( $package['products'] ) && ! empty( $package['products'] ) ) {
			$product             = reset( $package['products'] );//just the first product
			$this->_product_keys = $product['software_ids'];
		}

		/*$this->network_activated    = $this->_is_network_activated();

		add_action( 'admin_notices',                array( $this, 'print_notice' ) );
		add_action( 'network_admin_notices',        array( $this, 'print_notice' ) );
		add_action( 'admin_print_footer_scripts',   array( $this, 'admin_js' ) );

		add_action( 'wp_ajax_bb_' . $this->_product_key_safe . '_activate', array( $this, 'ajax_activate' ) );*/
	}

	/**
	 * Get license status.
	 * @return string 'active' | 'inactive' | 'expired'
	 */
	protected function _get_license_status() {
		$status          = 'active';
		$license_details = $this->network_activated ? get_site_option( $this->_option_name ) : get_option( $this->_option_name );
		$license_details = maybe_unserialize( $license_details );

		if ( empty( $license_details ) ) {
			return 'inactive';
		}

		if ( $license_details['is_active'] ) {
			return 'active';
		}

		return 'expired';
	}

	/**
	 * Query license server and check if license is still valid.
	 */
	public function refetch_license_status( $license_details ) {
		$license_details = maybe_unserialize( $license_details );
		if ( empty( $license_details ) ) {
			return false;
		}

		if ( ! $license_details['is_active'] ) {
			return false;
		}

		$request_params = array(
			'request'     => 'validate',
			'instance'    => $this->_domain_name,
			'licence_key' => $license_details['license_key'],
		);

		$q_response = $this->get_api_response( $request_params );

		if ( is_wp_error( $q_response ) || ( $q_response['response']['code'] != 200 ) ) {
			return false;
		}

		$response = (array) json_decode( $q_response['body'] );

		return $response;
	}

	public function refetch_licenses( $licenses ) {
		$request_params = array(
			'request'  => 'refetch',
			'instance' => $this->_domain_name,
			'licenses' => $licenses,
		);

		$q_response = $this->get_api_response( $request_params );

		if ( is_wp_error( $q_response ) || ( $q_response['response']['code'] != 200 ) ) {
			return false;
		}

		$response = (array) json_decode( $q_response['body'] );

		return $response;
	}

	public function activate( $key, $email ) {
		if ( empty( $key ) || empty( $email ) ) {
			return array( 'status'  => false,
			              'message' => __( 'We\'ve checked the license key, but it <strong>doesn\'t appear to be a valid BuddyBoss license.</strong> Please double check the license key and try again.', 'buddyboss-theme' )
			);
		}

		$request_params = array(
			'request'     => 'activate',
			'email'       => $email,
			'licence_key' => $key,
			'product_id'  => implode( ',', $this->_product_keys ),
			'instance'    => $this->_domain_name,
		);

		$q_response = $this->get_api_response( $request_params );

		if ( is_wp_error( $q_response ) || ( $q_response['response']['code'] != 200 ) ) {
			return array( 'status'  => false,
			              'message' => __( 'We are unable to validate the license key. Service unavailable.', 'buddyboss-theme' )
			);
		}

		$response = (array) json_decode( $q_response['body'] );

		if ( isset( $response['status'] ) ) {
			if ( $response['status'] ) {
				//activation was successful
				$response['is_active'] = true;
			} else {
				//activation failed
				$response['is_active'] = false;
			}

			return $response;
		}

		return array( 'status'  => false,
		              'message' => __( 'We\'ve checked the license key, but it <strong>doesn\'t appear to be a valid BuddyBoss license.</strong> Please double check the license key and try again.', 'buddyboss-theme' )
		);
	}

	public function get_api_response( $params = '' ) {
		$defaults = array(
			'bboss_license_api' => '1',
		);

		$params = wp_parse_args( $params, $defaults );
		if ( ! empty( $params ) ) {
			$params = wp_json_encode( $params );
		}

		return wp_remote_post(
			$this->_api_host,
			array(
				'headers'     => array(
					"cache-control" => "no-cache",
					"postman-token" => "b131698c-451b-1218-bbbd-07e0a9ea34bb",
				),
				'body'        => $params,
				'timeout'     => 50,
				'redirection' => 10,//max redirects
			)
		);
	}


	public function get_domain() {
		$home_url = "";

		//1. multisite - only the root domain
		if ( is_multisite() ) {
			$home_url = network_home_url();
		} else {
			$home_url = home_url();
		}

		$home_url = untrailingslashit( $home_url );
		$home_url = str_replace( array( 'http://', 'https://', 'www.' ), array( '', '', '' ), $home_url );

		return $home_url;
	}

	/**
	 * @param string $domain Pass $_SERVER['SERVER_NAME'] here
	 * @param bool $debug
	 *
	 * @return string
	 */
	public function get_tld( $domain, $debug = false ) {
		$original = $domain = strtolower( $domain );

		if ( filter_var( $domain, FILTER_VALIDATE_IP ) ) {
			return $domain;
		}

		$debug ? print( '<strong style="color:green">&raquo;</strong> Parsing: ' . $original ) : false;

		$arr = array_slice( array_filter( explode( '.', $domain, 4 ), function ( $value ) {
			return $value !== 'www';
		} ), 0 ); //rebuild array indexes

		if ( count( $arr ) > 2 ) {
			$count = count( $arr );
			$_sub  = explode( '.', $count === 4 ? $arr[3] : $arr[2] );

			$debug ? print( " (parts count: {$count})" ) : false;

			if ( count( $_sub ) === 2 ) // two level TLD
			{
				$removed = array_shift( $arr );
				if ( $count === 4 ) // got a subdomain acting as a domain
				{
					$removed = array_shift( $arr );
				}
				$debug ? print( "<br>\n" . '[*] Two level TLD: <strong>' . join( '.', $_sub ) . '</strong> ' ) : false;
			} elseif ( count( $_sub ) === 1 ) // one level TLD
			{
				$removed = array_shift( $arr ); //remove the subdomain

				if ( strlen( $_sub[0] ) === 2 && $count === 3 ) // TLD domain must be 2 letters
				{
					array_unshift( $arr, $removed );
				} else {
					// non country TLD according to IANA
					$tlds = array(
						'aero',
						'arpa',
						'asia',
						'biz',
						'cat',
						'com',
						'coop',
						'edu',
						'gov',
						'info',
						'jobs',
						'mil',
						'mobi',
						'museum',
						'name',
						'net',
						'org',
						'post',
						'pro',
						'tel',
						'travel',
						'xxx',
					);

					if ( count( $arr ) > 2 && in_array( $_sub[0], $tlds ) !== false ) //special TLD don't have a country
					{
						array_shift( $arr );
					}
				}
				$debug ? print( "<br>\n" . '[*] One level TLD: <strong>' . join( '.', $_sub ) . '</strong> ' ) : false;
			} else // more than 3 levels, something is wrong
			{
				for ( $i = count( $_sub ); $i > 1; $i -- ) {
					$removed = array_shift( $arr );
				}
				$debug ? print( "<br>\n" . '[*] Three level TLD: <strong>' . join( '.', $_sub ) . '</strong> ' ) : false;
			}
		} elseif ( count( $arr ) === 2 ) {
			$arr0 = array_shift( $arr );

			if ( strpos( join( '.', $arr ), '.' ) === false
			     && in_array( $arr[0], array( 'localhost', 'test', 'invalid' ) ) === false ) // not a reserved domain
			{
				$debug ? print( "<br>\n" . 'Seems invalid domain: <strong>' . join( '.', $arr ) . '</strong> re-adding: <strong>' . $arr0 . '</strong> ' ) : false;
				// seems invalid domain, restore it
				array_unshift( $arr, $arr0 );
			}
		}

		$debug ? print( "<br>\n" . '<strong style="color:gray">&laquo;</strong> Done parsing: <span style="color:red">' . $original . '</span> as <span style="color:blue">' . join( '.', $arr ) . "</span><br>\n" ) : false;

		return join( '.', $arr );
	}
}

function BBoss_License_Helper_init() {
	BBoss_License_Helper::instance();
}