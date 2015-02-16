function checkAll(ele,disabled,classX) {
     var checkboxes = document.getElementsByTagName('input');
     if (ele==1) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox' && hasClass(checkboxes[i], classX)) {
                 checkboxes[i].checked = true;
                 if (disabled) {

                   checkboxes[i].setAttribute("onClick","return false");
                 }
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox' && hasClass(checkboxes[i],classX)) {
                    if (hasClass(checkboxes[i],'forCheck')){

                    }else{
                        checkboxes[i].checked = false;
                        //checkboxes[i].checked = checkboxes[i].defaultChecked;
                    }

                 checkboxes[i].setAttribute("onClick","return true");
             }
         }
     }

 }

 function hasClass(element, cls) {
    return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
}


function passedVal(element,cls){
  //  alert($('#'+element.id).val());
    if ($(element).val() > 0 || $(element).val()!="") {
        $('.'+cls).val($(element).val());
    }else{
       var elements = document.getElementsByClassName(cls);
        for (var i=0; i<elements.length; i++) {
            elements[i].value = elements[i].defaultValue
        }
           
    }
}

function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }