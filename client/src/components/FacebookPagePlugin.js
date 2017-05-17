/* Facebook Page Plugin
===================================================================================================================== */

import $ from 'jquery';

$(function() {
  
  // Initialise:
  
  var id = null;
  
  // Adapt to Wrapper Width:
  
  $('.facebookpageplugin').each(function() {
    
    var $wrapper = $(this).find('.wrapper');
    
    $wrapper.find('.fb-page').attr('data-width', $wrapper.width());
    
  });
  
  // Detect Browser Resize:
  
  $(window).resize(function() {
    
    if (id !== null) {
      clearTimeout(id);
    }
    
    id = setTimeout(function(){
      
      // Refresh Plugins (because Facebook STILL cannot make a responsive page plugin... -_-):
      
      $('.facebookpageplugin').each(function() {
        
        var $wrapper = $(this).find('.wrapper');
        
        $wrapper.load($wrapper.data('url'), { width: $wrapper.width() }, function() {
          
          // Parse XFBML (re-renders the plugin):
          
          FB.XFBML.parse($wrapper[0]);
          
        });
        
      });
      
    }, 1000);
    
  });
  
});
