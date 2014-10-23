$.Controller("PagesController",{
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
      url:"/admin/pages/get_form",
      dataType:"json",
      success:function(resp){
        $("#content").append(resp.html)
        $("#content").find('.page_edit').attachPagesFormController()
      }
    });
  }
});
function wrapText(elementID, openTag, closeTag) {
    var textArea = $('#' + elementID);
    var len = textArea.val().length;
    var start = textArea[0].selectionStart;
    var end = textArea[0].selectionEnd;
    var selectedText = textArea.val().substring(start, end);
    var replacement = openTag + selectedText + closeTag;
    textArea.val(textArea.val().substring(0, start) + replacement + textArea.val().substring(end, len));
}
$.Controller("PagesFormController",{
  init: function(){
    this.element.find("textarea.cleditor").cleditor({
      width: "100%",
      height: "500px"
    });
   this._area_id = "_text_0"
    this.element.find(".control-group").hide()
    this.element.find(".control-group._0").show()
  },
  ".btn.btn-inverse -> click":function(ev){
    ev.preventDefault()
    this._area_id
    wrapText(this._area_id,"<strong>", "</strong>")
    //text = "<strong>"+getSelectionText()+"</strong>"
    
  },
  ".btn.btn-warning -> click":function(ev){
    ev.preventDefault()
    el   = $(ev.target)
    if(el.hasClass("active"))
      return
    btns = this.element.find(".btn.btn-warning")
    idx  = btns.index(el)
    this._area_id = "_text_" + idx
    btns.removeClass("active")
    el.addClass("active")
    this.element.find(".control-group").hide()
    this.element.find(".control-group._"+idx).show()
  },
  
  ".btn -> click":function(ev){
    ev.preventDefault()
   
    el = $(ev.target).hasClass("btn") ? $(ev.target) : $(ev.target).parents(".btn")
    if(!el.hasClass('btn-primary') && !el.hasClass('btn-warning') && !el.hasClass('btn-inverse')){
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
      url:"/admin/pages/"+action,
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