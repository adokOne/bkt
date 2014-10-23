$.Controller("PricesController",{
  init: function(){
    
  },
  click: function(ev){
    ev.preventDefault()
    this.load_form()
  },
  load_form:function(){
    $.ajax({
      url:"/admin/prices/get_form",
      dataType:"json",
      success:function(resp){
        $('body').append(resp.html)
        $('body').find('.modal').attachPricesFormController()
      }
    });
  }
});

$.Controller("PricesFormController",{
  init: function(){
  },
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
      url:"/admin/prices/"+action,
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