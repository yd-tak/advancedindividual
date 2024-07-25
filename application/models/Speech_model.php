<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\ApiCore\ApiException;
use Google\ApiCore\ValidationException;
// use getID3;

class Speech_model extends CI_Model {

    private $client;

    public function __construct()
    {
        parent::__construct();
        
        // Path to the service account JSON file
        $jsonPath = APPPATH . 'config/advin-service-account.json';
        // echo $jsonPath;
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $jsonPath);

        // Initialize the client with the JSON key file
        try {
            $this->client = new SpeechClient([
                'keyFilePath' => $jsonPath
            ]);
        } catch (ValidationException $e) {
            log_message('error', 'ValidationException: ' . $e->getMessage());
            show_error('Error initializing Google Cloud SpeechClient. ValidationException: ' . $e->getMessage());
        } catch (ApiException $e) {
            log_message('error', 'ApiException: ' . $e->getMessage());
            show_error('Error initializing Google Cloud SpeechClient. ApiException: ' . $e->getMessage());
        } catch (Exception $e) {
            log_message('error', 'General Exception: ' . $e->getMessage());
            show_error('Error initializing Google Cloud SpeechClient. Exception: ' . $e->getMessage());
        }
    }

    public function recognize_audio()
    {
        
        $config['upload_path']          = './assets/uploads/voices/';
        $config['allowed_types']        = '*';
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('audio'))
        {
            return ['error'=>$this->upload->display_errors()];
        }
        $audioFileName=$this->upload->data('file_name');
        
        $audioFilePath=FCPATH . 'assets/uploads/voices/'.$audioFileName;
        // Use getID3 to get the sample rate of the audio file
        // require_once(APPPATH . 'third_party/getid3/getid3.php'); // Ensure you have getid3 in third_party directory
        $getID3 = new getID3();
        $fileInfo = $getID3->analyze($audioFilePath);
        $sampleRate = $fileInfo['audio']['sample_rate'] ?? 16000; // Default to 16000 if not found

        log_message('info', 'Sample rate: ' . $sampleRate);

        // Get the contents of the audio file
        $audioContent = file_get_contents($audioFilePath);
        
            // set string as audio content
        $audio = (new RecognitionAudio())
            ->setContent($audioContent);

        // Set the configuration for the request
        // $config = new RecognitionConfig([
        //     'encoding' => RecognitionConfig\AudioEncoding::LINEAR16,
        //     'sample_rate_hertz' => $sampleRate,
        //     'language_code' => 'id-ID'
        // ]);
        // set config
        $config = (new RecognitionConfig())
            ->setEncoding(RecognitionConfig\AudioEncoding::LINEAR16)
            ->setSampleRateHertz($sampleRate)
            ->setLanguageCode('id-ID');
        $transcript='';
        try {
            $response = $this->client->recognize($config, $audio);
            foreach ($response->getResults() as $result) {
                $alternatives = $result->getAlternatives();
                $mostLikely = $alternatives[0];
                // $transcript = $mostLikely->getTranscript();
                $confidence = $mostLikely->getConfidence();
                $transcript .= $mostLikely->getTranscript() . "\n";
                // printf('Transcript: %s' . PHP_EOL, $transcript);
                // printf('Confidence: %s' . PHP_EOL, $confidence);
            }
        } catch (ApiException $e) {
            log_message('error', 'ApiException: ' . $e->getMessage());
            return ['error' => 'Error performing recognize request: ' . $e->getMessage()];
        } catch (Exception $e) {
            log_message('error', 'General Exception: ' . $e->getMessage());
            return ['error' => 'Error performing recognize request: ' . $e->getMessage()];
        }
        
        // $results = $response->getResults();


        // // Extract the transcript
        // $transcript = '';
        // foreach ($results as $result) {
        //     $alternatives = $result->getAlternatives();
        //     foreach ($alternatives as $alternative) {
        //         $transcript .= $alternative->getTranscript() . "\n";
        //     }
        // }

        // Close the client
        $this->client->close();

        log_message('info', 'Transcript: ' . $transcript);

        return ['transcript' => $transcript];
    }
}
