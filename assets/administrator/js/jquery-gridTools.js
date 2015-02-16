$(function(){
	var protocol = window.location.protocol;
			var host = window.location.host;
			var pathname = window.location.pathname.split('/');
			var fullpatch = protocol+"//"+host+"/"+pathname[1]+"/"+pathname[2]+"/";
			

    $.extend( true, $.fn.DataTable.TableTools.classes, {
        "container": "btns",
        "buttons": {
          "normal": "btn btn-default btn-sm",
          "disabled": "btn disabled"
        }, 
        "collection": {
          "container": "DTTT_dropdown dropdown-menu",
          "buttons": {
            "normal": "btn btn-default",
            "disabled": "disabled"
          }
        }
      } );

	 TableTools.BUTTONS.addBtn = $.extend( true,{}, $.fn.DataTable.TableTools.buttonBase, {
        'sButtonText': "Add New",
         'fnClick': function(nButton,oConfig){
             window.location = oConfig.sUrl
          }
      });

   TableTools.BUTTONS.refreshBtn = $.extend( true,{}, $.fn.DataTable.TableTools.buttonBase, {
        'sButtonText': "Refresh",
        'sButtonClass':'btn-success',
        "sButtonText":"<i class='fa fa-refresh white'></i> Refresh",
         'fnClick': function(nButton,oConfig){
             var oTable =  $('#table').dataTable();
           oTable.fnDraw();
           $('.clearValue').val("");
         	$('.btnSelect').addClass('disabled');
          }
      });

      TableTools.BUTTONS.bActivate = $.extend( true,{}, $.fn.DataTable.TableTools.buttonBase, {
      	"sButtonText":"<i class='fa fa-check white'></i> Activate",
         'sButtonClass':'btn-success disabled btnSelect',
         'dConfig':null,
         'fnClick': function(nButton,oConfig){
         		var aSelected = [];
         		$('.DTTT_selected').each(function(){
         				aSelected.push(this.id);
         		});
         		
         		$.post(fullpatch+"api/dactive/?gConf="+oConfig.dxConfig,{'act':true,'row':aSelected,'status':1},function(data){
         				if (data>0) {
         					var oTable =  $('#table').dataTable();
           					oTable.fnDraw();
           					$('.btnSelect').addClass('disabled');
         				};
         		});
          }
      });

      TableTools.BUTTONS.bDeactivate = $.extend( true,{}, $.fn.DataTable.TableTools.buttonBase, {
      	"sButtonText":"<i class='fa fa-times white'></i> Deactivate",
         'sButtonClass':'btn-danger disabled btnSelect',
         'dConfig':null,
         'fnClick': function(nButton,oConfig){
         		var aSelected = [];
         		$('.DTTT_selected').each(function(){
         				aSelected.push(this.id);
         		});
         		
         		$.post(fullpatch+"api/dactive/?gConf="+oConfig.dxConfig,{'act':true,'row':aSelected,'status':0},function(data){
         				if (data>0) {
         					var oTable =  $('#table').dataTable();
           					oTable.fnDraw();
           					$('.btnSelect').addClass('disabled');
         				};
         		});
          }
      });

     TableTools.BUTTONS.bDeactivate = $.extend( true,{}, $.fn.DataTable.TableTools.buttonBase, {
        "sButtonText":"<i class='fa fa-times white'></i> Deactivate",
         'sButtonClass':'btn-danger disabled btnSelect',
         'dConfig':null,
         'fnClick': function(nButton,oConfig){
            var aSelected = [];
            $('.DTTT_selected').each(function(){
                aSelected.push(this.id);
            });
            
            $.post(fullpatch+"api/dactive/?gConf="+oConfig.dxConfig,{'act':true,'row':aSelected,'status':0},function(data){
                if (data>0) {
                  var oTable =  $('#table').dataTable();
                    oTable.fnDraw();
                    $('.btnSelect').addClass('disabled');
                };
            });
          }
      });

     TableTools.BUTTONS.deleteBtn = $.extend( true,{}, $.fn.DataTable.TableTools.buttonBase, {
        "sButtonText":"<i class='fa fa-times white'></i> Remove",
         'sButtonClass':'btn-danger disabled btnSelect',
         'dConfig':null,
         'fnClick': function(nButton,oConfig){
            var aSelected = [];
            $('.DTTT_selected').each(function(){
                aSelected.push(this.id);
            });
            
            $.post(fullpatch+"api/delete/?gConf="+oConfig.dxConfig,{'act':true,'row':aSelected,'status':0},function(data){
                if (data>0) {
                  var oTable =  $('#table').dataTable();
                    oTable.fnDraw();
                    $('.btnSelect').addClass('disabled');
                };
            });
          }
      });

      TableTools.BUTTONS.bPublishedIt = $.extend( true,{}, $.fn.DataTable.TableTools.buttonBase, {
        "sButtonText":"<i class='fa fa-check white'></i> Publish",
         'sButtonClass':'btn-success disabled btnSelect',
         'dConfig':null,
         'fnClick': function(nButton,oConfig){
            var aSelected = [];
            $('.DTTT_selected').each(function(){
                aSelected.push(this.id);
            });
            
            $.post(fullpatch+"api/published/?gConf="+oConfig.dxConfig,{'act':true,'row':aSelected,'status':1},function(data){
                if (data>0) {
                  var oTable =  $('#table').dataTable();
                    oTable.fnDraw();
                    $('.btnSelect').addClass('disabled');
                };
            });
          }
      });

            TableTools.BUTTONS.bUnPublishedIt = $.extend( true,{}, $.fn.DataTable.TableTools.buttonBase, {
        "sButtonText":"<i class='fa fa-times white'></i> Unpublish",
         'sButtonClass':'btn-danger disabled btnSelect',
         'dConfig':null,
         'fnClick': function(nButton,oConfig){
            var aSelected = [];
            $('.DTTT_selected').each(function(){
                aSelected.push(this.id);
            });
            
            $.post(fullpatch+"api/published/?gConf="+oConfig.dxConfig,{'act':true,'row':aSelected,'status':0},function(data){
                if (data>0) {
                  var oTable =  $('#table').dataTable();
                    oTable.fnDraw();
                    $('.btnSelect').addClass('disabled');
                };
            });
          }
      });


});

