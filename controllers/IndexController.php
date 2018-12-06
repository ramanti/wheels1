<?php
/**
 * extended class ServiceController
 * defines functions that affect on Inddexcontroller
 *
 * PHP verion  7.1.3
 *
 * @category   Class
 * @author     praveen <praveen@travelinsert.com>
 *
 * @version    0.1
 */
namespace App\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Http\Request;
use App\Services\WheelsService;
 
define('APIKEY', '123456789');

/**
 * IndexController Class
 *
 * This class is used for send and receive the XML from Wheesys API.
 * @filesource serviceController.php
 * @api Wheelsys API
 * @since 1.0
 */

class IndexController extends Controller
{
    /**
     * ValidateApi method
     *
     * to validate the apikey entered
     * @api Wheelsys API
     * @filesource servicecontroller.php
     *
     * @param $apikey is used to get the apikey
     *
     * @return json string
     **/
    public function validateApi($apikey)
    {
        if (APIKEY == $apikey) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * GetStation List
     *
     * This function is used to get all station list from the Wheelsys API
     * @api Wheelsys API
     * @filesource servicecontroller.php
     *
     * @param $apikey is used to get the apikey
     *
     * @return json string
     **/

    public function stationAction()
    {
        if (isset($_GET['apikey'])) {
            $apikey = $_GET['apikey'];
        }
        $validate = self::validateApi($apikey);
        if ($validate == true) {
            $station = WheelsService::station();
            //$station = $a->station();
        } else {
            $station = 'API key is not valid';
        }
        return $station;
    }

    /**
     * Get Price Quote List
     *
     * This function is used to get price quote list for rates and availability of the vehicles from the Wheelsys API
     * @api Wheelsys API
     * @filesource servicecontroller.php
     *
     * @param $apikey is used to get the apikey
     * @param $from is used to get the from date
     * @param $from_time is used to get the from time
     * @param $to is used to get the to date
     * @param $to_time  is used to get the to time
     * @param $pickup_station is used to get the pickup station code
     * @param $return_station is used to get the return station code
     * @param $pickup_point is used to get the pickup station point
     * @param $dropoff_point is used to get the return station point
     *
     * @return json string
     **/

    public function priceAction()
    {
        $data = array();
        $data['from'] = isset($_GET['from']) ? $_GET['from'] : '' ; //14/12/2018
        $data['from_time'] = isset($_GET['from_time']) ? $_GET['from_time'] : '' ; //1200
        $data['to'] = isset($_GET['to']) ? $_GET['to']: '' ; //18/12/2018
        $data['to_time'] = isset($_GET['to_time']) ? $_GET['to_time'] : '' ; //2200
        $data['pickup_station'] = isset($_GET['pickup_station']) ? $_GET['pickup_station'] : '' ; //A9K
        $data['return_station'] = isset($_GET['return_station']) ? $_GET['return_station'] : '' ; //A9K //optional variable
        $data['pickup_point'] = isset($_GET['pickup_point']) ? $_GET['pickup_point'] : '' ; //optional variable
        $data['dropoff_point'] = isset($_GET['dropoff_point']) ? $_GET['dropoff_point'] : '' ;

        if (isset($_GET['apikey'])) {
            $apikey = $_GET['apikey'];
        }
        $validate = self::validateApi($apikey);
        if ($validate == true) {
            $priceqoute = WheelsService::priceQuote($data);
        } else {
            $pricequote = 'API key is not valid';
        }
        return $priceqoute;
    }

    /**
     * Get Groups List
     *
     * This function is used to get the vehicle's model and group from the Wheelsys API
     * @api Wheelsys API
     * @filesource servicecontroller.php
     *
     * @param $apikey is used to get the apikey
     *
     * @return json string
     **/

    public function groupAction()
    {
        if (isset($_GET['apikey'])) {
            $apikey = $_GET['apikey'];
        }
        $validate = self::validateApi($apikey);
        if ($validate == true) {
            $groups = WheelsService::groups();
        } else {
            $groups = 'API key is not valid';
        }
        return $groups;
    }

    /**
     * Get Reservation
     *
     * This function is used to make the reservation of the vehicles from the Wheelsys API
     * @api Wheelsys API
     * @filesource servicecontroller.php
     *
     * @param $apikey is used to get the apikey
     * @param $from is used to get the from date
     * @param $from_time is used to get the from time
     * @param $to is used to get the to date
     * @param $to_time  is used to get the to time
     * @param string $pickup_station is used to get the pickup station code
     * @param $return_station is used to get the return station code
     * @param $customer_name is used to get the return station code
     * @param $voucherno is used to get the return station code
     * @param $pickup_info to get the pickup like If outside the office or ant staion details
     * @param $return_info to get the drop location/area details
     * @param $customer_email to get the customer's email id
     * @param $customer_phone to get the customer's phone number
     * @param $quoteref_id to get the  price quote id from pricequote details
     * @param $pickup_point to get the pick up point
     * @param $remarks to get the drop point
     * @param $option_code to get the options of vehicles
     *
     * @return json string
     **/

    public function reservationAction()
    {
        $data = array();
        $data['from'] = isset($_GET['from']) ?  $_GET['from'] : '' ; //14/12/2018
        $data['from_time'] = isset($_GET['from_time']) ? $_GET['from_time'] : '' ; //1200
        $data['to'] = isset($_GET['to']) ? $_GET['to'] : '' ; //18/12/2018
        $data['to_time'] = isset($_GET['to_time']) ? $_GET['to_time'] : '' ; //2200
        $data['pickup_station'] = isset($_GET['pickup_station']) ? $_GET['pickup_station'] : '' ; //A9K
        $data['return_station'] = isset($_GET['return_station']) ? $_GET['return_station'] : '' ; //A9K //optional variable
        $data['customer_name'] = isset($_GET['customer_name']) ? $_GET['customer_name'] : '' ;
        $data['group'] = isset($_GET['group']) ? $_GET['group'] : '' ;
        $data['voucherno'] = isset($_GET['voucherno']) ? $_GET['voucherno'] : '';
        $data['pickup_info'] = isset($_GET['pickup_info']) ? $_GET['pickup_info'] : '' ; //optional variable  /* If outside the office or Flight No */
        $data['return_info'] = isset($_GET['return_info']) ? $_GET['return_info'] : '' ; //optional variable  /* If outside the office or any specific area */
        $data['customer_email'] = isset($_GET['customer_email']) ? $_GET['customer_email'] : ''; //optional variable
        $data['customer_phone'] = isset($_GET['customer_phone']) ? $_GET['customer_phone'] : ''; //optional variable
        $data['quoteref_id'] = isset($_GET['quoteref_id']) ? $_GET['quoteref_id'] : '' ; //optional variable /* Your Price Quote ID */
        $data['pickup_point'] = isset($_GET['pickup_point']) ? $_GET['pickup_point'] : ''; //optional variable
        $data['dropoff_point'] = isset($_GET['dropoff_point']) ? $_GET['dropoff_point'] : ''; //optional variable
        $data['remarks'] = isset($_GET['remarks']) ? $_GET['remarks'] : ''; //optional variable
        $data['option_code'] = isset($_GET['option_code']) ? $_GET['option_code'] : '' ; //optional variable /* options for the vehicles */
        if (isset($_GET['apikey'])) {
            $apikey = $_GET['apikey'];
        }
        $validate = self::validateApi($apikey);
        if ($validate == true) {
            $reservation = WheelsService::reservation($data);
        } else {
            $reservation =  'API key is not valid';
        }
        return $reservation;
    }

    /**
     * Get expresscheckout details
     *
     * This function is used to get check to provide advance customer details such as license number & identification
     * to speed up car delivery.
     * Express information can be set even if the reservation is at on-request statusf from Wheelsys API
     *
     * @api Wheelsys API
     * @filesource servicecontroller.php
     * @param $apikey is used to get the apikey
     * @param string $post_string is used for collect the XML request
     *
     * @return json sting
     **/

    public function expressCheckoutAction()
    {
        $data = array();
        $data['refno'] = $_GET['refno']; // AK912 sample value
        $data['irn'] = $_GET['irn']; // 9400907 sampl vlaue
        $apikey = '';
        if (isset($_GET['apikey'])) {
            $apikey = $_GET['apikey'];
        }
        $validate = self::validateApi($apikey);
        if ($validate == true) {
            $expressCheckout = WheelsService::expressCheckout($data);
        } else {
            $expressCheckout =  'API key is not valid';
        }
        return $expressCheckout;
    }
    /**
     * Get Amend Reservation  details
     *
     * This function is used to make the amendment for the reservation of the vehicles from the Wheelsys API
     * @api Wheelsys API
     * @filesource servicecontroller.php
     *
     * @param $apikey is used to get the apikey
     * @param $from is used to get the from date
     * @param $from_time is used to get the from time
     * @param $to is used to get the to date
     * @param $to_time  is used to get the to time
     * @param $pickup_station is used to get the pickup station code
     * @param $return_station is used to get the return station code
     * @param $customer_name is used to get the return station code
     * @param $voucherno is used to get the return station code
     * @param $irn is used to get the return irn
     * @param $refno is used to get the return refenrce number
     * @param $customer_name is used to get the return station code
     * @param $pickup_info to get the pickup like If outside the office or ant staion details
     * @param $return_info to get the drop location/area details
     * @param $customer_email to get the customer's email id
     * @param $customer_phone to get the customer's phone number
     * @param $quoteref_id to get the  price quote id from pricequote details
     * @param $pickup_point to get the pick up point
     * @param $remarks to get the drop point
     * @param $option_code to get the options of vehicles
     *
     * @return json string
     **/

    public function amendReservationAction()
    {
        $data = array();
        $data['from'] = isset($_GET['from']) ? $_GET['from'] : '' ; //14/12/2018
        $data['from_time'] = isset($_GET['from_time']) ? $_GET['from_time'] : '' ; //1200
        $data['to'] = isset($_GET['to']) ? $_GET['to'] : '' ; //18/12/2018
        $data['to_time'] = isset($_GET['to_time']) ? $_GET['to_time'] : '' ; //2200
        $data['pickup_station'] = isset($_GET['pickup_station']) ? $_GET['pickup_station'] : '' ; //A9K
        $data['return_station'] = isset($_GET['return_station']) ? $_GET['return_station'] : '' ; //A9K
        $data['customer_name'] = isset($_GET['customer_name']) ? $_GET['customer_name'] : '' ;
        $data['group'] = isset($_GET['group']) ? $_GET['group'] : '' ;
        $data['voucherno'] = isset($_GET['voucherno']) ? $_GET['voucherno'] : '' ;
        $data['irn'] =  isset($_GET['irn']) ? $_GET['irn'] : '' ;
        $data['refno'] = isset($_GET['refno']) ? $_GET['refno'] : '' ;
        $data['pickup_info'] = isset($_GET['pickup_info']) ? $_GET['pickup_info'] : '' ; //optional variable  /* If outside the office or Flight No */
        $data['return_info'] = isset($_GET['return_info']) ? $_GET['return_info'] : '' ; //optional variable  /* If outside the office or any specific area */
        $data['customer_email'] = isset($_GET['customer_email']) ? $_GET['customer_email'] : '' ; //optional variable
        $data['customer_phone'] = isset($_GET['customer_phone']) ? $_GET['customer_phone'] : ''; //optional variable
        $data['quoteref_id'] = isset($_GET['quoteref_id']) ? $_GET['quoteref_id'] : ''; //optional variable /* Your Price Quote ID */
        $data['pickup_point'] = isset($_GET['pickup_point']) ? $_GET['pickup_point'] :''; //optional variable
        $data['dropoff_point'] = isset($_GET['dropoff_point']) ? $_GET['dropoff_point'] : '' ; //optional variable
        $data['remarks'] = isset($_GET['remarks']) ? $_GET['remarks'] : '' ; //optional variable
        $data['option_code'] = isset($_GET['option_code']) ? $_GET['option_code'] : '' ; //optional variable /* options for the vehicles */
        if (isset($_GET['apikey'])) {
            $apikey = $_GET['apikey'];
        }
        $validate = self::validateApi($apikey);
        if ($validate == true) {
            $amend = WheelsService::amendReservation($data);
        } else {
            $amend =  'API key is not valid';
        }
        return $amend;
    }

    /**
     * Get cancel Reservation  details
     *
     * This function is used to cancel reservation of the vehicles from the Wheelsys API
     * @api Wheelsys API
     * @filesource servicecontroller.php
     *
     * @param $apikey is used to get the apikey
     * @param $irn is used to get the irn for cancellaiton
     * @param $refno is used to get the for  cancellation
     *
     * @return json string
     **/

    public function cancelReservationAction()
    {
        $data = array();
        $data['irn'] =  $_GET['irn'];
        $data['refno'] = $_GET['refno'];
        $apikey = '';
        if (isset($_GET['apikey'])) {
            $apikey = $_GET['apikey'];
        }
        $validate = self::validateApi($apikey);
        if ($validate == true) {
            $cancellation = WheelsService::cancelReservation($data);
        } else {
            $cancellation = 'API key is not valid';
        }
        return $cancellation;
    }

    /**
     * Get Reservation details
     *
     * This function is used to get reservation  details of reserved vehicle from the Wheelsys API
     * @api Wheelsys API
     * @filesource servicecontroller.php
     *
     * @param $apikey is used to get the apikey
     * @param $irn is used to get the irn for reservatin details
     * @param $refno is used to get the refno for reservation details
     *
     * @return json string
     **/

    public function readReservationAction()
    {
        $data = array();
        $data['irn'] =  $_GET['irn'];
        $data['refno'] = $_GET['refno'];
        $apikey = '';
        if (isset($_GET['apikey'])) {
            $apikey = $_GET['apikey'];
        }
        $validate = self::validateApi($apikey);
        if ($validate == true) {
            $readReservation = WheelsService::readReservation($data);
        } else {
            $readReservation = 'API key is not valid';
        }
        return $readReservation;
    }

    /**
     * Get vehicle options
     *
     * This function is used to get all optiona which the vehicle has from the Wheelsys API
     * @api Wheelsys API
     * @filesource servicecontroller.php
     *
     * @param $apikey is used to get the apikey
     *
     * @return void
     **/

    public function optionAction()
    {
        if (isset($_GET['apikey'])) {
            $apikey = $_GET['apikey'];
        }
        if (APIKEY == $apikey) {
            $options = WheelsService::option();
        } else {
            $options = 'API key is not valid';
        }
        return $options;
    }
}
