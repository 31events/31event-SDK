<?php

require_once 'Requests.php';
Requests::register_autoloader();

class ThirtyOneEvSDK {

    /**
     * @var int cURL's default timeout is too short
     */
    private $timeout = 99999999;

    /**
     * @var string Stores auth token for further requests
     */
    private $token;

    /**
     * @var string Base API URL
     */
    private $api;

    /**
     * @param string $api Base API URL to override
     */
    public function __construct($api = 'http://31events.com/api/index.cfm') {
        $this->api = $api;
    }

    /**
     * @param  string $username
     * @param string $password
     * @return array Parsed response
     */
    public function authencicate($username, $password) {
        $request = Requests::post(
            $this->api . '/authenticate',
            array('Content-Type' => 'application/json'),
            json_encode(array('username' => $username, 'password' => $password)),
            array('timeout' => $this->timeout)
        );
        $result = json_decode($request->body, true);
        $this->token = $result['TOKEN'];
        return $result;
    }

    /**
     * @param  int $event_id
     * @param  string $email
     * @return array Parsed response
     */
    public function eventSubscribe($event_id, $email) {
        $request = Requests::get(
            $this->api . '/event/' . $event_id . '/subscribe/' . $email,
            array(),
            array('timeout' => $this->timeout)
        );
        return json_decode($request->body, true);
    }

    /**
     * @param  int $event_id
     * @param array $list
     * @return array Parsed response
     */
    public function eventBulkSubscribe($event_id, $list) {
        $request = Requests::post(
            $this->api . '/event/' . $event_id . '/subscribe',
            array('Content-Type' => 'application/json', 'Token' => $this->token),
            json_encode(array('list' => $list)),
            array('timeout' => $this->timeout)
        );
        return json_decode($request->body, true);
    }

    /**
     * @param int $event_id
     * @return array Parsed response
     */
    public function eventSend($event_id) {
        $request = Requests::post(
            $this->api . '/event/' . $event_id,
            array('Token' => $this->token),
            array(),
            array('timeout' => $this->timeout)
        );
        return json_decode($request->body, true);
    }

    /**
     * @param string $event_title
     * @param string $event_subject
     * @param string $event_content
     * @param string $event_location
     * @param string $event_timezone
     * @param string $event_dateStart
     * @param string $event_dateEnd
     * @param string $event_reminder
     * @param string $event_issueTickets
     * @param string $event_ticketResponseContent
     * @param string $event_hostName
     * @param string $event_hostEmail
     * @param string $event_hostCompany
     * @param string $event_hostPhone
     * @return array Parsed response
     */
    public function eventCreate(
        $event_title,
        $event_subject,
        $event_content,
        $event_location,
        $event_timezone,
        $event_dateStart,
        $event_dateEnd,
        $event_reminder,
        $event_issueTickets,
        $event_ticketResponseContent,
        $event_hostName,
        $event_hostEmail,
        $event_hostCompany,
        $event_hostPhone
    ) {
        $request = Requests::post(
            $this->api . '/event',
            array('Content-Type' => 'application/json', 'Token' => $this->token),
            json_encode(
                array(
                    'event_title' => $event_title,
                    'event_subject' => $event_subject,
                    'event_content' => $event_content,
                    'event_location' => $event_location,
                    'event_timezone' => $event_timezone,
                    'event_dateStart' => $event_dateStart,
                    'event_dateEnd' => $event_dateEnd,
                    'event_reminder' => $event_reminder,
                    'event_issueTickets' => $event_issueTickets,
                    'event_ticketResponseContent' => $event_ticketResponseContent,
                    'event_hostName' => $event_hostName,
                    'event_hostEmail' => $event_hostEmail,
                    'event_hostCompany' => $event_hostCompany,
                    'event_hostPhone' => $event_hostPhone
                )
            ),
            array('timeout' => $this->timeout)
        );
        return json_decode($request->body, true);
    }

    /**
     * @param int $event_id
     * @param string $event_title
     * @param string $event_subject
     * @param string $event_content
     * @param string $event_location
     * @param string $event_timezone
     * @param string $event_dateStart
     * @param string $event_dateEnd
     * @param string $event_reminder
     * @param string $event_issueTickets
     * @param string $event_ticketResponseContent
     * @param string $event_hostName
     * @param string $event_hostEmail
     * @param string $event_hostCompany
     * @param string $event_hostPhone
     * @return array Parsed response
     */
    public function eventUpdate(
        $event_id,
        $event_title = null,
        $event_subject = null,
        $event_content = null,
        $event_location = null,
        $event_timezone = null,
        $event_dateStart = null,
        $event_dateEnd = null,
        $event_reminder = null,
        $event_issueTickets = null,
        $event_ticketResponseContent = null,
        $event_hostName = null,
        $event_hostEmail = null,
        $event_hostCompany = null,
        $event_hostPhone = null
    ) {
        $data = array(
            'event_title' => $event_title,
            'event_subject' => $event_subject,
            'event_content' => $event_content,
            'event_location' => $event_location,
            'event_timezone' => $event_timezone,
            'event_dateStart' => $event_dateStart,
            'event_dateEnd' => $event_dateEnd,
            'event_reminder' => $event_reminder,
            'event_issueTickets' => $event_issueTickets,
            'event_ticketResponseContent' => $event_ticketResponseContent,
            'event_hostName' => $event_hostName,
            'event_hostEmail' => $event_hostEmail,
            'event_hostCompany' => $event_hostCompany,
            'event_hostPhone' => $event_hostPhone
        );
        $request = Requests::put(
            $this->api . '/event/' . $event_id,
            array('Content-Type' => 'application/json', 'Token' => $this->token),
            json_encode(array_filter($data)),
            array('timeout' => $this->timeout)
        );
        return json_decode($request->body, true);
    }

    /**
     * @param int $event_id
     * @param string $email
     * @return array Parsed response
     */
    public function eventUnsubscribe($event_id, $email) {
        $request = Requests::get(
            $this->api . '/event/' . $event_id . '/unsubscribe/' . $email,
            array(),
            array('timeout' => $this->timeout)
        );
        return json_decode($request->body, true);
    }

    /**
     * @param int $event_id
     * @return array Parsed response
     */
    public function eventGet($event_id) {
        $request = Requests::get(
            $this->api . '/event/' . $event_id,
            array('Token' => $this->token),
            array('timeout' => $this->timeout)
        );
        return json_decode($request->body, true);
    }

    /**
     * @return array Parsed response
     */
    public function eventList() {
        $request = Requests::get(
            $this->api . '/event/list',
            array('Token' => $this->token),
            array('timeout' => $this->timeout)
        );
        return json_decode($request->body, true);
    }

    /**
     * @param  int $event_id
     * @return array Parsed response
     */
    public function eventDelete($event_id) {
        $request = Requests::delete(
            $this->api . '/event/' . $event_id,
            array('Token' => $this->token),
            array('timeout' => $this->timeout)
        );
        return json_decode($request->body, true);
    }

    /**
     * @param  int $event_id
     * @param string $response_type one of: "noreply", "accepted", "attended", "declined"
     * @return array Parsed response
     */
    public function eventResponses($event_id, $response_type) {
        $request = Requests::get(
            $this->api . '/event/' . $event_id . '/' . $response_type,
            array('Token' => $this->token),
            array('timeout' => $this->timeout)
        );
        return json_decode($request->body, true);
    }

    /**
     * @param int $customer_id
     * @return  array Parsed response
     */
    public function accountDelete($customer_id) {
        $request = Requests::delete(
            $this->api . '/account/' . $customer_id,
            array('Token' => $this->token),
            array('timeout' => $this->timeout)
        );
        return json_decode($request->body, true);
    }

    /**
     * @return  array Parsed response
     */
    public function accountList() {
        $request = Requests::get(
            $this->api . '/account/list',
            array('Token' => $this->token),
            array('timeout' => $this->timeout)
        );
        return json_decode($request->body, true);
    }

    /**
     * @param int $customer_id
     * @return  array Parsed response
     */
    public function accountGet($customer_id) {
        $request = Requests::get(
            $this->api . '/account/' . $customer_id,
            array('Token' => $this->token),
            array('timeout' => $this->timeout)
        );
        return json_decode($request->body, true);
    }

    /**
     * @param string $customer_firstName
     * @param string $customer_lastName
     * @param string $customer_email
     * @param string $customer_phone
     * @param string $customer_username
     * @param string $customer_password
     * @param string $customer_billingName
     * @param string $customer_billingAddress
     * @param string $customer_billingCity
     * @param string $customer_billingState
     * @param string $customer_billingZip
     * @param string $customer_timezone
     * @param string $customer_readytalkAccessCode
     * @param string $customer_readytalkPassCode
     * @param string $customer_active
     * @return  array Parsed response
     */
    public function accountCreate(
        $customer_firstName,
        $customer_lastName,
        $customer_email,
        $customer_phone,
        $customer_username,
        $customer_password,
        $customer_billingName,
        $customer_billingAddress,
        $customer_billingCity,
        $customer_billingState,
        $customer_billingZip,
        $customer_timezone,
        $customer_readytalkAccessCode,
        $customer_readytalkPassCode,
        $customer_active
    ) {
        $request = Requests::post(
            $this->api . '/account',
            array('Content-Type' => 'application/json', 'Token' => $this->token),
            json_encode(
                array(
                    'customer_firstName' => $customer_firstName,
                    'customer_lastName' => $customer_lastName,
                    'customer_email' => $customer_email,
                    'customer_phone' => $customer_phone,
                    'customer_username' => $customer_username,
                    'customer_password' => $customer_password,
                    'customer_billingName' => $customer_billingName,
                    'customer_billingAddress' => $customer_billingAddress,
                    'customer_billingCity' => $customer_billingCity,
                    'customer_billingState' => $customer_billingState,
                    'customer_billingZip' => $customer_billingZip,
                    'customer_timezone' => $customer_timezone,
                    'customer_readytalkAccessCode' => $customer_readytalkAccessCode,
                    'customer_readytalkPassCode' => $customer_readytalkPassCode,
                    'customer_active' => $customer_active
                )
            ),
            array('timeout' => $this->timeout)
        );
        return json_decode($request->body, true);
    }

    /**
     * @param int $account_id
     * @param string $customer_firstName
     * @param string $customer_lastName
     * @param string $customer_email
     * @param string $customer_phone
     * @param string $customer_username
     * @param string $customer_password
     * @param string $customer_billingName
     * @param string $customer_billingAddress
     * @param string $customer_billingCity
     * @param string $customer_billingState
     * @param string $customer_billingZip
     * @param string $customer_timezone
     * @param string $customer_readytalkAccessCode
     * @param string $customer_readytalkPassCode
     * @param string $customer_active
     * @return array Parsed response
     */
    public function accountUpdate(
        $account_id,
        $customer_firstName = null,
        $customer_lastName = null,
        $customer_email = null,
        $customer_phone = null,
        $customer_username = null,
        $customer_password = null,
        $customer_billingName = null,
        $customer_billingAddress = null,
        $customer_billingCity = null,
        $customer_billingState = null,
        $customer_billingZip = null,
        $customer_timezone = null,
        $customer_readytalkAccessCode = null,
        $customer_readytalkPassCode = null,
        $customer_active = null
    ) {
        $data = array(
            'customer_firstName' => $customer_firstName,
            'customer_lastName' => $customer_lastName,
            'customer_email' => $customer_email,
            'customer_phone' => $customer_phone,
            'customer_username' => $customer_username,
            'customer_password' => $customer_password,
            'customer_billingName' => $customer_billingName,
            'customer_billingAddress' => $customer_billingAddress,
            'customer_billingCity' => $customer_billingCity,
            'customer_billingState' => $customer_billingState,
            'customer_billingZip' => $customer_billingZip,
            'customer_timezone' => $customer_timezone,
            'customer_readytalkAccessCode' => $customer_readytalkAccessCode,
            'customer_readytalkPassCode' => $customer_readytalkPassCode,
            'customer_active' => $customer_active
        );
        $request = Requests::put(
            $this->api . '/account/' . $account_id,
            array('Content-Type' => 'application/json', 'Token' => $this->token),
            json_encode(array_filter($data)),
            array('timeout' => $this->timeout)
        );
        return json_decode($request->body, true);
    }

}