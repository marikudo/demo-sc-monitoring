<div class="content">
  <ul class="breadcrumb">
    <li>
    <p>home</p>
    </li>
    <li><a href="#" class="active" data-toggle='tooltip' data-placement='top' title='Some tooltip text!'><?=ucwords($user['permission']['module'])?></a> </li>
  </ul>
  <h1 class="content-title"><i class="fa fa-user"></i> <?=ucwords($user['permission']['module'])?></h1>

<?=isset($success) ? showMessage($success) : null;?>
<div class="table-container">
<table class="table table-hover table-custom display" style="font: 12px 'Arial';" id="table">
    <thead>
      <tr>
        
        <th class="align-center">Action</th>
        <th class="align-center">Username</th>
        <th class="align-right">First Name</th>
        <th class="align-right">Last Name</th>
        <th class="align-right">Role</th>
        <th class="align-center">Status</th>
      </tr>
        </thead>
    <tbody>
    </tbody>
  </table>
  </div>
</div>
<style type="text/css">
.row{margin-left: 0px;margin-right: 0px}
</style>
<script type="text/javascript">
var data = [];
var aSelected = [];
$(document).ready(function(){
    /* Datatable decleration
    -----------------------------*/
   var oTable =  $('#table').dataTable({
    "sDom":"<'action-container clearfix custom-table-container'Tf><'clearfix custom-table-container'rtip>",
    "bProcessing": true,  
    "bServerSide": true,
    "sAjaxSource": "api/data/?gConf=<?=$hashConfig?>",
    
    "aoColumns":[

                {"bSearchable":false,"mData":"button","sWidth":"80px"},
                {"bSearchable":true,"mData":"email"},
                {"bSearchable":true,"mData":"first_name","sWidth":"150px",},
                {"bSearchable":true,"mData":"last_name","sWidth":"150px",},
                {"bSearchable":true,"mData":"role","sWidth":"150px",},
                {"bSearchable":false,"mData":"status","sWidth":"100px","sClass":'align-center'},
                ],
    "aoColumnDefs":[
                  {'bSortable':false,'aTargets':[0]},
                  {'bSortable':true,'aTargets':[1]},
                  {'bSortable':false,'aTargets':[2]},
                  {'bSortable':false,'aTargets':[3]},
                  {'bSortable':true,'aTargets':[4]},
                  {'bSortable':false,'aTargets':[5]},
                  ],
        "oTableTools": {
              "sRowSelect": "multi",
                 "aButtons": [

                              <?php
                                if ($user['permission']['_create']==1) {
                                  ?>
                                         {
                                          "sExtends": "addBtn",
                                          "sButtonText":"<i class='fa fa-plus'></i> New record",
                                          "sUrl":"<?=base_url()?>xhrs/<?=$user['permission']['_url']?>/new-record"
                                        },
                                      <?php
                                    }
                                    ?>
                              {
                                "sExtends": "refreshBtn",
                              },
                              <?php
                                    if ($user['permission']['_update']==1) {
                                  ?>
                                       {
                                          "sExtends": "bActivate",
                                          "dxConfig" : "<?=$hashConfig?>"
                                        },
                                        {
                                          "sExtends": "bDeactivate",
                                          "dxConfig" : "<?=$hashConfig?>"
                                        },
                                      <?php
                                    }
                                  ?>

                                  <?php
                                   if ($user['permission']['_delete']==1) {
                              ?>
                                  {
                                   "sExtends": "deleteBtn",
                                    "dxConfig" : "<?=$hashConfig?>",
                                    'fnClick': function(nButton,oConfig){
                                        $('.DTTT_selected').each(function(){
                                            aSelected.push(this.id);
                                        });
                                        $('#mDelete-container').modal('show');
                                    }
                                  }
                            <?php
                              /*end of delelte*/
                                }
                              ?>
                              
                             ]
            },
           
            "sScrollY": "300px",
            "bScrollCollapse": false,
            "iDisplayLength": 50,

    })
    /* end of datatable
    ----------------------------------*/

      $('#mDelete').click(function(){
        $.post("<?=$user['permission']['_url']?>/delete/?gConf=<?=$hashConfig?>",{'act':true,'row':aSelected,'status':0},function(data){
          var res = data.split(':');

          if (res[0] > 0) {
            aSelected = [];
              $('#notd').html(res[1]);
              $('#result-container').modal({
                show: true,
                keyboard: false
            });
               var oTable =  $('#table').dataTable();
                  oTable.fnDraw();
                 $('.btnSelect').addClass('disabled');
          };
        });

  });

 });



</script>