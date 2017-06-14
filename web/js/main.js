/**
 * Created by HLATAOUI on 15/05/2017.
 */
var $collectionHolder;
// setup an "add a tag" link
var $addTagLink = $('<a href="#" class="add_tag_link">Add image</a>');
var $newLinkLi = $('<li></li>').append($addTagLink);

$("document").ready(function(){

    $('.js-datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });

    $(".tags").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    })
    
    $(".marques").change(function(){
       $.ajax({
           type:'get',
           url:Routing.generate('models_for_marque', { id_marque: $(this).val()}),
           beforeSend: function(){
               $(".models option").remove();
               $("#main_appbundle_car_tags option").remove();
           },
           success:function(data){
               $.each(data.models,function(index,value){
                   $(".models").append($('<option>',{value:index,text:value}));
               });

               $.each(data.tags,function(index,value){
                   $("#main_appbundle_car_tags").append($('<option>',{value:index,text:value}));
               });
           }
       });

    })

    // Get the ul that holds the collection of tags
    $collectionHolder = $('ul.images');
    // add the "add a tag" anchor and li to the tags ul
    $collectionHolder.append($newLinkLi);
    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);
    $addTagLink.on('click', function (e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();
        // add a new tag form (see next code block)
        addTagForm($collectionHolder, $newLinkLi);
    });
    
});

function addTagForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');
    // get the new index
    var index = $collectionHolder.data('index');
    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);
    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);
    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);
}

