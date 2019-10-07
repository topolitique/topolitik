function toggleMenu() {
  let menu = 'menu';
  let nomenu = 'unem';
  let shouldBeActive = document.getElementById('site-header-categories').className.includes('menu') ? nomenu : menu;
  document.getElementById('site-header-categories').className = "site-header-categories " + shouldBeActive;
  document.getElementById('site-header').className = "site-header " + shouldBeActive;
  document.getElementById('site-header-navigation-button').className = "site-header-navigation-button " + shouldBeActive;
}

function printWelcomeMessage() {
  console.log("\n\n%cBonjour, bienvenue sur le site de TOPO",'font-weight: bold;');
  console.log("%cUn problème ? Contactez-nous à topo@unige.ch ", 'color: #C30E00; font-weight: bold;');
  console.log("%cou contactez les web master: Mark Spurgeon (markspurgeon96@hotmail.com) et Alexandre Petot. ", 'color: #C30E00')
}

( function( $ ) {

  printWelcomeMessage();
    var count = 11;
    var total = 200;

    $(window).scroll(function(){
      if ($(window).scrollTop() == $(document).height() - $(window).height()){
       if (count > total){
         return false;
       } else{
          console.log('Reached bottom of page.');
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

      console.log('Requesting articles');

      $.ajax({
        url: `/${prefix}wp-admin/admin-ajax.php`,
        type:'POST',
        data: "action=infinite_scroll&page_no="+ pageNumber + '&loop_file=template-parts%2Farchive-loop',
        success: function (html) {
          console.log(`Loading ${count} articles.`);
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

/* Module ajouté afin de gérer l'animation des interview (affichage des réponses) */
const itvHeader = document.querySelectorAll('.interview-header');
itvHeader.forEach(element => {
  element.addEventListener('click', toggleActive);
})

function toggleActive(event){
  if(event.target.classList.contains('interview-header')) {
    event.target.classList.toggle('reponse-active');
    event.target.nextElementSibling.classList.toggle('reponse-active')
  }
}