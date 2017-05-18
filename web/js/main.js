/**
 * Created by HLATAOUI on 15/05/2017.
 */
$("document").ready(function(){

    $('.js-datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });

    //$(".select2").select2();

    $(".marques").change(function(){
       $.ajax({
           type:'get',
           url:Routing.generate('models_for_marque', { id_marque: $(this).val()}),
           beforeSend: function(){
               $(".models option").remove();
           },
           success:function(data){
               $.each(data.models,function(index,value){
                   $(".models").append($('<option>',{value:index,text:value}));
               });
               //$(".models").html(data);
           }
       });

    })

    var tagsCount = '{{ form.tags|length }}';

    $('#add-another-tag').click(function(e) {
        e.preventDefault();
        var tagsList = $('#tags-fields-list');
        // grab the prototype template
        var newWidget = tagsList.attr('data-prototype');
        // replace the "__name__" used in the id and name of the prototype
        // with a number that's unique to your emails
        // end name attribute looks like name="contact[emails][2]"
        newWidget = newWidget.replace(/__name__/g, tagsCount);
        tagsCount++;
        // create a new list element and add it to the list
        var newLi = $('<li></li>').html(newWidget);
        newLi.appendTo(tagsList);
    });

});

