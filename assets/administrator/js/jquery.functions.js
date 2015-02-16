var globalx = [];
var _ids = [];
var globalkey;
var temp_id = 0;
var id = 0;
var _config = null;
!function($){
 
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	var testm = [];

	$('input.toUpperCase').on('keypress', function(event) {
        var $this = $(this),
            val = $this.val();

        val = val.substr(0, 1).toUpperCase() + val.substr(1).toLowerCase();
        $this.val(val);
    });

	$('.tTip').tooltip();
	//$('#hire_date').datepicker("option", "dateFormat", "yy-mm-dd");
  
	$('.alphanumeric').alphanumeric({allow:"., -"});
	$('.alpha').alpha({allow:" "});
	$('.numeric').numeric({allow:"-"});

	$('#stack1').on('hidden.bs.modal', function () {
		  	globalx = [];
	});

 	$('#yesDelete').click(function(){
 		//	alert(_config);
 			var protocol = window.location.protocol;
			var host = window.location.host;
			var pathname = window.location.pathname.split('/');
			var fullpatch = protocol+"//"+host+"/"+pathname[1]+"/"+pathname[2]+"/api/action/?gConf="+_config;
				//alert(fullpatch);
			var module = $('#module').val();
			$.post(fullpatch,{_delete:true,row:temp_id,key:id,logmo:module},function(data){
				if(data==1){
					 var oTable =  $('#table').dataTable();
					 oTable.fnDraw();
						//$('#table').datatables();
						$('#stack1').modal('hide');
						$('#delete_'+id).fadeOut();
						//$('#success_modal').modal('show');
					}else{
						$('#result').fadeIn('slow').addClass('alert alert-error').html('Unable to Delete. This role was use by another user.').css({'margin-botton':'5px!important'});
					}
				});
			//}

			
			
			
 	});




 	if($('#calendar').length > 0){

 	/*var calendar = $('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			selectable: true,
			selectHelper: true,
			select: function(start, end, allDay) {
				var title = prompt('Event Title:');
				if (title) {
					calendar.fullCalendar('renderEvent',
						{
							title: title,
							start: start,
							end: end,
							allDay: allDay
						},
						true // make the event "stick"
					);
				}
				calendar.fullCalendar('unselect');
			},
			editable: true,
			events: [
				{
					title: 'All Day Event',
					start: new Date(y, m, 1)
				},
				{
					title: 'Long Event',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d-2)
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d+4, 16, 0),
					allDay: false
				},
				{
					title: 'Meeting',
					start: new Date(y, m, d, 10, 30),
					allDay: false
				},
				{
					title: 'Lunch',
					start: new Date(y, m, d, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false
				},
				{
					title: 'Birthday Party',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false
				},
				{
					title: 'Click for Google',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: 'http://google.com/'
				}
			]
		});*/
 	}

 $('.backx').click(function(){
		//javascript:history.back();
		//window.location = '/main/';

		var protocol = window.location.protocol;
			var host = window.location.host;
			var pathname = window.location.pathname.split('/');
			var fullpatch = protocol+"//"+host+"/"+pathname[1]+"/"+pathname[2]+"/";
			window.location = fullpatch;
	});
}(window.jQuery);
$(document).on("click", ".deleteall", function (event) {
     event.preventDefault();
     		var x;
		    var searchIDs = $("input.check:checkbox:checked").map(function(){
		        return this.value;
		    }).toArray();
		    var _IDs = $("input.check:checkbox:checked").map(function(){
		        return this.id;
		    }).toArray();
		    if(searchIDs!=""){
		    	globalx = JSON.stringify({data:searchIDs});
		    	globalkey = this.id;
		    	_ids = _IDs; 
				/*$.each(searchIDs,function(index, value){
					globalx += value;	
				});*/

				
			}

		var h  = $(window).height();
		$('.scroll').css({'height':""+(h-90)+"px"});
		$(".nano").nanoScroller();
		// $('#ToolTables_table_0').addClass('btn-success');
		// $('.selectpicker').selectpicker();
});


function print_data(){
 			var searchIDs = $("input.check:checkbox:checked").map(function(){
		        return this.value;
		    }).toArray();
		$('#xrole').printArea();
	return false;	
}

function fDelete(ctr,key,config){
	id = ctr;
	temp_id = key
	_config = config;
  $('#stack1').modal();
}

function fActivate(ctr,key,config,status){

			var protocol = window.location.protocol;
			var host = window.location.host;
			var pathname = window.location.pathname.split('/');
			var fullpatch = protocol+"//"+host+"/"+pathname[1]+"/"+pathname[2]+"/api/dactive/"+status+"/"+key+"/?gConf="+config;

			$.post(fullpatch,{'act':true,'row':key},function(data){
				if (parseInt(data) > 0) {
					 var oTable =  $('#table').dataTable();
					 oTable.fnDraw();
				};
			});
}
