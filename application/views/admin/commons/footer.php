   
               
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

       


        <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="<?php echo base_url('public/admin/assets/libs/jquery/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('public/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
    <script src="<?php echo base_url('public/admin/assets/libs/metismenu/metisMenu.min.js');?>"></script>
    <script src="<?php echo base_url('public/admin/assets/libs/simplebar/simplebar.min.js');?>"></script>
    <script src="<?php echo base_url('public/admin/assets/libs/node-waves/waves.min.js');?>"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <!-- Required datatable js -->
    <script src="<?php echo base_url('public/admin/assets/libs/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/admin/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <!-- Responsive examples -->
    <script src="<?php echo base_url('public/admin/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/admin/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/admin/assets/js/pages/datatables.init.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="<?php echo base_url('public/admin/assets/js/app.js');?>"></script>
    <script src="<?php echo base_url('public/admin/assets/js/event.js');?>"></script>
    <script src="<?php echo base_url('public/admin/assets/js/sweetalert.min.js'); ?>"></script>
    <script type="text/javascript">
        $("#page_name, #page_heading").summernote({
            height: 200
          });
    </script>
<!-- Firebase script-->
 <script src="https://www.gstatic.com/firebasejs/5.9.1/firebase.js"></script>



<script>
    $( "#from_date, #to_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
      // Your web app's Firebase configuration
      var firebaseConfig = {
        apiKey: "AIzaSyAJmX6LXMmZsFuMmutZ-gAqts1bh0EkE6E",
        authDomain: "firbase-c20de.firebaseapp.com",
        databaseURL: "https://firbase-c20de.firebaseio.com",
        projectId: "firbase-c20de",
        storageBucket: "firbase-c20de.appspot.com",
        messagingSenderId: "63397822890",
        appId: "1:63397822890:web:0b7a6acd125c92640b6bd3",
        measurementId: "G-3E699EZNBG"
      };
      // Initialize Firebase
      firebase.initializeApp(firebaseConfig);
      // firebase.analytics();
    </script>

<!-- Firebase script-->

<script>

$(document).on('click', '.admin_chat_btn', function (e) {    
        var admin_id = 'TyM1oIvSbn';
        var user_id = $(".chatActive").data('id');
        var msg = $('.message-input').val();
        var url = $('#admin_chat_form').attr('action');
        var messagesRef = firebase.database().ref('messages/' + user_id + "_" + admin_id);

        $(".text_err_msg_cht").remove();
    
        if (msg.trim() != '') {
            var msg = $('.message-input').val();
            $.post(url, {user_id: user_id, msg: msg}, function () {

            });
            $('.message-input').val('');
            var newMessageRef = messagesRef.push();
//            var today = new Date();
//            if(today.getDate().toString().length == 1){
//               var tm = "0"+today.getDate();
//            }else{
//               var tm = today.getDate();
//            }
//            var mnt = today.getMonth()+1
//            if(mnt.toString().length == 1){
//               var mnt = "0"+mnt;
//            }else{
//               var mnt = mnt;
//            }
//            var date = tm + '-' + (mnt) + '-' + today.getFullYear();
//            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
//            var dateTime = date + ' ' + time;
            var today = new Date();
            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

            newMessageRef.set({
                adminId: 'TyM1oIvSbn',
//                messageType: "text",
                senderType: "ADMIN",
                text: msg,
                time:firebase.database.ServerValue.TIMESTAMP,
                userId: user_id

            });
        } else {
            $("#msg_chat").parent('.input-group').after("<span class='text-danger text_err_msg_cht'>Please Enter Message.</span>");
        }
    })
    
    
    
    
var admin_id = 'TyM1oIvSbn';
var user_id = $(".chatActive").data('id');
        
var query = firebase.database().ref('messages/' + user_id + "_" + admin_id);
query.on('child_added', function (childSnapshot) {
var childData = childSnapshot.val();
var adminId =  childData.adminId;
var userId =     childData.userId;
var senderType = childData.senderType;
var timestamp = childData.time;
var d = new Date(timestamp);
var h = d.getHours();
var m = d.getMinutes();
var s = d.getSeconds();
var time = h + ':' + m + ':' + s;

 if(senderType == 'USER'){
   $(".personalReviver").append('<div class="revicerInner left_contet"><div class="reciverImg"><img src="<?php echo base_url('public/assets/images/')  ?>user.png" class="img-fluid" alt="client"></div><div class="reciverContent"><p>'+ childData.text +'</p><span class="chatDate">'+time+'</span></div></div>');
 
 }
else{
    $(".personalReviver").append('<div class="revicerInner right_contet"><div class="reciverImg"><img src="<?php echo base_url('public/assets/images/')  ?>user.png" class="img-fluid" alt="client"></div><div class="reciverContent"><p>'+ childData.text +'</p><span class="chatDate">'+time+'</span></div></div>');
}

})

</script>
    </body>

</html>
