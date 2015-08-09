<?php

class MailinglistTest extends PHPUnit_Framework_TestCase
{
	public function testAllLists()
	{
		$mailchimp = new \mailchimp\MailchimpConnector(APIKEY_TEST);
		$mailingList = $mailchimp->getLists();
		$this->assertCount(MAILINGLIST_COUNT, $mailingList);
		$this->assertContainsOnlyInstancesOf("\Mailchimp\MailingList", $mailingList);
	}

	public function getOneList()
	{
		$mailchimp = new \mailchimp\MailchimpConnector(APIKEY_TEST);
		$list0 = $mailchimp->getLists(MAILINGLIST_NAME);
		$this->assertNotNull($list0);
		$this->assertInstanceOf("\Mailchimp\MailingList", $list0);
		$this->assertEquals(MAILINGLIST_ID, $list0->id);
		$this->assertEquals(MAILINGLIST_NAME, $list0->name);
		$list0 = $mailchimp->getLists(MAILINGLIST_NAME);
		$this->assertNotNull($list0);
		$this->assertInstanceOf("\Mailchimp\MailingList", $list0);
		$this->assertEquals(MAILINGLIST_ID, $list0->id);
		$this->assertEquals(MAILINGLIST_NAME, $list0->name);
		$this->assertNull($mailchimp->getLists("fail"));
	}

}

