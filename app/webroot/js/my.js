$(function () { 
	/*$('#example2').DataTable({
	  "paging": true,
	  "lengthChange": false,
	  "searching": false,
	  "ordering": true,
	  "info": true,
	  "autoWidth": false
	});*/
	
	selectLeftBar();
	hideAlert();
});

function selectLeftBar(){
	$(".sidebar-menu li").removeClass('active');
	$(".sidebar-menu li").find('a[href*="'+window.location.href+'"]').parents('.treeview').click();
	$(".sidebar-menu li").find('a[href*="'+window.location.href+'"]').parents('.treeview').addClass('active');
	$(".sidebar-menu li").find('a[href*="'+window.location.href+'"]').parent('li').addClass('active');
}

function hideAlert(){
	$(".alert").fadeTo(2000, 500).slideUp(500, function(){
	    $("#success-alert").alert('close');
	});
}