var PF_VERSION = "2017-07-14-095045977", data = document.getElementById("printfriendly-data");

if (data) {
  var pfData = JSON.parse(data.getAttribute("data"));
  pfstyle = pfData.pfstyle, pfOptions = pfData.pfOptions;
}

var pfMod = window.pfMod || function(e, t) {
  var i = e.document, n = "https:", o = {
    environment: "production",
    disableUI: !1,
    protocol: "https:",
    dir: "ltr",
    usingBM: !1,
    maxImageWidth: 750,
    filePath: "/assets/versions/",
    platform: "unknown",
    hosts: {
      cdn: "https://cdn.printfriendly.com",
      pf: "https://app.printfriendly.com",
      ds: "https://www.printfriendly.com",
      ds_cdn: "https://ds-4047.kxcdn.com",
      pdf: "https://pdf.printfriendly.com",
      email: "https://app.printfriendly.com",
      page: e.location.host.split(":")[0]
    },
    domains: {
      page: e.location.host.split(":")[0].split("www.").pop()
    }
  }, r = {
    removeEmailsFromUrl: function(e) {
      for (var t = (e = e.split("?")[0]).split("/"), i = t.length; i-- > 0; ) -1 !== t[i].indexOf("@") && t.splice(i, 1);
      return t.join("/");
    }
  }, a = {
    isReady: !1,
    readyBound: !1,
    ready: function() {
      if (!a.isReady) {
        if (!document.body) return setTimeout(a.ready, 13);
        a.isReady = !0, a.readyFunc.call();
      }
    },
    doScrollCheck: function() {
      if (!a.isReady) {
        try {
          document.documentElement.doScroll("left");
        } catch (e) {
          return setTimeout(a.doScrollCheck, 50);
        }
        a.detach(), a.ready();
      }
    },
    detach: function() {
      document.addEventListener ? (document.removeEventListener("DOMContentLoaded", a.completed, !1), 
      e.removeEventListener("load", a.completed, !1)) : document.attachEvent && "complete" === document.readyState && (document.detachEvent("onreadystatechange", a.completed), 
      e.detachEvent("onload", a.completed));
    },
    completed: function(e) {
      (document.addEventListener || "load" === e.type || "complete" === document.readyState) && (a.detach(), 
      a.ready());
    },
    bindReady: function() {
      if (!a.readyBound) {
        if (a.readyBound = !0, "complete" === document.readyState) return a.ready();
        if (document.addEventListener) document.addEventListener("DOMContentLoaded", a.completed, !1), 
        e.addEventListener("load", a.completed, !1); else if (document.attachEvent) {
          document.attachEvent("onreadystatechange", a.completed), e.attachEvent("onload", a.completed);
          var t = !1;
          try {
            t = null == e.frameElement && document.documentElement;
          } catch (e) {}
          t && t.doScroll && a.doScrollCheck();
        }
      }
    },
    domReady: function(e) {
      this.readyFunc = e, this.bindReady();
    },
    canonicalize: function(e) {
      if (e) {
        var t = document.createElement("div");
        return t.innerHTML = "<a></a>", t.firstChild.href = e, t.innerHTML = t.innerHTML, 
        t.firstChild.href;
      }
      return e;
    }
  }, s = {
    headerImageUrl: a.canonicalize(e.pfHeaderImgUrl),
    headerTagline: e.pfHeaderTagline,
    imageDisplayStyle: e.pfImageDisplayStyle,
    customCSSURL: a.canonicalize(e.pfCustomCSS),
    disableClickToDel: e.pfdisableClickToDel,
    disablePDF: e.pfDisablePDF,
    disablePrint: e.pfDisablePrint,
    disableEmail: e.pfDisableEmail
  };
  -1 !== "|full-size|remove-images|large|medium|small|".indexOf(e.pfImagesSize) ? s.imagesSize = e.pfImagesSize : s.imagesSize = 1 == e.pfHideImages ? "remove-images" : "full-size";
  var c = {
    version: PF_VERSION,
    initialized: !1,
    finished: !1,
    onServer: !1,
    hasContent: !1,
    messages: [],
    errors: [],
    hasAdBlock: !0,
    init: function(t) {
      try {
        this.initialized = !0, this.configure(t), this.onServerSetup(), this.setVariables(), 
        this.detectBrowser(), this.startIfNecessary(), e.print = this.start;
      } catch (e) {
        d.log(e);
      }
    },
    configure: function(t) {
      if (this.config = o, t) {
        this.config.environment = t.environment || "development";
        for (var i in t.hosts) this.config.hosts[i] = t.hosts[i];
        t.filePath && (this.config.filePath = t.filePath), t.ssLocation && (this.config.ssLocation = t.ssLocation), 
        t.ssStyleSheetHrefs && (this.config.ssStyleSheetHrefs = t.ssStyleSheetHrefs);
      }
      this.userOptions = {
        redirect: {
          disableForiPad: !!this.getVal(e.pfUserOptions, "redirect.disableForiPad")
        }
      };
    },
    getVal: function(e, t) {
      for (var i = t.split("."); void 0 !== e && i.length; ) e = e[i.shift()];
      return e;
    },
    startIfNecessary: function() {
      (e.pfstyle || this.urlHasAutoStartParams()) && this.start();
    },
    urlHasAutoStartParams: function() {
      return -1 !== this.config.urls.page.indexOf("pfstyle=wp");
    },
    start: function() {
      c.isRedirectNecessary() ? c.redirect() : c.supportedSiteType() && a.domReady(function() {
        try {
          c.startTime = new Date().getTime(), c.sanitizeLocation(), c.config.disableUI || c.createMask(), 
          c.loadCore();
        } catch (e) {
          d.log(e);
        }
      });
    },
    sanitizeLocation: function() {
      url = document.location.href.split("?")[0], url = r.removeEmailsFromUrl(url), url !== document.location.href && (history && "function" == typeof history.pushState ? history.pushState({
        pf: "sanitized"
      }, document.title, url) : c.urlHasPII = !0);
    },
    unsanitizeLocation: function() {
      history && history.state && "sanitized" == history.state.pf && history.back();
    },
    onServerSetup: function() {
      e.onServer && (this.onServer = !0, this.config.disableUI = !0);
    },
    setVariables: function() {
      var t = this, i, n = "";
      "production" !== this.config.environment && (n = "?_=" + Math.random());
      var o = t.config.hosts.cdn + t.config.filePath + t.version + "/pf-app/print.css" + n;
      this.config.disableUI && (o = ""), this.config.urls = {
        js: {
          jquery: "https://cdn.printfriendly.com/assets/unversioned/jquery/1.12.4.min.js",
          core: t.config.hosts.cdn + t.config.filePath + t.version + "/core.js" + n,
          algo: t.config.hosts.cdn + t.config.filePath + t.version + "/algo.js" + n
        },
        css: {
          page: o
        },
        pdfMake: t.config.hosts.pdf + "/pdfs/make",
        email: t.config.hosts.email + "/email/new"
      };
      try {
        i = top.location.href;
      } catch (t) {
        i = e.location.href;
      }
      this.config.urls.page = i, this.userSettings = s, !e.pfstyle || "bk" !== e.pfstyle && "nbk" !== e.pfstyle && "cbk" !== e.pfstyle || (this.config.usingBM = !0);
    },
    detectBrowser: function() {
      this.browser = {};
      var e = navigator.appVersion;
      e && -1 !== e.indexOf("MSIE") ? (this.browser.version = parseFloat(e.split("MSIE")[1]), 
      this.browser.isIE = !0) : this.browser.isIE = !1;
    },
    detectAdBlock: function(e) {
      c.loadScript("https://key-cdn.printfriendly.com/check-3.2.1.min.js", function() {
        function t(e) {
          var t = new XMLHttpRequest();
          t.open("POST", c.config.hosts.pf + "/stats", !0), t.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8"), 
          t.send("event=" + e), "undefined" != typeof fuckAdBlock && fuckAdBlock.clearEvent();
        }
        if ("undefined" == typeof fuckAdBlock) t("adblock.present"), e(!0); else {
          fuckAdBlock.onDetected(function() {
            t("adblock.present"), e(!0);
          }), fuckAdBlock.onNotDetected(function() {
            t("adblock.absent"), e(!1);
          });
          try {
            fuckAdBlock.check(!0);
          } catch (e) {}
        }
      });
    },
    loadScript: function(e, t) {
      var i = document.getElementsByTagName("head")[0], n = document.createElement("script");
      n.type = "text/javascript", n.src = e, n.onreadystatechange = t, n.onload = t, i.appendChild(n);
    },
    createIframe: function(e) {
      var t = e.createElement("iframe");
      return t.src = "javascript:false", t.frameBorder = "0", t.allowTransparency = "true", 
      t;
    },
    loadHtmlInIframe: function(e, t, i) {
      var n, o;
      try {
        o = t.contentWindow.document;
      } catch (i) {
        n = e.domain, t.src = "javascript:var d=document.open();d.domain='" + n + "';void(0);", 
        o = t.contentWindow.document;
      }
      o.write(i), o.close();
    },
    redirect: function() {
      var e = [ "source=cs", "url=" + encodeURIComponent(top.location.href) ], t;
      for (var i in s) void 0 !== s[i] && e.push(i + "=" + encodeURIComponent(s[i]));
      t = this.config.hosts.pf + "/print/?" + e.join("&"), this.urlHasAutoStartParams() ? top.location.replace(t) : top.location.href = t;
    },
    supportedSiteType: function() {
      return "about:blank" !== c.config.urls.page && ("http:" === c.config.protocol || "https:" === c.config.protocol);
    },
    isRedirectNecessary: function() {
      try {
        var t = navigator.userAgent.match(/Edge\/(\d+.\d+)/);
        return !!(!history || "function" != typeof history.pushState || navigator.userAgent.match(/(ipod|opera.mini|blackberry|playbook|bb10)/i) || this.browser.isIE && this.browser.version < 11 || this.browser.isIE && e.adsbygoogle || "undefined" != typeof $ && $.jcarousel && this.browser.isIE || t && 2 === t.length && parseFloat(t[1]) < 13.10586);
      } catch (e) {
        return d.log(e), !1;
      }
    },
    createMask: function() {
      var e = document.createElement("div");
      e.innerHTML = '<div id="pf-mask" style="z-index: 2147483627!important; position: fixed !important; top: 0pt !important; left: 0pt !important; background-color: rgb(0, 0, 0) !important; opacity: 0.8 !important;filter:progid:DXImageTransform.Microsoft.Alpha(opacity=80); height: 100% !important; width: 100% !important;"></div>', 
      document.body.appendChild(e.firstChild);
    },
    closePreview: function() {
      a.readyBound = !1, a.isReady = !1, c.unsanitizeLocation();
      var e = document.getElementById("pf-core");
      e.parentElement.removeChild(e);
      var t = document.getElementById("pf-mask");
      t.parentElement.removeChild(t);
      var i = document.getElementById("gaiframe");
      i && i.parentElement.removeChild(i);
    },
    removeDoubleSemiColon: function(e) {
      return e.replace(/;{2}/g, ";");
    },
    loadCore: function() {
      var e = '<!DOCTYPE html><html><head><meta http-equiv="X-UA-Compatible" content="IE=edge" /><meta name="viewport" content="width=device-width, initial-scale=1"><script src="' + this.config.urls.js.jquery + '"><\/script><script src="' + this.config.urls.js.core + '"><\/script><link media="screen" type="text/css" rel="stylesheet" href="' + this.config.urls.css.page + '"></head><body class="cs-core-iframe" onload="core.init();"></body>', t = this.createIframe(document);
      t.id = "pf-core", t.name = "pf-core", document.body.appendChild(t);
      var i = t.style.cssText + ";width: 100% !important;max-width:100% !important;height: 100% !important; display: block !important; overflow: hidden !important; position: absolute !important; top: 0px !important; left: 0px !important; background-color: transparent !important; z-index: 2147483647!important";
      t.style.cssText = this.removeDoubleSemiColon(i), this.loadHtmlInIframe(document, t, e);
    }
  }, d = {
    _window: e.top,
    _doc: e.top.document,
    installInitiated: !1,
    validFile: /d3nekkt1lmmhms|printfriendly\.com|printnicer\.com|algo\.js|printfriendly\.js|core\.js/,
    setVars: function() {
      this._window.frames["pf-core"] && this._window.frames["pf-core"].document && (this._window = this._window.frames["pf-core"], 
      this._doc = this._window.document);
    },
    install: function() {
      if (this.installInitiated) return !0;
      this.installInitiated = !0, this.setVars();
      var e = this._doc.createElement("script"), t = this._doc.getElementsByTagName("script")[0];
      e.src = "//cdn.ravenjs.com/3.2.0/raven.min.js", t.parentNode.appendChild(e), this.wait();
    },
    wait: function() {
      if (!this._window.Raven) return setTimeout(function() {
        d.wait();
      }, 100);
      this.configure(), this.pushExistingErrors();
    },
    configure: function() {
      var e = "https://5463b49718cd4266911eab9e5c0e114d@app.getsentry.com/22091", t = {
        dataCallback: function(e) {
          var t, i;
          try {
            (t = e.stacktrace.frames[0]).filename.match(d.validFile) && "onload" !== t.function || e.stacktrace.frames.shift();
          } catch (e) {}
          return e;
        },
        shouldSendCallback: function(e) {
          return !!(e && e.extra && e.extra.file);
        },
        release: c.version
      };
      this._window.Raven.config(e, t).install();
    },
    sendError: function(e, t) {
      (t = void 0 !== t ? {
        file: t.file
      } : {
        file: "printfriendly.js"
      }).usingBM = c.config.usingBM, t.url = c.config.urls.page, "production" === c.config.environment && this._window.Raven.captureException(e, {
        extra: t
      });
    },
    pushExistingErrors: function() {
      for (var e = 0; e < c.errors.length; e++) this.sendError(c.errors[e].err, c.errors[e].opts);
    },
    log: function(e, t) {
      c.finished = !0, t = t || {
        file: "printfriendly.js"
      };
      try {
        this._window.Raven ? this.sendError(e, t) : (c.errors.push({
          err: e,
          opts: t
        }), this.install(), c.messages.push(e.name + " : " + e.message), c.messages.push(e.stack));
      } catch (e) {}
    }
  };
  return c.exTracker = d, c;
}(window), priFri = pfMod;

pfMod.initialized && data ? pfMod.start() : "algo" === window.name || "pf-core" === window.name || pfMod.initialized || pfMod.init(window.pfOptions);