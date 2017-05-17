/**
 * Created by HLATAOUI on 15/05/2017.
 */
$("document").ready(function(){

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

});