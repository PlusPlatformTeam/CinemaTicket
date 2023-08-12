/*!
 * AdminLTE v3.0.0-alpha.2 (https://adminlte.io)
 * Copyright 2014-2018 Abdullah Almsaeed <abdullah@almsaeedstudio.com>
 * Licensed under MIT (https://github.com/almasaeed2010/AdminLTE/blob/master/LICENSE)
 */
!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?t(exports):"function"==typeof define&&define.amd?define(["exports"],t):t(e.adminlte={})}(this,function(e){"use strict";var i,t,o,n,r,a,s,c,f,l,u,d,h,p,_,g,y,m,v,C,D,E,A,O,w,b,L,S,j,T,I,Q,R,P,x,B,M,k,H,N,Y,U,V,G,W,X,z,F,q,J,K,Z,$,ee,te,ne="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},ie=function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")},oe=(i=jQuery,t="ControlSidebar",o="lte.control.sidebar",n=i.fn[t],r=".control-sidebar",a='[data-widget="control-sidebar"]',s=".main-header",c="control-sidebar-open",f="control-sidebar-slide-open",l={slide:!0},u=function(){function n(e,t){ie(this,n),this._element=e,this._config=this._getConfig(t)}return n.prototype.show=function(){this._config.slide?i("body").removeClass(f):i("body").removeClass(c)},n.prototype.collapse=function(){this._config.slide?i("body").addClass(f):i("body").addClass(c)},n.prototype.toggle=function(){this._setMargin(),i("body").hasClass(c)||i("body").hasClass(f)?this.show():this.collapse()},n.prototype._getConfig=function(e){return i.extend({},l,e)},n.prototype._setMargin=function(){i(r).css({top:i(s).outerHeight()})},n._jQueryInterface=function(t){return this.each(function(){var e=i(this).data(o);if(e||(e=new n(this,i(this).data()),i(this).data(o,e)),"undefined"===e[t])throw new Error(t+" is not a function");e[t]()})},n}(),i(document).on("click",a,function(e){e.preventDefault(),u._jQueryInterface.call(i(this),"toggle")}),i.fn[t]=u._jQueryInterface,i.fn[t].Constructor=u,i.fn[t].noConflict=function(){return i.fn[t]=n,u._jQueryInterface},u),re=(d=jQuery,h="Layout",p="lte.layout",_=d.fn[h],g=".main-sidebar",y=".main-header",m=".content-wrapper",v=".main-footer",C="hold-transition",D=function(){function n(e){ie(this,n),this._element=e,this._init()}return n.prototype.fixLayoutHeight=function(){var e={window:d(window).height(),header:d(y).outerHeight(),footer:d(v).outerHeight(),sidebar:d(g).height()},t=this._max(e);d(m).css("min-height",t-e.header),d(g).css("min-height",t-e.header)},n.prototype._init=function(){var e=this;d("body").removeClass(C),this.fixLayoutHeight(),d(g).on("collapsed.lte.treeview expanded.lte.treeview collapsed.lte.pushmenu expanded.lte.pushmenu",function(){e.fixLayoutHeight()}),d(window).resize(function(){e.fixLayoutHeight()}),d("body, html").css("height","auto")},n.prototype._max=function(t){var n=0;return Object.keys(t).forEach(function(e){t[e]>n&&(n=t[e])}),n},n._jQueryInterface=function(t){return this.each(function(){var e=d(this).data(p);e||(e=new n(this),d(this).data(p,e)),t&&e[t]()})},n}(),d(window).on("load",function(){D._jQueryInterface.call(d("body"))}),d.fn[h]=D._jQueryInterface,d.fn[h].Constructor=D,d.fn[h].noConflict=function(){return d.fn[h]=_,D._jQueryInterface},D),ae=(E=jQuery,A="PushMenu",w="."+(O="lte.pushmenu"),b=E.fn[A],L={COLLAPSED:"collapsed"+w,SHOWN:"shown"+w},S={screenCollapseSize:768},j={TOGGLE_BUTTON:'[data-widget="pushmenu"]',SIDEBAR_MINI:".sidebar-mini",SIDEBAR_COLLAPSED:".sidebar-collapse",BODY:"body",OVERLAY:"#sidebar-overlay",WRAPPER:".wrapper"},T="sidebar-collapse",I="sidebar-open",Q=function(){function n(e,t){ie(this,n),this._element=e,this._options=E.extend({},S,t),E(j.OVERLAY).length||this._addOverlay()}return n.prototype.show=function(){E(j.BODY).addClass(I).removeClass(T);var e=E.Event(L.SHOWN);E(this._element).trigger(e)},n.prototype.collapse=function(){E(j.BODY).removeClass(I).addClass(T);var e=E.Event(L.COLLAPSED);E(this._element).trigger(e)},n.prototype.toggle=function(){(E(window).width()>=this._options.screenCollapseSize?!E(j.BODY).hasClass(T):E(j.BODY).hasClass(I))?this.collapse():this.show()},n.prototype._addOverlay=function(){var e=this,t=E("<div />",{id:"sidebar-overlay"});t.on("click",function(){e.collapse()}),E(j.WRAPPER).append(t)},n._jQueryInterface=function(t){return this.each(function(){var e=E(this).data(O);e||(e=new n(this),E(this).data(O,e)),t&&e[t]()})},n}(),E(document).on("click",j.TOGGLE_BUTTON,function(e){e.preventDefault();var t=e.currentTarget;"pushmenu"!==E(t).data("widget")&&(t=E(t).closest(j.TOGGLE_BUTTON)),Q._jQueryInterface.call(E(t),"toggle")}),E.fn[A]=Q._jQueryInterface,E.fn[A].Constructor=Q,E.fn[A].noConflict=function(){return E.fn[A]=b,Q._jQueryInterface},Q),se=(R=jQuery,P="Treeview",B="."+(x="lte.treeview"),M=R.fn[P],k={SELECTED:"selected"+B,EXPANDED:"expanded"+B,COLLAPSED:"collapsed"+B,LOAD_DATA_API:"load"+B},H=".nav-item",N=".nav-treeview",Y=".menu-open",V="menu-open",G={trigger:(U='[data-widget="treeview"]')+" "+".nav-link",animationSpeed:300,accordion:!0},W=function(){function i(e,t){ie(this,i),this._config=t,this._element=e}return i.prototype.init=function(){this._setupListeners()},i.prototype.expand=function(e,t){var n=this,i=R.Event(k.EXPANDED);if(this._config.accordion){var o=t.siblings(Y).first(),r=o.find(N).first();this.collapse(r,o)}e.slideDown(this._config.animationSpeed,function(){t.addClass(V),R(n._element).trigger(i)})},i.prototype.collapse=function(e,t){var n=this,i=R.Event(k.COLLAPSED);e.slideUp(this._config.animationSpeed,function(){t.removeClass(V),R(n._element).trigger(i),e.find(Y+" > "+N).slideUp(),e.find(Y).removeClass(V)})},i.prototype.toggle=function(e){var t=R(e.currentTarget),n=t.next();if(n.is(N)){e.preventDefault();var i=t.parents(H).first();i.hasClass(V)?this.collapse(R(n),i):this.expand(R(n),i)}},i.prototype._setupListeners=function(){var t=this;R(document).on("click",this._config.trigger,function(e){t.toggle(e)})},i._jQueryInterface=function(n){return this.each(function(){var e=R(this).data(x),t=R.extend({},G,R(this).data());e||(e=new i(R(this),t),R(this).data(x,e)),"init"===n&&e[n]()})},i}(),R(window).on(k.LOAD_DATA_API,function(){R(U).each(function(){W._jQueryInterface.call(R(this),"init")})}),R.fn[P]=W._jQueryInterface,R.fn[P].Constructor=W,R.fn[P].noConflict=function(){return R.fn[P]=M,W._jQueryInterface},W),ce=(X=jQuery,z="Widget",q="."+(F="lte.widget"),J=X.fn[z],K={EXPANDED:"expanded"+q,COLLAPSED:"collapsed"+q,REMOVED:"removed"+q},$="collapsed-card",ee={animationSpeed:"normal",collapseTrigger:(Z={DATA_REMOVE:'[data-widget="remove"]',DATA_COLLAPSE:'[data-widget="collapse"]',CARD:".card",CARD_HEADER:".card-header",CARD_BODY:".card-body",CARD_FOOTER:".card-footer",COLLAPSED:".collapsed-card"}).DATA_COLLAPSE,removeTrigger:Z.DATA_REMOVE},te=function(){function n(e,t){ie(this,n),this._element=e,this._parent=e.parents(Z.CARD).first(),this._settings=X.extend({},ee,t)}return n.prototype.collapse=function(){var e=this;this._parent.children(Z.CARD_BODY+", "+Z.CARD_FOOTER).slideUp(this._settings.animationSpeed,function(){e._parent.addClass($)});var t=X.Event(K.COLLAPSED);this._element.trigger(t,this._parent)},n.prototype.expand=function(){var e=this;this._parent.children(Z.CARD_BODY+", "+Z.CARD_FOOTER).slideDown(this._settings.animationSpeed,function(){e._parent.removeClass($)});var t=X.Event(K.EXPANDED);this._element.trigger(t,this._parent)},n.prototype.remove=function(){this._parent.slideUp();var e=X.Event(K.REMOVED);this._element.trigger(e,this._parent)},n.prototype.toggle=function(){this._parent.hasClass($)?this.expand():this.collapse()},n.prototype._init=function(e){var t=this;this._parent=e,X(this).find(this._settings.collapseTrigger).click(function(){t.toggle()}),X(this).find(this._settings.removeTrigger).click(function(){t.remove()})},n._jQueryInterface=function(t){return this.each(function(){var e=X(this).data(F);e||(e=new n(X(this),e),X(this).data(F,"string"==typeof t?e:t)),"string"==typeof t&&t.match(/remove|toggle/)?e[t]():"object"===("undefined"==typeof t?"undefined":ne(t))&&e._init(X(this))})},n}(),X(document).on("click",Z.DATA_COLLAPSE,function(e){e&&e.preventDefault(),te._jQueryInterface.call(X(this),"toggle")}),X(document).on("click",Z.DATA_REMOVE,function(e){e&&e.preventDefault(),te._jQueryInterface.call(X(this),"remove")}),X.fn[z]=te._jQueryInterface,X.fn[z].Constructor=te,X.fn[z].noConflict=function(){return X.fn[z]=J,te._jQueryInterface},te);e.ControlSidebar=oe,e.Layout=re,e.PushMenu=ae,e.Treeview=se,e.Widget=ce,Object.defineProperty(e,"__esModule",{value:!0})});
//# sourceMappingURL=adminlte.min.js.map
/**
 * AdminLTE Demo Menu
 * ------------------
 * You should not use this file in production.
 * This file is for demo purposes only.
 */
(function ($) {
    'use strict'
  
    var $sidebar   = $('.control-sidebar')
    var $container = $('<div />', {
      class: 'p-3'
    })
  
    $sidebar.append($container)
  
    var navbar_dark_skins = [
      'bg-primary',
      'bg-info',
      'bg-success',
      'bg-danger'
    ]
  
    var navbar_light_skins = [
      'bg-warning',
      'bg-white',
      'bg-gray-light'
    ]
  
    $container.append(
      '<h5>تنظیمات قالب</h5><hr class="mb-2"/>'
      + '<h6>رنگ‌های نوار ناوبری</h6>'
    )
  
    var $navbar_variants        = $('<div />', {
      'class': 'd-flex'
    })
    var navbar_all_colors       = navbar_dark_skins.concat(navbar_light_skins)
    var $navbar_variants_colors = createSkinBlock(navbar_all_colors, function (e) {
      var color = $(this).data('color')
      console.log('Adding ' + color)
      var $main_header = $('.main-header')
      $main_header.removeClass('navbar-dark').removeClass('navbar-light')
      navbar_all_colors.map(function (color) {
        $main_header.removeClass(color)
      })
  
      if (navbar_dark_skins.indexOf(color) > -1) {
        $main_header.addClass('navbar-dark')
        console.log('AND navbar-dark')
      } else {
        console.log('AND navbar-light')
        $main_header.addClass('navbar-light')
      }
  
      $main_header.addClass(color);
      setCookie('main_header_color', color + ' ' + nav_type,100);
    })
  
    $navbar_variants.append($navbar_variants_colors)
  
    $container.append($navbar_variants)
  
    var $checkbox_container = $('<div />', {
      'class': 'mb-4'
    })
    var main_header_border = '';
    var $navbar_border = $('<input />', {
      type   : 'checkbox',
      value  : 1,
      checked: $('.main-header').hasClass('border-bottom'),
      'class': 'mr-1'
    }).on('click', function () {
      if ($(this).is(':checked')) {
        $('.main-header').addClass('border-bottom');
        main_header_border = 'border-bottom';
      } else {
        $('.main-header').removeClass('border-bottom');
        main_header_border = '';
      }
      setCookie('main_header_border', main_header_border,100);
    })
    $checkbox_container.append($navbar_border)
    $checkbox_container.append('<span>مرز نوار ناوبری</span>')
    $container.append($checkbox_container)
  
  
    var sidebar_colors = [
      'bg-primary',
      'bg-warning',
      'bg-info',
      'bg-danger',
      'bg-success'
    ]
  
    var sidebar_skins = [
      'sidebar-dark-primary',
      'sidebar-dark-warning',
      'sidebar-dark-info',
      'sidebar-dark-danger',
      'sidebar-dark-success',
      'sidebar-light-primary',
      'sidebar-light-warning',
      'sidebar-light-info',
      'sidebar-light-danger',
      'sidebar-light-success'
    ]
  
    $container.append('<h6>نوار تیره</h6>')
    var $sidebar_variants = $('<div />', {
      'class': 'd-flex'
    })
    $container.append($sidebar_variants)
    $container.append(createSkinBlock(sidebar_colors, function () {
      var color         = $(this).data('color')
      var sidebar_class = 'sidebar-dark-' + color.replace('bg-', '')
      var $sidebar      = $('.main-sidebar')
      sidebar_skins.map(function (skin) {
        $sidebar.removeClass(skin)
      })
  
      $sidebar.addClass(sidebar_class);
      setCookie('main_sidebar_color', sidebar_class,100);
    }))
  
    $container.append('<h6>نوار روشن</h6>')
    var $sidebar_variants = $('<div />', {
      'class': 'd-flex'
    })
    $container.append($sidebar_variants)
    $container.append(createSkinBlock(sidebar_colors, function () {
      var color         = $(this).data('color')
      var sidebar_class = 'sidebar-light-' + color.replace('bg-', '')
      var $sidebar      = $('.main-sidebar')
      sidebar_skins.map(function (skin) {
        $sidebar.removeClass(skin)
      })
  
      $sidebar.addClass(sidebar_class);
      setCookie('main_sidebar_color', sidebar_class,100);
    }))
  
    var logo_skins = navbar_all_colors
    $container.append('<h6>رنگ برند لوگو</h6>')
    var $logo_variants = $('<div />', {
      'class': 'd-flex'
    })
    $container.append($logo_variants)
    var $clear_btn = $('<a />', {
      href: 'javascript:void(0)'
    }).text('پاک کردن').on('click', function () {
      var $logo = $('.brand-link')
      logo_skins.map(function (skin) {
        $logo.removeClass(skin)
      })
      setCookie('logo_color', color,100);
    })
    $container.append(createSkinBlock(logo_skins, function () {
      var color = $(this).data('color')
      var $logo = $('.brand-link')
      logo_skins.map(function (skin) {
        $logo.removeClass(skin)
      })
      $logo.addClass(color);
      setCookie('logo_color', color,100);
    }).append($clear_btn))
  
    function createSkinBlock(colors, callback) {
      var $block = $('<div />', {
        'class': 'd-flex flex-wrap mb-3'
      })
  
      colors.map(function (color) {
        var $color = $('<div />', {
          'class': (typeof color === 'object' ? color.join(' ') : color) + ' elevation-2'
        })
  
        $block.append($color)
  
        $color.data('color', color)
  
        $color.css({
          width       : '40px',
          height      : '20px',
          borderRadius: '25px',
          marginRight : 10,
          marginBottom: 10,
          opacity     : 0.8,
          cursor      : 'pointer'
        })
  
        $color.hover(function () {
          $(this).css({ opacity: 1 }).removeClass('elevation-2').addClass('elevation-4')
        }, function () {
          $(this).css({ opacity: 0.8 }).removeClass('elevation-4').addClass('elevation-2')
        })
  
        if (callback) {
          $color.on('click', callback)
        }
  
      })
  
      return $block
    }
  
    $('[data-widget="chat-pane-toggle"]').click(function() {
        $(this).closest('.card').toggleClass('direct-chat-contacts-open')
    });
    $('[data-toggle="tooltip"]').tooltip();
  
  
    function ConvertNumberToPersion() {
          let persian = { 0: '۰', 1: '۱', 2: '۲', 3: '۳', 4: '۴', 5: '۵', 6: '۶', 7: '۷', 8: '۸', 9: '۹' };
          function traverse(el) {
              if (el.nodeType == 3) {
                  var list = el.data.match(/[0-9]/g);
                  if (list != null && list.length != 0) {
                      for (var i = 0; i < list.length; i++)
                          el.data = el.data.replace(list[i], persian[list[i]]);
                  }
              }
              for (var i = 0; i < el.childNodes.length; i++) {
                  traverse(el.childNodes[i]);
              }
          }
          traverse(document.body);
      }
  
    ConvertNumberToPersion();
  
    $('.sidebar-mini .main-header .nav-item').click(function () {
      let sidebar_mini = $('.sidebar-mini');
      let class_name = sidebar_mini.attr('class');
      class_name = class_name.replace('sidebar-mini sans ', '');
      if (class_name == 'sidebar-open') {
        setCookie('sidebar_class', 'sidebar-collapse', 100);
      } else {
        setCookie('sidebar_class', 'sidebar-open', 100);
      }
    });
  
    let _sidebar_class = checkCookie('sidebar_class') ? getCookie('sidebar_class') : 'sidebar-open';
    let _main_header_color = checkCookie('main_header_color') ? getCookie('main_header_color') : 'navbar-dark bg-success';
    let _main_header_border = checkCookie('main_header_border') ? getCookie('main_header_border') : 'border-bottom';
    let _main_sidebar_color = checkCookie('main_sidebar_color') ? getCookie('main_sidebar_color') : 'sidebar-dark-info';
    let _logo_color = checkCookie('logo_color') ? getCookie('logo_color') : 'bg-success';
    if(_main_header_border == 'border-bottom') $('.control-sidebar input[type=checkbox]').attr('checked', true);
    $('.main-header').addClass(_main_header_color).addClass(_main_header_border);
    $('.main-sidebar').addClass(_main_sidebar_color);
    $('.main-sidebar .brand-link').addClass(_logo_color);
    $('.sidebar-mini').addClass(_sidebar_class);
  
  })(jQuery)
  
  function setCookie(cname, cvalue, exdays) {
    let d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires+"; path=/";
  }
  function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i=0; i<ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1);
      if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
  }
  function checkCookie(cname) {
    let check_cookie = getCookie(cname);
    if(check_cookie == ""){
      return false;
    }
    return true;
  }
  