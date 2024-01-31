   $(document).ready(function (){
$(".item-delete").click(function (){
    $("#item_id").val($(this).data('id'));
    $("#delete_title").html($(this).data('title'));

    $("#delete-form").slideDown();
});


$("#delete-cancel").click(function (e){
    e.preventDefault();
    $("#item_id").val('');
    $("#delete_title").html('');

    $("#delete-form").slideUp();
    return false;
});

});