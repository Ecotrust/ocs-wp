!function(e){var s=function(s,t,i,a){if(e(s).length>0){var o=e(s).offset().top;t=a?t:0,e("."+n.settings.className+"__focused-section").removeClass(n.settings.className+"__focused-section"),e(s).addClass(n.settings.className+"__focused-section"),e("html:not(:animated),body:not(:animated)").animate({scrollTop:o-i},t)}},t=function(){return window.location.hash},n={classes:{loading:"sn-loading",failed:"sn-failed",success:"sn-active"},defaults:{sections:"h2",subSections:!1,sectionElem:"section",className:"scroll-nav",showHeadline:!0,headlineText:"Scroll To",showTopLink:!0,topLinkText:"Top",fixedMargin:40,scrollOffset:40,fixedHeaderSize:0,animated:!0,speed:500,insertLocation:"insertBefore",arrowKeys:!1,activeClass:"active",scrollToHash:!0,onInit:null,onRender:null,onDestroy:null,onResetPos:null},_set_body_class:function(s){var t=e("body");"loading"===s?t.addClass(n.classes.loading):"success"===s?t.removeClass(n.classes.loading).addClass(n.classes.success):t.removeClass(n.classes.loading).addClass(n.classes.failed)},_find_sections:function(s){var t=n.settings.sections,i=[];if(n.settings.showTopLink){var a=s.children().first();a.is(t)||i.push(a.nextUntil(t).andSelf())}s.find(t).each(function(){i.push(e(this).nextUntil(t).andSelf())}),n.sections={raw:i}},_setup_sections:function(s){var t=[];e(s).each(function(s){var i=[],a=e(this),o="scrollNav-"+(s+1),l=function(){return 0===s},r=function(){return!a.eq(0).is(n.settings.sections)},c=n.settings.showTopLink&&l()&&r()?n.settings.topLinkText:a.filter(n.settings.sections).text();if(a.wrapAll("<"+n.settings.sectionElem+' id="'+o+'" class="'+n.settings.className+'__section" />'),n.settings.subSections){var d=a.filter(n.settings.subSections);d.length>0&&d.each(function(s){var t=o+"-"+(s+1),l=e(this).text(),r=a.filter(e(this).nextUntil(d).andSelf());r.wrapAll('<div id="'+t+'" class="'+n.settings.className+'__sub-section" />'),i.push({id:t,text:l})})}t.push({id:o,text:c,sub_sections:i})}),n.sections.data=t},_tear_down_sections:function(s){e(s).each(function(){var s=this.sub_sections;e("#"+this.id).children().unwrap(),s.length>0&&e(s).each(function(){e("#"+this.id).children().unwrap()})})},_setup_nav:function(s){var t=e("<span />",{"class":n.settings.className+"__heading",text:n.settings.headlineText}),i=e("<div />",{"class":n.settings.className+"__wrapper"}),a=e("<nav />",{"class":n.settings.className,role:"navigation"}),o=e("<ol />",{"class":n.settings.className+"__list"});e.each(s,function(s){var t,i=0===s?e("<li />",{"class":n.settings.className+"__item "+n.settings.activeClass}):e("<li />",{"class":n.settings.className+"__item"}),a=e("<a />",{href:"#"+this.id,"class":n.settings.className+"__link",text:this.text});this.sub_sections.length>0&&(i.addClass("is-parent-item"),t=e("<ol />",{"class":n.settings.className+"__sub-list"}),e.each(this.sub_sections,function(){var s=e("<li />",{"class":n.settings.className+"__sub-item"}),i=e("<a />",{href:"#"+this.id,"class":n.settings.className+"__sub-link",text:this.text});t.append(s.append(i))})),o.append(i.append(a).append(t))}),n.settings.showHeadline?a.append(i.append(t).append(o)):a.append(i.append(o)),n.nav=a},_insert_nav:function(){var e=n.settings.insertLocation,s=n.settings.insertTarget;n.nav[e](s)},_setup_pos:function(){var s=n.nav,t=e(window).height(),i=s.offset().top,a=function(s){var t=e("#"+s.id),n=t.height();s.top_offset=t.offset().top,s.bottom_offset=s.top_offset+n};e.each(n.sections.data,function(){a(this),e.each(this.sub_sections,function(){a(this)})}),n.dims={vp_height:t,nav_offset:i}},_check_pos:function(){var s=n.nav,t=e(window).scrollTop(),i=t+n.settings.scrollOffset+n.settings.fixedHeaderSize,a=t+n.dims.vp_height-n.settings.scrollOffset,o=[],l=[];t>n.dims.nav_offset-n.settings.fixedMargin?s.addClass("fixed"):s.removeClass("fixed");var r=function(e){return e.top_offset>=i&&e.top_offset<=a||e.bottom_offset>i&&e.bottom_offset<a||e.top_offset<i&&e.bottom_offset>a};e.each(n.sections.data,function(){r(this)&&o.push(this),e.each(this.sub_sections,function(){r(this)&&l.push(this)})}),s.find("."+n.settings.className+"__item").removeClass(n.settings.activeClass).removeClass("in-view"),s.find("."+n.settings.className+"__sub-item").removeClass(n.settings.activeClass).removeClass("in-view"),e.each(o,function(e){0===e?s.find('a[href="#'+this.id+'"]').parents("."+n.settings.className+"__item").addClass(n.settings.activeClass).addClass("in-view"):s.find('a[href="#'+this.id+'"]').parents("."+n.settings.className+"__item").addClass("in-view")}),n.sections.active=o,e.each(l,function(e){0===e?s.find('a[href="#'+this.id+'"]').parents("."+n.settings.className+"__sub-item").addClass(n.settings.activeClass).addClass("in-view"):s.find('a[href="#'+this.id+'"]').parents("."+n.settings.className+"__sub-item").addClass("in-view")})},_init_scroll_listener:function(){e(window).on("scroll.scrollNav",function(){n._check_pos()})},_rm_scroll_listeners:function(){e(window).off("scroll.scrollNav")},_init_resize_listener:function(){e(window).on("resize.scrollNav",function(){n._setup_pos(),n._check_pos()})},_rm_resize_listener:function(){e(window).off("resize.scrollNav")},_init_click_listener:function(){e("."+n.settings.className).find("a").on("click.scrollNav",function(t){t.preventDefault();var i=e(this).attr("href"),a=n.settings.speed,o=n.settings.scrollOffset,l=n.settings.animated;s(i,a,o,l)})},_rm_click_listener:function(){e("."+n.settings.className).find("a").off("click.scrollNav")},_init_keyboard_listener:function(t){n.settings.arrowKeys&&e(document).on("keydown.scrollNav",function(e){if(40===e.keyCode||38===e.keyCode){var i=function(e){var s=0,i=t.length;for(s;i>s;s++)if(t[s].id===n.sections.active[0].id){var a=40===e?s+1:s-1,o=void 0===t[a]?void 0:t[a].id;return o}},a=i(e.keyCode);if(void 0!==a){e.preventDefault();var o="#"+a,l=n.settings.speed,r=n.settings.scrollOffset,c=n.settings.animated;s(o,l,r,c)}}})},_rm_keyboard_listener:function(){e(document).off("keydown.scrollNav")},init:function(i){return this.each(function(){var a=e(this);n.settings=e.extend({},n.defaults,i),n.settings.insertTarget=n.settings.insertTarget?e(n.settings.insertTarget):a,a.length>0?(n.settings.onInit&&n.settings.onInit.call(this),n._set_body_class("loading"),n._find_sections(a),a.find(n.settings.sections).length>0?(n._setup_sections(n.sections.raw),n._setup_nav(n.sections.data),n.settings.insertTarget.length>0?(n._insert_nav(),n._setup_pos(),n._check_pos(),n._init_scroll_listener(),n._init_resize_listener(),n._init_click_listener(),n._init_keyboard_listener(n.sections.data),n._set_body_class("success"),n.settings.scrollToHash&&s(t()),n.settings.onRender&&n.settings.onRender.call(this)):(console.log('Build failed, scrollNav could not find "'+n.settings.insertTarget+'"'),n._set_body_class("failed"))):(console.log('Build failed, scrollNav could not find any "'+n.settings.sections+'s" inside of "'+a.selector+'"'),n._set_body_class("failed"))):(console.log('Build failed, scrollNav could not find "'+a.selector+'"'),n._set_body_class("failed"))})},destroy:function(){return this.each(function(){n._rm_scroll_listeners(),n._rm_resize_listener(),n._rm_click_listener(),n._rm_keyboard_listener(),e("body").removeClass("sn-loading sn-active sn-failed"),e("."+n.settings.className).remove(),n._tear_down_sections(n.sections.data),n.settings.onDestroy&&n.settings.onDestroy.call(this),n.settings=[],n.sections=void 0})},resetPos:function(){n._setup_pos(),n._check_pos(),n.settings.onResetPos&&n.settings.onResetPos.call(this)}};e.fn.scrollNav=function(){var s,t=arguments[0];if(n[t])t=n[t],s=Array.prototype.slice.call(arguments,1);else{if("object"!=typeof t&&t)return e.error("Method "+t+" does not exist in the scrollNav plugin"),this;t=n.init,s=arguments}return t.apply(this,s)}}(jQuery),function(e,s,t){function n(s,t){this.element=s,this.settings=e.extend({},i,t),this._defaults=i,this._name=a,this.init()}var i={label:"MENU",duplicate:!0,duration:200,easingOpen:"swing",easingClose:"swing",closedSymbol:"&#9658;",openedSymbol:"&#9660;",prependTo:"body",appendTo:"",parentTag:"a",closeOnClick:!1,allowParentLinks:!1,nestedParentLinks:!0,showChildren:!1,removeIds:!1,removeClasses:!1,removeStyles:!1,brand:"",init:function(){},beforeOpen:function(){},beforeClose:function(){},afterOpen:function(){},afterClose:function(){}},a="slicknav",o="slicknav";n.prototype.init=function(){var t,n,i=this,a=e(this.element),l=this.settings;if(l.duplicate?(i.mobileNav=a.clone(),i.mobileNav.removeAttr("id"),i.mobileNav.find("*").each(function(s,t){e(t).removeAttr("id")})):(i.mobileNav=a,i.mobileNav.removeAttr("id"),i.mobileNav.find("*").each(function(s,t){e(t).removeAttr("id")})),l.removeClasses&&(i.mobileNav.removeAttr("class"),i.mobileNav.find("*").each(function(s,t){e(t).removeAttr("class")})),l.removeStyles&&(i.mobileNav.removeAttr("style"),i.mobileNav.find("*").each(function(s,t){e(t).removeAttr("style")})),t=o+"_icon",""===l.label&&(t+=" "+o+"_no-text"),"a"===l.parentTag&&(l.parentTag='a href="#"'),i.mobileNav.attr("class",o+"_nav"),n=e('<div class="'+o+'_menu"></div>'),""!==l.brand){var r=e('<div class="'+o+'_brand">'+l.brand+"</div>");e(n).append(r)}i.btn=e(["<"+l.parentTag+' aria-haspopup="true" tabindex="0" class="'+o+"_btn "+o+'_collapsed">','<span class="'+o+'_menutxt">'+l.label+"</span>",'<span class="'+t+'">','<span class="'+o+'_icon-bar"></span>','<span class="'+o+'_icon-bar"></span>','<span class="'+o+'_icon-bar"></span>',"</span>","</"+l.parentTag+">"].join("")),e(n).append(i.btn),""!==l.appendTo?e(l.appendTo).append(n):e(l.prependTo).prepend(n),n.append(i.mobileNav);var c=i.mobileNav.find("li");e(c).each(function(){var s=e(this),t={};if(t.children=s.children("ul").attr("role","menu"),s.data("menu",t),t.children.length>0){var n=s.contents(),a=!1,r=[];e(n).each(function(){return e(this).is("ul")?!1:(r.push(this),void(e(this).is("a")&&(a=!0)))});var c=e("<"+l.parentTag+' role="menuitem" aria-haspopup="true" tabindex="-1" class="'+o+'_item"/>');if(l.allowParentLinks&&!l.nestedParentLinks&&a)e(r).wrapAll('<span class="'+o+"_parent-link "+o+'_row"/>').parent();else{var d=e(r).wrapAll(c).parent();d.addClass(o+"_row")}l.showChildren?s.addClass(o+"_open"):s.addClass(o+"_collapsed"),s.addClass(o+"_parent");var _=e('<span class="'+o+'_arrow">'+(l.showChildren?l.openedSymbol:l.closedSymbol)+"</span>");l.allowParentLinks&&!l.nestedParentLinks&&a&&(_=_.wrap(c).parent()),e(r).last().after(_)}else 0===s.children().length&&s.addClass(o+"_txtnode");s.children("a").attr("role","menuitem").click(function(s){l.closeOnClick&&!e(s.target).parent().closest("li").hasClass(o+"_parent")&&e(i.btn).click()}),l.closeOnClick&&l.allowParentLinks&&(s.children("a").children("a").click(function(s){e(i.btn).click()}),s.find("."+o+"_parent-link a:not(."+o+"_item)").click(function(s){e(i.btn).click()}))}),e(c).each(function(){var s=e(this).data("menu");l.showChildren||i._visibilityToggle(s.children,null,!1,null,!0)}),i._visibilityToggle(i.mobileNav,null,!1,"init",!0),i.mobileNav.attr("role","menu"),e(s).mousedown(function(){i._outlines(!1)}),e(s).keyup(function(){i._outlines(!0)}),e(i.btn).click(function(e){e.preventDefault(),i._menuToggle()}),i.mobileNav.on("click","."+o+"_item",function(s){s.preventDefault(),i._itemClick(e(this))}),e(i.btn).keydown(function(e){var s=e||event;13===s.keyCode&&(e.preventDefault(),i._menuToggle())}),i.mobileNav.on("keydown","."+o+"_item",function(s){var t=s||event;13===t.keyCode&&(s.preventDefault(),i._itemClick(e(s.target)))}),l.allowParentLinks&&l.nestedParentLinks&&e("."+o+"_item a").click(function(e){e.stopImmediatePropagation()})},n.prototype._menuToggle=function(e){var s=this,t=s.btn,n=s.mobileNav;t.hasClass(o+"_collapsed")?(t.removeClass(o+"_collapsed"),t.addClass(o+"_open")):(t.removeClass(o+"_open"),t.addClass(o+"_collapsed")),t.addClass(o+"_animating"),s._visibilityToggle(n,t.parent(),!0,t)},n.prototype._itemClick=function(e){var s=this,t=s.settings,n=e.data("menu");n||(n={},n.arrow=e.children("."+o+"_arrow"),n.ul=e.next("ul"),n.parent=e.parent(),n.parent.hasClass(o+"_parent-link")&&(n.parent=e.parent().parent(),n.ul=e.parent().next("ul")),e.data("menu",n)),n.parent.hasClass(o+"_collapsed")?(n.arrow.html(t.openedSymbol),n.parent.removeClass(o+"_collapsed"),n.parent.addClass(o+"_open"),n.parent.addClass(o+"_animating"),s._visibilityToggle(n.ul,n.parent,!0,e)):(n.arrow.html(t.closedSymbol),n.parent.addClass(o+"_collapsed"),n.parent.removeClass(o+"_open"),n.parent.addClass(o+"_animating"),s._visibilityToggle(n.ul,n.parent,!0,e))},n.prototype._visibilityToggle=function(s,t,n,i,a){var l=this,r=l.settings,c=l._getActionItems(s),d=0;n&&(d=r.duration),s.hasClass(o+"_hidden")?(s.removeClass(o+"_hidden"),a||r.beforeOpen(i),s.slideDown(d,r.easingOpen,function(){e(i).removeClass(o+"_animating"),e(t).removeClass(o+"_animating"),a||r.afterOpen(i)}),s.attr("aria-hidden","false"),c.attr("tabindex","0"),l._setVisAttr(s,!1)):(s.addClass(o+"_hidden"),a||r.beforeClose(i),s.slideUp(d,this.settings.easingClose,function(){s.attr("aria-hidden","true"),c.attr("tabindex","-1"),l._setVisAttr(s,!0),s.hide(),e(i).removeClass(o+"_animating"),e(t).removeClass(o+"_animating"),a?"init"===i&&r.init():r.afterClose(i)}))},n.prototype._setVisAttr=function(s,t){var n=this,i=s.children("li").children("ul").not("."+o+"_hidden");t?i.each(function(){var s=e(this);s.attr("aria-hidden","true");var i=n._getActionItems(s);i.attr("tabindex","-1"),n._setVisAttr(s,t)}):i.each(function(){var s=e(this);s.attr("aria-hidden","false");var i=n._getActionItems(s);i.attr("tabindex","0"),n._setVisAttr(s,t)})},n.prototype._getActionItems=function(e){var s=e.data("menu");if(!s){s={};var t=e.children("li"),n=t.find("a");s.links=n.add(t.find("."+o+"_item")),e.data("menu",s)}return s.links},n.prototype._outlines=function(s){s?e("."+o+"_item, ."+o+"_btn").css("outline",""):e("."+o+"_item, ."+o+"_btn").css("outline","none")},n.prototype.toggle=function(){var e=this;e._menuToggle()},n.prototype.open=function(){var e=this;e.btn.hasClass(o+"_collapsed")&&e._menuToggle()},n.prototype.close=function(){var e=this;e.btn.hasClass(o+"_open")&&e._menuToggle()},e.fn[a]=function(s){var t=arguments;if(void 0===s||"object"==typeof s)return this.each(function(){e.data(this,"plugin_"+a)||e.data(this,"plugin_"+a,new n(this,s))});if("string"==typeof s&&"_"!==s[0]&&"init"!==s){var i;return this.each(function(){var o=e.data(this,"plugin_"+a);o instanceof n&&"function"==typeof o[s]&&(i=o[s].apply(o,Array.prototype.slice.call(t,1)))}),void 0!==i?i:this}}}(jQuery,document,window);
//# sourceMappingURL=plugins.js.map
