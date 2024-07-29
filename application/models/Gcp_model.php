<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Google\ApiCore\ApiException;
use Google\Apps\Meet\V2\Client\SpacesServiceClient;
use Google\Apps\Meet\V2\CreateSpaceRequest;
use Google\Apps\Meet\V2\Space;
use Google\Auth\Credentials\ServiceAccountCredentials;
// use getID3;

class Gcp_model extends CI_Model {

    private $client;
    private $service;

    public function __construct()
    {
        parent::__construct();

        $jsonPath = APPPATH . 'config/advin-service-account.json';
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $jsonPath);
    }

    public function create_space_sample()
    {
        $jsonPath = APPPATH . 'config/advin-service-account.json';
        // Create a client.
        $credentials = (new ServiceAccountCredentials(['https://www.googleapis.com/auth/meetings.space.readonly','https://www.googleapis.com/auth/meetings.space.created']
         ,$jsonPath,
         'advin-469@advin-430605.iam.gserviceaccount.com'
         ));
        // Create a client.
        $spacesServiceClient = new SpacesServiceClient(['credentials' => $credentials]);

        // $spacesServiceClient = new SpacesServiceClient();

        // Prepare the request message.
        $request = new CreateSpaceRequest();

        // Call the API and handle any network failures.
        try {
            /** @var Space $response */
            $response = $spacesServiceClient->createSpace($request);
            printf('Response data: %s' . PHP_EOL, $response->serializeToJsonString());
        } catch (ApiException $ex) {
            printf('Call failed with message: %s' . PHP_EOL, $ex->getMessage());
        }
    }
}
