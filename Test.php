<?php

require_once 'ThirtyOneEvSDK.php';

class Test extends PHPUnit_Framework_TestCase {

    /**
     * @var $sdk ThirtyOneEvSDK SDK instance
     */
    private $sdk;

    /**
     * Authenticates a user. Executed before each test.
     */
    public function setUp() {
        $this->sdk = new ThirtyOneEvSDK();
        $result = $this->sdk->authencicate('test', 'test');
        $this->assertArrayHasKey('TOKEN', $result);
    }

    /**
     * Tests subscription for an event.
     */
    public function testEventSubscribe() {
        $result = $this->sdk->eventSubscribe(3718, 'test@test.com');
        $this->assertArrayHasKey('MESSAGE', $result);
    }

    /**
     * Tests bulk subscription for an event.
     */
    public function testEventBulkSubscribe() {
        $result = $this->sdk->eventBulkSubscribe(
            3719,
            array(
                array(
                    'recipient_firstName' => 'Test Name',
                    'recipient_lastName' => 'Test Lname',
                    'recipient_company' => 'Test Company',
                    'recipient_phoneNumber' => '9999999999',
                    'recipient_email' => 'test@test.com',
                ),
                array(
                    'recipient_firstName' => 'Test Name2',
                    'recipient_lastName' => 'Test Lname2',
                    'recipient_company' => 'Test Company2',
                    'recipient_phoneNumber' => '9999999990',
                    'recipient_email' => 'test2@test2.com',
                ),
            )
        );
        $this->assertArrayHasKey('MESSAGE', $result);
    }

    /**
     * Tests event creation.
     */
    public function testEventCreate() {
        $result = $this->sdk->eventCreate(
            "Test Title",
            "Test Subj",
            "Test Content",
            "Test Location",
            "US-Mountain",
            "03/31/2014 12:00",
            "04/01/2014 12:00",
            5,
            0,
            "",
            "",
            "",
            "",
            ""
        );
        $this->assertArrayHasKey('EVENT_ID', $result);
    }

    /**
     *  Tests event updating.
     */
    public function testEventUpdate() {
        $result = $this->sdk->eventUpdate(
            3719,
            "Test Title"
        );
        $this->assertArrayHasKey('EVENT_ID', $result);
    }

    /**
     *  Tests unsubscribing from an event.
     */
    public function testEventUnsubscribe() {
        $result = $this->sdk->eventUnsubscribe(3718, 'test@test.com');
        $this->assertArrayHasKey('MESSAGE', $result);
    }

    /**
     * Tests sending an event.
     */
    public function testEventSend() {
        $result = $this->sdk->eventSend(3719);
        $this->assertArrayHasKey('EVENT_ID', $result);
    }

    /**
     * Tests fetching an event.
     */
    public function testEventGet() {
        $result = $this->sdk->eventGet(3719);
        $this->assertArrayHasKey('event_id', $result);
    }

    /**
     *  Tests fetching event responses.
     */
    public function testEventResponses() {
        $result = $this->sdk->eventResponses(3718, 'noreply');
        if (count($result)) {
            $this->assertArrayHasKey('recipient_email', $result[0]);
        }
    }

    /**
     *  Tests fetching event list.
     */
    public function testEventList() {
        $result = $this->sdk->eventList();
        if (count($result)) {
            $this->assertArrayHasKey('event_id', $result[0]);
        }
    }

    /**
     *  Tests deleting of an event.
     */
    public function testEventDelete() {
        $result = $this->sdk->eventDelete(3718);
        $this->assertArrayHasKey('EVENT_ID', $result);
    }

    /**
     *  Tests fetching an account.
     */
    public function testAccountGet() {
        $result = $this->sdk->accountGet(1048);
        $this->assertArrayHasKey('customer_id', $result);
    }

    /**
     *  Tests fetching account list.
     */
    public function testAccountList() {
        $result = $this->sdk->accountList();
        if (count($result)) {
            $this->assertArrayHasKey('customer_id', $result[0]);
        }
    }

    /**
     *  Tests deleting of an account.
     */
    public function testAccountDelete() {
        $result = $this->sdk->accountDelete(1048);
        $this->assertArrayHasKey('CUSTOMER_ID', $result);
    }

    /**
     * Tests account creation
     */
    public function testAccountCreate() {
        $result = $this->sdk->accountCreate(
            "Test Fname",
            "Test Lname",
            "test@test.com",
            "9999999999",
            "test_customer",
            "test_password",
            "Test Bname",
            "Test Address",
            "Test City",
            "Test State",
            "Test Zip",
            "US-Mountain",
            "",
            "",
            1
        );
        $this->assertArrayHasKey('CUSTOMER_ID', $result);
    }

    /**
     *  Tests deleting an account.
     */
    public function testAccountUpdate() {
        $result = $this->sdk->accountUpdate(
            1048,
            "Test Fname"
        );
        $this->assertArrayHasKey('CUSTOMER_ID', $result);
    }

}
