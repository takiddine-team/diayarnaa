// $(document).click(function(e) {
// 	if (!$(e.target).is('.c_blomem')) {
//     	$('.collapse').collapse('hide');	    
//     }
// });


// show number item
function myRowOne() {

    $('#i_show_container').removeClass('container_900')

    var divs = document.querySelectorAll('#i_show_num');
    for (var i = 0; i < divs.length; i++) {
        divs[i].classList.add('col-md-3');
        divs[i].classList.remove('col-md-6');
    }
  }

  function myRowThree() {

    $('#i_show_container').addClass('container_900')

    var divs = document.querySelectorAll('#i_show_num');
    for (var i = 0; i < divs.length; i++) {
        divs[i].classList.remove('col-md-3');
        divs[i].classList.add('col-md-6');
    }
  }
