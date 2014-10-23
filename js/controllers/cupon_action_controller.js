$.Controller("cupon_action_controller",{
  init:function(){
    this.element.find('.btn-success').remove()
    this.row_id = this.element.parent().find('td').eq(0).text()
  },
  
  delete_row:function(id){
    $.ajax({
      url:"/admin/cupons/delete/",
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
      url:"/admin/cupons/get_form/",
      type:"post",
      data:"id="+id,
      dataType:"json",
      success:function(resp){
        $('body').append(resp.html)
        $('body').find('.modal').attachCuponFormController();
          for(i in resp.data){
            $('.form_edit').find("#_"+i).val(resp.data[i]).change()
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


$.Controller("CuponFormController",{
  init: function(){
    this.element.show()
  },
  ".btn -> click":function(ev){
    ev.preventDefault()
    el = $(ev.target);
    if(!el.hasClass('btn-primary'))
      el.parents('.modal').remove();
    else
      if(el.hasClass('org'))
        this.edit_price('save_org')
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
      url:"/admin/cupons/"+action,
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
$.Controller("CuponController",{
  init: function(){
    
  },
  click: function(ev){
    ev.preventDefault()
    if(this.element.hasClass("organization"))
      this.load_form("get_organization_form")
    else 
      this.load_form("get_form")
  },
  load_form:function(type){
    $.ajax({
      url:"/admin/cupons/"+type,
      dataType:"json",
      success:function(resp){

        $('body').append(resp.html)
        $('body').find('.modal').attachCuponFormController()
      }
    });
  }
});
