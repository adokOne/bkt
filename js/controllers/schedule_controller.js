$.Controller("ScheduleController",{
  init: function(){
    
  },
  click: function(ev){
    ev.preventDefault()
    this.load_form()
  },
  load_form:function(){
    $.ajax({
      url:"/admin/schedule/get_form",
      dataType:"json",
      success:function(resp){
        $('body').append(resp.html)
        $('body').find('.modal').attachScheduleFormController()
      }
    });
  }
});

$.Controller("ScheduleFormController",{
  init: function(){
    this.element.find("#_start_date").datepicker()
    this.element.find("#_time_from").timepicker({
      hourMin: 8,
      hourMax: 16
    });
    this.element.find("#_time_to").timepicker({
      hourMin: 8,
      hourMax: 16
    });
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
      url:"/admin/schedule/"+action,
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
