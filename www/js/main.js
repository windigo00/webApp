$(function(){
	//init grido
	$('.grido').grido({ajax: true});
//	$.nette.init();
});

$(function(){

});

function showPanel(ref, action, title, id) {
	id = id?id:'action-panel';
	var panel = $('#'+id);
	if (panel.length == 0) {
		var panel =  $('<div style="background: #050505;position:fixed; width:100%; height:100%;left:0;top:0;z-index: 1050;opacity: 0.6;"></div>'+
		'<div id="'+id+'" class="modal">'+
			'<div class="modal-dialog">'+
				'<div class="modal-content">'+
					'<div class="modal-header">'+
						'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
						'<h4 class="modal-title">'+title+'</h4>'+
					'</div>'+
					'<div class="modal-body">'+
					'</div>'+
				'</div>'+
			'</div>');
		$(document.body).append(panel)
		$('.modal-title', panel).append(action)
		$('.close', panel).click(function(){
			panel.hide();
		})
		panel.show();
	} else {
		$('.modal-title', panel).html(title).append(action)
		panel.show();
		panel.prev('div').show();
	}
	
	$('.modal-body', panel).load(ref);
}