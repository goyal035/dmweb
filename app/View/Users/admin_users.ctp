<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$title_for_layout;?>
      </h1>
     </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-lg-12">
                                <!-- START -->
                                <table id="userGrid" class="responsive nowrap" cellspacing="0" width="100%">
                                  <thead>
                                  <tr>
                                    <th>Id</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                  </tr>
                                  </thead>
                                  <tfoot>
                                  <tr class="filter" width="100%">
                                    <td></td>
                                    <td> <input class="search_init" type="text" value="" placeholder="First name" name="fname"> </td>
                                    <td> <input class="search_init" type="text" value="" placeholder="Last name" name="lname"> </td>
                                    <td > <input class="search_init" type="text" value="" placeholder="Email" name="email"> </td>
                                    <td>
                                        <select class="search_init" type="text" value="" placeholder="Role" name="status"> 
                                            <option value="" selected="selected">Select</option>
                                            <option value="2">Instructor</option>
                                            <option value="3" >User</option>
                                        </select> 
                                    </td>
                                    <td valign="top">
                                        <input type="button" id="search_button" class="btn btn-success btn-xs margin-bottom-5" value="Search">
                                        <input type="button" id="reset_button" class="btn btn-danger btn-xs" value="Reset">
                                    </td>
                                </tr>
                                </tfoot> 
                                </table>  
                                <!--  END-->
                            </div>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
      </div>
    </section>
  </div>

<script type="text/javascript">
var table;
$.extend( $.fn.dataTable.defaults, {
    responsive: true
} );
$(document).ready(function() {
    table = $('#userGrid').DataTable( {
        "processing": true,
        "serverSide": true,
        "responsive":true,
        //"lengthMenu": [10,20,50, 100],
        "pageLength": "<?=Configure::read('Site.admin_rec_per_pg');?>",
        //"filter":false,        
        "ajax": '<?php echo $this->Html->url(array("controller" => "users","action" => "admin_user_data","full_base"=>TRUE));?>',
        "columns": [
                        { "name": "User.id", "orderable":false,"searchable":false,'width':'7%', 'sClass': 'text-center'},
                        { "name": "User.fname", 'width':'15%'},
                        { "name": "User.lname", 'width':'13%'},
                        { "name": "User.email", 'width':'17%'},
                        { "name": "User.role" ,"orderable":false,"searchable":true,'width':'8%', 'sClass': 'text-center'},
                        { "name": "User.common" ,"orderable":false,"searchable":false,'width':'10%', 'sClass': 'text-center'}
                        
                    ],
        "order": [[1, "desc"]],  
    });
    
    $(".dataTables_filter").remove(); 
});

$("#search_button").click(function(){
  table.columns().eq( 0 ).each( function ( colIdx) {
    if($( 'input,select', table.column( colIdx ).footer().length )){
         table
        .column( colIdx )
        .search( $( 'input,select', table.column( colIdx ).footer() ).val());
    } 
  });
  table.draw();
});


 //reset search 
$("#reset_button").click(function(){
  table.columns().eq( 0 ).each( function ( colIdx) {
    if($( 'input', table.column( colIdx ).footer().length )){
      $( '.search_init', table.column( colIdx ).footer() ).val("");
           table
          .column( colIdx )
          .search("");
    } 
  });
  table.draw();
});   
     //to remove default filter


/*function changeUserStatus(id,status){
    URL = '<?php echo $this->Html->url(array("controller" => "users","action" => "change_status","admin"=>TRUE));?>';
    $.ajax({
        url : URL,
        type: "POST",
        data : ({id:id,status:status}),
        beforeSend: function (XMLHttpRequest) {
        },
        complete: function (XMLHttpRequest, textStatus) {
            $("#reset_button").click();
        },
        success : function(data){
            if(data ==1 ) {    
                $("#list").trigger("reloadGrid");
            }else {
                bootbox.alert("Error while changing the user status.", function() { });
            }
        }
    });
}*/

function change_status(id,status){
    var model = 'User';
    var field = 'status';
    status = status || 2;
    URL = '<?php echo $this->Html->url(array("controller" => "users","action" => "change_status","full_base"=>TRUE));?>';
    bootbox.confirm("Are you sure to do this action ?", function(res) {
        if(res){
            $.ajax({
                url : URL,
                type: "POST",
                data : ({id:id,status:status,model:model,field:field}),
                beforeSend: function (XMLHttpRequest) {
                },
                complete: function (XMLHttpRequest, textStatus) {
                    $("#reset_button").click();
                },
                success : function(data){
                    if(data ==1 ) {    
                        $("#userGrid").trigger("reloadGrid");
                    }else {
                        bootbox.alert("Error while changing the user status.");
                    }
                }
            });
        }
    });
    
}   


    
  </script>


