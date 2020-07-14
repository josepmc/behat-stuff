<?php

namespace Helper;

use stdClass;

$GLOBALS['sid_token'] = '';
/**
 * A quick and dirty mail client for guerrillamail.
 * Their API documentation here is stale: https://www.guerrillamail.com/GuerrillaMailAPI.html
 * You should only use the documentation from here: https://docs.google.com/document/d/1Qw5KQP1j57BPTDmms5nspe-QAjNEsNg8cQHpAAycYNM/edit?hl=en#!
 */
class Mail
{
    /**
     * Sends a new request to guerrilla mail
     */
    private function sendRequest($fun, $args = [])
    {
        $params = $args;
        $params['ip'] = "127.0.0.1";
        $params['agent'] = "Mozilla_foo_bar";
        $params['f'] = $fun;
        // This parameter is the only one needed to keep the session
        $params['sid_token'] = $GLOBALS['sid_token'];

        $url = "http://api.guerrillamail.com/ajax.php?". http_build_query($params);

        $response = file_get_contents($url);
        assert($response !== '', "Guerrilla Mail response's is null! An error occured.");
        $json = json_decode($response);
        $GLOBALS['sid_token'] = $json->sid_token;
        return $json;
    }
    /**
     * Returns a new email address
     */
    public function getEmail(): string
    {
        $response = $this->sendRequest("get_email_address");
        return $response->email_addr;
    }
    /**
     * Gets the new emails
     */
    public function getNewMail(): stdClass
    {
        $response = $this->sendRequest("check_email", ['seq' => 0]);
        $response->count = intval($response->count);
        return $response;
    }
}
