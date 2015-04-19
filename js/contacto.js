$(document).ready(function(){
  $('#contacto').submit(function(e) {
      e.preventDefault();
      e.stopPropagation();
      $.ajax({
             type: "POST",
             url: $("#contacto").attr("action"),
             data: $("#contacto").serialize(), // serializes the form's elements.
             success: function(data){
              $('#contactoOK').removeClass('oculto');
              $('#contacto').addClass('oculto');
             },
             error: function(data){
              $('#contactoERROR').removeClass('oculto');
             }
           });

      return false; // avoid to execute the actual submit of the form.
  });
});