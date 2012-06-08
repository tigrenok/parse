$(function() {

    
    $('#textarea_min').toggle(function(){
        $('#Content_data_content_ifr').css('height','173px');
        $('#Content_data_content_tbl').css('height','300px');   
        $('#textarea_min').html('Max');   
    },function(){
        $('#Content_data_content_ifr').css('height','506px');
        $('#Content_data_content_tbl').css('height','619px');   
        $('#textarea_min').html('Min');  
    });
    $('#post_site_id').change(function() {
        var id = $("#post_site_id option:selected").val();    
        $.ajax({
            url: '/postSite/siteList/'+id,
            success: function(data) {
                $('#post_site_categories').html(data);
            }
        });    
        
        $.ajax({
            url: '/postSite/siteInfo/'+id,
            success: function(data) {
                $('#parse_site_info').html(data);
            }
        });   
    });
    
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