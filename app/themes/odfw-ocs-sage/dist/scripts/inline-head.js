var setUpOCSsearch={init:function(){self=this,this.h1=document.querySelector("h1"),this.h1.className="sr-only",document.documentElement.className="js",this.search=document.querySelector("#search-field"),this.title=-1!==document.body.className.indexOf("home")?"Search":this.h1.firstChild.nodeValue,this.widthOffset=document.querySelector("#cpt-listings-wrap")?150:42,this.searchBoxWidth=this.search.clientWidth-self.widthOffset,this.lenTest=document.getElementById("length-test"),this.searchOriginalFontSize=window.getComputedStyle(this.search,null).getPropertyValue("font-size"),this.sizeChanged=!1,this.searchForm=document.querySelector(".search-form"),this.search.setAttribute("placeholder",self.title),this.search.setAttribute("data-og-font-size",self.searchOriginalFontSize),this.lenTest.innerHTML=self.title,self.checkSearchBoxLength(),this.search.addEventListener("input",self.handleSearchChange),this.search.addEventListener("propertychange",self.handleSearchChange),this.search.addEventListener("blur",self.handleSearchChange),this.search.addEventListener("focus",self.focusInput),this.searchForm.addEventListener("submit",self.handleSubmit)},focusInput:function(){self.search.setAttribute("placeholder","")},checkSearchBoxLength:function(e){var t=self.lenTest.clientWidth+1;t>self.searchBoxWidth?(self.search.style.fontSize=Math.max(Math.min(self.searchBoxWidth/t*33,parseFloat(33)),parseFloat(13))+"px",self.sizeChanged=!0):self.sizeChanged&&t<self.searchBoxWidth&&(self.search.style.fontSize=self.searchOriginalFontSize)},handleSearchChange:function(e){var t=self.search.value.length;self.lenTest.innerHTML=self.search.value,0===t&&(self.search.setAttribute("placeholder",self.title),self.lenTest.innerHTML=self.title),self.checkSearchBoxLength()},handleSubmit:function(e){var t=(document.querySelector("main"),document.createElement("span"));t.className="searching",t.innerHTML="Searching the OCS for <mark>"+self.search.value+"</mark>.",window.setTimeout(function(){document.body.className=document.body.className+=" search-submitted"},100)}};window.innerWidth>767&&(document.documentElement.className="no-fouc",document.onreadystatechange=function(){"interactive"===document.readyState&&setUpOCSsearch.init()});var projectId=null,mtiTracking=document.createElement("link");mtiTracking.type="text/css",mtiTracking.rel="stylesheet",mtiTracking.href=("https:"===document.location.protocol?"https:":"http:")+"//fast.fonts.net/t/1.css?apiType=css&projectid="+projectId,(document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]).appendChild(mtiTracking);
//# sourceMappingURL=inline-head.js.map
