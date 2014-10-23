$.Controller("MenuEditController",{
  init:function(){
    $(".btn_block").remove()
  }
  
});



$.Controller("MenuController",{
  init:function(){
    
  },
  
  ".btn-danger -> click":function(ev){
     ev.preventDefault();
     el = $(ev.target)
    $.ajax({
      url:"/admin/menu/delete",
      dataType:"json",
      data: "id="+el.data("id"),
      type:"post",
      success:function(resp){
        window.location.reload()
      }
    });
  },
  ".btn-inverse -> click":function(ev){
    ev.preventDefault();
    this.load_form($(ev.target).data("parent_id"));
  },
  load_form:function(parent_id){
    self = this
    $.ajax({
      url:"/admin/menu/get_form",
      dataType:"json",
      data: "id="+self.element.data("id")+"&parent_id="+parent_id,
      type:"post",
      success:function(resp){
        $('body').append(resp.html);
        $(".modal").attachMenuFormController();
      }
    });
  }
  
});




$.Controller("MenuFormController",{
  
  ".btn -> click":function(ev){
    ev.preventDefault()
    el = $(ev.target);
    if(!el.hasClass('btn-primary'))
      el.parents('.modal').remove();
    else
      this.edit_price('save')
  },
  "button -> click":function(ev){
    ev.preventDefault()
    el = $(ev.target);
    el.parents('.modal').remove();
  },
  edit_price:function(action){
    form = this.element.find(".form-horizontal.form_edit")
    $.ajax({
      url:"/admin/menu/"+action,
      dataType:"json",
      type:"post",
      data:form.serialize(),
      success:function(resp){
        if(resp.success)
          window.location.reload()
      }
    })
  },
  
  "#_link -> change":function(ev){
    ev.preventDefault()
    val = $(ev.target).find("option:selected").text()
    $("#_name").val(val)
  }
  
  
  
  
  
  
  
  
  
  
});





