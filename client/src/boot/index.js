/* SilverWare Facebook Boot
===================================================================================================================== */

import $ from 'jquery';

$(function() {
  
  $('body').prepend('<div id="fb-root"></div>');
  
  $.ajaxSetup({ cache: true });
  
  $.getScript('https://connect.facebook.net/en_US/sdk.js', function() {
    
    var appId = $('body').attr('data-facebook-app-id');
    
    FB.init({
      appId: appId,
      xfbml: true,
      version: 'v3.1',
      autoLogAppEvents: true
    });
    
    $('#loginbutton, #feedbutton').removeAttr('disabled');
    
  });
  
});
