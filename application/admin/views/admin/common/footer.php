  </div><!--right panel end-->
</div><!--parent container end-->
    
  <div id="stack1" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
      <div class="modal-dialog" style="width:350px;margin-top: 15%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="color:#333">Delete</h4>
      </div>
      <div class="modal-body">
        <p style=""><span class="glyphicon glyphicon-question-sign" style="color:#3276b1"></span> Are you sure do you want to delete?</p>

      </div>
      <div class="modal-footer" style="text-align:center;margin-top:0px">
        <button type="button" data-dismiss="modal" class="btn btn-default btn-sm pull-right" style="margin-left:15px;">No</button>
        <button type="button" data-dismiss="modal" class="btn btn-primary btn-sm pull-right" id="yesDelete">Yes</button>

      </div>
    </div>
    </div>

    <div id="ajax-modal" class="modal fade" tabindex="-1" style="display: none;"></div>


    <div id="result-container" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
      <div class="modal-dialog" style="width:390px;margin-top: 15%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="modaltitile" style="color:#3c763d">Successful</h4>
      </div>
      <div class="modal-body" id="modalbody">
        <p style="color:#3c763d"><?=ucwords($user['permission']['module'])?> was successfully deleted.</p>
      </div>
      <div class="modal-footer" style="text-align:center;margin-top:0px">
        <button type="button" data-dismiss="modal" class="btn btn-default btn-sm pull-right" style="margin-left:15px;">OK</button>

      </div>
    </div>
</div>



<div id="mDelete-container" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
      <div class="modal-dialog" style="width:350px;margin-top: 15%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="color:#333">Delete</h4>
      </div>
      <div class="modal-body">
        <p style=""><span class="glyphicon glyphicon-question-sign" style="color:#3276b1"></span> Are you sure do you want to delete?</p>

      </div>
      <div class="modal-footer" style="text-align:center;margin-top:0px">
        <button type="button" data-dismiss="modal" class="btn btn-default btn-sm pull-right" style="margin-left:5px;">Cancel</button>
        <button type="button" data-dismiss="modal" class="btn btn-primary btn-sm pull-right" id="mDelete">Yes</button>

      </div>
    </div>
</div>

<div id="confirm-container" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
      <div class="modal-dialog" style="width:350px;margin-top: 15%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="color:#333">Congratulation!</h4>
      </div>
      <div class="modal-body">
        <p style=""><span class="glyphicon glyphicon-question-sign" style="color:#3276b1"></span> <span id="confirmtxt">Record was succefully updated.</span></p>

      </div>
      <div class="modal-footer" style="text-align:center;margin-top:0px">
        <button type="button" data-dismiss="modal" class="btn btn-default btn-sm pull-right" style="margin-left:5px;">Ok</button>
      </div>
    </div>
</div>