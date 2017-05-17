/* SilverWare Facebook Boot
===================================================================================================================== */

import $ from 'jquery';

$(function() {
  
  $('body').prepend('<div id="fb-root"></div>');
  
  $.ajaxSetup({ cache: true });
  
  $.getScript('//connect.facebook.net/en_US/sdk.js', function() {
    
    var appId = $('body').attr('data-facebook-app-id');
    
    FB.init({
      appId: appId,
      xfbml: true,
      version: 'v2.7'
    });
    
    $('#loginbutton, #feedbutton').removeAttr('disabled');
    
  });
  
});
