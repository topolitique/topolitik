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
  console.log("%cou contactez les web master: Mark Spurgeon (mark.spurgeon@protonmail.com)", 'color: #C30E00')
}

( function( $ ) {

  printWelcomeMessage();
    var count = 11;
    var total = 200;

    $(window).scroll(function(){
      if ($(window).scrollTop() > 100 ) {
        $('div.sticky-margin-container').addClass('float');
      } else {
        $('div.sticky-margin-container').removeClass('float');
      };

      if ($(window).scrollTop() == $(document).height() - $(window).height()){
       if (count > total){
          // add this data to html
          return false;
       } else{
          console.log('Reached bottom of page.');
          if (window.location.href.includes('category')) {
            loadArticle(count);
          }
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

/* Module ajouté afin de gérer l'animation des interview (affichage des réponses) */
const itvHeader = document.querySelectorAll('.interview-header');
itvHeader.forEach(element => {
  element.addEventListener('click', toggleActive);
})

function toggleActive(){
  if(this.classList.contains('interview-header')) {
    this.classList.toggle('reponse-active');
    this.nextElementSibling.classList.toggle('reponse-active')
  }
}


function updateDonationLink(event) {
  let amount = document.getElementById('donation-amount').value;
  let name = document.getElementById('donation-name').value;
  let surname = document.getElementById('donation-surname').value;
  let email = document.getElementById('donation-email').value;

  let link = `https://topo.payrexx.com/fr/vpos?amount=${amount}&currency=CHF&contact_forename=${name}&contact_surname=${surname}&contact_email=${email}`
  document.getElementById('donation-link').href = link
}