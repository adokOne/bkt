

$.Controller("OnLineRegController",{
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
          if(resp.status){
          alert(resp.msg)
          window.location.href = "/thanks"
            $(".b_shadow").remove()
          }
          else
            alert("Перевірте введені дані")
            
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
  
  "input[name=phone] -> keyup":function(ev){
    el = $(ev.target)
    el.val($.trim(el.val().replace(/[^+0-9]/g, "")))
  },
  
  "click":function(ev){
    el = $(ev.target)
    if(el.hasClass("b_shadow"))
      this.element.remove()
  }

});
$.Controller("CallBackController",{
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
          
            $(".b_shadow").hide()
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
  
  "input[name=phone] -> keyup":function(ev){
    el = $(ev.target)
    el.val($.trim(el.val().replace(/[^+0-9]/g, "")))
  },
  
  "click":function(ev){
    el = $(ev.target)
    if(el.hasClass("b_shadow"))
      this.element.remove()
  }
  
});
