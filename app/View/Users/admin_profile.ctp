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
                                  <?php  echo $this->Form->create('User',array('class'=>'form-horizontal style-form'));?>
                                    
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
                                                echo $this->Html->link('Cancel',array('controller'=>'users','action'=>'dashboard','full_base'=>true),array('class'=>'btn btn-warning')
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