<?php

class RM_Stripe_Service implements RM_Gateway_Service
{
    private $paypal;
    private $options;
    private $currency;

    function __construct() {
        $this->options= new RM_Options();
        $this->currency = $this->options->get_value_of('currency');
    }



    function setOptions($options) {
        $this->options = $options;
    }

    public function cancel() {

    }
    
    public function convert_price_into_lowest_unit($price, $currency)
    {
        switch(strtoupper($currency))
        {
            case 'BIF':
            case 'DJF':
            case 'JPY':
            case 'KRW':
            case 'PYG':
            case 'VND':
            case 'XAF':
            case 'XPF':
            case 'CLP':
            case 'GNF':
            case 'KMF':
            case 'MGA':
            case 'RWF':
            case 'VUV':
            case 'XOF':
                return $price;
                
            default:
                return $price*100;
        }
    }

    public function charge($data,$pricing_details) {
        $curr_date = RM_Utilities::get_current_time();
        $stripe_api_key = $this->options->get_value_of('stripe_api_key');
        
        if($stripe_api_key == null)
            return false;
        
        if($pricing_details->total_price <=0.0)
            return true;            //Zero amount case.
        
        $invoice = (string) date("His") . rand(1234, 9632);
        
        $global_options= new RM_Options();
        // Get the credit card details submitted by the form
        $error = '';
        $success = '';
        
        $retdata=array();
        $retdata['html'] = "";
        $retdata['status']= "";
        // Create the charge on Stripe's servers - this will charge the user's card
        $items= array();
        foreach($pricing_details->billing as $detail){
            if(isset($item->qty))
                $items[]= $detail->label." x ".$qty;
            else
                $items[]= $detail->label;
        }
        $response='';
        $items_str= implode(', ',$items);
        try{
        	\Stripe\Stripe::setApiKey($stripe_api_key); //sk_test_GsT4d690JZzbFk48w0GhsrIX
        	$charge = \Stripe\Charge::create(
            array(
                "amount" => $this->convert_price_into_lowest_unit($pricing_details->total_price, $this->currency), // amount in cents
                "currency" => strtolower($this->currency),
                "source" => $data->stripeToken,
                "receipt_email" => $data->user_email,
                "description" => $items_str
            ));
	        $response= $charge->getLastResponse();
	        $response_body= json_decode($response->body);
        }
        
        catch (\Stripe\Error\InvalidRequest $e) {
                $retdata['html'] = "Error: ".$e->getMessage();
                $retdata['status'] = 'do_not_redirect';
                if(!$response || !isset($response->body))
                    $log = array("exception_message" => $e->getMessage(), "exception_code" => $e->getCode());
                else
                    $log = json_decode($response->body, true);

                $log_entry_id = RM_DBManager::insert_row('PAYPAL_LOGS', array('submission_id' => $data->submission_id,
                    'form_id' => $data->form_id,
                    'txn_id' => '',
                    'status' => 'Card Declined',
                    'invoice' => $invoice,
                    'total_amount' => $pricing_details->total_price,
                    'currency' => $this->currency,
                    'log' => maybe_serialize($log),
                    'posted_date' => $curr_date,
                    'pay_proc' => 'stripe',
                    'bill' => maybe_serialize($pricing_details)), array('%d', '%d', '%s', '%s', '%s', '%f', '%s', '%s', '%s', '%s', '%s'));
                return $retdata;
		} 
		catch(\Stripe\Error\Card $e){
                    $retdata['html'] = "Error: ".$e->getMessage();
                    $retdata['status'] = 'do_not_redirect';
                    
                    if(!$response || !isset($response->body))
                        $log = array("exception_message" => $e->getMessage(), "exception_code" => $e->getCode(), "stripe_code" => $e->getStripeCode());
                    else
                        $log = json_decode($response->body, true);
                    
			$log_entry_id = RM_DBManager::insert_row('PAYPAL_LOGS', array('submission_id' => $data->submission_id,
                'form_id' => $data->form_id,
                'txn_id' => '',
                'status' => 'Card Declined',
                'invoice' => $invoice,
                'total_amount' => $pricing_details->total_price,
                'currency' => $this->currency,
                'log' => maybe_serialize($log),
                'posted_date' => $curr_date,
                'pay_proc' => 'stripe',
                'bill' => maybe_serialize($pricing_details)), array('%d', '%d', '%s', '%s', '%s', '%f', '%s', '%s', '%s', '%s', '%s'));
                return $retdata;
		}

        if($response->code=="200"){
            $log_entry_id = RM_DBManager::insert_row('PAYPAL_LOGS', array('submission_id' => $data->submission_id,
                'form_id' => $data->form_id,
                'txn_id' => $response_body->balance_transaction,
                'status' => $response_body->status,
                'invoice' => $invoice,
                'total_amount' => $pricing_details->total_price,
                'currency' => $this->currency,
                'log' => maybe_serialize(json_decode($response->body, true)),
                'posted_date' => $curr_date,
                'pay_proc' => 'stripe',
                'bill' => maybe_serialize($pricing_details)), array('%d', '%d', '%s', '%s', '%s', '%f', '%s', '%s', '%s', '%s', '%s'));
            return $retdata;
        }
        return false;
    }

    public function refund() {
        
    }

    public function subscribe() {
        
    }

}

