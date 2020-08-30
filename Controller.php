<?php

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

defined('BASEPATH') OR exit('No direct script access allowed');

class Test_series extends MX_Controller {

    function __construct() {
        parent::__construct();
        /* !!!!!! Warning !!!!!!!11
         *  admin panel initialization
         *  do not over-right or remove auth_panel/auth_panel_ini/auth_ini
         */
        $this->load->helper(['aul', 'custom']);
        modules::run('auth_panel/auth_panel_ini/auth_ini');
        $this->load->library('grocery_CRUD');
        $this->load->library('form_validation', 'uploads');
        $this->load->model("Test_series_model");
    }

    public function _example_output($output = null) {
        $this->load->view(AUTH_TEMPLATE . 'grocery_crud_template', (array) $output);
    }

    public function amazon_s3_upload($name, $aws_path) {
        $_FILES['file'] = $name;
        require_once(FCPATH . 'aws/aws-autoloader.php');

        $s3Client = new S3Client([
            'version' => 'latest',
            'region' => AMS_REGION,
            'credentials' => [
                'key' => AMS_S3_KEY,
                'secret' => AMS_SECRET,
            ],
        ]);
        $result = $s3Client->putObject(array(
            'Bucket' => AMS_BUCKET_NAME,
            'Key' => $aws_path . '/' . rand(0, 7896756) . $_FILES["file"]["name"],
            'SourceFile' => $_FILES["file"]["tmp_name"],
            'ContentType' => 'image',
            'ACL' => 'public-read',
            'StorageClass' => 'REDUCED_REDUNDANCY',
            'Metadata' => array('param1' => 'value 1', 'param2' => 'value 2')
        ));
        $data = $result->toArray();
        return $data['ObjectURL'];
    }

    public function index() {
        $view_data['page'] = 'add_test_series';
        $data['page_title'] = "Add Test Series";
        $view_data['daily_result_status'] = $this->Test_series_model->test_series_result_status_count();
        //print_r($view_data['daily_result_status']['daily']); die;
        $view_data['stream_lists'] = $this->Test_series_model->get_stream_list();
        $view_data['sub_stream_lists'] = $this->Test_series_model->get_sub_stream_list();
        $view_data['languages'] = $this->Test_series_model->get_langs();
        //echo('<pre>');
        //print_r($view_data['sub_stream_lists']);
        $data['page_data'] = $this->load->view('test_series/add_test_series', $view_data, TRUE);
        echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
    }

    public function add_test_series() {
        if ($this->input->post()) {
           
            $user_data = $this->session->userdata('active_user_data');
            $backend_user_id = $user_data->id;
             
            $this->form_validation->set_rules('set_type', 'set_type', 'required');
            $this->form_validation->set_rules('test_series_name', 'Test series name', 'required|is_unique[course_test_series_master.test_series_name]');
            //$this->form_validation->set_rules('subject', 'Subject', 'required');
            //$this->form_validation->set_rules('difficulty_level', 'Difficulty level', 'required');
            //$this->form_validation->set_rules('total_questions', 'Total questions', 'required');
            //$this->form_validation->set_rules('session', 'Session', 'required');
            //$this->form_validation->set_rules('test_type', 'Test type', 'required');
            //$this->form_validation->set_rules('description', 'Description', 'required');
            //$this->form_validation->set_rules('test_price', 'Test price', 'required');
            //$this->form_validation->set_rules('time_in_mins', 'Time in seconds', 'required');
            //$this->form_validation->set_rules('negative_marking', 'Negative marking', 'required');
            //$this->form_validation->set_rules('total_marks', 'Total marks', 'required');
            //	$this->form_validation->set_rules('marks_per_question', 'Marks per question', 'required|is_natural_no_zero');
            $this->form_validation->set_rules('pass_percentage', 'Passing percentage ', 'required|greater_than[0]|less_than_equal_to[100]');

            if ($this->form_validation->run() == FALSE) {
                //$error = validation_errors();
                //echo $error; die;				
            } else {
                
                $lnguage = implode(',', $this->input->post('lang_id'));

                $insert_data = array('set_type' => $this->input->post('set_type'),
                    'test_series_name' => $this->input->post('test_series_name'),
                    'subject' => $this->input->post('subject'),
                    'difficulty_level' => $this->input->post('difficulty_level'),
                    'total_questions' => $this->input->post('total_questions'),
                    'no_of_subjects' => $this->input->post('no_of_subjects'),
                    'session' => $this->input->post('session'),
                    'test_type' => $this->input->post('test_type'),
                    'description' => $this->input->post('description'),
                    'test_price' => $this->input->post('test_price'),
                    'time_in_mins' => $this->input->post('time_in_mins'),
                    'negative_marking' => $this->input->post('negative_marking'),
                    'total_marks' => 0, //$this->input->post('marks_per_question') * $this->input->post('total_questions'),
                    'marks_per_question' => $this->input->post('marks_per_question'),
                    'pass_percentage' => $this->input->post('pass_percentage'),
                    'video_url' => $this->input->post('video_url'),
                    'lang_id' => $lnguage,
                    'sub_stream' => $this->input->post('sub_stream'),
                    'stream' => $this->input->post('stream'),
                    'subject' => $this->input->post('subject_id'),
                    'topic_id' => $this->input->post('topic_id'),
                    'sub_topic_id' => $this->input->post('sub_topic_id') ? $this->input->post('sub_topic_id') : 0,
                    'backend_user_id' => $backend_user_id
                );
                $add_series = $this->db->insert('course_test_series_master', $insert_data);
                page_alert_box('success', 'Action performed', 'Test added successfully');
            }
        }
         redirect($_SERVER["HTTP_REFERER"]);
    }

    public function ajax_test_series_list() {
        // storing  request (ie, get/post) global array to a variable
        $requestData = $_REQUEST;
        $user_data = $this->session->userdata('active_user_data');
        $instructor_id = $user_data->instructor_id;
        $backend_user_id = $user_data->id;
        $where = "";

        if ($instructor_id != 0) {
            //$where = "WHERE ctsm.backend_user_id = $backend_user_id";
        }

        $columns = array(
            // datatable column index  => database column name
            0 => 'id',
            1 => 'test_series_name',
            2 => 'stream',
            3 => 'sub_stream',
            4 => 'test_type',
            // 5 => 'subject_name',
            5 => 'session',
            6 => 'total_questions',
            7 => 'time_in_mins',
            // 8 => 'negative_marking',
            8 => 'total_marks',
            9 => 'publish',
        );

        $query = "SELECT count(ctsm.id) as total FROM course_test_series_master ctsm $where";
        $query = $this->db->query($query);
        $query = $query->row_array();
        $totalData = (count($query) > 0) ? $query['total'] : 0;
        $totalFiltered = $totalData;

        $sql = "SELECT ctsm.*,csm.name as subject_name,csnm.name as main_stream,substreamtbl.name as main_substream
								FROM course_test_series_master as  ctsm
								left join course_subject_master as csm
								on ctsm.subject = csm.id
								left join course_stream_name_master as csnm on  ctsm.stream=csnm.id 
								left join course_stream_name_master as substreamtbl on  ctsm.sub_stream=substreamtbl.id 
								 where set_type=0 $where";

        // getting records as per search parameters
        if (!empty($requestData['columns'][0]['search']['value'])) {   //name
            $sql .= " AND id LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][5]['search']['value'])) {   //name
            $sql .= " AND ctsm.id = '" . $requestData['columns'][5]['search']['value'] . "' ";
        }
        if (!empty($requestData['columns'][9]['search']['value'])) {  //salary
            $sql .= " AND publish = '" . $requestData['columns'][9]['search']['value'] . "' ";
        }
        if (!empty($requestData['columns'][1]['search']['value'])) {  //salary
            $sql .= " having test_series_name LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][2]['search']['value'])) {  //salary
            $sql .= " having main_stream LIKE '" . $requestData['columns'][2]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][3]['search']['value'])) {  //salary
            $sql .= " having main_substream LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][4]['search']['value'])) {  //salary
            $sql .= " having test_type LIKE '" . $requestData['columns'][4]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][6]['search']['value'])) {  //salary
            $sql .= " having total_questions LIKE '" . $requestData['columns'][6]['search']['value'] . "%' ";
        }

        if (!empty($requestData['columns'][7]['search']['value'])) {  //salary
            $sql .= " having time_in_mins LIKE '" . $requestData['columns'][7]['search']['value'] . "%' ";
        }

        if (!empty($requestData['columns'][8]['search']['value'])) {  //salary
            $sql .= " having total_marks LIKE '" . $requestData['columns'][8]['search']['value'] . "%' ";
        }

        $query = $this->db->query($sql)->result();

        $totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

        $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

        $result = $this->db->query($sql)->result();

        $data = array();
        foreach ($result as $r) {  // preparing an array
            $nestedData = array();
            if ($r->difficulty_level == 1) {
                $difficulty_level = "Easy";
            } elseif ($r->difficulty_level == 2) {
                $difficulty_level = "Medium";
            } elseif ($r->difficulty_level == 3) {
                $difficulty_level = "Hard";
            }
            if ($r->test_price == 1) {
                $test_price = "Free";
            } elseif ($r->test_price == 2) {
                $test_price = "Paid";
            }
            if ($r->test_type == 1) {
                $test_type = "Assesment";
            } elseif ($r->test_type == 2) {
                $test_type = "Examintaion";
            }
//            if ($r->consider_time == 1) {
//                $consider_time = "Test time";
//            } elseif ($r->consider_time == 2) {
//                $consider_time = "Question time";
//            }
//            if ($r->consider_time == 1) {
//                $consider_time = "Test time";
//            } elseif ($r->consider_time == 2) {
//                $consider_time = "Question time";
//            } elseif ($r->consider_time == 0) {
//                $consider_time = "--NA--";
//            }
            if ($r->shuffle == 1) {
                $shuffle = "Yes";
            } elseif ($r->shuffle == 0) {
                $shuffle = "No";
            }

            if ($r->test_type == 1) {
                $test_type = "Full length test";
            } elseif ($r->test_type == 2) {
                $test_type = "Previous year test";
            } elseif ($r->test_type == 3) {
                $test_type = "Sectional test";
            } else {
                $test_type = "--NA--";
            }

            $nestedData[] = ++$requestData['start']; //$r->id;
            $nestedData[] = $r->test_series_name;
            $nestedData[] = $r->main_stream;
            $nestedData[] = $r->main_substream;
            $nestedData[] = $test_type;
            $nestedData[] = $r->id;
            $nestedData[] = $r->total_questions;
            $nestedData[] = $r->time_in_mins;
            $nestedData[] = $r->total_marks;
            if ($r->publish == 0) {
                $publish = "<button class='btn-sm btn btn-danger btn-xs bold'> Unpublished</button>";
            }
            if ($r->publish == 1) {
                $publish = "<button class='btn-sm btn btn-success btn-xs bold' > Published</button>";
            }
            $nestedData[] = $publish;
            $action = "<a class='btn-sm btn btn-success btn-xs bold' href='" . AUTH_PANEL_URL . "test_series/test_series/edit_test_series/" . $r->id . "'>Edit</a>";
            $nestedData[] = $action;
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );

        echo json_encode($json_data);  // send data as json format
    }

    public function edit_test_series($id) {
        if ($this->input->post('basic_details_submit')) {
            $this->update_test_series_part1();
        } else if ($this->input->post('account_details_button')) {
            $this->update_test_series_part2();
        }

        $view_data['page'] = 'edit_test_series';

        $data['page_title'] = "Edit Test Series";
        $view_data['subject_list'] = $this->Test_series_model->get_subject_list();

        $view_data['test_series_detail'] = $this->Test_series_model->get_test_series_by_id($id);
        //pre($view_data['test_series_detail']);die;
        $test_id = $view_data['test_series_detail']['id'];

        $this->db->select('sum(no_of_questions) as qus_count,csm.name as section_name,csm.id as id,test_series_sections.test_series_id');
        $this->db->join('course_subject_master as csm', 'csm.id = test_series_sections.section_id');
        $this->db->where('test_series_id', $test_id);
        $this->db->group_by('section_id');

        $view_data['ts_sections_questions'] = $this->db->get('test_series_sections')->result_array();
        //	print_r($view_data['ts_sections_questions']);
        $this->db->where('test_series_id', $test_id);
        $view_data['section_test_series'] = $this->db->get('test_series_sections')->result_array();
        // print_r($view_data);die;
        //pre($view_data['test_series_detail']);die;
        // $this->exportCsv()
        $view_data['id'] = $id;
        $data['page_data'] = $this->load->view('test_series/edit_test_series', $view_data, TRUE);

        echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
    }

    public function exportCsv($id){
        
		$filename = 'report'.date('Ymd').'.csv'; 
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");
	   // get data 
        $usersData =  $this->Test_series_model->getcsvData($id);
        // print_r($usersData);die;
		// file creation 
		$file = fopen('php://output','w');
		$header = array("Name","Email","Mobile","Result","Marks","Time","Percentage"); 
		fputcsv($file, $header);
		foreach ($usersData as $key=>$line){
            $line['result'] = $line['result']=="1"?"Passed":"Failed";
            $line['time'] = gmdate("H:i:s", $line['total_test_series_time']-$line['time_remain']);
            //  $line['total_test_series_time']-$line['time_remain'];
            $line['percentage'] = ($line['marks']/$line['test_series_marks']) * 100;

            unset($line['total_test_series_time'],$line['time_remain'],$line['test_series_marks']); 
            fputcsv($file,$line); 

		}
		fclose($file); 
		exit;
        
    }

    public function uploadimage() {
        if ($_POST && $_FILES && $_FILES["userfile"]['name'] !== '') {
            $image_info = getimagesize($_FILES["userfile"]["tmp_name"]);
            $image_width = $image_info[0];
            $image_height = $image_info[1];

            if ($image_width == $image_height) {
                $file = $this->amazon_s3_upload($_FILES['userfile'], "course_file_meta");
                $this->db->where('id', $this->input->post('id'));
                $this->db->update('course_test_series_master', array('image' => $file));
                page_alert_box('success', 'Course Image', 'Course cover image updated successfully.');
            } else {
                page_alert_box('error', 'Course Image', 'Course cover image should have same height and width');
            }
            redirect(AUTH_PANEL_URL . "test_series/test_series/edit_test_series/" . $this->input->post('id'));
        } else {

            redirect(AUTH_PANEL_URL . "test_series/test_series/edit_test_series/" . $this->input->post('id'));
        }
    }

    function uploadCSV() {
        $test_series_id = $_POST['id'];
        $test_series_data = $this->Test_series_model->get_test_series_by_id($test_series_id);
        $count = 0;
        if ($_FILES['userfile']['name'] !== '') {

            $fp = fopen($_FILES['userfile']['tmp_name'], 'r') or die("can't open file");

            /* ----------------------------------------------------------- */
            $error = "";
            $row_error = "";
            while ($csv_line = fgetcsv($fp, 1024)) {
                $count++;
                if ($count == 1) {
                    continue;
                }//keep this if condition if you want to remove the first row

                for ($i = 0, $j = count($csv_line); $i < $j; $i++) {
                    $insert_csv = array();
                    $insert_csv['question'] = trim($csv_line[0]);
                    $insert_csv['description'] = $csv_line[1];
                    $insert_csv['question_type'] = strtoupper(trim($csv_line[2]));
                    /* $insert_csv['negative_marks'] = $csv_line[3];
                      $insert_csv['marks'] = $csv_line[4]; */
                    $insert_csv['difficulty_level'] = $csv_line[3];
                    $insert_csv['duration'] = $csv_line[4];
                    $insert_csv['option_1'] = $csv_line[5];
                    $insert_csv['option_2'] = $csv_line[6];
                    $insert_csv['option_3'] = $csv_line[7];
                    $insert_csv['option_4'] = $csv_line[8];
                    $insert_csv['option_5'] = $csv_line[9];
                    $insert_csv['answer'] = $csv_line[10];
                    /* $insert_csv['status'] = $csv_line[11]; */
                    $insert_csv['subject_id'] = $test_series_data['subject'];
                    $insert_csv['uploaded_by'] = $this->session->userdata('active_user_data');
                }
                if ($insert_csv['question'] == "") {
                    $row_error .= '"question" field is required. ';
                }
                if ($insert_csv['question_type'] == "") {
                    $row_error .= '"question_type" field is required. ';
                }
                /* if($insert_csv['negative_marks'] == "" ){
                  $row_error .= '"negative_marks" field is required. ';
                  }
                  if($insert_csv['marks'] == "" ){
                  $row_error .= '"marks" field is required. ';
                  } */
                if ($insert_csv['difficulty_level'] == "") {
                    $row_error .= '"difficulty_level" field is required. ';
                }
                if ($insert_csv['duration'] == "") {
                    $row_error .= '"duration" field is required. ';
                }
                if ($insert_csv['option_1'] == "") {
                    $row_error .= '"option_1" field is required. ';
                }
                if ($insert_csv['option_2'] == "") {
                    $row_error .= '"option_2" field is required. ';
                }
                if ($insert_csv['answer'] == "") {
                    $row_error .= '"answer" field is required. ';
                }
                /* if($insert_csv['status'] == "" ){
                  $row_error .= '"status" field is required. ';
                  } */
                if ($insert_csv['question_type'] != "MC" && $insert_csv['question_type'] != "SC" && $insert_csv['question_type'] != "TF") {
                    $row_error .= '"question_type" field is not valid. ';
                }
                $defaul_answer_array = array(1, 2, 3, 4, 5);
                $answer = explode(',', $insert_csv['answer']); //print_r($defaul_answer_array);die;
                foreach ($answer as $answerChild) {
                    if (in_array($answerChild, $defaul_answer_array) == false) {
                        $row_error .= '"answer" field should contain valid integer values only. ';
                    }
                }


                $i++;

                if ($row_error != "") {
                    $error .= '<span class="bold">Error found in row number ' . $count . ' </span> -: ' . $row_error . '</br>';
                    $row_error = "";
                }
            }
            // echo $error;die;
            if ($error != "") {
                $_SESSION['question_csv_error'] = $error;
                page_alert_box('error', 'Action not performed', 'Invalid CSV Uploaded');
                redirect(AUTH_PANEL_URL . "test_series/test_series/edit_test_series/" . $test_series_id);
            }


            /* ----------------------------------------------------------- */
            $count = 0;
            $fq = fopen($_FILES['userfile']['tmp_name'], 'r') or die("can't open file");
            while ($csv_line = fgetcsv($fq, 1024)) {
                $count++;
                if ($count == 1) {
                    continue;
                }//keep this if condition if you want to remove the first row
                for ($i = 0, $j = count($csv_line); $i < $j; $i++) {
                    $insert_csv = array();
                    $insert_csv['question'] = $csv_line[0];
                    $insert_csv['description'] = $csv_line[1];
                    $insert_csv['question_type'] = $csv_line[2];
                    $insert_csv['negative_marks'] = $csv_line[3];
                    $insert_csv['marks'] = $csv_line[4];
                    $insert_csv['difficulty_level'] = $csv_line[5];
                    $insert_csv['duration'] = $csv_line[6];
                    $insert_csv['option_1'] = $csv_line[7];
                    $insert_csv['option_2'] = $csv_line[8];
                    $insert_csv['option_3'] = $csv_line[9];
                    $insert_csv['option_4'] = $csv_line[10];
                    $insert_csv['option_5'] = $csv_line[11];
                    $insert_csv['answer'] = $csv_line[12];
                    $insert_csv['status'] = $csv_line[13];
                }
                $i++;

                $data = array(
                    'question' => $insert_csv['question'],
                    'description' => $insert_csv['description'],
                    'question_type' => $insert_csv['question_type'],
                    'negative_marks' => $insert_csv['negative_marks'],
                    'marks' => $insert_csv['marks'],
                    'difficulty_level' => $insert_csv['difficulty_level'],
                    'duration' => $insert_csv['duration'],
                    'option_1' => $insert_csv['option_1'],
                    'option_2' => $insert_csv['option_2'],
                    'option_3' => $insert_csv['option_3'],
                    'option_4' => $insert_csv['option_4'],
                    'option_5' => $insert_csv['option_5'],
                    'answer' => $insert_csv['answer'],
                    'status' => $insert_csv['status'],
                );

                $this->db->insert('course_question_bank_master', $data);
                $question_id = $this->db->insert_id();

                $question_relation_data = array(
                    'test_series_id' => $test_series_id,
                    'question_id' => $question_id
                );
                $this->db->insert('course_testseries_question_relation', $question_relation_data);
                page_alert_box('success', 'Action performed', 'CSV uploaded successfully');
            }


            redirect(AUTH_PANEL_URL . "test_series/test_series/edit_test_series/" . $test_series_id);
        } else {
            page_alert_box('error', 'Action not performed', 'Choose and Upload a csv file');

            redirect(AUTH_PANEL_URL . "test_series/test_series/edit_test_series/" . $test_series_id);
        }
    }

    public function ajax_test_series_question_list() {
        // storing  request (ie, get/post) global array to a variable
        $test_series_id = $this->input->get('test_series_id');
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'id',
            1 => 'question',
            3 => 'stream',
            4 => 'sub_stream',
            5 => 'subject_name',
            6 => 'topic_id',
            7 => 'question_type',
            8 => 'language',
            9 => 'test_name',
        );

        $query = "SELECT count(id) as total FROM course_testseries_question_relation where test_series_id = $test_series_id";
        $query = $this->db->query($query);
        $query = $query->row_array();
        $totalData = (count($query) > 0) ? $query['total'] : 0;
        $totalFiltered = $totalData;

        $sql = "SELECT cqbm.*,csm.name as subject_name , cstm.topic as topic_name,ctqr.id as relation_id,ctqr.section_id ,csmsection.name as section_name,
		                        csnm.name as main_stream,substreamtbl.name as main_substream,language_code.language, bu.username as uploader_name 
								FROM course_testseries_question_relation as  ctqr
								left join course_question_bank_master as cqbm on cqbm.config_id = ctqr.question_id
								left join course_subject_master as csm on cqbm.subject_id = csm.id
								left join course_subject_topic_master as cstm  on cstm.id = cqbm.topic_id
						    	left join course_subject_master as csmsection on ctqr.section_id = csmsection.id
							    left join course_stream_name_master as csnm on  cqbm.stream_id=csnm.id 
								left join course_stream_name_master as substreamtbl on  cqbm.sub_stream_id=substreamtbl.id 
								Left join language_code on language_code.id=cqbm.lang_code
								left join backend_user as bu on bu.id = cqbm.uploaded_by
								where ctqr.test_series_id = $test_series_id and  cqbm.lang_code = 1
								";

        // // getting records as per search parameters
        if (!empty($requestData['columns'][0]['search']['value'])) {   //name
            $sql .= " AND id LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][1]['search']['value'])) {  //salary
            $sql .= " having question LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][3]['search']['value'])) {  //salary
            $sql .= " having main_stream LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][4]['search']['value'])) {  //salary
            $sql .= " having main_substream LIKE '" . $requestData['columns'][4]['search']['value'] . "%' ";
        }

        if (!empty($requestData['columns'][5]['search']['value'])) {  //salary
            $sql .= " having subject_name LIKE '" . $requestData['columns'][5]['search']['value'] . "%' ";
        }

        if (!empty($requestData['columns'][6]['search']['value'])) {  //salary
            $sql .= " having topic_name LIKE '" . $requestData['columns'][6]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][7]['search']['value'])) {  //salary
            $sql .= " having question_type LIKE '" . $requestData['columns'][7]['search']['value'] . "%' ";
        }

        if (!empty($requestData['columns'][8]['search']['value'])) {  //salary
            $sql .= " having lang_code LIKE '" . $requestData['columns'][8]['search']['value'] . "%' ";
        }

        if (!empty($requestData['columns'][9]['search']['value'])) {  //salary
            $sql .= " having cqbm.test_name LIKE '%" . $requestData['columns'][9]['search']['value'] . "%' ";
        }
        $query = $this->db->query($sql)->result();

        $totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

        $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

        $result = $this->db->query($sql)->result();

        //	echo $this->db->last_query();
        $data = array();
        foreach ($result as $r) {  // preparing an array
            $nestedData = array();
            $difficulty_level = "";
            if ($r->difficulty_level == 1) {
                $difficulty_level = "Easy";
            } elseif ($r->difficulty_level == 2) {
                $difficulty_level = "Medium";
            } elseif ($r->difficulty_level == 3) {
                $difficulty_level = "Hard";
            }
            //	if($r->question_type == 1){ $question_type = "Single Choice"; }elseif($r->question_type == 2){$question_type = "Multiple Choice";}elseif($r->question_type == 3){$question_type = "True-False";}


            if ($r->status == 1) {
                $status = "Yes";
            } elseif ($r->status == 0) {
                $status = "No";
            }

            $nestedData[] = $r->id;
            $q = strip_tags($r->question);
            //echo substr($q,0,20).(strlen($q)>20?' ...':'');die;
            $nestedData[] = mb_substr($q, 0, 25) . (strlen($q) > 25 ? ' ...' : '');
            $nestedData[] = $r->main_stream;
            $nestedData[] = $r->main_substream;
            $nestedData[] = ($r->subject_name) ? $r->subject_name : "--NA--";
            $nestedData[] = ($r->topic_name) ? $r->topic_name : "--NA--";

            $nestedData[] = $r->language;
            $nestedData[] = $r->uploader_name;
            $nestedData[] = $r->config_id;
            $nestedData[] = $r->test_name;
            $action = "<a target='_blank' class='btn-sm btn btn-success btn-xs bold' href='" . AUTH_PANEL_URL . "question_bank/question_bank/edit_question?config_id=" . $r->config_id . "'><i class='fa fa-pencil'></i></a>";
            $action .= "<a  class='btn-sm btn btn-danger btn-xs bold pull-right' onclick=\"return confirm('Are you sure you want to delete?')\"   href='" . AUTH_PANEL_URL . "test_series/test_series/delete_question_from_testseries/" . $r->config_id . "/" . $test_series_id . "'> <i class='fa fa-times'></i></a>";
            $nestedData[] = $action;
            //$nestedData[] = '<input type="checkbox" name="id_sec[]" value="'.$r->relation_id.'">';


            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );

        echo json_encode($json_data);  // send data as json format
    }

    private function update_test_series_part1() {
        if ($this->input->post()) {
            //pre($_POST);die;
            // ECHO '<PRE>';
            // print_r($_POST);
// 			$this->form_validation->set_rules('test_series_name', 'Test series name', 'required');
            $this->form_validation->set_rules('total_questions', 'Total questions', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('test_price', 'Test price', 'required');
            $this->form_validation->set_rules('time_in_mins', 'Time in mins', 'required');
            $this->form_validation->set_rules('total_marks', 'Total marks', 'required');
            $this->form_validation->set_rules('pass_percentage', 'Passing percentage ', 'required|greater_than[0]|less_than_equal_to[100]');

            if ($this->form_validation->run() == FALSE) {
                //$error = validation_errors();
                //echo $error; die;
            } else {
                $id = $this->input->post('id');
                $lnguage = implode(',', $this->input->post('language'));
                $update_data = array('set_type' => $this->input->post('set_type'),
                    'test_series_name' => $this->input->post('test_series_name'),
                    'subject' => $this->input->post('subject_id'),
                    'topic_id' => $this->input->post('topic_id'),
                    'sub_topic_id' => $this->input->post('sub_topic_id'),
                    'chapter_id' => $this->input->post('chapter_id'),
                    'no_of_subjects' => $this->input->post('no_of_subjects'),
                    'difficulty_level' => $this->input->post('difficulty_level'),
                    'total_questions' => $this->input->post('total_questions'),
                    'session' => $this->input->post('session'),
                    'test_type' => $this->input->post('test_type'),
                    'lang_id' => $lnguage,
                    'stream' => $this->input->post('stream'),
                    'sub_stream' => $this->input->post('sub_stream'),
                    'description' => $this->input->post('description'),
                    'test_price' => $this->input->post('test_price'),
                    'time_in_mins' => $this->input->post('time_in_mins'),
                    'pass_percentage' => $this->input->post('pass_percentage'),
                    'negative_marking' => $this->input->post('negative_marking'),
                    'video_url' => $this->input->post('video_url'),
                    'total_marks' => $this->input->post('marks_per_question') * $this->input->post('total_questions'),
                    'marks_per_question' => $this->input->post('marks_per_question')
                );
                //  ECHO '<PRE>';
                //  print_r($update_data); 

                $this->db->where('id', $id);
                $update_series = $this->db->update('course_test_series_master', $update_data);
                page_alert_box('success', 'Action performed', 'Test series updated successfully');
            }
        }
    }

    private function update_test_series_part2() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('shuffle', 'Shuffle', 'required');
            $this->form_validation->set_rules('cutoff', 'cutoff', 'required');
            $this->form_validation->set_rules('answer_shuffle', 'Answer shuffle', 'required');
            $this->form_validation->set_rules('time_boundation', 'Time boundation', 'required');
            $this->form_validation->set_rules('allow_duplicate_rank', 'Allow duplicate rank', 'required');

            if ($this->input->post('start_date') != "") {
                $this->form_validation->set_rules('end_date', 'End date', 'required');
                $this->form_validation->set_rules('start_date', 'Start date', 'required');
            }
            $start_date = "";
            $end_date = "";


            if ($this->form_validation->run() == FALSE) {
                $error = validation_errors();
                echo $error;
                die;
            } else {  //echo "3"; die;
                $id = $this->input->post('id');
                if ($this->input->post('start_date') != "") {
                    $start_date = strtotime($this->input->post('start_date')) . "000";
                }
                //$new_start_date = date('Y-m-d',$start_date/1000);
                if ($this->input->post('end_date') != "") {
                    $end_date = strtotime($this->input->post('end_date')) . "000";
                }
                //$new_end_date = date('Y-m-d',$end_date/1000);
                $update_data = array('shuffle' => $this->input->post('shuffle'),
                    'cutoff' => $this->input->post('cutoff'),
                    'answer_shuffle' => $this->input->post('answer_shuffle'),
                    'shuffle' => $this->input->post('shuffle'),
                    'time_boundation' => $this->input->post('time_boundation'),
                    'pass_message' => $this->input->post('pass_message'),
                    'general_message' => $this->input->post('general_message'),
                    'fail_message' => $this->input->post('fail_message'),
                    'allow_duplicate_rank' => $this->input->post('allow_duplicate_rank'),
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'is_reattempt' => ($this->input->post('is_reattempt')) ? strtotime($this->input->post('is_reattempt')) : 0,
                    'reward_points' => $this->input->post('reward_points')
                );
                $this->db->where('id', $id);
                $update_series = $this->db->update('course_test_series_master', $update_data);
                page_alert_box('success', 'Action performed', 'Test series updated successfully');
            }
        }
    }

    public function set_test_series_publish($id) {
        $this->db->where('id', $id);
        $question_nos = $this->db->get('course_test_series_master')->row_array();

        $query = "SELECT count(id) as total FROM course_testseries_question_relation where test_series_id = $id";
        $query = $this->db->query($query);
        $query = $query->row_array();
        $totalData = $query['total'];

        if ($totalData == $question_nos['total_questions']) {
            $this->db->where('id', $id);
            $this->db->update('course_test_series_master', array('publish' => 1));
            page_alert_box('success', 'Action performed', 'Test series published successfully');
            redirect(AUTH_PANEL_URL . "test_series/test_series/edit_test_series/" . $id);
        } else {
            page_alert_box('error', 'Error', 'Not exact no. of questions found');
            redirect(AUTH_PANEL_URL . "test_series/test_series/edit_test_series/" . $id);
        }
    }

    public function set_test_series_unpublish($id) {
        $this->db->where('id', $id);
        $this->db->update('course_test_series_master', array('publish' => 0));
        page_alert_box('warning', 'Action performed', 'Test series unpublished successfully');
        redirect(AUTH_PANEL_URL . "test_series/test_series/edit_test_series/" . $id);
    }

    public function ajax_test_series_report_list() {
        // storing  request (ie, get/post) global array to a variable
        $test_series_id = $_GET['test_series_id'];
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'mobile',
            4 => 'result',
            5 => 'marks',
            6 => 'total_test_series_time',
            7 => 'creation_time'
        );

        $query = "SELECT count(id) as total FROM course_test_series_report where test_series_id = $test_series_id";
        $query = $this->db->query($query);
        $query = $query->row_array();
        $totalData = (count($query) > 0) ? $query['total'] : 0;
        $totalFiltered = $totalData;

        $sql = "SELECT ctsr.*,u.name as name,u.email as email,u.mobile	as mobile
								FROM course_test_series_report as  ctsr
								join users as u
								on ctsr.user_id = u.id where test_series_id = $test_series_id";

        // getting records as per search parameters
        if (!empty($requestData['columns'][0]['search']['value'])) {   //name
            $sql .= " AND id LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][1]['search']['value'])) {  //salary
            $sql .= " AND name LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][2]['search']['value'])) {  //salary
            $sql .= " AND result LIKE '" . $requestData['columns'][2]['search']['value'] . "%' ";
        }
        
        
        if (!empty($requestData['columns'][3]['search']['value'])) {  //salary
            $sql .= " AND result LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
        }

        if (!empty($requestData['columns'][4]['search']['value'])) {  //salary
            $sql .= " AND result LIKE '" . $requestData['columns'][4]['search']['value'] . "%' ";
        }

        if (!empty($requestData['columns'][5]['search']['value'])) {  //salary
            $sql .= " AND result LIKE '" . $requestData['columns'][5]['search']['value'] . "%' ";
        }

        if (!empty($requestData['columns'][6]['search']['value'])) {  //salary
            $sql .= " AND result LIKE '" . $requestData['columns'][6]['search']['value'] . "%' ";
        }

        if (!empty($requestData['columns'][7]['search']['value'])) {  //salary
            $sql .= " AND result LIKE '" . $requestData['columns'][7]['search']['value'] . "%' ";
        }

        if (!empty($requestData['columns'][8]['search']['value'])) {  //salary
            $date = explode(',', $requestData['columns'][8]['search']['value']);
            $start = strtotime($date[0]) * 1000;
            $end = (strtotime($date[1]) * 1000) + 86400000;
            $sql .= "  and  ctsr.creation_time >= '$start' and ctsr.creation_time <= '$end'";
        }

        $query = $this->db->query($sql)->result();

        $totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

        $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

        $result = $this->db->query($sql)->result();
        $data = array();
        foreach ($result as $r) {  // preparing an array
            $nestedData = array();

            if ($r->result == 1) {
                $result = "Passed";
            } elseif ($r->result == 0) {
                $result = "Failed";
            }

            $time = $r->total_test_series_time - $r->time_remain;
            $percentage = ($r->marks/$r->test_series_marks)*100;
            $nestedData[] = $r->id;
            $nestedData[] = $r->name;
            $nestedData[] = $r->email;
            $nestedData[] = $r->mobile;
            $nestedData[] = $result;
            $nestedData[] = $r->marks;
            $nestedData[] = gmdate("H:i:s", $time);
            $nestedData[] = $percentage;
            $nestedData[] = date("d-m-Y", $r->creation_time / 1000);


            //$action = "<a class='btn-sm btn btn-success btn-xs bold' href='" . AUTH_PANEL_URL . "test_series/test_series/edit_test_series/" . $r->id . "'>Edit</a>";
            //$nestedData[] = $action;

            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );

        echo json_encode($json_data);  // send data as json format
    }

    public function delete_question_from_testseries($id, $test_series_id) {

        $delete_user = $this->Test_series_model->delete_question_from_testseries($id, $test_series_id);
        //echo $delete_user;
        //	echo $this->db->last_query();
        if ($delete_user == '1') {
            //$this->session->set_flashdata('success_message', 'Question has been Deleted succssfully');
            page_alert_box('success', 'Action performed', 'Question has been Deleted succssfully');
        } else if ($delete_user == '2') {
            //	$this->session->set_flashdata('error_message', 'Question not Deleted');
            page_alert_box('error', 'Action not  performed', 'Question not Deleted');
        }
        redirect(AUTH_PANEL_URL . 'test_series/test_series/edit_test_series/' . $test_series_id);
    }

    public function ajax_subject_wise_question_list() {
        // storing  request (ie, get/post) global array to a variable
        //$subject_id =  $this->input->get('subject_id');
        $test_series_id = $this->input->get('test_series_id');

        $this->db->where('test_series_id', $test_series_id);
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'id',
            1 => 'question',
            2 => 'subject_name',
            3 => 'topic_id',
            4 => 'stream',
            5 => 'sub_stream',
            6 => 'question_type',
            7 => 'duration',
            8 => 'config_id',
            9 => 'test_name'
        );

        $query = "SELECT count(cqbm.id) as total 
						FROM course_question_bank_master as cqbm
						left join course_subject_master as csm on cqbm.subject_id = csm.id
						left join course_testseries_question_relation as ctqr on   ctqr.question_id = cqbm.config_id and ctqr.test_series_id = $test_series_id
						where 
						cqbm.subject_id in (select section_id from test_series_sections where test_series_id=$test_series_id)   
						and ctqr.id is null  and cqbm.lang_code = 1 and cqbm.is_verified=1";
        $query = $this->db->query($query);
        $query = $query->row_array();
        $totalData = (count($query) > 0) ? $query['total'] : 0;
        $totalFiltered = $totalData;

        $sql = "SELECT cqbm.id , cqbm.difficulty_level , cqbm.status , cqbm.config_id ,cqbm.test_name ,
		cqbm.question , cqbm.subject_id
								,csm.name as subject_name , cstm.topic as topic_name ,  bu.username as uploader_name,csnm.name as main_stream,substreamtbl.name as main_substream  
								FROM course_question_bank_master as  cqbm
								left join course_subject_master as csm on cqbm.subject_id = csm.id
								left join course_subject_topic_master as cstm  on cstm.id = cqbm.topic_id
								left join course_testseries_question_relation as ctqr on  ctqr.question_id = cqbm.config_id and ctqr.test_series_id = $test_series_id
								left join test_series_sections as tss on ctqr.test_series_id = tss.test_series_id 
								left join backend_user as bu on bu.id = cqbm.uploaded_by
								left join course_stream_name_master as csnm on  cqbm.stream_id=csnm.id 
								left join course_stream_name_master as substreamtbl on  cqbm.sub_stream_id=substreamtbl.id 
								where cqbm.subject_id in (select section_id from test_series_sections where test_series_id=$test_series_id)
								and ctqr.id is null  and cqbm.lang_code = 1 and cqbm.is_verified=1 

								";

        // getting records as per search parameters
        if (!empty($requestData['columns'][0]['search']['value'])) {   //name
            $sql .= " AND id LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][1]['search']['value'])) {  //salary
            $sql .= " having question LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][2]['search']['value'])) {  //salary
            $sql .= " having subject_name LIKE '" . $requestData['columns'][2]['search']['value'] . "%' ";
        }

        if (!empty($requestData['columns'][3]['search']['value'])) {  //salary
            $sql .= " having topic_name LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][4]['search']['value'])) {  //salary
            $sql .= " having question_type LIKE '" . $requestData['columns'][4]['search']['value'] . "%' ";
        }

        if (!empty($requestData['columns'][5]['search']['value'])) {  //salary
            $sql .= " having bu.username LIKE '" . $requestData['columns'][5]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][6]['search']['value'])) {  //salary
            $sql .= " having config_id LIKE '" . $requestData['columns'][6]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][9]['search']['value'])) {  //salary
            $sql .= " having test_name LIKE '%" . $requestData['columns'][9]['search']['value'] . "%' ";
        }

        $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

        $result = $this->db->query($sql)->result();
        $data = array();
        foreach ($result as $r) {  // preparing an array
            $nestedData = array();
            $difficulty_level = "";
            if ($r->difficulty_level == 1) {
                $difficulty_level = "Easy";
            } elseif ($r->difficulty_level == 2) {
                $difficulty_level = "Medium";
            } elseif ($r->difficulty_level == 3) {
                $difficulty_level = "Hard";
            }
            if ($r->status == 1) {
                $status = "Yes";
            } elseif ($r->status == 0) {
                $status = "No";
            }

            $nestedData[] = $r->id;
            $q = strip_tags($r->question);
            $nestedData[] = mb_substr($q, 0, 25) . (strlen($q) > 25 ? ' ...' : '');
            $nestedData[] = ($r->subject_name) ? $r->subject_name : "--NA--";
            $nestedData[] = ($r->topic_name) ? $r->topic_name : "--NA--";
            $nestedData[] = $r->main_stream;
            $nestedData[] = $r->main_substream;

            $nestedData[] = $r->uploader_name;
            $nestedData[] = $r->config_id;
            $nestedData[] = $r->test_name;
            $action = "<a target='_blank' data-test-series-id ='$test_series_id' data-section-id='$r->subject_id' data-question-id='$r->config_id'  class='btn-sm btn btn-success btn-xs bold add_question_to_series'>Add</a>";

            $nestedData[] = $action;
            $nestedData[] = '<input type="checkbox" name="id[]" value="' . $r->config_id . '"  data-section-id="' . $r->subject_id . '">';
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data, // total data array,
            "last" => $this->db->last_query()
        );

        echo json_encode($json_data);  // send data as json format
    }

    public function add_question_to_testseries() {
        
        $test_series_id = $_POST['testSeriesId'];
        $question_id = $_POST['questionId'];
        $section_id = $_POST['subject_id'];
        $add_question = $this->Test_series_model->add_question_to_testseries($test_series_id, $question_id, $section_id);
        echo $add_question;
    }

    public function test_question_count() {

        $test_series_id = $_POST['testSeriesId'];
        $question_id = $_POST['questionId'];
        $section_id = $_POST['subject_id'];
        $add_question = $this->Test_series_model->count_section_question($test_series_id, $section_id);
        echo $add_question;
        //echo json_encode(array('status'=>true));		
    }

    public function add_section_to_testseries() {
        $test_series_id = $_POST['testSeriesId'];
        $question_id = 1;
        $data_array = array(
            'test_series_id' => $_POST['testSeriesId'],
            'no_of_questions' => $_POST['no_question'],
            'marks_per_question' => $_POST['marks_per_ques'],
            'negative_marks' => $_POST['negative'],
            'section_timing' => $_POST['minutes'],
            'section_id' => $_POST['section_id'],
            'section_cutoff' => $_POST['section_cutoff']
        );
        $add_question = $this->Test_series_model->add_section_to_testseries($data_array);
        echo $add_question;
        //echo json_encode(array('status'=>True));
    }

    public function delete_section_testseries() {
        $test_series_id = $_POST['testSeriesId'];
        $section_id = $_POST['section_id'];
        $this->db->where('test_series_id', $test_series_id);
        $this->db->where('section_id', $section_id);
        $select_testseries_sec = $this->db->get('course_testseries_question_relation')->result_array();
//echo $this->db->last_query();
        if ($select_testseries_sec) {
            echo '2';
        } else {
            $this->db->where('test_series_id', $test_series_id);
            $this->db->where('section_id', $section_id);
            $query = $this->db->delete('test_series_sections');

            if ($query) {
                $this->db->select('sum(`section_timing`)as total_time,sum(`no_of_questions`) as total_questions,sum((no_of_questions*marks_per_question) ) as total_marks ');
                $this->db->where('test_series_id', $test_series_id);
                $check = $this->db->get('test_series_sections')->row_array();

                $array = array('time_in_mins' => $check['total_time'], 'total_questions' => $check['total_questions'], 'total_marks' => $check['total_marks']);
                $this->db->where('id', $test_series_id);

                $this->db->update("course_test_series_master", $array);
            }
            if ($query) {

                echo '1';
            }
        }
    }

    public function select_edit_element($id) {
        
    }

    public function edit_section_testseries() {
        $test_series_id = $_POST['testSeriesId'];
        $question_id = 1;
        $id = $_POST['id'];
        $data = array(
            'test_series_id' => $_POST['testSeriesId'],
            'no_of_questions' => $_POST['no_question'],
            'marks_per_question' => $_POST['marks_per_ques'],
            'negative_marks' => $_POST['negative'],
            'section_timing' => $_POST['minutes'],
            'section_id' => $_POST['section_id'],
            'section_cutoff' => $_POST['section_cutoff']
        );

        $this->db->where('test_series_id', $data['test_series_id']);
        $this->db->where('section_id', $data['section_id']);
        $this->db->where('id!=', $id);
        $check = $this->db->get('test_series_sections')->result_array();
        if ($check) {
            echo '2';
        } else {
            $this->db->where('test_series_id', $data['test_series_id']);
            $this->db->where('id', $id);
            $result = $this->db->update("test_series_sections", $data);
            if ($this->db->affected_rows() > 0) {
                $this->db->select('sum(`section_timing`)as total_time,sum(`no_of_questions`) as total_questions, sum((no_of_questions*marks_per_question) ) as total_marks ');
                $this->db->where('test_series_id', $data['test_series_id']);
                $check = $this->db->get('test_series_sections')->row_array();

                $array = array('time_in_mins' => $check['total_time'], 'total_questions' => $check['total_questions'], 'total_marks' => $check['total_marks']);
                $this->db->where('id', $data['test_series_id']);

                $this->db->update("course_test_series_master", $array);
            }
            if ($result) {
                echo '1';
            } else {
                echo '2';
            }
        }
    }

    public function ajax_test_series_section_list() {
        // storing  request (ie, get/post) global array to a variable
        $test_series_id = $_GET['test_series_id'];
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'id',
            1 => 'section_id',
            2 => 'no_of_questions',
            3 => 'marks_per_question',
            4 => 'negive_marks',
            5 => 'section_timing'
        );

        $query = "SELECT count(id) as total FROM test_series_sections where test_series_id = $test_series_id";
        $query = $this->db->query($query);
        $query = $query->row_array();
        $totalData = (count($query) > 0) ? $query['total'] : 0;
        $totalFiltered = $totalData;

        $sql = "SELECT tss.* , course_subject_master.name as section_name	FROM test_series_sections as  tss left join course_subject_master on tss.section_id=course_subject_master.id
								 where test_series_id = $test_series_id";

        // getting records as per search parameters
        if (!empty($requestData['columns'][0]['search']['value'])) {   //name
            $sql .= " AND id LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][1]['search']['value'])) {  //salary
            $sql .= " AND section_id LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][2]['search']['value'])) {  //salary
            $sql .= " AND no_of_questions LIKE '" . $requestData['columns'][2]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][3]['search']['value'])) {  //salary
            $sql .= " AND marks_per_question LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][4]['search']['value'])) {  //salary
            $sql .= " AND negive_marks LIKE '" . $requestData['columns'][4]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][5]['search']['value'])) {  //salary
            $sql .= " AND section_timing LIKE '" . $requestData['columns'][5]['search']['value'] . "%' ";
        }


        $query = $this->db->query($sql)->result();

        $totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

        $sql .= " ORDER BY id   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

        $result = $this->db->query($sql)->result();

        $data = array();
        foreach ($result as $r) {  // preparing an array
            $nestedData = array();

            //	if($r->result == 1){ $result = "Passed";}elseif($r->result == 0){ $result = "Failed";}


            $nestedData[] = $r->id;
            $nestedData[] = $r->section_name;
            $nestedData[] = $r->no_of_questions;
            $nestedData[] = $r->marks_per_question;
            $nestedData[] = $r->negative_marks;
            $nestedData[] = $r->section_timing;
            $nestedData[] = ' <input type="button" id="edit_button2"  class="btn btn-info btn-xs edit_section_element " name="edit_section_element"  style=""  value="Edit"  onclick="">
				<input type="button" id="edit_button2"  class="btn btn-info btn-xs update_section_element "  style="display:none;" value="update"  onclick=";">
				<button  type="button" data-section="' . $r->section_id . '" class="btn btn-danger btn-xs delete_section_element" id="delete_section_element"  onclick="delete_section(' . $r->section_id . ',' . $r->test_series_id . ');" >delete</button>
				
		';

            //$action = "<a class='btn-sm btn btn-success btn-xs bold' href='" . AUTH_PANEL_URL . "test_series/test_series/edit_test_series/" . $r->id . "'>Edit</a>";
            //$nestedData[] = $action;

            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );

        echo json_encode($json_data);  // send data as json format
    }

    function add_question_to_section_liist() {
        $test_series_id = $this->input->get('test_series_id');
        $view_data['page'] = 'add_test_series';
        $data['page_title'] = "Add Questions to Section";
        //echo('<pre>');
        //print_r($view_data['sub_stream_lists']);
        $data['page_data'] = $this->load->view('test_series/add_ques_section', $view_data, TRUE);
        echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
    }

    function add_sections_in_test() {

        $section_id = $_POST['section_id'];
        $id = $_POST['id'];
        $add_question = $this->Test_series_model->connect_section_to_testseries($section_id, $id);
        echo json_encode(array('status' => True));
    }

}
