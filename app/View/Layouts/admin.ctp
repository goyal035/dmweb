<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo Configure::read('Site.title')." : ".$title_for_layout;//$cakeDescription ?>
		<?php //echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array(
			//'cake.generic',
			'bootstrap.min',
			//'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
			//'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
			'font-awesome.min.css',
			'ionicons.min',
			'AdminLTE',
			'skins/_all-skins.min',
			'jquery.dataTables',
			//'dataTables.bootstrap',
			'responsive.dataTables.min',
			//'datepicker3'
			'blueChk',
			'my'
		));

		echo $this->Html->script(array(
			'jQuery-2.2.0.min',
			//'https://code.jquery.com/ui/1.11.4/jquery-ui.min.js',
			'jquery-ui.min',
			'bootstrap.min',
			'icheck',
			'jquery.dataTables',
			'dataTables.bootstrap',
			'jquery.validate',
			'dataTables.responsive.min',
			//'jquery.knob',
			//'bootstrap3-wysihtml5.all',
			//'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js',
			//'daterangepicker',
			'jquery.slimscroll',
			'app',
			'bootbox.min',
			'my'
			//'dashboard',
			//'demo'
		));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<?php
$bodyClass = 'hold-transition skin-blue sidebar-mini';
switch($currUrl){
	case 'users/admin_login' : $bodyClass="hold-transition login-page"; break;
}
?>
<body class="<?=$bodyClass;?>">
	<?=$this->Session->Flash();?>
	<?php if($currUrl=='users/admin_login'){
		echo $this->element('admin_content');
	}else{
		echo '<div class="wrapper">';
		echo $this->element('admin_header');
		echo $this->element('admin_sidebar');
		echo $this->element('admin_content');
		echo $this->element('admin_footer');
		echo '</div>';
	}?>    
    
	<?php //echo $this->element('sql_dump'); ?>
	<?php 

	?>
	<script>
	$(function () {
    $('input').iCheck({
	      checkboxClass: 'icheckbox_square-blue',
	      radioClass: 'iradio_square-blue',
	      increaseArea: '20%' // optional
	    });
	  });
	</script>
</body>
</html>
