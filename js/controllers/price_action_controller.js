$.Controller("PricesController",{
  second_init: false,
  init: function(){
    $(".btn.btn-success").remove();
    if(!this.parent.second_init){
      this.parent.second_init = true;
      $("form").attachPricesController();
      
    }
  },

  ".btn-danger -> click":function(ev){
    ev.preventDefault();
    row_id = $(ev.target).parents("tr").find('td').eq(0).text()
    if(confirm("Точно видалити данну ціну?"))
     this.delete_row(row_id)
  },

  delete_row:function(id){
    $.ajax({
      url:"/admin/prices/delete/",
      data:"id="+id,
      type:"post",
      dataType:"json",
      success:function(resp){
        if(resp.success)
          window.location.reload()
      }
    });
  },
  ".btn-info -> click":function(ev){
     row_id = $(ev.target).parents("tr").find('td').eq(0).text()
    this.load_form(row_id)
  },


  click: function(ev){
    ev.preventDefault()
    if($(ev.target).hasClass("btn-inverse"))
      this.load_form("")
  },
  load_form:function(id){
    $.ajax({
      url:"/admin/prices/get_form",
      type:"post",
      dataType:"json",
      data:"id="+id,
      success:function(resp){
        $('body').append(resp.html)
        $('body').find('.modal').attachPricesFormController()
          for(i in resp.data){
            $('.form_edit').find("#_"+i).val(resp.data[i]).change()
          }
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