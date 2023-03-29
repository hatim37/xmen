$(document).ready(function() {
    $('.select2').select2();
   });


   $(document).on('change', '#mission_cible', function () {
    let $field = $(this)
    let $form = $field.closest('form')
    let data = {}
    data[$field.attr('name')] = $field.val()

    $.post($form.attr('action'), data).then(function (data) {
          
       let $input = $(data).find('#mission_agent')
        
       $('#mission_agent').replaceWith($input)
       $('.select2').select2();
    })
   });
 
    $(document).on('change', '#mission_specialite', function () {
    let $field = $(this)
    let $form = $field.closest('form')
    let data = {}
    data[$field.attr('name')] = $field.val()
   
    $.post($form.attr('action'), data).then(function (data) {
          
       let $input = $(data).find('#mission_agent')
        
       $('#mission_agent').replaceWith($input)
       
       $('.select2').select2();
    })
   });
 
   $(document).on('change', '#mission_pays', function () {
    let $field = $(this)
    let $form = $field.closest('form')
    let data = {}
    data[$field.attr('name')] = $field.val()
    
    $.post($form.attr('action'), data).then(function (data) {
          
       let $input = $(data).find('#mission_contact')
       let $input2 = $(data).find('#mission_planque')
        
       $('#mission_contact').replaceWith($input)
       $('#mission_planque').replaceWith($input2)
      
       $('.select2').select2();
    })
   });