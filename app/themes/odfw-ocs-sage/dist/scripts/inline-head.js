var setUpOCSsearch={init:function(){this.h1=document.querySelector("h1"),this.search=document.querySelector("#search-field"),this.title=-1!==document.body.className.indexOf("home")?"Search":this.h1.firstChild.nodeValue,this.lenTest=document.getElementById("length-test"),this.searchBoxWidth=this.search.clientWidth-40,this.searchOriginalFontSize=window.getComputedStyle(this.search,null).getPropertyValue("font-size"),this.sizeChanged=!1,self=this,this.h1.className="sr-only",this.search.setAttribute("placeholder",self.title),this.search.setAttribute("data-og-font-size",self.searchOriginalFontSize),this.lenTest.innerHTML=self.title,self.checkSearchBoxLength(),this.search.addEventListener("input",self.handleSearchChange),this.search.addEventListener("propertychange",self.handleSearchChange),this.search.addEventListener("blur",self.handleSearchChange),this.search.addEventListener("focus",self.focusInput)},focusInput:function(){self.search.setAttribute("placeholder","")},checkSearchBoxLength:function(e){var t=self.lenTest.clientWidth+1;t>self.searchBoxWidth?(self.search.style.fontSize=Math.max(Math.min(self.searchBoxWidth/t*33,parseFloat(33)),parseFloat(13))+"px",self.sizeChanged=!0):self.sizeChanged&&t<self.searchBoxWidth&&(self.search.style.fontSize=self.searchOriginalFontSize)},handleSearchChange:function(e){var t=self.search.value.length;self.lenTest.innerHTML=self.search.value,0===t&&(self.search.setAttribute("placeholder",self.title),self.lenTest.innerHTML=self.title),self.checkSearchBoxLength()}};window.innerWidth>767&&(document.onreadystatechange=function(){"interactive"==document.readyState&&setUpOCSsearch.init()});
//# sourceMappingURL=inline-head.js.map