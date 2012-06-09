$(function() {
  $(".items tr").dblclick(
    function(){ 
      var href = $(location).attr('href');
      $(window.location).attr('href', href.replace("index", "update")+'/'+$(this).find('td:first').text());
    });
    
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

function post_validate(){
  $('#error_post_site_id').html('');
  var id = $('#post_site_id').val();
  if(id == '0'){
    $('#error_post_site_id').html('выберите сайт для постинга');
    return false;
  }else
    return true;
}