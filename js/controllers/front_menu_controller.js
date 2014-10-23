$.Controller("FrontMenuController",{
  init:function(){
    console.log(this.element);
  },
  
  "h1.one1 -> click":function(ev){
    
    
    
    
    ev.preventDefault()
    
    

    
    div = $(ev.target).parents(".collapsed")
    if(div.find("a").length < 1)
      window.location.href = $(ev.target).attr("href")
    else{
      
      if(div.hasClass("open")){
        div.removeClass("open");
        div.css("height",35);
        return
      }
      
    this.element.find(".collapsed").each(function(i,el){
      $(el).css("height",35);
    });
      
      
      height  = 35;
      _height = 0;
      div.find("a").each(function(i,el){
        _height += ($(el).height() + 20)
      });
      fin_height = (_height + height)
          for(height ; height <= fin_height  ; height ++){
            
            div.css("height",height)
           
          }

    }
    
     div.addClass("open");
    
    
    
  }
  
});
