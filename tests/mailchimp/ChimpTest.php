<?php

class UserTest extends PHPUnit_Framework_TestCase
{
	public function testUsers()
	{
		$mailchimp = new \mailchimp\MailchimpConnector(APIKEY_TEST);
		$list0 = $mailchimp->getLists(MAILINGLIST_ID);
		$chimps = $list0->getUsers();
	}
}

