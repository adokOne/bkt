$.Controller("OnlineRegController",{
  init:function(){
    
    this.setup_validation();
    this.set_submit();
  },
  set_submit:function(){
    self = this
    this.element.ajaxForm({
      dataType:'json',
      success:function(resp){
        alert(resp.msg)
        if(resp.status)
          window.location.href = "/thanks"
        //  self.show_errors(resp.text);
          
      }
    });
  },
  submit:function(ev){
    /*if(!this.element.valid())
      ev.preventDefault()*/
  },
  show_errors:function(text){
    field = this.element.prev();
    old   = field.text();
    field.html(text).css('color','red').show();
    self = this
    setTimeout('self.remove_error(field,old)',1200);
  },
  remove_error:function(field,text){
    field.css('color','#646464');
    field.html(text);
  },
  
  
  
  setup_validation: function() {
    this.element.validate({
      ignore: "",
      highlight: function(el, e_cls) {
        $(el).parents("dl").find("b").addClass(e_cls);
      },
      unhighlight: function(el, e_cls) {
        $(el).parents("dl").find("b").removeClass(e_cls);
      },
      errorPlacement: function(err,el) {
        if(el.attr("name") == "group"){
          $(el).parents("dl").find("b").addClass("error");
        }
          
      },
      onkeyup: false,
      onfocusout: false,
      focusCleanup: true,
      focusInvalid: false,
      minlength:3
    });
  }, 
  
  "input[name=phone] -> keyup":function(ev){
    el = $(ev.target)
    el.val($.trim(el.val().replace(/[^+0-9]/g, "")))
  },
  
  "input[name=email] -> keyup":function(ev){
    el = $(ev.target)
    el.val($.trim(el.val().replace(/[^@.\-_0-9a-zA-Z\s]/g, "")))
  },
  "input[name=name] -> keyup":function(ev){
    el = $(ev.target)
    el.val(el.val().replace(/[@.\-_0-9a-zA-Z]/, ""))
  },
  "input[name=is_group] -> change":function(ev){
    n_el = $(ev.target).parents("dl").next()
    
    if($(ev.target).is(":checked")){
      n_el.css("visibility","visible")
      $("select[name=group]").attr("required","required").valid()
    }
     else{
      n_el.css("visibility","hidden")
      $("select[name=group]").removeAttr("required").valid()
      }
  }
  
  
  
  
  
});
