$.Controller("sale_action_controller",{
  init:function(){
    console.log($("#eedd").length)
    this.element.find('.btn-success').remove()
    this.row_id = this.element.parent().find('td').eq(0).text()
  },
  
  delete_row:function(id){
    $.ajax({
      url:"/admin/sale/delete/",
      data:"id="+id,
      type:"post",
      dataType:"json",
      success:function(resp){
        if(resp.success)
          window.location.reload()
      }
    });
  },
  get_edit_form:function(id){
    self = this
    $.ajax({
      url:"/admin/sale/get_form/",
      type:"post",
      data:"id="+id,
      dataType:"json",
      success:function(resp){
      $(".btn_block").hide()
       $("#content").find('form').hide()
        $("#content").append(resp.html)
        $("#content").find('.page_edit').attachBlogFormController()
          for(i in resp.data){
            $('.page_save').find("#_"+i).val(resp.data[i]).change()
          }
      }
    });
  },
  
  ".btn-danger -> click":function(ev){
    ev.preventDefault()
    if(confirm("Точно видалити данні?"))
      this.delete_row(this.row_id)
  },
  ".icon-edit -> click":function(ev){
    ev.preventDefault()
    el = $(ev.target)
    this.get_edit_form(this.row_id)
  }
  
});



$.Controller("BlogController",{
  init: function(){
    $('[data-auto-controller="news_action_controller"]').attr("id","ddd")
    $('[data-auto-controller="news_action_controller"]').attachsale_action_controller()
  },
  click: function(ev){
    ev.preventDefault()
    this.element.parents(".btn_block").hide()
    this.load_form()
    $("#content").find('form').hide()
  },
  load_form:function(){
    $.ajax({
      url:"/admin/sale/get_form",
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
      url:"/admin/sale/"+action,
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


