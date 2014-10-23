$.Controller("FeedbckController",{
  "a -> click":function(ev){
     ev.preventDefault(); 
    
  }
  
});

$.Controller("SendFeedbackController",{

  init:function(){
    
    this.setup_validation()
  },
  
  
  
  submit_from:function(){
    form = this.element.find("form")
      $.ajax({
        url:form.attr("action"),
        data:form.serialize(),
        type:"post",
        dataType:"json",
        success:function(resp){
          
            
              window.location.reload();
        }
      });
  },
  
  ".button -> click":function(ev){
    ev.preventDefault()
    if(this.element.find("form").valid())
      this.submit_from()
  },
  
  setup_validation: function() {
    this.element.find("form").validate({
      ignore: "",
      highlight: function(el, e_cls) {
        $(el).addClass(e_cls);
      },
      unhighlight: function(el, e_cls) {
        $(el).removeClass(e_cls);
      },
      errorPlacement: function(err,el) {
          
      },
      onkeyup: false,
      onfocusout: false,
      focusCleanup: true,
      focusInvalid: false,
      minlength:3
    });
  },
  
  "input[name=name] -> keyup":function(ev){
    el = $(ev.target)
    el.val(el.val().replace(/[@.\-_0-9a-zA-Z]/, ""))
  },
    
  "click":function(ev){
     ev.preventDefault(); 
     if($(ev.target).hasClass("send")){
         $(".b_shadow_2").show();
          return;
}
    el = $(ev.target)
    if(el.hasClass("b_shadow_2"))
      this.element.hide()
  },
  "a -> click":function(ev){
     ev.preventDefault(); 
    
  }






});