<?php
/**
 * WooCommerce Local Pickup Plus
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@skyverge.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade WooCommerce Local Pickup Plus to newer
 * versions in the future. If you wish to customize WooCommerce Local Pickup Plus for your
 * needs please refer to http://docs.woocommerce.com/document/local-pickup-plus/
 *
 * @package     WC-Shipping-Local-Pickup-Plus
 * @author      SkyVerge
 * @copyright   Copyright (c) 2012-2017, SkyVerge, Inc.
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

defined( 'ABSPATH' ) or exit;

/**
 * Local Pickup time adjustment.
 *
 * Helper object to adjust scheduling of a local pickup. It can be used to define
 * a lead time or a pickup deadline for scheduling a purchase order collection.
 *
 * This consists of units (integer) of time (an interval expressed as hours, days,
 * weeks or months). When a pickup location has set a lead time, customers in front
 * end that are scheduling a pickup for that location, they will be unable to choose
 * a slot that is before the lead time has past. When a pickup location has a
 * pickup deadline, the set value will be used as boundary for the calendar until
 * when it's possible to schedule a pickup collection.
 *
 * @since 2.0.0
 */
class WC_Local_Pickup_Plus_Schedule_Adjustment {


	/** @var int ID of the corresponding pickup location */
	private $location_id;

	/** @var string the property ID */
	protected $id;

	/** @var string time amount value */
	protected $value = '';


	/**
	 * Lead time constructor.
	 *
	 * @since 2.0.0
	 *
	 * @param string $id the identifier of the corresponding property and field
	 * @param string $time_string an amount of time as a string (e.g. "2 days", "3 weeks", "1 month", etc.)
	 * @param int $location_id optional, ID of the corresponding pickup location
	 */
	public function __construct( $id, $time_string = null, $location_id = 0 ) {

		$this->id = $id;

		if ( null !== $time_string ) {
			$this->value = $this->parse_value( $time_string );
		}

		$this->location_id = (int) $location_id;
	}


	/**
	 * Parse and validate a time value.
	 *
	 * @since 2.0.0
	 *
	 * @param string $time_interval lead time to validate
	 * @return string
	 */
	private function parse_value( $time_interval ) {

		$value = '';

		if ( is_string( $time_interval ) ) {

			$pieces = explode( ' ', $time_interval );

			if (    isset( $pieces[1] )
			     && is_numeric( $pieces[0] )
			     && $this->is_valid_interval( $pieces[1] ) ) {

				$value = $time_interval;
			}
		}

		return $value;
	}


	/**
	 * Set the time value.
	 *
	 * @since 2.0.0
	 *
	 * @param int $amount the time amount
	 * @param string $interval the time interval
	 */
	public function set_value( $amount, $interval ) {

		$this->value = $this->parse_value( "{$amount} {$interval}" );
	}


	/**
	 * Get the raw value.
	 *
	 * @since 2.0.0
	 *
	 * @return string
	 */
	public function get_value() {
		return $this->value;
	}


	/**
	 * Get available time intervals.
	 *
	 * @since 2.0.0
	 *
	 * @param bool $with_data whether to return an associative array with labels and time or just the interval keys. Default false
	 * @return string[]|array[] indexed or associative array
	 */
	private function get_intervals( $with_data = false ) {

		$intervals = array(

			'hours'  => array(
				'label' => __( 'Hour(s)', 'woocoomerce-shipping-local-pickup-plus' ),
				'time'  => HOUR_IN_SECONDS,
			),

			'days'   => array(
				'label' => __( 'Day(s)', 'woocoomerce-shipping-local-pickup-plus' ),
				'time'  => DAY_IN_SECONDS,
			),

			'weeks'  => array(
				'label' => __( 'Week(s)', 'woocoomerce-shipping-local-pickup-plus' ),
				'time'  => WEEK_IN_SECONDS,
			),

			'months' => array(
				'label' => __( 'Month(s)', 'woocoomerce-shipping-local-pickup-plus' ),
				'time'  => MONTH_IN_SECONDS,
			),

		);

		return true === $with_data ? $intervals : array_keys( $intervals );
	}


	/**
	 * Validate a time interval type.
	 *
	 * @since 2.0.0
	 *
	 * @param string $interval should be: 'hours', 'days', 'weeks' or 'months'
	 * @return bool
	 */
	private function is_valid_interval( $interval ) {
		return in_array( $interval, $this->get_intervals(), true );
	}


	/**
	 * Check whether there is a valid time.
	 *
	 * @since 2.0.0
	 *
	 * @return bool
	 */
	public function is_null() {
		return empty( $this->value );
	}


	/**
	 * Get time amount.
	 *
	 * @since 2.0.0
	 *
	 * @return int|null
	 */
	public function get_amount() {

		if ( ! $this->is_null() ) {

			$pieces = explode( ' ', $this->value );

			return (int) $pieces[0];
		}

		return null;
	}


	/**
	 * Get the time interval.
	 *
	 * @since 2.0.0
	 *
	 * @return null|string
	 */
	public function get_interval() {

		if ( ! $this->is_null() ) {

			$pieces = explode( ' ', $this->value );

			return $pieces[1];
		}

		return null;
	}


	/**
	 * Get the time in seconds.
	 *
	 * @since 2.0.0
	 *
	 * @return int timestamp
	 */
	public function in_seconds() {

		$seconds   = 0;
		$interval  = $this->get_interval();
		$intervals = $this->get_intervals( true );

		if ( isset( $intervals[ $interval ]['time'] ) ) {
			$seconds = (int) $this->get_amount() * $intervals[ $interval ]['time'];
		}

		return $seconds;
	}


	/**
	 * Apply the adjustment to a date or timestamp and return the adjusted date.
	 *
	 * @since 2.0.0
	 *
	 * @param null $date optional: defaults to now - any valid datetime string or timestamp
	 * @param string $format optional: default to mysql format, can be any valid PHP format
	 * @return int|null|string a datetime string according to $format type
	 */
	public function get_relative_date( $date = null, $format = 'mysql' ) {
		return $this->get_relative_datetime( $date, $format );
	}


	/**
	 * Apply the adjustment to a date or timestamp and return the adjusted timestamp.
	 *
	 * @since 2.0.0
	 *
	 * @param null|string|int $date a date as a timestamp or datetime string
	 * @return int|null a timestamp or null in case of error
	 */
	public function get_relative_time( $date = null ) {
		return $this->get_relative_datetime( $date, 'timestamp' );
	}


	/**
	 * Get the relative date or timestamp.
	 *
	 * Applies the adjustment to a date and returns the modified date.
	 *
	 * @since 2.0.0
	 *
	 * @param int|string $date optional: a date or timestamp or datetime object (defaults to current timestamp)
	 * @param string $format optional: the date to format the returned value: 'timestamp', 'mysql' or any accepted PHP date formats (default: mysql format)
	 * @return string|int|null a datetime string or timestamp, null in case of error
	 */
	private function get_relative_datetime( $date = null, $format = 'mysql' ) {

		if ( null === $date ) {
			$date = current_time( 'timestamp', true );
		} elseif ( is_numeric( $date ) ) {
			$date = (int) $date;
		} elseif ( is_string( $date ) ) {
			$date = strtotime( $date );
		} else {
			$date = null;
		}

		$relative_date = $date;

		if ( is_int( $date ) ) {

			$date += $this->in_seconds();

			if ( 'mysql' === $format ) {
				$relative_date = date( 'Y-m-d H:i:s', $date );
			} elseif ( 'timestamp' === $format ) {
				$relative_date = $date;
			} else {
				$relative_date = date_i18n( $format, $date );
			}
		}

		return $relative_date;
	}


	/**
	 * Get a time input field HTML.
	 *
	 * @since 2.0.0
	 *
	 * @param array $args array of input field arguments
	 * @return string HTML
	 */
	public function get_field_html( array $args ) {

		$args = wp_parse_args( $args, array(
			'name'     => '',
			'disabled' => false,
		) );

		if ( empty( $args['name'] ) || ! is_string( $args['name'] ) ) {
			return '';
		}

		ob_start();

		?>
		<div class="wc-local-pickup-plus-field wc-local-pickup-plus-schedule-adjustment-field <?php echo sanitize_html_class( "wc-local-pickup-plus-{$this->id}-field" ); ?>">
			<input
				type="number"
				id="<?php echo esc_attr( $args['name'] . '_amount' ); ?>"
				name="<?php echo esc_attr( $args['name'] . '_amount' ); ?>"
				value="<?php echo max( 0, (int) $this->get_amount() ); ?>"
				style="max-width: 48px; text-align: right;"
				placeholder="0"
				step="1"
				min="0"
				<?php disabled( $args['disabled'], true, true ); ?>
			/>
			<select
				name="<?php echo esc_attr( $args['name'] . '_interval' ); ?>"
				id="<?php echo esc_attr( $args['name'] . '_interval' ); ?>"
				<?php disabled( $args['disabled'], true, true ); ?>>
				<?php $selected_interval = $this->get_interval(); ?>
				<?php foreach ( $this->get_intervals( true ) as $interval => $data ) : ?>
					<option value="<?php echo esc_attr( $interval ); ?>" <?php selected( $interval, $selected_interval, true ); ?>><?php echo strtolower( esc_html( $data['label'] ) ); ?></option>
				<?php endforeach; ?>
			</select>
			<?php echo ! empty( $args['desc_tip'] ) ? wc_help_tip( $args['desc_tip'] ) : ''; ?>
		</div>
		<?php

		return ob_get_clean();
	}


	/**
	 * Output a time adjustment input field HTML.
	 *
	 * @since 2.0.0
	 *
	 * @param array $args array of arguments
	 */
	public function output_field_html( array $args ) {

		echo $this->get_field_html( $args );
	}


}
