<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\StreamingRecognitionConfig;
use Google\Cloud\Speech\V1\StreamingRecognizeRequest;

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
    public function test_audio(){

        $speechClient=new SpeechClient();
        
        #local
        $audioFilePath=FCPATH . 'assets/uploads/voices/test4.wav';
        // $audioFilePath=base_url('assets/uploads/voices/audio.mp3');
        $audioContent = file_get_contents($audioFilePath);

        $getID3 = new getID3();
        $fileInfo = $getID3->analyze($audioFilePath);
        pre($fileInfo);
        // $uri=base_url('assets/uploads/voices/audio6.wav');
        // echo $uri;
        
        #google storage
        // $gcsURI = 'gs://cloud-samples-data/speech/brooklyn_bridge.raw';

        $audio = (new RecognitionAudio())
            // ->setUri($uri);
        ->setContent($audioContent);

        # The audio file's encoding, sample rate and language
        $config = new RecognitionConfig([
            'encoding' => AudioEncoding::LINEAR16,
            // 'sample_rate_hertz' => 16000,
            'language_code' => 'id-ID',
            'audio_channel_count'=>$fileInfo['audio']['channels']??1
        ]);

        # Instantiates a client
        $client = new SpeechClient();

        # Detects speech in the audio file
        $response = $client->recognize($config, $audio);

        # Print most likely transcription
        foreach ($response->getResults() as $result) {
            $alternatives = $result->getAlternatives();
            // pre($alternatives,1);
            $mostLikely = $alternatives[0];
            $transcript = $mostLikely->getTranscript();
            printf('Transcript: %s' . PHP_EOL, $transcript);
        }

        $client->close();
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
        
        $audioFilePath=base_url('assets/uploads/voices/'.$audioFileName);
        // $audioFilePath=base_url('assets/uploads/voices/recording6.wav');
        
        $getID3 = new getID3();
        $fileInfo = $getID3->analyze($audioFilePath);
        $sampleRate = $fileInfo['audio']['sample_rate'] ?? 44100; // Default to 16000 if not found
        $sampleRate=44100;

        log_message('info', 'Sample rate: ' . $sampleRate);

        // Get the contents of the audio file
        $audioContent = file_get_contents($audioFilePath);
        
            // set string as audio content
        $audio = (new RecognitionAudio())
            ->setContent($audioContent);

        // set config
        $config = (new RecognitionConfig())
            ->setEncoding(AudioEncoding::LINEAR16)
            ->setSampleRateHertz($sampleRate)
            ->setLanguageCode('id-ID');
        
        $strmConfig = new StreamingRecognitionConfig();
        $strmConfig->setConfig($config);

        $strmReq = new StreamingRecognizeRequest();
        $strmReq->setStreamingConfig($strmConfig);

        $strm = $this->client->streamingRecognize();
        $strm->write($strmReq);

        $strmReq = new StreamingRecognizeRequest();
        $strmReq->setAudioContent($audioContent);
        $strm->write($strmReq);

        $transcript='';
        try {
            #normal
            // $response = $this->client->recognize($config, $audio);
            // foreach ($response->getResults() as $result) {
            //     $alternatives = $result->getAlternatives();
            //     $mostLikely = $alternatives[0];
            //     $confidence = $mostLikely->getConfidence();
            //     $transcript .= $mostLikely->getTranscript() . "\n";
            // }

            //#long running
            // $operation = $this->client->longRunningRecognize($config, $audio);
            // $operation->pollUntilComplete();

            // if ($operation->operationSucceeded()) {
            //     $response = $operation->getResult();

            //     // each result is for a consecutive portion of the audio. iterate
            //     // through them to get the transcripts for the entire audio file.
            //     foreach ($response->getResults() as $result) {
            //         $alternatives = $result->getAlternatives();
            //         $mostLikely = $alternatives[0];
            //         // $transcript = $mostLikely->getTranscript();
            //         $confidence = $mostLikely->getConfidence();
            //         // printf('Transcript: %s' . PHP_EOL, $transcript);
            //         // printf('Confidence: %s' . PHP_EOL, $confidence);
            //         $transcript .= $mostLikely->getTranscript() . "\n";
            //     }
            // } else {
            //     print_r($operation->getError());
            // }
            foreach ($strm->closeWriteAndReadAll() as $response) {
                foreach ($response->getResults() as $result) {
                    foreach ($result->getAlternatives() as $alt) {
                        // printf("Transcription: %s\n", $alt->getTranscript());
                        $transcript.=$alt->getTranscript();
                    }
                }
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

        return ['transcript' => $transcript,'sampleRate'=>$sampleRate];
    }
}
