<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$title_for_layout;?>
        <!-- <small>Preview</small> -->
      </h1>
     <!--  <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <!--<div class="box-header with-border">
              <h3 class="box-title">Horizontal Form</h3>
            </div> -->
            <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <!-- <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-users fa-fw"></i> Edit User
                                </h3>
                            </div> -->
                            <div class="panel-body">
                                <div class="col-lg-10">
                                  <?php  echo $this->Form->create('User',array('class'=>'form-horizontal style-form','enctype'=>'multipart/form-data','validate'));?>
                                    
                                            <div class="form-group">
                                                <?php echo $this->Form->label('First Name',null,array('class'=>'col-md-3 control-label'));?>
                                                <div class="col-md-7">
                                                    <?php echo $this->Form->input('fname',array('class'=>'form-control','label'=>false,'div'=>false));?>
                                                </div>    
                                            </div>
                                            
                                             <div class="form-group">
                                                <?php echo $this->Form->label('Last Name',null,array('class'=>'col-md-3 control-label'));?>
                                                <div class="col-md-7">
                                                    <?php echo $this->Form->input('lname',array('class'=>'form-control','label'=>false,'div'=>false));?>
                                                </div>    
                                            </div>
                                            
                                             <div class="form-group">
                                                <?php echo $this->Form->label('Email',null,array('class'=>'col-md-3 control-label'));?>
                                                <div class="col-md-7">
                                                    <?php echo $this->Form->input('email',array('class'=>'form-control','label'=>false,'div'=>false));?>
                                                </div>    
                                            </div>
                                            
                                             <div class="form-group">
                                                <?php echo $this->Form->label('Password',null,array('class'=>'col-md-3 control-label'));?>
                                                <div class="col-md-7">
                                                    <?php echo $this->Form->input('password',array('type'=>'password','class'=>'form-control','required'=>false,'label'=>false,'div'=>false,'value'=>''));?>
                                                </div>    
                                            </div>
                                            
                                             <div class="form-group">
                                                <?php echo $this->Form->label('Confirm Password',null,array('class'=>'col-md-3 control-label'));?>
                                                <div class="col-md-7">
                                                    <?php echo $this->Form->input('cpassword',array('type'=>'password','class'=>'form-control','required'=>false,'label'=>false,'div'=>false));?>
                                                </div>    
                                            </div>

                                            <div class="form-group">
                                                <?php $options=array(2=>'Instructor',3=>'User')?>
                                                <?php echo $this->Form->label('Type',null,array('class'=>'col-md-3 control-label'));?>
                                                <div class="col-md-7">
                                                    <?php echo $this->Form->input('role',array('options'=>$options,'class'=>'form-control','required'=>false,'label'=>false,'div'=>false,'disabled'=>isset($this->request->data['User']['id'])? true:false));?>
                                                </div>    
                                            </div>

                                            <div class="form-group">
                                                <?php echo $this->Form->label('Image',null,array('class'=>'col-md-3 control-label'));?>
                                                <div class="col-md-4">
                                                    <?php echo $this->Form->input('user_image',array('type'=>'file','class'=>'form-control','required'=>false,'label'=>false,'div'=>false));
                                                       echo  $this->Form->hidden('image');
                                                    ?>
                                                </div>    
                                                <div class="col-md-3">
                                                    <?php 
                                                    $img =isset( $this->request->data['User']['image'] ) ? $this->request->data['User']['image'] : "";
                                                    $url = $this->Custom->chkImgExist('/images/users/'.$img);
                                                    echo $this->Html->image($url,array('style'=>'width:100px;')); ?>
                                                </div>
                                            </div>

                                            <?php 
                                                echo $this->Form->hidden('id'); 
                                                echo $this->Form->hidden('u_modified',array('class'=>'form-control','value'=>date('Y-m-d H:i:s')));
                                            ?>
                                    </div> 
                                    <div class="col-lg-10">
                                      <div class="form-group">
                      <?php //echo $this->Form->label('',null,array('class'=>'col-md-3 control-label'));?>
                                            <div  class="col-md-3 control-label"></div>
                                            <div class="col-md-7">
                                                <?php echo $this->Form->submit('Save',array('class'=>'btn btn-primary','label'=>false,'div'=>false));?>
                                                <?php
                                                echo $this->Html->link('Cancel',array('controller'=>'users','action'=>'users','full_base'=>true),array('class'=>'btn btn-warning')
                          //'Are You sure to do that ? '
                        );
                        ?>
                                            </div>    
                                        </div>
                                    </div> 
                                    <?php echo $this->Form->end();?>  
                            </div>
                        </div>
                    </div>
            </div>        
                  
          </div>
          <!-- /.box -->
          
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

  <script type="text/javascript">
      $.validator.setDefaults({
          highlight: function(element) {
              $(element).closest('.form-group').addClass('has-error');
          },
          unhighlight: function(element) {
              $(element).closest('.form-group').removeClass('has-error');
          },
          errorElement: 'div',
          errorClass: 'error-message',
          errorPlacement: function(error, element) {
              if(element.parent('.input-group').length) {
                  error.insertAfter(element.parent());
              } else {
                  error.insertAfter(element);
              }
          }
      });

      $('#UserAdminAddUserForm').validate({ // initialize the plugin
          rules: {
              "data[User][fname]": {
                  required: true,
                  minlength: 5
              },
              "data[User][lname]": {
                  required: true,
                  minlength: 5
              },
              "data[User][email]": {
                required: true,
                email: true
              },
              "data[User][user_image]": {
                required: true,
              }
          },
          messages: {
            "data[User][fname]": {required:"This field is required.",minlength:"Field should have minimum 5 charecter."},
            "data[User][lname]": {required: "This field is required.",minlength:"Field should have minimum 5 charecter."},
            "data[User][email]": {
              required: "This field is required.",
              email: "Your email address must be in the format of name@domain.com"
            },
            "data[User][user_image]": {required: "This field is required."},
          },
          /*errorElement:'div',
          errorClass:'form-error',
          validClass:'form-success',
          errorPlacement: function(error, element) {
            error.insertAfter(element);
          },
          highlight: function (element, errorClass, validClass) { 
            $(element).parents("div.control-group").addClass(errorClass).removeClass(validClass); 
          }, 
          unhighlight: function (element, errorClass, validClass) { 
            $(element).parents(".error").removeClass(errorClass).addClass(validClass); 
          },*/
      });
  </script>