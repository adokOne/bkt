$.Controller("BlogController",{
  init: function(){
    
  },
  click: function(ev){
    ev.preventDefault()
    this.element.parents(".btn_block").hide()
    this.load_form()
    $("#content").find('form').hide()
  },
  load_form:function(){
    $.ajax({
      url:"/admin/blog/get_form",
      dataType:"json",
      success:function(resp){
        $("#content").append(resp.html)
        $("#content").find('.page_edit').attachBlogFormController()
      }
    });
  }
});

$.Controller("BlogFormController",{
  init: function(){
    this.element.find("textarea.cleditor").cleditor({
      width: "100%",
      height: "500px"
    });
    this.element.find(".control-group").hide()
    this.element.find(".control-group._0").show()
  },
  
  ".btn.btn-warning -> click":function(ev){
    ev.preventDefault()
    el   = $(ev.target)
    if(el.hasClass("active"))
      return
    btns = $(".btn.btn-warning")
    idx  = btns.index(el)
    btns.removeClass("active")
    el.addClass("active")
    this.element.find(".control-group").hide()
    this.element.find(".control-group._"+idx).show()
  },
  
  ".btn -> click":function(ev){
    ev.preventDefault()
   
    el = $(ev.target).hasClass("btn") ? $(ev.target) : $(ev.target).parents(".btn")
    if(!el.hasClass('btn-primary') && !el.hasClass('btn-warning')){
      $('.page_edit').remove();
      $("#content").find('form').show();
      $(".btn_block").show()
    }
    if(el.hasClass("save"))
      this.edit_price('save')
  },
  "button -> click":function(ev){
    ev.preventDefault()
    el = $(ev.target);
    el.parents('.modal').remove();
  },

  edit_price:function(action){
    form = this.element.find(".page_save")
    $.ajax({
      url:"/admin/blog/"+action,
      dataType:"json",
      type:"post",
      data:form.serialize(),
      success:function(resp){
        if(resp.success)
          window.location.reload()
      }
    })
  }
});