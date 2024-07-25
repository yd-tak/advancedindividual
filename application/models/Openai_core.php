<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// use OpenAI;
class Openai_core extends CI_Model {
    private $_apikey='';
    private $_assistant_id='';
    private $_thread_id='';
    public function __construct(){
        parent::__construct();
        $this->_apikey=getSetting('openai_key');
        $this->client = OpenAI::client($this->_apikey);
        $this->_cv_parser='asst_XgaImoNF9BpJmEjFEGVZscdV';
        $this->_search_data='asst_3JoUdTy2CmHc8QfFo2C3tZfG';
    }
    public $_cv_parser_prompt='You are a HR Admin whose job is to read through a candidate CV in raw text string format and summarize it into structured JSON, here is the JSON format that you must parse it to:
        {
        "firstname":"","lastname":"","birth_date":"yyyy-mm-dd","current_residency":"","age":"","marriage_status":"Single/Married/Divorced","gender":"Male/Female",
        "education_history":[{"degree":"High School/Vocational School/Diploma/Bachelor/Master/Doctorate","institution_name":"","from_year":"yyyy","to_year":"yyyy","field_of_study":"","gpa":"","status_of_enrollment":"DropOut/Ongoing/Graduated","achievements":""}],
        "work_history":[{"company_name":"","from_year":"yyyy","to_year":"yyyy","job_position":"","responsibilities":"","salary":"","reason_of_resignment":"","achievements":""}],
        "technical_skills":[""],
        "expected_salary":"","strong_qualities":"","weak_qualities":"","reason_to_hire":"",
        "professional_certification":[{"certification":"","certified_year":"","certification_number":""}]
        }';
    public function save_assistant($assistant_id){
        $assistant = $this->client->assistants()->retrieve($assistant_id);
        $this->db->set([
            'id'=>$assistant->id,
            'object'=>$assistant->object,
            'createdAt'=>$assistant->createdAt,
            'name'=>$assistant->name,
            'instructions'=>$assistant->instructions,
            'model'=>$assistant->model,
            'description'=>$assistant->description,
            'tools'=>json_encode($assistant->tools),
            'fileIds'=>json_encode($assistant->fileIds),
            'metadata'=>json_encode($assistant->metadata)
        ])->insert('ai_assistant');
        return $assistant;
    }
    public function set_assistant($assistant_id){
        $this->_assistant_id=$assistant_id;
    }
    public function set_thread($thread_id){
        $this->_thread_id=$thread_id;
    }
    private function _create_thread(){
        $thread=$this->client->threads()->create([]);
        // pre($thread);
        $this->db->set([
            'id'=>$thread->id,
            'object'=>$thread->object,
            'createdAt'=>$thread->createdAt,
            'metadata'=>json_encode($thread->metadata)
        ])->insert('ai_thread');
        $this->_thread_id=$thread->id;
        return $thread;
    }
    private function _create_message($message_content,$thread_id=false){
        if(!$thread_id){
            $thread_id=$this->_thread_id;
        }
        $message=$this->client->threads()->messages()->create($this->_thread_id,[
            'role'=>'user',
            'content'=>$message_content
        ]);
        return $message;
    }
    public function _get_messages($thread_id=false){
        if(!$thread_id){
            $thread_id=$this->_thread_id;
        }
        $messages=$this->client->threads()->messages()->list($thread_id);
        return $messages->data;
    }
    private function _get_lastmessage($thread_id=false){
        if(!$thread_id){
            $thread_id=$this->_thread_id;
        }
        $messages=$this->client->threads()->messages()->list($thread_id);
        return $messages->data[count($messages->data)-1]->content[0]->text->value;
    }
    private function _run_thread($thread_id=false,$assistant_id=false){
        if(!$thread_id)
            $thread_id=$this->_thread_id;
        if(!$assistant_id)
            $assistant_id=$this->_assistant_id;
        
        $run=$this->client->threads()->runs()->create(
            $thread_id,
            [
                'assistant_id'=>$assistant_id
            ]
        );
        while(true){
            sleep(5);
            $run=$this->client->threads()->runs()->retrieve(
                $thread_id,
                $run->id
            );
            if($run->status=='completed'){
                break;
            }
        }
        $run->messages=$this->_get_messages();
        $lastmessage='';
        foreach($run->messages as $row){
            if($row->role=='assistant'){
                $lastmessage.=$row->content[0]->text->value;
            }
            else{
                break;
            }
        }
        $run->lastmessage=$lastmessage;
        return $run;
    }
    public function run_cv_to_json(){
        
    }
    public function run_cv_json_restructure(){
        
    }
    public function run_extract_cv($cv_content){
        $thread=$this->_create_thread();
        $this->run_text_normalizer($cv_content);
    }
    public function create_tester($testname,$testprompt,$interviewlang){
        $testprompt.="

            Conduct the test in ".$interviewlang." Language.
        ";
        $assistant = $this->client->assistants()->create([
            'instructions' => $testprompt,
            'name' => 'AI '.$testname.' Tester',
            'tools' => [
                [
                    'type' => 'code_interpreter',
                ],
            ],
            'model' => 'gpt-4-turbo'
        ]);
        $this->db->set([
            'id'=>$assistant->id,
            'object'=>$assistant->object,
            'createdAt'=>$assistant->createdAt,
            'name'=>$assistant->name,
            'instructions'=>$assistant->instructions,
            'model'=>$assistant->model,
            'description'=>$assistant->description,
            'tools'=>json_encode($assistant->tools),
            'fileIds'=>json_encode($assistant->fileIds),
            'metadata'=>json_encode($assistant->metadata)
        ])->insert('ai_assistant');
        $this->_assistant_id=$assistant->id;
        return $assistant->id;
    }
    public function create_test($candidatename,$testname){
        //create a thread
        $thread=$this->_create_thread();
        //create a message for a candidate
        $content="Hi my name is ".$candidatename.". I am here for the ".$testname.".";
        $this->_create_message($content);
        $run=$this->_run_thread();
        return $run;
    }

    public function create_interviewer($jobtitle,$company,$jobdesc,$interviewlang){
        $assistant = $this->client->assistants()->create([
            'instructions' => 'You are an expert HR Recruiter with 10+ years in Recruitment. You are tasked to interview a candidate for a '.$jobtitle.' position at '.$company->name.'. '.$company->name.' is a '.$company->industry.' operating in '.$company->country.'. Conduct the interview in '.$interviewlang.' language.
                You have 4 main task, which are:

                A. First is to validate their work experience, you need to check and understand whether the candidate are truthful about their work experience they put in CV, do not ask them outright if they are being truthful or not, instead do this by asking questions on their job details. Ask this question one by one for each of their job experience, i.e. the candidate have 4 job experience, ask about the first one, then once the candidate reply, ask about the second one, etc. 
                
                B. Second, ask these questions to the candidate:
                    - Strong and weak qualities
                    - Why '.getCompany('name').' should hire them
                    - Expected salary

                C. Third you need to ask 3 technical questions relating to a '.$jobtitle.' position in a '.$company->industry.' company and score their answer.

                D. Finally you need to ask 3 question to evaluate and score their personality.

                Please ask these questions one by one and ensure you receive an answer for each questions before moving to the next question. If the candidate misses or does not answer a question, politely prompt them to provide the information again and again until it is answered.
                
                Once you have had all the information, you must summarize the candidate data that you have collected in JSON FORMAT, date data must be in yyyy-mm-dd format, information about numbers or salary must be in numeric format, also in your JSON you MUST add 3 elements:
                1. A score from 0 (least suitable) - 100 (most suitable) on how suitable do you think the candidate is, from candidate data, technical questions and personality questions you have acquired. BE HARSH on your scoring. "suitable_score"
                2. A Score on their grammars & vocabulary from 0 (bad grammar) - 100 (excellent grammar), BE HARSH on your scoring. "grammar_vocab_score"
                3. A Score from 0 (least likely) - 3 (most likely) on how likely the candidate is answering the question using AI tools. BE SUSPICIOUS on your scoring and name it "ai_probability". Follow this scoring matrix:
                    - 0: Not using any AI Tools
                    - 1: Use AI Tools for at least 10 percent of the question
                    - 2: Use AI Tools for at least 30 percent of the question
                    - 3: Use AI Tools for at least 50 percent of the question

                Once you have summarized, output me the JSON response only, follow this JSON format and do not append or prepend any text outside of the JSON response:

                {
                    "work_evaluation":[
                        {
                            "workexps_id":"",
                            "evaulation":"",
                            "score":""
                        }
                    ],
                    "expected_salary":"",
                    "strong_qualities":[
                        ""
                    ],
                    "weak_qualities":[
                        ""
                    ],
                    "reason_to_hire":"",
                    "technical_question":[
                        {
                            "question":"",
                            "answer":"",
                            "score":""
                        }
                    ],
                    "personality_question":[
                        {
                            "question":"",
                            "answer":"",
                            "evaluation":"",
                            "score":""
                        }
                    ],
                    "suitable_score":"",
                    "grammar_vocab_score":"",
                    "ai_probability":""
                }',
            'name' => 'AI Interviewer Rev.2',
            'tools' => [
                [
                    'type' => 'code_interpreter',
                ],
            ],
            'model' => 'gpt-4-turbo',
        ]);
        $this->db->set([
            'id'=>$assistant->id,
            'object'=>$assistant->object,
            'createdAt'=>$assistant->createdAt,
            'name'=>$assistant->name,
            'instructions'=>$assistant->instructions,
            'model'=>$assistant->model,
            'description'=>$assistant->description,
            'tools'=>json_encode($assistant->tools),
            'fileIds'=>json_encode($assistant->fileIds),
            'metadata'=>json_encode($assistant->metadata)
        ])->insert('ai_assistant');
        $this->_assistant_id=$assistant->id;
        return $assistant->id;
    }
    public function create_interview($candidatename,$cvdata){
        //create a thread
        $thread=$this->_create_thread();
        //create a message for a candidate
        $content="Hi my name is ".$candidatename.". I am here for the interview. Here is my CV Data in JSON: ".$cvdata;
        $this->_create_message($content);
        $run=$this->_run_thread();
        return $run;
        // $lastmessage=$this->_get_lastmessage();

        // return [
        //     'threadid'=>$thread->id,
        //     'lastmessage'=>$lastmessage
        // ];
    }
    public function do_chat($system,$request,$model='gpt-4-turbo'){
        $response = $this->client->chat()->create([
            'model' => $model,
            'messages' => [
                ['role'=>'system','content'=>$system],
                ['role' => 'user', 'content' => $request],
            ],
        ]);
        $answer='';
        foreach ($response->choices as $result) {
            $answer.=$result->message->content;
        }
        $answer=str_replace("\n", "<br>", $answer);
        return $answer;
    }
    public function do_chatjson($system,$request,$model='gpt-4-turbo'){
        $response = $this->client->chat()->create([
            'model' => $model,
            'messages' => [
                ['role'=>'system','content'=>$system],
                ['role' => 'user', 'content' => $request],
            ],
        ]);
        $answer='';
        foreach ($response->choices as $result) {
            $answer.=$result->message->content;
        }
        // $answer=str_replace("\n", "<br>", $answer);
        $json=$this->check_for_json($answer);
        return $json;
    }
    public function run_message($content){
        $this->_create_message($content);
        $run=$this->_run_thread();
        $json_lastmessage=$this->check_for_json($run->lastmessage);
        if($json_lastmessage){
            $run->json_lastmessage=json_decode($json_lastmessage);
        }
        return $run;
        // $lastmessage=$this->_get_lastmessage();

        // return $lastmessage;
    }
    public function searchData($datas,$description){
        $this->set_assistant($this->_search_data);
        $thread=$this->_create_thread();
        $run=$this->run_message("
            List of Datas: ".json_encode($datas).".
            Search Description: $description
        ");
        // pre($run)
        return $run;
    }
    public function parseCV($cvtext){
        $this->set_assistant($this->_cv_parser);
        $thread=$this->_create_thread();
        $run=$this->run_message($cvtext);
        
        return $run;
    }
    public function check_for_json($fullstring){
        $pattern = '/\{(?:[^{}]|(?R))*\}/';

        // Find and extract the JSON part of the string
        preg_match($pattern, $fullstring, $matches);

        // Check if a match was found and output it
        if (isset($matches[0])) {
            $json = $matches[0];
            return $json;
        } else {
            return false;
        }
    }
}
?>
