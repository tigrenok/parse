$(function() {
    
    $('#SitePars_law_id').change(function() {
        var id = $("#SitePars_law_id option:selected").val();    
        $.ajax({
            url: '/sitePars/lawInfo/'+id,
            success: function(data) {
                $('.law_info').html(data);
            }
        });    
    });
    
    $('#SitePars_child_id').change(function() {
        var id = $("#SitePars_child_id option:selected").val();    
        $.ajax({
            url: '/sitePars/childInfo/'+id,
            success: function(data) {
                $('.child_info').html(data);
            }
        });    
    });
    
});