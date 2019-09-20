function toggleMenu() {
  let menu = 'menu';
  let nomenu = 'unem';
  let shouldBeActive = document.getElementById('site-header-categories').className.includes('menu') ? nomenu : menu;
  document.getElementById('site-header-categories').className = "site-header-categories " + shouldBeActive;
  document.getElementById('site-header').className = "site-header " + shouldBeActive;
  document.getElementById('site-header-navigation-button').className = "site-header-navigation-button " + shouldBeActive;
}

( function( $ ) {

    var count = 11;
    var total = 200;
    $(window).scroll(function(){
      if ($(window).scrollTop() == $(document).height() - $(window).height()){
       if (count > total){
         return false;
       } else{
         loadArticle(count);
       }
       count++;
      }
    });
 
    function loadArticle(pageNumber){
      $('a#inifiniteLoader').show('fast');
      // fix for topolitique.ch
      let prefix = '';
      if (window.location.href.toString().includes('/beta/')) {
        prefix = "beta/"
      }
      $.ajax({
        url: `/${prefix}wp-admin/admin-ajax.php`,
        type:'POST',
        data: "action=infinite_scroll&page_no="+ pageNumber + '&loop_file=template-parts%2Farchive-loop',
        success: function (html) {
          $('li#inifiniteLoader').hide('1000');
          $("#archive-content").append(html);
        },
        error: function(e) {
          console.error(e);
        }
      });
      return false;
    }
  } )( jQuery );