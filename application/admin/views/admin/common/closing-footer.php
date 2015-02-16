<?php
echo $require_footer;
	if(file_exists($require_footer)){
		require($require_footer);
	}
?>
    <script type="text/javascript">
        jQuery(function($) {

      });
    </script>

      <?php
      $base_path = base_url('assets/administrator/');
        echo require_js(array(
              /*JQUERY VALIDATE*/
              $base_path."jquery.validate/jquery.validate.js",
              //$base_path."jquery.validate/jquery.maskedinput.min.js",
              $base_path."jquery.validate/jquery.form.js",
              $base_path."jquery.validate/jquery.alphanumeric.js",

              /*DATATABLES*/
              $base_path."datatables/js/datatables.js",
              $base_path."datatables/js/dataTables.bootstrap.js",
              $base_path."datatables/js/dataTables.xhrs.js",
              $base_path."datatables/js/dataTables.fixedColumns.js",
              $base_path."datatables/js/TableTools.js",
              $base_path."datatables/js/jquery.dataTables.columnFilter.js",
              $base_path."datatables/js/ZeroClipboard.js",
              $base_path."bootstrap-select/bootstrap-select.min.js",

             $base_path."js/tooltip.js",
              $base_path."js/jquery.functions.js",

          ));

    ?>
    <script type="text/javascript">
    $(document).ready(function (argument) {
        if ( $( "#calendar" ).length ) {
             $('#calendar').fullCalendar({
              header: {
                left: 'prev,next',
                center: 'title',
                right: 'today'
              },
              events: "<?=base_url('xhrs/calendar-guest/reserve')?>", cache: true   
            })
         
        }

         $(document).on('mouseenter', ".actions", function () {
       // alert(1);
           var $this = $(this);
          // if (this.offsetWidth < this.scrollWidth && !$this.attr('title')) {
               $this.tooltip({
                   title: $this.text(),
                   placement: "top"
               });
               $this.tooltip('show');
          // }
       });
     
    });

    </script>
      </body>
</html>