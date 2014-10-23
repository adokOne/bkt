$(document).ready(function(){
  $('*[data-auto-controller]').each(function() {
      var plg;
      if ((plg = $(this)['attach' + $(this).data('auto-controller')])) {
        return plg.call($(this));
      }
     });
     
     
  $("#call_back_button").click(function(ev){
    ev.preventDefault()
    $.ajax({
    	url:"/main/get_call_back_form",
	type:"post",
	dataType:"json",
	success:function(resp){
		$("#content").after(resp.html);
		$(".b_shadow").show()
    		$(".b_shadow").attachCallBackController();
	}
    })
    
 
  })


  $("#navigation a").click(function(ev){
    ev.preventDefault()
    id = $(this).attr("id") +"_"
    console.log("wefwe")
    $('html, body').animate({
         scrollTop: $("#"+id).offset().top
     }, 1000);

  });

  slide_init()
});

function doOnlineReg(kyrs,grupa,type){
  $.ajax({
    type:"post",
    dataType:"json",
    url:"/get_online_reg_form/"+kyrs+"/"+grupa+"/"+type,
    success:function(resp){
      $("#content").after(resp.html);
      $(".b_shadow").show()
      $(".b_shadow").attachOnLineRegController();
    }

  });
}


  function slide_init(){
    partners  = $('#baner_slide .baner_item')
    _index     = 0
    partners.each(function(i,el){
      el = $(el)
      if(i!=0)
        el.hide()
    })

    partners_slider = setInterval(function(){
      if(partners.length==1)
        return false
      _index+=1
      if(_index==1)
        partners.eq((partners.length-1)).fadeOut()
      _index == -1 ? (partners.length-1) : _index
      partners.eq((_index-1)).fadeOut()
      partners.eq((_index)).fadeIn()
      if(_index==(partners.length-1)){
        //partners.eq(0).show('slow')
        _index = -1
      }
        
    }, 4000)
  }
