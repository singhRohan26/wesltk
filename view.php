<?php
$all_language_meta = $this->db->select('id,language')->get('language_code')->result_array();
?>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="" id="question_list" class="modal fade">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Questions Lists</h4>

            </div>

            <div class="modal-body" id = "questions_list">

                <div class="panel-body">
                    <button class="btn-success btn btn-xs add_questions_element pull-right ">Add All</button> 
                    <div class="adv-table">
                        <table  class="display table table-bordered table-striped " style="width:100%"  id="subject_questions_list">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Question</th>
                                    <th>Subject</th>
                                    <th>Topic</th>
                                    <th>Main Stream</th>
                                    <th>Sub Stream</th>		
                                    <th>Added by </th>
                                    <th>Qs_ID </th>
                                    <th>Test Name</th>
                                    <th>Action </th>
                                    <th><input name="select_all" value="1" id="example-select-all" type="checkbox"></th>
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                    <th><input type="text" data-column="0"  class="search-input-text form-control"></th>
                                    <th><input type="text" data-column="1"  class="search-input-text form-control"></th>
                                    <th><input type="text" data-column="2"  class="search-input-text form-control"></th>
                                    <th><input type="text" data-column="3"  class="search-input-text form-control"></th>
                                    <th><input type="text" data-column="4"  class="search-input-text form-control"></th>
                                    <th><input type="text" data-column="5"  class="search-input-text form-control"></th>

                                    <th><input type="text" data-column="7"  class="search-input-text form-control"></th>
                                    <th><input type="text" data-column="8"  class="search-input-text form-control"></th>
                                    <th><input type="text" data-column="9"  class="search-input-text form-control"></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="col-md-3">
    <section class="panel">
        <header class="panel-heading">
            Test Menu <small data-original-title="Note" data-content="You can change it from 'Advance option' tab." data-placement="bottom" data-trigger="hover" title="" aria-hidden="true" class="bold popovers label label-info pull-right"> Rewards Points <?php echo $test_series_detail['reward_points']; ?></small>
        </header>
        <div class="panel-body">
            <ul class="nav prod-cat">
                <li><a href="javascript:void(0)" data-div="1" ><i class=" fa fa-angle-right"></i> Basic information</a></li>
                <li><a href="javascript:void(0)" data-div="4" ><i class=" fa fa-angle-right"></i> Advance option </a></li>
                <li class="hide"><a href="javascript:void(0)" data-div="5" ><i class=" fa fa-angle-right"></i> Cover image </a></li>
                <li class="hide"><a href="javascript:void(0)" data-div="2" ><i class=" fa fa-angle-right"></i> Add questions(CSV) </a></li>
                <li><a href="javascript:void(0)" data-div="8" ><i class=" fa fa-angle-right"></i> Question Section</a></li>
                <li><a href="javascript:void(0)" data-div="3" ><i class=" fa fa-angle-right"></i> Questions list </a></li>
                <li><a href="javascript:void(0)" data-div="6" ><i class=" fa fa-angle-right"></i> Report </a></li>
                      <!-- <li><a href="javascript:void(0)" data-div="7" ><i class=" fa fa-angle-right"></i> Used In </a></li> -->
                <li><a href="javascript:void(0)" ><i class=" fa fa-angle-right"></i>TEST ID <?php echo $test_series_detail['id']; ?></a></li>
            </ul>
        </div>
        <div class="panel-body">

            <?php if ($test_series_detail['publish'] == 0) { ?>
                <a href="<?php echo AUTH_PANEL_URL . "test_series/test_series/set_test_series_publish/" . $test_series_detail['id']; ?>"><button class="btn btn-xs btn-success pull-right bold">Publish</button></a>
            <?php } else { ?>
                <a href="<?php echo AUTH_PANEL_URL . "test_series/test_series/set_test_series_unpublish/" . $test_series_detail['id']; ?>"><button class="btn btn-xs btn-danger pull-right bold">Unpublish</button></a>
            <?php } ?>
        </div>
    </section>
    <?php
    /* get sale status */
    $sql = "select count(id) total,
              sum(case when result = 0 then 1 else 0 end) fail,
              sum(case when result = 1 then 1 else 0 end) pass
              from course_test_series_report
              Where test_series_id = " . $test_series_detail['id'];
    $sale_result = $this->db->query($sql)->row();
    $total = $pass = $fail = 0;
    if ($sale_result) {
        $total = $sale_result->total;
        $pass = $sale_result->pass;
        $fail = $sale_result->fail;
    }

    $all_language_meta = $this->db->select('id,language')->get('language_code')->result_array();
    $first_lng = $test_series_detail['lang_id'];
    $lang_arrray = explode(',', $first_lng);
    //print_r( $ts_sections_questions);
    //$count_qus=$ts_sections_questions['qus_count'];
    ?>

    <section class="panel">
        <div class="weather-bg">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-6">
                        <i class="fa fa-users"></i>Attempts</div>
                    <div class="col-xs-6">
                        <div class="degree"><?php echo $total; ?></div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="weather-category">
            <ul>
                <li class="active"><h5>Pass</h5><?php echo $pass; ?></li>
                <li><h5>fail</h5><?php echo $fail; ?></li>
            </ul>
        </footer>

    </section>

</div>

<div class="col-md-9 no-padding">

    <div style="display:none" class="alert bg-danger show_question_warning">
        <h4 class="bold">
            <i class="fa fa-ok-sign"></i>
            Note !
        </h4>
        <p>To publish this test you need to add <br>
            <?php
            foreach ($ts_sections_questions as $tsq) {
                echo $tsq['qus_count'];
                echo '&nbsp;questions ';
                echo '&nbsp;in &nbsp; ';
                echo $tsq['section_name'];
                echo '&nbsp;section ';
                echo '<br>';
            }
            ?>  
        </p>
    </div>


    <div id="tabContent1" class="col-lg-12 tabu">
        <section class="panel">
            <header class="panel-heading">
                Edit Test
            </header>



            <div class="panel-body">
                <form role="form" method="post" action="<?php echo AUTH_PANEL_URL . 'test_series/test_series/edit_test_series/' . $test_series_detail['id'] ?>"  enctype="multipart/form-data">             
                    <input type="hidden"  name = "id" id="id" value="<?php echo $test_series_detail['id']; ?>" class="form-control input-sm">
                    <input type="hidden"  name = "set_type"  value="" class="form-control input-sm">
                    <?php
                    $all_option = $this->db->where('status', 0)->get('course_stream_name_master')->result();
                    $main_option = $sub_option = "";
                    foreach ($all_option as $ao) {
                        if ($ao->parent_id == 0) {
                            if ($ao->id == $test_series_detail['stream']) {
                                $stream_st = "selected";
                            } else {
                                $stream_st = "";
                            }
                            $main_option .= "<option value='" . $ao->id . "' $stream_st  required>" . $ao->name . "</option>";
                        } else {
                            if ($ao->id == $test_series_detail['sub_stream']) {
                                $stream_st = "selected";
                            } else {
                                $stream_st = "";
                            }
                            $sub_option .= "<option style='display: none;' class='substream sub" . $ao->parent_id . "' value='" . $ao->id . "' $stream_st required>" . $ao->name . "</option>";
                        }
                    }

                    $test_type_data = $this->db->get('course_test_type_attribute')->result_array();
                    ?>

                    <div class="form-group col-md-4">
                        <label >SELECT STREAM</label>
                        <select class="form-control input-sm stream_element_select" name="stream">
                            <option value=''>--select Stream--</option>
<?php echo $main_option; ?>
                        </select>
                    </div>  
                    <div class="form-group col-md-4">
                        <label >SELECT SUB STREAM</label>
                        <select class="form-control input-sm sub_element_select" name="sub_stream">
                            <option value=''>--select Sub Stream--</option>
<?php echo $sub_option; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">Select Subject</label>
                        <select class="form-control input-sm " id="subject_id_basic" name="subject_id">
                            <option value="">Select</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">Select Topic</label>
                        <select class="form-control input-sm " id="topic_id_basic" name="topic_id">
                            <option value="">Select</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Sub Topic Name</label>
                        <select class="form-control input-sm " id="sub_topic_id_basic" name="sub_topic_id">
                            <option value="">Select</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label >TEST TYPE</label>
                        <select class="form-control input-sm" name="test_type" value="<?php echo $test_series_detail['test_type']; ?>" class="form-control input-sm">
                            <?php foreach ($test_type_data as $td) { ?>
                                <option value="<?php echo $td['id']; ?>" <?php if ($test_series_detail['test_type'] == $td['id']) {
                                echo "selected";
                            } ?>><?php echo $td['name']; ?></option>

<?php } ?>


                            <span class="error bold"><?php echo form_error('test_type'); ?></span>
                        </select>
                    </div>   

                    <div class="form-group col-md-4">
                        <label >Test Name</label>
                        <input type="text" placeholder="Enter name" name = "test_series_name" id="test_series_name" value="<?php echo $test_series_detail['test_series_name']; ?>" class="form-control input-sm"><span class="error bold"><?php echo form_error('test_series_name'); ?></span>

                    </div>
                    <div class="form-group col-md-4">
                        <label >Total questions</label>
                        <input type="text" placeholder="Enter total no. question" name = "total_questions" id="total_questions" value="<?php echo $test_series_detail['total_questions']; ?>" class="form-control input-sm" readonly>
                        <span class="error bold"><?php echo form_error('total_questions'); ?></span>
                    </div>
                    <div class="form-group col-md-4  hide">
                        <label>Session (year)</label>
                        <input type="text" placeholder="Session (year)" name = "session" id="session" value="<?php echo $test_series_detail['session']; ?>" class="form-control input-sm">
                        <span class="error bold"><?php echo form_error('session'); ?></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Pass percentage</label>
                        <input type="text" placeholder="Pass percentage"  name = "pass_percentage" id="pass_percentage" value="<?php echo $test_series_detail['pass_percentage']; ?>" class="form-control input-sm" onkeypress="return isNumberKey(event)">
                        <span class="error bold"><?php echo form_error('pass_percentage'); ?></span>
                    </div>
                    <div class="form-group col-md-4 ">
                        <label for="exampleInputEmail1">No of Subject</label>
                        <input type="number" placeholder="no of subjects" name = "no_of_subjects" value="<?php echo $test_series_detail['no_of_subjects']; ?>" id="no_of_subjects" class="form-control input-sm" onkeypress="return isNumberKey(event)">

                        <span class="error bold"><?php //echo form_error('subject'); ?></span>
                    </div>
                    <div class="form-group col-md-4 dropdown">
                        <label for="exampleInputEmail1">Language</label>
                        <button class="col-md-12  btn btn-sm btn-default dropdown-toggle" type="button" data-toggle="dropdown">language
                            <span class="caret"></span></button>
                        <ul class="col-md-12 dropdown-menu">
                            <?php
                            foreach ($all_language_meta as $language) {
                                if (in_array($language["id"], $lang_arrray)) {
                                    $lng_select = "checked='checked' readonly";
                                } else {
                                    $lng_select = "";
                                }
                                ?> 
                                <li>
                                    <input 
                                        data-lang-name="<?php echo $language['language']; ?>"
                                        name="language[]" 
                                        class=" language_checkbox select2-select req" 
                                        type="checkbox" 
                                        value="<?php echo $language['id']; ?>" 
                                        name="language[]" <?php echo $lng_select; ?>  
                                        onChange="getSelectedOptions()" >
    <?php echo $language['language']; ?> 
                                </li>
<?php } ?>
                        </ul>
                    </div>
                    <div class="form-group col-md-4 hide">
                        <label for="exampleInputEmail1">Subject</label>
                        <select class="form-control input-sm subject_element_select" name="subject" >
                        </select>
                        <span class="error bold"><?php echo form_error('subject'); ?></span>
                    </div>
                    <div class="form-group col-md-4 hide">
                        <label>Time in minutes</label>
                        <input type="text" placeholder="Time in minutes" name = "time_in_mins" id="time_in_mins" value="<?php echo $test_series_detail['time_in_mins']; ?>" class="form-control input-sm">
                        <span class="error bold"><?php echo form_error('session'); ?></span>
                    </div>
                    <div class="form-group col-md-4 ">
                        <label for="exampleInputEmail1">Difficulty level</label>
                        <select class="form-control input-sm" name="difficulty_level" value="<?php echo $test_series_detail['difficulty_level']; ?>" >
                            <option value="1" <?php if ($test_series_detail['difficulty_level'] == 1) {
    echo "selected";
} ?> >Easy</option>
                            <option value="2" <?php if ($test_series_detail['difficulty_level'] == 2) {
    echo "selected";
} ?> >Medium</option>
                            <option value="3" <?php if ($test_series_detail['difficulty_level'] == 3) {
    echo "selected";
} ?>>Hard</option>
                            <span class="error bold"><?php echo form_error('difficulty_level'); ?></span>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Video Url</label>
                        <input type="text" placeholder="video url" name = "video_url" value="<?php echo $test_series_detail['video_url']; ?>" id="video_url" class="form-control input-sm">

                        <span class="error bold"><?php //echo form_error('subject'); ?></span>

                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea rows="4" cols="50" class="form-control input-sm" name="description" value="" ><?php echo $test_series_detail['description']; ?></textarea>
                        <span class="error bold"><?php echo form_error('description'); ?></span>
                    </div>
                    <div class="form-group col-md-4 hide">
                        <label for="exampleInputEmail1">Test_price</label>
                        <select class="form-control input-sm" name="test_price" value="<?php echo $test_series_detail['test_price']; ?>" class="form-control">
                            <option value="1" <?php if ($test_series_detail['test_price'] == 1) {
    echo "selected";
} ?> >Free</option>
                            <option value="2" <?php if ($test_series_detail['test_price'] == 2) {
    echo "selected";
} ?>>Paid</option>
                            <span class="error bold"><?php echo form_error('test_price'); ?></span>
                        </select>
                    </div>

                    <div class="form-group col-md-4 hide">
                        <label>Negetive marking per question</label>
                        <input type="text" placeholder="Negative marking" name = "negative_marking" id="negative_marking" value="<?php echo $test_series_detail['negative_marking']; ?>" class="form-control input-sm">
                        <span class="error bold"><?php echo form_error('negative_marking'); ?></span>
                    </div>
                    <div class="form-group col-md-4 hide ">
                        <label>Marks per question</label>
                        <input type="text" placeholder="Marks per question" name = "marks_per_question" id="marks_per_question" value="<?php echo $test_series_detail['marks_per_question']; ?>" class="form-control input-sm">
                        <span class="error bold"><?php echo form_error('marks_per_question'); ?></span>
                    </div>
                    <div class="form-group col-md-4  hide">
                        <label>Total marks</label>
                        <input readonly type="text" placeholder="Total marks" name = "total_marks" id="total_marks" value="<?php echo $test_series_detail['total_marks']; ?>" class="form-control input-sm">
                        <span class="error bold"><?php echo form_error('total_marks'); ?></span>
                    </div>


                    <div class="form-group col-md-12">
                        <input class="btn btn-info btn-sm"  type="submit" name="basic_details_submit" value="Upload" >
                    </div>
                </form>

            </div>
        </section>
    </div>
    <div id="tabContent2" class="col-lg-12 tabu hide">
        <section class="panel">
            <header class="panel-heading">
                Upload CSV <a href="<?php echo base_url() . 'auth_panel_assets/sample_csv_questions.csv'; ?>" class="pull-right btn-sm btn btn-info btn-xs">Download Sample CSV</a>
            </header>
            <div class="panel-body">
                <div class="panel-body">
                    <form role="form" action="<?php echo AUTH_PANEL_URL . 'test_series/test_series/uploadCSV'; ?>" method="post" enctype="multipart/form-data" name="form1" id="form2">
<?php if (isset($_SESSION['question_csv_error'])) {
    echo $_SESSION['question_csv_error'];
    unset($_SESSION['question_csv_error']);
} ?>
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <input type="hidden"  id="id" name ="id" value="<?php echo $test_series_detail['id']; ?>">
                            <input type="file" accept=".csv" id="exampleInputFile" name ="userfile">

                        </div>
                        <button class="btn btn-info btn-sm" type="submit">Submit</button>
                    </form>
                </div>
                <div class="alert alert-success">
                    <span class="bold"> GUIDLINES :-</span>
                    <ul class="margin-bottom-none padding-left-lg">
                        <li><span class="bold">question : </span>This field is for question content.</li>
                        <li><span class="bold">description : </span>This field is for question description.</li>
                        <li><span class="bold">question_type : </span>This field is for question type :- MC - for multiple choice , SC -  for single choice , TF - for True & False</li>
                        <li><span class="bold">difficulty_level : </span>This field is for questions difficulty :- valueshold be 1,2,or 3 (1 - Easy , 2 -  medium , 3 - hard) </li>
                        <li><span class="bold">duration : </span>This field is for test duration in minutes</li>
                        <li><span class="bold">Option_1 : </span>This field is for question's option-1 </li>
                        <li><span class="bold">Option_2 : </span>This field is for question's option-2</li>
                        <li><span class="bold">Option_3 : </span>This field is for question's option-3</li>
                        <li><span class="bold">Option_4 : </span>This field is for question's option-4</li>
                        <li><span class="bold">Option_5 : </span>This field is for question's option-5</li>
                        <li><span class="bold">answer : </span>This field contains the answer of particular question and it should contain answer/answers separated by comma ex - 1 or 1,2,5</li>

                    </ul>
                </div>
            </div>


        </section>
    </div>

    <div id="tabContent3" class="col-lg-12 tabu">
        <section class="panel">
            <header class="panel-heading">
                Questions List
                <button class="btn-success btn-xs btn pull-right"  data-toggle="modal" data-target="#question_list"><i class="fa fa-plus"></i> Add</button>

            </header>
            <div class="hide">
                <label for="exampleInputEmail1"></label>
                <select class=" input-xs section_select pull-right" name="section_select" id="section_select">
                    <option value=''>--select Sub Stream--</option>
<?php foreach ($ts_sections_questions as $section_sect) { ?> 
                        <option value='<?php echo $section_sect['id']; ?>'><?php echo $section_sect['section_name']; ?></option>
<?php } ?>
                </select>
                <button class="btn-success btn btn-sm add_section_element pull-right ">Add All</button>

            </div>	
            <div class="panel-body">

                <div class="adv-table">
                    <table  class="display table table-bordered table-striped col-md-12" style="width:100%"  id="all-user-grid">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Question</th>
                                <th>Main Stream</th>
                                <th>Sub Stream</th>
                                <th>Subject</th>
                                <th>Topic</th>
                                <!-- <th>Difficulty level</th>
                                <th>Duration</th> -->
                                <th>Language</th>
                                <th>Added by</th>
                                <th>Q_ID</th>
                                <th>Test name </th>
                                <th>Action </th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th><input type="text" data-column="0"  class="search-input-text form-control"></th>
                                <th><input type="text" data-column="1"  class="search-input-text form-control"></th>
                                <th><input type="text" data-column="3"  class="search-input-text form-control"></th>
                                <th><input type="text" data-column="4"  class="search-input-text form-control"></th>
                                <th><input type="text" data-column="5"  class="search-input-text form-control"></th>
                                <th><input type="text" data-column="6"  class="search-input-text form-control"></th>
                                <th>
                                    <select data-column="8"  class="form-control search-input-select">
<?php foreach ($all_language_meta as $language) { ?>
                                            <option value="<?php echo $language['id']; ?>"><?php echo $language['language']; ?></option>

<?php } ?>
                                    </select>
                                </th>
                                <th></th>
                                <th></th>
                                <th><input type="text" data-column="9"  class="search-input-text form-control"></th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <div id="tabContent4" class="col-lg-12 tabu">
        <section class="panel">
            <header class="panel-heading">
                Advance option
            </header>
            <div class="panel-body">
                <form role="form" method="post" action="<?php echo AUTH_PANEL_URL . 'test_series/test_series/edit_test_series/' . $test_series_detail['id'] ?>"  enctype="multipart/form-data">
                    <input type="hidden"  name = "id" id="id" value="<?php echo $test_series_detail['id']; ?>" class="form-control input-sm">
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Cutoff</label>
                        <input requied type="text" placeholder="cutoff" name = "cutoff" id="cutoff" value="<?php echo $test_series_detail['cutoff']; ?>" class="form-control input-sm">
                        <span class="error bold"><?php echo form_error('cutoff'); ?></span>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Shuffle Question</label>
                        <select class="form-control input-sm" name="shuffle"  >
                            <option value="1" <?php if ($test_series_detail['shuffle'] == 1) {
    echo "selected";
} ?>>Yes</option>
                            <option value="0" <?php if ($test_series_detail['shuffle'] == 0) {
    echo "selected";
} ?>>No</option>
                        </select>
                        <span class="error bold"><?php echo form_error('shuffle'); ?></span>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Shuffle answers</label>
                        <select class="form-control input-sm" name="answer_shuffle" >
                            <option value="1" <?php if ($test_series_detail['answer_shuffle'] == 1) {
    echo "selected";
} ?> >Yes</option>
                            <option value="0" <?php if ($test_series_detail['answer_shuffle'] == 0) {
    echo "selected";
} ?>>No</option>
                        </select>
                        <span class="error bold"><?php echo form_error('answer_shuffle'); ?></span>
                    </div>
                    
                     
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Time boundation</label>
                        <select class="form-control input-sm" name="time_boundation" >
                            <option value="1"<?php if ($test_series_detail['time_boundation'] == 1) {
    echo "selected";
} ?>   >Yes</option>
                            <option value="0" <?php if ($test_series_detail['time_boundation'] == 0) {
    echo "selected";
} ?>  >No</option>
                        </select>
                        <span class="error bold"><?php echo form_error('time_boundation'); ?></span>
                    </div>
                    <div class="form-group col-md-3 ">
                        <label for="exampleInputEmail1">Re-Attempt Available Till</label>
                        <input class="form-control input-sm dpd_is_reattempt" name="is_reattempt" value="<?= ($test_series_detail['is_reattempt']) ? date("Y-m-d", $test_series_detail['is_reattempt']) : "" ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Duplicate rank</label>
                        <select class="form-control input-sm" name="allow_duplicate_rank" >
                            <option value="1" <?php if ($test_series_detail['allow_duplicate_rank'] == 1) {
    echo "selected";
} ?> >Yes</option>
                            <option value="0" <?php if ($test_series_detail['allow_duplicate_rank'] == 0) {
    echo "selected";
} ?> >No</option>
                        </select>
                        <span class="error bold"><?php echo form_error('allow_duplicate_rank'); ?></span>
                    </div>
 
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">Date Range</label>
                        <div data-date-format="mm/dd/yyyy" data-date="13/07/2013" class="input-group input-large">
                            <input type="text" name="start_date" class="form-control test_start_date"value="<?php echo ($test_series_detail['start_date'] != "") ? date('Y-m-d', $test_series_detail['start_date'] / 1000) : ""; ?>">
                            <span style="color:red"><?php echo form_error('start_date'); ?></span>
                            <span class="input-group-addon">To</span>
                            <input type="text" name="end_date" class="form-control test_end_date" value="<?php echo ($test_series_detail['end_date'] != "") ? date('Y-m-d', $test_series_detail['end_date'] / 1000) : ""; ?>">
                            <span style="color:red"><?php echo form_error('end_date'); ?></span>
                        </div>
                        <span class="help-block text-center">Select date range</span>
                    </div>
                    <div class="col-md-12 hide">
                        <div class="form-group col-md-3 bootstrap-timepicker">
                            <label>Start time</label>
             
                            <input type="text" placeholder="Start time" name = "start_time" id="start_time" value="<?php echo $test_series_detail['start_date']; ?>"  class="form-control input-sm test_start_timepicker">
                            <span class="error bold"><?php echo form_error('start_time'); ?></span>
                        </div>
                        <div class="form-group col-md-3 bootstrap-timepicker">
                            <label>End time</label>
                            <input type="text" placeholder="End time" name = "end_time" id="end_time" value="<?php echo $test_series_detail['end_date']; ?>" class="form-control input-sm test_end_timepicker">
                            <span class="error bold"><?php echo form_error('end_time'); ?></span>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Pass message</label>
                        <input type="text" placeholder="Pass message" name = "pass_message" id="pass_message" value="<?php echo $test_series_detail['pass_message']; ?>" class="form-control input-sm">
                        <span class="error bold"><?php echo form_error('pass_message'); ?></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label>General message</label>
                        <input type="text" placeholder="General message" name = "general_message" id="general_message" value="<?php echo $test_series_detail['general_message']; ?>" class="form-control input-sm">
                        <span class="error bold"><?php echo form_error('general_message'); ?></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Fail message</label>
                        <input type="text" placeholder="Fail message" name = "fail_message" id="fail_message" value="<?php echo $test_series_detail['fail_message']; ?>" class="form-control input-sm">
                        <span class="error bold"><?php echo form_error('fail_message'); ?></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Reward Points</label>
                        <input type="text" placeholder="Reward Points" name = "reward_points" id="reward_points" value="<?php echo $test_series_detail['reward_points']; ?>" class="form-control input-sm">
                        <span class="error bold"><?php echo form_error('reward_points'); ?></span>
                    </div>
                    <div class="form-group col-md-12">
                        <input class="btn btn-info btn-sm"  type="submit" name="account_details_button" value="Update" >
                    </div>
                </form>
            </div>
        </section>
    </div>
    <div id="tabContent5" class="col-lg-12 tabu hide">
        <section class="panel">
            <header class="panel-heading">
                Upload Cover image
            </header>
            <div class="panel-body">
                <div class="cover_image_element"><img src="<?php echo $test_series_detail['image']; ?>" style="max-width:100px;"></div>
                <div class="panel-body">
                    <form role="form" action="<?php echo AUTH_PANEL_URL . 'test_series/test_series/uploadimage'; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <input type="hidden"  id="id" name ="id" value="<?php echo $test_series_detail['id']; ?>">
                            <input type="file" accept="image/*" id="exampleInputFile" name ="userfile">
                        </div>
                        <button class="btn btn-info" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </section>
    </div>



    <div id="tabContent8" class="col-lg-12 tabu">
        <section class="panel">
            <header class="panel-heading">
                Add Section
            </header>
            <div class="panel-body">

                <button id="add_row_section" class="btn btn-warning btn-sm pull-right">Add Section</button>
                <button id="edit_rows" class="btn btn-primary btn-sm pull-right " onclick="edit_section();">View List</button> 
                <table class="table table-hover" id="ques_table" style="display:none;">
                    <thead>
                    <th><button id="add_row" class="btn btn-success btn-sm pull-left">Add</button><th>
                    <tr>
                        <th>Section</th>
                        <th>No of Question</th>
                        <th>Marks per Question</th>
                        <th>Negative Weightage</th>
                        <th>Section Timing</th>     
                        <th>Cut off</th>   
                        <th>Action</th>
                    </tr>
                    </thead>


                    <tbody>
<?php //print_r($subject_list) ;  ?>
                        <tr id="append_row" class="hide">
                            <td>
                                <select name="section_name" class="col-md-8 element_section_name">
<?php foreach ($subject_list as $subjects) { ?> 
                                        <option value="<?php echo $subjects['id']; ?>"><?php echo $subjects['name']; ?></option>
<?php } ?>
                                </select>
                            </td>

                            <td><input class="col-md-8" name="no_question" id="no_question" value="" type="text" placeholder="no of question" onkeypress="return isNumberKey(event)" ></td>

                            <td><input class="col-md-8"   name="marks_per_ques" id="marks_per_ques" type="text" placeholder="Marks per question" onkeypress="return isNumberKey(event)" ></td>

                            <td>
                                <select name="negative_mrks" id="negative_mrkse" >
                                    <option value="0">0</option>
<?php $j = 1;
for ($i = 1; $i <= 10; $i++) {
    ?>
                                        <option value="<?php echo round($j / $i, 2); ?>" >1/<?php echo $i; ?></option>
<?php } ?>
                                </select>
                            </td>

                            <td>
                           <!--  <select name="seconds" id="seconds">
<?php for ($i = 0; $i <= 10; $i++) { ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php } ?>
                            </select> -->

                                <select name="minutes" id="minutes">
                                        <?php for ($i = 1; $i <= 240; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php } ?>
                                </select>
                            </td>   
                            <td><input type="text" value="" name="section_cutoff"></td>     
                            <td>
                                <button  type="button" class="btn btn-primary btn-xs save_section_element" id="save_section_element">Save</button>
                                <button  type="button" class="btn btn-danger btn-xs delete_section_element" id="delete_section_element" >delete</button>

                            </td>
                        </tr>


                    </tbody>
                </table>
                <div id="edit_section">
                    <table class="table table-hover" id="edit_section_table" >
                        <thead>
                            <tr>
                                <th>Section</th>
                                <th>No of Question</th>
                                <th>Marks per Question</th>
                                <th>Negative Weightage</th>
                                <th>Section Timing</th>  
                                <th>Cut off</th>         
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
<?php
foreach ($section_test_series as $st_section) {
    $time_section = explode(".", $st_section['section_timing']);
    $minutes = $time_section[0];
    ?>
                                <tr  >
                                    <td>
                                        <input class="col-md-8"   name="sec_id" id="sec_id" type="hidden" value="<?php echo $st_section['id']; ?>" >

                                        <select name="section_namee" class="col-md-8 element_section_namee" readonly>
    <?php foreach ($subject_list as $subjects) { ?> 
                                                <option value="<?php echo $subjects['id']; ?>" <?php if ($st_section['section_id'] == $subjects['id']) { ?>
                                                            selected= "selected" <?php } ?> ><?php echo $subjects['name']; ?></option>
    <?php } ?>
                                        </select>
                                    </td>

                                    <td><input class="col-md-8" name="no_questione" id="no_questione" value="<?php echo $st_section['no_of_questions']; ?>" type="text" placeholder="no of question" onkeypress="return isNumberKey(event)" ></td>

                                    <td><input class="col-md-8"   name="marks_per_quese" id="marks_per_quese" type="text" value="<?php echo $st_section['marks_per_question']; ?>"  placeholder="Marks per question" onkeypress="return isNumberKey(event)" ></td>
                                    <td>
                                        <select name="negative_mrkse" id="negative_mrkse" >
                                            <option value="0">0</option>
    <?php $j = 1;
    for ($i = 1; $i <= 10; $i++) {
        ?>

                                                <option value="<?php echo round($j / $i, 2); ?>" <?php if ($st_section['negative_marks'] == round($j / $i, 2)) { ?>
                                                            selected= "selected" <?php } ?> >1/<?php echo $i; ?>
                                                </option>
    <?php } ?>
                                        </select>
                                    </td>

                                    <td><select name="minutese" id="minutese">
    <?php for ($i = 1; $i <= 240; $i++) { ?>
                                                <option value="<?php echo $i; ?>" <?php if ($minutes == $i) { ?>
                                                            selected="selected"      <?php } ?> ><?php echo $i; ?></option>
    <?php } ?>

                                        </select> 

            <!-- <select name="minutese" id="minutese">
    <?php for ($i = 1; $i <= 60; $i++) { ?>
                <option value="<?php echo $i; ?>" <?php if ($minutes == $i) { ?>
                       selected="selected"     <?php } ?> ><?php echo $i; ?></option>
    <?php } ?>
            </select> -->
                                    </td>     
                                    <td><input type="text" name="section_cutoff" value="<?php echo $st_section['section_cutoff']; ?>"></td>      
                                    <td>
                                        <input type="button" id="edit_button2"  class="btn btn-info btn-xs edit_section_element " data-practice_id="<?php //echo $tp['practice_id'];  ?>" name="edit_section_element"  style=""  value="Edit"  onclick="">
                                        <input type="button" id="edit_button2"  class="btn btn-info btn-xs update_section_element "  style="display:none;" value="update"  onclick=";">
                                        <button  type="button" class="btn btn-danger btn-xs delete_section_element" id="delete_section_element"  >delete</button>
                                    </td>
                                </tr>
                          <?php } ?>
                        </tbody>
                    </table>
                    <div role="dialog"  id="myModal5" class="modal fade" >
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                    <h4 class="modal-title "> Add Course Type </h4>
                                </div>
                                <div class="modal-body">
                                    <div class="panel-body">
                                        <form id="add_course_type_course" novalidate="novalidate" autocomplete="off" role="form" method="post" action="<?php echo AUTH_PANEL_URL . "course_product/course/add_course_type"; ?>" enctype="multipart/form-data" class="form-inline">
                                            <div class="form-group">
                                                <!-- <label for="exampleInputEmail2" >Course Type</label> -->
                                                <input type="text" name="course_type" placeholder="course type "   id="practice_id" value="<?php //echo @$course_data['practice_id'];  ?>" class="input-sm form-control required">
                                            </div>
                                          <!-- <input type="hidden" name="active_topic_id" value="<?php //echo @$course_data['practice_id'];  ?>"> -->
                                            <input type="hidden" name="course_id" value="<?php echo $c_id ?>">
                                            <button class="btn btn-success btn-sm" type="submit">Add</button>
                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

</section>
<!-- new 5 oct-veenus strt -->
<section class="panel  hide">
    <header class="panel-heading">
        Section
    </header>
    <div class="panel-body">
        <div class="adv-table">
            <table  class="display table table-bordered table-striped col-md-12" style="width:100%" id="all-test-series-section-grid">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Section</th>
                        <th>No of Question</th>
                        <th>Marks per Question</th>
                        <th>Negative Weightage</th>
                        <th>Section Timing</th>        
                        <th>Action</th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th><input type="text" data-column="0"  class="search-input-text form-control"></th>
                        <th><input type="text" data-column="1"  class="search-input-text form-control"></th>
                        <th><input type="text" data-column="2"  class="search-input-text form-control"></th>
                        <th><input type="text" data-column="3"  class="search-input-text form-control"></th>
                        <th><input type="text" data-column="3"  class="search-input-text form-control"></th>
                        <th><input type="text" data-column="3"  class="search-input-text form-control"></th>
                        <th><input type="text" data-column="3"  class="search-input-text form-control"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>
<!-- new 5 oct-veenus -->
</div>
<!--<div id="tabContent5" class="col-lg-12 tabu">
    <section class="panel">
        <header class="panel-heading">
            Upload Cover image
        </header>
        <div class="panel-body">
            <div class="cover_image_element"><img src="<?php echo $test_series_detail['image']; ?>" style="max-width:100px;"></div>
            <div class="panel-body">
                <form role="form" action="<?php echo AUTH_PANEL_URL . 'test_series/test_series/uploadimage'; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <input type="hidden"  id="id" name ="id" value="<?php echo $test_series_detail['id']; ?>">
                        <input type="file" accept="image/*" id="exampleInputFile" name ="userfile">
                    </div>
                    <button class="btn btn-info" type="submit">Submit</button>
                </form>
            </div>
        </div>
</div>        -->
</section>
</div>
<div id="tabContent6" class="col-lg-12 tabu">
    <section class="panel">
        <header class="panel-heading">
            Report
        </header>
        <div class="panel-body">
            <div class="adv-table">
            <a href="<?php echo base_url('index.php/auth_panel/test_series/test_series/exportCsv/'.$id) ?>" class="btn btn-success btn-sm">Export CSV</a><br>
                <div class="col-md-6 pull-right">
                    
                    <div data-date-format="dd-mm-yyyy" data-date="13/07/2013" class="input-group ">
                        <div  class="input-group-addon">From</div>
                        <input type="text" id="min-date-test-series" class="form-control date-range-filter input-sm course_start_date"  placeholder="">

                        <div class="input-group-addon">to</div>

                        <input type="text" id="max-date-test-series" class="form-control date-range-filter input-sm course_end_date"  placeholder="">

                    </div>
                </div>
                <table  class="display table table-bordered table-striped col-md-12" style="width:100%" id="all-test-series-report-grid">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User name</th> 
                            <th>Email</th>
                            <th>Phone</th>                           
                            <th>Result</th>
                            <th>Score</th>
                            <th>Time</th>
                            <th>Percentage</th>
                            <th>Creation time</th>
                            
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th><input type="text" data-column="0"  class="search-input-text form-control"></th>
                            <th><input type="text" data-column="1"  class="search-input-text form-control"></th>
                            <th><input type="text" data-column="2"  class="search-input-text form-control"></th>
                            <th><input type="text" data-column="3"  class="search-input-text form-control"></th>
                            <th><input type="text" data-column="4"  class="search-input-text form-control"></th>
                            <th><input type="text" data-column="5"  class="search-input-text form-control"></th>
                            <th><input type="text" data-column="6"  class="search-input-text form-control"></th>
                            <th><input type="text" data-column="7"  class="search-input-text form-control"></th>
                            <th><input type="text" data-column="8"  class="search-input-text form-control"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>

<?php
/* related course code start here
 * do not send key if no relation found
 */
$sql = "SELECT id ,title ,cover_image,mrp ,tags,  description,is_new ,for_dams ,non_dams
					from course_master
					where id IN (SELECT ctm.course_fk FROM course_segment_element as cse join course_topic_master ctm on ctm.id = cse.segment_fk where type='test' && element_fk = '" . $test_series_detail['id'] . "' group by ctm.course_fk  ) ";
$match = $this->db->query($sql)->result_array();
if (count($match) > 0) {
    
}
?>
<div id="tabContent7" class="col-lg-12 tabu">
    <section class="panel">
        <header class="panel-heading">
            Used In Courses
        </header>
        <style>
            .course_desc {

                max-height: 40px;
                min-height: 40px;
                overflow: hidden;
            }
            .course_tags {
                max-height: 40px;
                min-height: 40px;
                overflow: hidden;
            }
        </style>
        <div class="panel-body">
            <div class="row-fluid">
                <ul class="thumbnails">
<?php foreach ($match as $m) { ?>
                        <li class="col-md-4">
                            <div class="thumbnail">
                                <img alt="<?php echo $m['title']; ?>" style="max-width: 300px; height: 100px;" src="<?php echo $m['cover_image']; ?>">
                                <div class="caption">
                                    <h4 class="capitalize" ><?php echo $m['title']; ?></h4>
                                    <p class="course_desc" ><?php echo substr($m['description'], 0, 80) . ' ...'; ?></p>
                                    <p><a class="btn btn-success btn-xs " href="<?php echo AUTH_PANEL_URL . 'course_product/course/edit_course_page?course_id=' . $m['id']; ?>">View</a></p>
                                </div>
                            </div>
                        </li>
<?php } ?>
                </ul>
            </div>
        </div>
    </section>
</div>
</div>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="crossorigin="anonymous"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>-->
<script>
    $.ajax({
        type: 'POST',
        url: "<?= AUTH_PANEL_URL ?>course_product/stream/get_subject_by_stream/" + '<?= $test_series_detail['sub_stream'] ?>' + "?json=json",
        dataType: 'json',
        success: function (data) {
            if (data.data == 1) {
                let selected = "";
                $.each(data.result, function (index, value) {
                    selected = "";
                    if (value.id == "<?= $test_series_detail['subject'] ?>") {
                        selected = "SELECTED";
                    }
                    $("#subject_id_basic").append("<option " + selected + " value='" + value.id + "'>" + value.name + "</option>");
                });
                $("#subject_id_basic").val("<?=$test_series_detail['subject']?>").change();
                
                //show_toast('success', 'Subject Synced', 'Successful');
            } else {
                show_toast('error', 'Subject Not Found', 'Error');
            }
            $.ajax({
                type: 'POST',
                url: "<?= AUTH_PANEL_URL ?>course_product/Subject_topics/get_topic_from_subject/" + '<?=$test_series_detail['subject']?>' + "?return=json",

                dataType: 'json',
                success: function (data) {
                    var html = "<option value=''>--select--</option>";
                    if (data) {
                         $.each( data , function( key , value ) {
                         html += "<option value='"+value.id+"'>"+value.topic+"</option>";
                        });
                        $("#topic_id_basic").html(html).val("<?= $test_series_detail['topic_id'] ?>").change();
                        //show_toast('success', 'Topic Synced', 'Successful');
                    }else{
                        show_toast('error', 'Topic Not Found', 'Error');
                    }
                    $.ajax({
                        type: 'POST',
                        url: "<?= AUTH_PANEL_URL ?>course_product/Subject_topics/get_sub_topic_from_topic/" + "<?= $test_series_detail['topic_id'] ?>"+"?return=ajax_json",
                        dataType: 'json',
                        success: function (data) {
                            if (data.data == 1) {
                                $("#sub_topic_id_basic").html(data.result);
                                $("#sub_topic_id_basic").val("<?= $test_series_detail['sub_topic_id'] ?>");
                                //show_toast('success', 'Subtopic Synced', 'Successful');
                            } else {
                                show_toast('error', 'Subtopic Not Found', 'Error');
                            }
                        },
                        error: function (data) {

                        }
                    });
                },
                error: function (data) {

                }
            });
        },
        error: function (data) {

        }
    });
    $("#subject_id_basic").change(function () {
        $("#topic_id_basic,#sub_topic_id_basic").html("<option value=''>Select</option>");
        var subject_id = $(this).val();
        if (!subject_id) {
            show_toast('error', 'Please Select Valid Chapter', 'InValid Chapter');
            return false;
        }
        $.ajax({
            type: 'POST',
            url: "<?= AUTH_PANEL_URL ?>course_product/Subject_topics/get_topic_from_subject/" + subject_id + "?return=json",

            dataType: 'json',
            success: function (data) {
                 var html = "<option value=''>--select--</option>";
                        $.each( data , function( key , value ) {
                       html += "<option value='"+value.id+"'>"+value.topic+"</option>";
                     });
                 $("#topic_id_basic").html(html).val("<?= $test_series_detail['topic_id'] ?>").change();
                   
                
            },
            error: function (data) {

            }
        });
    });
    $("#topic_id_basic").change(function () {
        $("#sub_topic_id").html("<option value=''>Select</option>");
        var topic_id = $(this).val();

        if (!topic_id) {
            show_toast('error', 'Please Select Valid Topic', 'InValid Topic');
            return false;
        }
        $.ajax({
            type: 'POST',
            url: "<?= AUTH_PANEL_URL ?>course_product/Subject_topics/get_sub_topic_from_topic/" + topic_id +"?return=ajax_json",
            dataType: 'json',
            success: function (data) {
                if (data.data == 1) {
                    $("#sub_topic_id_basic").html(data.result);
                    $("#sub_topic_id_basic").val("<?= $test_series_detail['sub_topic_id'] ?>");
                    //show_toast('success', 'Subtopic Synced', 'Successful');
                } else {
                    show_toast('error', 'Subtopic Not Found', 'Error');
                }
            },
            error: function (data) {

            }
        });
    });
    $(".sub_element_select").change(function () {
        $("#subject_id_basic,#topic_id_basic,#sub_topic_id_basic").html("<option value=''>Select</option>");
        var sub_stream = $(this).val();
        if (!sub_stream) {
            show_toast('error', 'Please Select Valid Sub Stream', 'InValid Sub Stream');
            return false;
        }
        $.ajax({
            type: 'POST',
            url: "<?= AUTH_PANEL_URL ?>course_product/stream/get_subject_by_stream/" + sub_stream + "?json=json",
            dataType: 'json',
            success: function (data) {
                if (data.data == 1) {
                    let selected = "";
                    $.each(data.result, function (index, value) {
                        selected = "";
                        if (value.id == "<?= $test_series_detail['subject'] ?>") {
                            selected = "SELECTED";
                        }
                        $("#subject_id_basic").append("<option " + selected + " value='" + value.id + "'>" + value.name + "</option>");
                    });
                    $("#subject_id_basic").val("<?=$test_series_detail['subject']?>").change();
                    show_toast('success', 'Subject Synced', 'Successful');
                } else {
                    show_toast('error', 'Subject Not Found', 'Error');
                }
            },
            error: function (data) {

            }
        });
    });
    let g_unit_id = 1, g_chapter_id = 1, g_topic_id = 1, g_sub_topic_id = 1;
    function ajax_call_basic(task_id, attr) {
        $.ajax({
            type: 'POST',
            url: "<?= AUTH_PANEL_URL ?>course_product/Subject_topics/ajax_get_unit",
            data: {id: task_id},
            dataType: 'json',
            success: function (data) {
                if (data.data == 1) {
                    $("#" + attr).html(data.result);
                    show_toast('success', 'Unit/Chapter Synced', 'Successful');
                } else {
                    show_toast('error', 'Unit/Chapter Not Found', 'Error');
                }
            },
            error: function (data) {

            }
        });
    }
</script>
<?php
$adminurl = AUTH_PANEL_URL;
$test_series_id = $test_series_detail['id'];
$subject_id = $test_series_detail['subject'];
$total_question_reqd = $test_series_detail['total_questions'];
$custum_js = <<<EOD
<script>
    $('#container').addClass('sidebar-closed');
    $('#main-content').css('margin-left',"0px");
</script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
<script>
    $(".stream_element_select").change(function() {
       val = $(this).val();
       $('.sub_element_select').val('');
       $('.substream').hide();
       $('.sub'+val).show();
    });
    function getCookie(cn) {
        var name = cn+"=";
        var allCookie = decodeURIComponent(document.cookie).split(';');
        var cval = [];
        for(var i=0; i < allCookie.length; i++) {
            if (allCookie[i].trim().indexOf(name) == 0) {
                cval = allCookie[i].trim().split("=");
            }
        }
        return (cval.length > 0) ? cval[1] : "";
    }
    /* show hide magic */
    $('.prod-cat a').click(function (e) {
         div =  $(this).data('div');
        $('.tabu').hide();
        $(this).tab('show');
        var tabContent = '#tabContent' + div;
        $(tabContent).show();
       document.cookie = "activediv_test="+tabContent;
    });

    if(getCookie("activediv_test")){
         $('.tabu').hide();
       $(getCookie('activediv_test')).show();
    }
    /* datatables */
    jQuery(document).ready(function() {
        var table = 'all-user-grid';
        var dataTable = jQuery("#"+table).DataTable( {
            "processing": true,
            "serverSide": true,
            "order": [[ 0, "desc" ]],
            "ajax":{
                url :"$adminurl"+"test_series/test_series/ajax_test_series_question_list/?test_series_id=$test_series_id", // json datasource
                type: "post",  // method  , by default get
                error: function(){  // error handling
                    jQuery("."+table+"-error").html("");
                    jQuery("#"+table+"_processing").css("display","none");
                }
            }
        });
        jQuery("#"+table+"_filter").css("display","none");
        $('#all-user-grid .search-input-text').on( 'keyup click', function () {   // for text boxes
            var i =$(this).attr('data-column');  // getting column index
            var v =$(this).val();  // getting search input value
            dataTable.columns(i).search(v).draw();
        });
        $('#all-user-grid .search-input-select').on( 'change', function () {   // for select box
             var i =$(this).attr('data-column');
             var v =$(this).val();
             dataTable.columns(i).search(v).draw();
        });

        $( document ).ajaxComplete(function( event, xhr, settings ) {
          if ( settings.url === "$adminurl"+"test_series/test_series/ajax_test_series_question_list/?test_series_id=$test_series_id" ) {
            //$( ".log" ).text( "Triggered ajaxComplete handler. The result is " +
            //  xhr.responseText );
            var obj = jQuery.parseJSON(xhr.responseText);
            if('$total_question_reqd' != obj.recordsTotal ){
              $('.show_question_warning').show();
            }else{
              $('.show_question_warning').hide();
            }
          }
        });

        // Handle click on "Select all" control
        $('#example-select-all_select').on('click', function(){
           // Get all rows with search applied
           var rows = dataTable_q_list.rows({ 'search': 'applied' }).nodes();
           // Check/uncheck checkboxes for all rows in the table
           $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });
        // Handle click on checkbox to set state of "Select all" control
        $('#example tbody').on('change', 'input[type="checkbox"]', function(){
           // If checkbox is not checked
           if(!this.checked){
              var el = $('example-select-all_select').get(0);
              // If "Select all" control is checked and has 'indeterminate' property
              if(el && el.checked && ('indeterminate' in el)){
                 // Set visual state of "Select all" control
                 // as 'indeterminate'
                 el.indeterminate = true;
              }
           }
        });
        // Handle form submission event of section add
        //$('#frm-example').on('submit', function(e){
            $('.add_section_element').on('click', function(e){
            //add_section_element
            var form = this;
            var section_id=$("#section_select").val();
            //alert(section_id);
            // Iterate over all checkboxes in the table
            dataTable.$('input[type="checkbox"]').each(function(){
                // If checkbox is checked
                if(this.checked){
                    // Create a hidden element
                    console.log($(this).val());
                    var id = $(this).val();
                    jQuery.ajax({
                        url: "$adminurl"+"test_series/test_series/add_sections_in_test",
                        method: 'POST',
                        dataType: 'json',
                        async:false,
                        data: {
                            "id":  id,
                            "section_id":  section_id,
                        },
                        success: function (data) {
                            $('#all-user-grid').DataTable().ajax.reload();
                            show_toast('success', "Questions Added to to the selected section.", "Question Added");
                        }
                    });
                }
            });
            $('#sall-user-grid').DataTable().ajax.reload();

            }); 
        });

        jQuery(document).ready(function() {
            var table = 'all-test-series-report-grid';
            var dataTable_test_series = jQuery("#"+table).DataTable( {
            "processing": true,
            "serverSide": true,
            "order": [[ 0, "desc" ]],
            "ajax":{
                url :"$adminurl"+"test_series/test_series/ajax_test_series_report_list/?test_series_id=$test_series_id", // json datasource
                type: "post",  // method  , by default get
                error: function(){  // error handling
                    jQuery("."+table+"-error").html("");
                    jQuery("#"+table+"_processing").css("display","none");
                }
            }
        });
        jQuery("#"+table+"_filter").css("display","none");
        $('#all-test-series-report-grid .search-input-text').on( 'keyup click', function () {   // for text boxes
            var i =$(this).attr('data-column');  // getting column index
            var v =$(this).val();  // getting search input value
            dataTable_test_series.columns(i).search(v).draw();
        });
        $('#all-test-series-report-grid .search-input-select').on( 'change', function () {   // for select box
             var i =$(this).attr('data-column');
             var v =$(this).val();
             dataTable_test_series.columns(i).search(v).draw();
        });
        // Re-draw the table when the a date range filter changes
        $('#all-test-series-report-grid  .date-range-filter').change(function() {
            if($('#min-date-test-series').val() !="" && $('#max-date-test-series').val() != "" ){
                var dates = $('#min-date-test-series').val()+','+$('#max-date-test-series').val();
                dataTable_test_series.columns(3).search(dates).draw();
            }
        });
    });
			              
    $('.test_start_date').datepicker({
        autoclose: true
    });
    $('.test_end_date').datepicker({
        autoclose: true
    });
    $('.dpd_is_reattempt').datepicker({
        autoclose: true
    });    
    $('.test_start_timepicker').timepicker({
        autoclose: true,
        minuteStep: 1,
        showSeconds: false,
        showMeridian: false
    });
    $('.test_end_timepicker').timepicker({
        autoclose: true,
        minuteStep: 1,
        showSeconds: false,
        showMeridian: false
    });
    $('#min-date-test-series').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    });
    $('#max-date-test-series').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    });

    jQuery(document).ready(function() {
        var subject_id = '$subject_id';
        var table = 'subject_questions_list';
        var dataTable_q_list = jQuery("#"+table).DataTable({
           "processing": true,
           "serverSide": true,
           "order": [[ 0, "desc" ]],
           "ajax":{
               url :"$adminurl"+"test_series/test_series/ajax_subject_wise_question_list/?subject_id="+subject_id+"&test_series_id=$test_series_id", // json datasource
               type: "post",  // method  , by default get
               error: function(){  // error handling
                   jQuery("."+table+"-error").html("");
                   jQuery("#"+table+"_processing").css("display","none");
               }
           },
           "pageLength": 10,
           'columnDefs': [
            {'targets': 7,'searchable': false,'orderable': false,'className': 'dt-body-center'},
            {'targets': 9,'searchable': false,'orderable': false,'className': 'dt-body-center'},
            {'targets': 10,'searchable': false,'orderable': false,'className': 'dt-body-center'}
           ]
        });
        jQuery("#"+table+"_filter").css("display","none");
        $('#subject_questions_list .search-input-text').on( 'keyup click', function () {   // for text boxes
            var i =$(this).attr('data-column');  // getting column index
            var v =$(this).val();  // getting search input value
            dataTable_q_list.columns(i).search(v).draw();
        });
        $('#subject_questions_list .search-input-select').on( 'change', function () {   // for select box
            var i =$(this).attr('data-column');
            var v =$(this).val();
            dataTable_q_list.columns(i).search(v).draw();
        });
        // Handle click on "Select all" control
        $('#example-select-all').on('click', function(){
           // Get all rows with search applied
           var rows = dataTable_q_list.rows({ 'search': 'applied' }).nodes();
           // Check/uncheck checkboxes for all rows in the table
           $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        // Handle click on checkbox to set state of "Select all" control
        $('#example tbody').on('change', 'input[type="checkbox"]', function(){
           // If checkbox is not checked
           if(!this.checked){
              var el = $('#example-select-all').get(0);
              // If "Select all" control is checked and has 'indeterminate' property
              if(el && el.checked && ('indeterminate' in el)){
                 // Set visual state of "Select all" control
                 // as 'indeterminate'
                 el.indeterminate = true;
              }
           }
        });

        // Handle form submission event
        //$('#frm-example').on('submit', function(e){
        $('.add_questions_element').on('click', function(e){
            //add_questions_element
            var form = this;
            // Iterate over all checkboxes in the table
            dataTable_q_list.$('input[type="checkbox"]').each(function(){
                // If checkbox is checked
                if(this.checked){
                    // Create a hidden element
                    var testSeriesId =	'$test_series_id';
                    var questionId =	$(this).val();
                    var subject_id =	$(this).data('section-id');
                                   
                    jQuery.ajax({
                        url: "$adminurl"+"test_series/test_series/add_question_to_testseries",
                        method: 'POST',
                        dataType: 'json',
                        async:false,
                        data: {
                          "testSeriesId":  testSeriesId,
                          "questionId":  questionId,
                          "subject_id":  subject_id
                        },
                        success: function (data) {
                            if(data=='1'){
                                $('#all-user-grid').DataTable().ajax.reload();
                                show_toast('success', "Question added to test series.", "Question Added");
                            }else if(data=='2'){
                                // $('#all-user-grid').DataTable().ajax.reload();
                                show_toast('error', "No of questions exceeded in this section .", "Question not  Added");
                            }else if(data=='3'){
                                // $('#all-user-grid').DataTable().ajax.reload();
                                show_toast('error', "Question Already Added in this test series .", "Question not  Added");
                            }
                        }
                    });
                }
            });
            $('#subject_questions_list').DataTable().ajax.reload();
        });
    });

    $(document).on('click','.add_question_to_series',function() {
        var testSeriesId =	$(this).data('test-series-id');
        var questionId =	$(this).data('question-id');
        var subject_id =	$(this).data('section-id');
        jQuery.ajax({
            url: "$adminurl"+"test_series/test_series/test_question_count",
            method: 'POST',
            dataType: 'json',
            async:false,
            data: {
              "testSeriesId":  testSeriesId,
              "questionId":  questionId,
              "subject_id":  subject_id,
            },
            success: function (data) {
                if(data=='1'){
                    $('#subject_questions_list').DataTable().ajax.reload();
                    $('#all-user-grid').DataTable().ajax.reload();
                    show_toast('error', "No of questions exceeded in this section .", "Question not  Added");
                }else{
                    jQuery.ajax({
                        url: "$adminurl"+"test_series/test_series/add_question_to_testseries",
                        method: 'POST',
                        dataType: 'json',
                        async:false,
                        data: {
                          "testSeriesId":  testSeriesId,
                          "questionId":  questionId,
                          "subject_id":  subject_id,
                        },
                        success: function (data) {
                          $('#subject_questions_list').DataTable().ajax.reload();
                          $('#all-user-grid').DataTable().ajax.reload();
                          show_toast('success', "Question added to test series.", "Question Added");
                        },
                    });
                }                 
            },
        });             
    });

    $(document).ready(function(){
        $('#add_row').click(function(){
            var row_html   =($("#append_row").html());
            $('#ques_table tbody').append('<tr>'+row_html+'</tr>');
            $("#ques_table").show(); 
            $("#edit_section_table").hide(); 
            
        });
        $('#add_row_section').click(function(){
            $("#ques_table").show(); 
            $("#edit_section_table").hide(); 
            
        });
       
    });

    function getSelectedOptions(){
        $('.language_checkbox:checked').each(function() {
            if($(".language_checkbox:checked").length <= 2) {

            }else{
                // $(this).prop('checked', false);
                //alert('You can select only 2 languages ');
                show_toast('error', 'You can select only 2 languages ','language');
            }
        });
    }
    /*----add test sections----*/ 
    
    $(document).on('click', '.save_section_element', function(event) {
        console.log('adding sec' );
        var section_id = $(this).closest('tr').find('select[name=section_name]').val();
        var no_question = $(this).closest('tr').find('input[name=no_question]').val();
        var marks_per_ques = $(this).closest('tr').find('input[name=marks_per_ques]').val();
        var negative = $(this).closest('tr').find('select[name=negative_mrks]').val();
        var minutes = $(this).closest('tr').find('select[name=minutes]').val();
        var section_cutoff = $(this).closest('tr').find('input[name=section_cutoff]').val();
        // var seconds = $(this).closest('tr').find('select[name=seconds]').val();
        testSeriesId=$("#id").val();

        if(section_id==''){           
            alert('Please choose section');           
        }else if(no_question==''){               
            alert('Please enter number of questions '); 
        }else if(marks_per_ques==''){                    
            alert('Please enter marks per question ');                    
        }else if(negative==''){                        
            alert('Please enter negivie marks per question ');                        
        }else if(minutes==''){                            
            alert('Please enter minutes '); 
        }else{    
            //alert(negative);
            jQuery.ajax({
                url: "$adminurl"+"test_series/test_series/add_section_to_testseries",
                method: 'POST',
                dataType: 'json',
                async:false,
                data: {
                    "section_id":section_id,
                    "no_question":no_question,
                    "marks_per_ques":marks_per_ques,
                    "negative":negative,
                    "minutes":minutes,
                    "testSeriesId":  testSeriesId,
                    "section_cutoff":section_cutoff
                },
                success: function (data) {
                    if(data=='1'){
                        show_toast('error', "Please Choose another section. As already choosen!.", "Section not  Added");
                    }else  if(data=='2'){
                        $('#subject_questions_list').DataTable().ajax.reload();
                        $('#all-user-grid').DataTable().ajax.reload();
                        show_toast('success', "Section added to test series.", "Section Added");
                        $(this).closest('tr').find('.save_section_element').hide();
                        $(this).closest('tr').find('.edit_section_element').show();
                        window.location.reload();
                    }                           
                },                        
            });
        }
    });

    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    } 
    
    
    /*----delete test sections----*/ 
    $(document).on('click', '.delete_section_element', function(event) {
        var section_id = $(this).closest('tr').find('select[name=section_namee]').val();
        testSeriesId=$("#id").val();
        var questionId =	$(this).data('question-id');
        if(section_id==''){
            var section_id =	$(this).data('section');    
        }        
        //alert(section_id);       
        jQuery.ajax({
            url: "$adminurl"+"test_series/test_series/delete_section_testseries",
            method: 'POST',
            dataType: 'json',
            async:false,
            data: {
                "section_id":section_id,      
                "testSeriesId":  testSeriesId,
            },
            success: function (data) {
                // alert(data);
                if(data=='1'){
                    $(event.target).closest("tr").remove();
                    
                     show_toast('success', "Section Deleted from test series.", "Section Deleted");
                }else if(data=='2'){
                    show_toast('error', "Section Already in use,Cannot delete it", "Section ");         
                }      
            },
        });
    });

    /*----edit test sections----*/ 
    $(document).on('click', '.edit_section_element', function(event) {
        $(".edit_section_element").hide();
        $(".update_section_element").show();
        //$(this).closest('tr').find('input:button[name=save_section_element]').hide();
        //$(this).closest('tr').find('.edit_section_element').show();
        //alert('hii');
        var value = $(this).html();
        if(value=='Edit'){
            $(this).html('Update'); 
        }else{
            $(this).html('Update');
        }
    });
      
    $(document).on('click', '.update_section_element', function(event) {     
        var section_id = $(this).closest('tr').find('select[name=section_namee]').val();
        var no_question = $(this).closest('tr').find('input[name=no_questione]').val();
        var marks_per_ques = $(this).closest('tr').find('input[name=marks_per_quese]').val();
        var negative = $(this).closest('tr').find('select[name=negative_mrkse]').val();
        var minutes = $(this).closest('tr').find('select[name=minutese]').val();
        var seconds = $(this).closest('tr').find('select[name=secondse]').val();
        var sec_id = $(this).closest('tr').find('input[name=sec_id]').val();
        var section_cutoff = $(this).closest('tr').find('input[name=section_cutoff]').val();
        testSeriesId = $("#id").val();

        if(section_id==''){            
            alert('Please choose section');            
        }else if(no_question==''){   
            alert('Please enter number of questions ');                
        }else if(marks_per_ques==''){    
            alert('Please enter marks per question ');
        }else if(negative==''){
            alert('Please enter negivie marks per question ');
        }else if(minutes==''){    
            alert('Please enter minutes ');
        }else if(seconds==''){ 
            alert('Please enter seconds ');
        }else{
            jQuery.ajax({
                url: "$adminurl"+"test_series/test_series/edit_section_testseries",
                method: 'POST',
                dataType: 'json',
                async:false,
                data: {
                    "section_id":section_id,
                    "no_question":no_question,
                    "marks_per_ques":marks_per_ques,
                    "negative":negative,
                    "minutes":minutes,
                    "testSeriesId":  testSeriesId,
                    "id":sec_id,
                    "section_cutoff":section_cutoff
                },
                success: function (data) {
                    if(data=='1'){
                        show_toast('success', "Section Updated Successfully.", "Section Updated");
                        $(".edit_section_element").show();
                        $(".update_section_element").hide();  
                        window.location.reload();
                    }else{
                        show_toast('error', "Section  Not Updated .", "Section Not Updated");
                    }
                }
            });
        }
    });

    function edit_section(){
        $("#ques_table").hide(); 
        $("#edit_section_table").show(); 
    }

    jQuery(document).ready(function() {
        var table = 'all-test-series-section-grid';
        var dataTable_test_series = jQuery("#"+table).DataTable( {
            "processing": true,
            "serverSide": true,
            "order": [[ 0, "desc" ]],
            "ajax":{
                url :"$adminurl"+"test_series/test_series/ajax_test_series_section_list/?test_series_id=$test_series_id", // json datasource
                type: "post",  // method  , by default get
                error: function(){  // error handling
                    jQuery("."+table+"-error").html("");
                    jQuery("#"+table+"_processing").css("display","none");
                }
            }
        } );
        jQuery("#"+table+"_filter").css("display","none");
        $('#all-test-series-report-grid .search-input-text').on( 'keyup click', function () {   // for text boxes
            var i =$(this).attr('data-column');  // getting column index
            var v =$(this).val();  // getting search input value
            dataTable_test_series.columns(i).search(v).draw();
        } );
         $('#all-test-series-report-grid .search-input-select').on( 'change', function () {   // for select box
             var i =$(this).attr('data-column');
             var v =$(this).val();
             dataTable_test_series.columns(i).search(v).draw();
         } );
        // Re-draw the table when the a date range filter changes
        $('#all-test-series-report-grid  .date-range-filter').change(function() {
            if($('#min-date-test-series').val() !="" && $('#max-date-test-series').val() != "" ){
                var dates = $('#min-date-test-series').val()+','+$('#max-date-test-series').val();
                dataTable_test_series.columns(3).search(dates).draw();
            }
        });
    });
</script>

EOD;
echo modules::run('auth_panel/template/add_custum_js', $custum_js);
