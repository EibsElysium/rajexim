// Scrolling and Sliding Effect
// Prevent Native Scrolling
// Implement Custom Scrolling Function
"use strict";
! function(n) {
    return "function" == typeof define && define.amd ? define(["jquery"], function(e) {
        return n(e, window, document)
    }) : "object" == typeof exports ? module.exports = n(require("jquery"), window, document) : n(jQuery, window, document)
}(function(n, e, t) {
    "use strict";
    var i, s, a, o, r, l, c, f, d, u, h, g, p, v, m, y, C, b, T, x, S, w, E, _, I, N, k, H, A, O, M;
    E = {
        paneClass: "nano-pane",
        sliderClass: "nano-slider",
        contentClass: "nano-content",
        iOSNativeScrolling: !1,
        preventPageScrolling: !1,
        disableResize: !1,
        alwaysVisible: !1,
        flashDelay: 1500,
        sliderMinHeight: 20,
        sliderMaxHeight: null,
        documentContext: null,
        windowContext: null
    }, b = "scrollbar", C = "scroll", d = "mousedown", u = "mouseenter", h = "mousemove", p = "mousewheel", g = "mouseup", y = "resize", r = "drag", l = "enter", x = "up", m = "panedown", a = "DOMMouseScroll", o = "down", S = "wheel", c = "keydown", f = "keyup", T = "touchmove", i = "Microsoft Internet Explorer" === e.navigator.appName && /msie 7./i.test(e.navigator.appVersion) && e.ActiveXObject, s = null, k = e.requestAnimationFrame, w = e.cancelAnimationFrame, A = t.createElement("div").style, M = function() {
        var n, e, t, i, s, a;
        for (i = ["t", "webkitT", "MozT", "msT", "OT"], n = s = 0, a = i.length; a > s; n = ++s)
            if (t = i[n], e = i[n] + "ransform", e in A) return i[n].substr(0, i[n].length - 1);
        return !1
    }(), O = function(n) {
        return M === !1 ? !1 : "" === M ? n : M + n.charAt(0).toUpperCase() + n.substr(1)
    }, H = O("transform"), I = H !== !1, _ = function() {
        var n, e, i;
        return n = t.createElement("div"), e = n.style, e.position = "absolute", e.width = "100px", e.height = "100px", e.overflow = C, e.top = "-9999px", t.body.appendChild(n), i = n.offsetWidth - n.clientWidth, t.body.removeChild(n), i
    }, N = function() {
        var n, t, i;
        return t = e.navigator.userAgent, (n = /(?=.+Mac OS X)(?=.+Firefox)/.test(t)) ? (i = /Firefox\/\d{2}\./.exec(t), i && (i = i[0].replace(/\D+/g, "")), n && +i > 23) : !1
    }, v = function() {
        function c(i, a) {
            this.el = i, this.options = a, s || (s = _()), this.$el = n(this.el), this.doc = n(this.options.documentContext || t), this.win = n(this.options.windowContext || e), this.body = this.doc.find("body"), this.$content = this.$el.children("." + this.options.contentClass), this.$content.attr("tabindex", this.options.tabIndex || 0), this.content = this.$content[0], this.previousPosition = 0, this.options.iOSNativeScrolling && null != this.el.style.WebkitOverflowScrolling ? this.nativeScrolling() : this.generate(), this.createEvents(), this.addEvents(), this.reset()
        }
        return c.prototype.preventScrolling = function(n, e) {
            if (this.isActive)
                if (n.type === a)(e === o && n.originalEvent.detail > 0 || e === x && n.originalEvent.detail < 0) && n.preventDefault();
                else if (n.type === p) {
                if (!n.originalEvent || !n.originalEvent.wheelDelta) return;
                (e === o && n.originalEvent.wheelDelta < 0 || e === x && n.originalEvent.wheelDelta > 0) && n.preventDefault()
            }
        }, c.prototype.nativeScrolling = function() {
            this.$content.css({
                WebkitOverflowScrolling: "touch"
            }), this.iOSNativeScrolling = !0, this.isActive = !0
        }, c.prototype.updateScrollValues = function() {
            var n, e;
            n = this.content, this.maxScrollTop = n.scrollHeight - n.clientHeight, this.prevScrollTop = this.contentScrollTop || 0, this.contentScrollTop = n.scrollTop, e = this.contentScrollTop > this.previousPosition ? "down" : this.contentScrollTop < this.previousPosition ? "up" : "same", this.previousPosition = this.contentScrollTop, "same" !== e && this.$el.trigger("update", {
                position: this.contentScrollTop,
                maximum: this.maxScrollTop,
                direction: e
            }), this.iOSNativeScrolling || (this.maxSliderTop = this.paneHeight - this.sliderHeight, this.sliderTop = 0 === this.maxScrollTop ? 0 : this.contentScrollTop * this.maxSliderTop / this.maxScrollTop)
        }, c.prototype.setOnScrollStyles = function() {
            var n;
            I ? (n = {}, n[H] = "translate(0, " + this.sliderTop + "px)") : n = {
                top: this.sliderTop
            }, k ? (w && this.scrollRAF && w(this.scrollRAF), this.scrollRAF = k(function(e) {
                return function() {
                    return e.scrollRAF = null, e.slider.css(n)
                }
            }(this))) : this.slider.css(n)
        }, c.prototype.createEvents = function() {
            this.events = {
                down: function(n) {
                    return function(e) {
                        return n.isBeingDragged = !0, n.offsetY = e.pageY - n.slider.offset().top, n.slider.is(e.target) || (n.offsetY = 0), n.pane.addClass("active"), n.doc.on(h, n.events[r]).on(g, n.events[x]), n.body.on(u, n.events[l]), !1
                    }
                }(this),
                drag: function(n) {
                    return function(e) {
                        return n.sliderY = e.pageY - n.$el.offset().top - n.paneTop - (n.offsetY || .5 * n.sliderHeight), n.scroll(), n.contentScrollTop >= n.maxScrollTop && n.prevScrollTop !== n.maxScrollTop ? n.$el.trigger("scrollend") : 0 === n.contentScrollTop && 0 !== n.prevScrollTop && n.$el.trigger("scrolltop"), !1
                    }
                }(this),
                up: function(n) {
                    return function() {
                        return n.isBeingDragged = !1, n.pane.removeClass("active"), n.doc.unbind(h, n.events[r]).unbind(g, n.events[x]), n.body.unbind(u, n.events[l]), !1
                    }
                }(this),
                resize: function(n) {
                    return function() {
                        n.reset()
                    }
                }(this),
                panedown: function(n) {
                    return function(e) {
                        return n.sliderY = (e.offsetY || e.originalEvent.layerY) - .5 * n.sliderHeight, n.scroll(), n.events.down(e), !1
                    }
                }(this),
                scroll: function(n) {
                    return function(e) {
                        n.updateScrollValues(), n.isBeingDragged || (n.iOSNativeScrolling || (n.sliderY = n.sliderTop, n.setOnScrollStyles()), null != e && (n.contentScrollTop >= n.maxScrollTop ? (n.options.preventPageScrolling && n.preventScrolling(e, o), n.prevScrollTop !== n.maxScrollTop && n.$el.trigger("scrollend")) : 0 === n.contentScrollTop && (n.options.preventPageScrolling && n.preventScrolling(e, x), 0 !== n.prevScrollTop && n.$el.trigger("scrolltop"))))
                    }
                }(this),
                wheel: function(n) {
                    return function(e) {
                        var t;
                        return null != e ? (t = e.delta || e.wheelDelta || e.originalEvent && e.originalEvent.wheelDelta || -e.detail || e.originalEvent && -e.originalEvent.detail, t && (n.sliderY += -t / 3), n.scroll(), !1) : void 0
                    }
                }(this),
                enter: function(n) {
                    return function(e) {
                        var t;
                        return n.isBeingDragged && 1 !== (e.buttons || e.which) ? (t = n.events)[x].apply(t, arguments) : void 0
                    }
                }(this)
            }
        }, c.prototype.addEvents = function() {
            var n;
            this.removeEvents(), n = this.events, this.options.disableResize || this.win.on(y, n[y]), this.iOSNativeScrolling || (this.slider.on(d, n[o]), this.pane.on(d, n[m]).on("" + p + " " + a, n[S])), this.$content.on("" + C + " " + p + " " + a + " " + T, n[C])
        }, c.prototype.removeEvents = function() {
            var n;
            n = this.events, this.win.unbind(y, n[y]), this.iOSNativeScrolling || (this.slider.unbind(), this.pane.unbind()), this.$content.unbind("" + C + " " + p + " " + a + " " + T, n[C])
        }, c.prototype.generate = function() {
            var n, t, i, a, o, r, l;
            return a = this.options, r = a.paneClass, l = a.sliderClass, n = a.contentClass, (o = this.$el.children("." + r)).length || o.children("." + l).length || this.$el.append('<div class="' + r + '"><div class="' + l + '" /></div>'), this.pane = this.$el.children("." + r), this.slider = this.pane.find("." + l), 0 === s && N() ? (i = e.getComputedStyle(this.content, null).getPropertyValue("padding-right").replace(/[^0-9.]+/g, ""), t = {
                right: -14,
                paddingRight: +i + 14
            }) : s && (t = {
                right: -s
            }, this.$el.addClass("has-scrollbar")), null != t && this.$content.css(t), this
        }, c.prototype.restore = function() {
            this.stopped = !1, this.iOSNativeScrolling || this.pane.show(), this.addEvents()
        }, c.prototype.reset = function() {
            var n, e, t, a, o, r, l, c, f, d, u, h;
            return this.iOSNativeScrolling ? void(this.contentHeight = this.content.scrollHeight) : (this.$el.find("." + this.options.paneClass).length || this.generate().stop(), this.stopped && this.restore(), n = this.content, a = n.style, o = a.overflowY, i && this.$content.css({
                height: this.$content.height()
            }), e = n.scrollHeight + s, d = parseInt(this.$el.css("max-height"), 10), d > 0 && (this.$el.height(""), this.$el.height(n.scrollHeight > d ? d : n.scrollHeight)), l = this.pane.outerHeight(!1), f = parseInt(this.pane.css("top"), 10), r = parseInt(this.pane.css("bottom"), 10), c = l + f + r, h = Math.round(c / e * l), h < this.options.sliderMinHeight ? h = this.options.sliderMinHeight : null != this.options.sliderMaxHeight && h > this.options.sliderMaxHeight && (h = this.options.sliderMaxHeight), o === C && a.overflowX !== C && (h += s), this.maxSliderTop = c - h, this.contentHeight = e, this.paneHeight = l, this.paneOuterHeight = c, this.sliderHeight = h, this.paneTop = f, this.slider.height(h), this.events.scroll(), this.pane.show(), this.isActive = !0, n.scrollHeight === n.clientHeight || this.pane.outerHeight(!0) >= n.scrollHeight && o !== C ? (this.pane.hide(), this.isActive = !1) : this.el.clientHeight === n.scrollHeight && o === C ? this.slider.hide() : this.slider.show(), this.pane.css({
                opacity: this.options.alwaysVisible ? 1 : "",
                visibility: this.options.alwaysVisible ? "visible" : ""
            }), t = this.$content.css("position"), ("static" === t || "relative" === t) && (u = parseInt(this.$content.css("right"), 10), u && this.$content.css({
                right: "",
                marginRight: u
            })), this)
        }, c.prototype.scroll = function() {
            return this.isActive ? (this.sliderY = Math.max(0, this.sliderY), this.sliderY = Math.min(this.maxSliderTop, this.sliderY), this.$content.scrollTop(this.maxScrollTop * this.sliderY / this.maxSliderTop), this.iOSNativeScrolling || (this.updateScrollValues(), this.setOnScrollStyles()), this) : void 0
        }, c.prototype.scrollBottom = function(n) {
            return this.isActive ? (this.$content.scrollTop(this.contentHeight - this.$content.height() - n).trigger(p), this.stop().restore(), this) : void 0
        }, c.prototype.scrollTop = function(n) {
            return this.isActive ? (this.$content.scrollTop(+n).trigger(p), this.stop().restore(), this) : void 0
        }, c.prototype.scrollTo = function(n) {
            return this.isActive ? (this.scrollTop(this.$el.find(n).get(0).offsetTop), this) : void 0
        }, c.prototype.stop = function() {
            return w && this.scrollRAF && (w(this.scrollRAF), this.scrollRAF = null), this.stopped = !0, this.removeEvents(), this.iOSNativeScrolling || this.pane.hide(), this
        }, c.prototype.destroy = function() {
            return this.stopped || this.stop(), !this.iOSNativeScrolling && this.pane.length && this.pane.remove(), i && this.$content.height(""), this.$content.removeAttr("tabindex"), this.$el.hasClass("has-scrollbar") && (this.$el.removeClass("has-scrollbar"), this.$content.css({
                right: ""
            })), this
        }, c.prototype.flash = function() {
            return !this.iOSNativeScrolling && this.isActive ? (this.reset(), this.pane.addClass("flashed"), setTimeout(function(n) {
                return function() {
                    n.pane.removeClass("flashed")
                }
            }(this), this.options.flashDelay), this) : void 0
        }, c
    }(), n.fn.nanoScroller = function(e) {
        return this.each(function() {
            var t, i;
            if ((i = this.nanoscroller) || (t = n.extend({}, E, e), this.nanoscroller = i = new v(this, t)), e && "object" == typeof e) {
                if (n.extend(i.options, e), null != e.scrollBottom) return i.scrollBottom(e.scrollBottom);
                if (null != e.scrollTop) return i.scrollTop(e.scrollTop);
                if (e.scrollTo) return i.scrollTo(e.scrollTo);
                if ("bottom" === e.scroll) return i.scrollBottom(0);
                if ("top" === e.scroll) return i.scrollTop(0);
                if (e.scroll && e.scroll instanceof n) return i.scrollTo(e.scroll);
                if (e.stop) return i.stop();
                if (e.destroy) return i.destroy();
                if (e.flash) return i.flash()
            }
            return i.reset()
        })
    }, n.fn.nanoScroller.Constructor = v
}), ! function(n, e) {
    if ("function" == typeof define && define.amd) define(["jquery"], e);
    else if ("undefined" != typeof exports) e(require("jquery"));
    else {
        var t = {
            exports: {}
        };
        e(n.jquery), n.metisMenu = t.exports
    }
}(this, function(n) {
    "use strict";

    function e(n) {
        return n && n.__esModule ? n : {
            "default": n
        }
    }

    // Transition Effect
    // Sidebar Menu Effect Not Included in HTML At the moment

    function t(n, e) {
        if (!(n instanceof e)) throw new TypeError("Cannot call a class as a function")
    }
    var i = (e(n), "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(n) {
            return typeof n
        } : function(n) {
            return n && "function" == typeof Symbol && n.constructor === Symbol && n !== Symbol.prototype ? "symbol" : typeof n
        }),
        s = function(n) {
            function e() {
                return {
                    bindType: a.end,
                    delegateType: a.end,
                    handle: function(e) {
                        return n(e.target).is(this) ? e.handleObj.handler.apply(this, arguments) : void 0
                    }
                }
            }

            function t() {
                if (window.QUnit) return !1;
                var n = document.createElement("mm");
                for (var e in o)
                    if (void 0 !== n.style[e]) return {
                        end: o[e]
                    };
                return !1
            }

            function i(e) {
                var t = this,
                    i = !1;
                return n(this).one(r.TRANSITION_END, function() {
                    i = !0
                }), setTimeout(function() {
                    i || r.triggerTransitionEnd(t)
                }, e), this
            }

            function s() {
                a = t(), n.fn.emulateTransitionEnd = i, r.supportsTransitionEnd() && (n.event.special[r.TRANSITION_END] = e())
            }
            var a = !1,
                o = {
                    WebkitTransition: "webkitTransitionEnd",
                    MozTransition: "transitionend",
                    OTransition: "oTransitionEnd otransitionend",
                    transition: "transitionend"
                },
                r = {
                    TRANSITION_END: "mmTransitionEnd",
                    triggerTransitionEnd: function(e) {
                        n(e).trigger(a.end)
                    },
                    supportsTransitionEnd: function() {
                        return Boolean(a)
                    }
                };
            return s(), r
        }(jQuery);
    ! function(n) {
        var e = "metisMenu",
            a = "metisMenu",
            o = "." + a,
            r = ".data-api",
            l = n.fn[e],
            c = 350,
            f = {
                toggle: !0,
                preventDefault: !0,
                activeClass: "active",
                collapseClass: "collapse",
                collapseInClass: "in",
                collapsingClass: "collapsing",
                triggerElement: "a",
                parentTrigger: "li",
                subMenu: "ul"
            },
            d = {
                SHOW: "show" + o,
                SHOWN: "shown" + o,
                HIDE: "hide" + o,
                HIDDEN: "hidden" + o,
                CLICK_DATA_API: "click" + o + r
            },
            u = function() {
                function e(n, i) {
                    t(this, e), this._element = n, this._config = this._getConfig(i), this._transitioning = null, this.init()
                }
                return e.prototype.init = function() {
                    var e = this;
                    n(this._element).find(this._config.parentTrigger + "." + this._config.activeClass).has(this._config.subMenu).children(this._config.subMenu).attr("aria-expanded", !0).addClass(this._config.collapseClass + " " + this._config.collapseInClass), n(this._element).find(this._config.parentTrigger).not("." + this._config.activeClass).has(this._config.subMenu).children(this._config.subMenu).attr("aria-expanded", !1).addClass(this._config.collapseClass), n(this._element).find(this._config.parentTrigger).has(this._config.subMenu).children(this._config.triggerElement).on(d.CLICK_DATA_API, function(t) {
                        var i = n(this),
                            s = i.parent(e._config.parentTrigger),
                            a = s.siblings(e._config.parentTrigger).children(e._config.triggerElement),
                            o = s.children(e._config.subMenu);
                        e._config.preventDefault && t.preventDefault(), "true" !== i.attr("aria-disabled") && (s.hasClass(e._config.activeClass) ? (i.attr("aria-expanded", !1), e._hide(o)) : (e._show(o), i.attr("aria-expanded", !0), e._config.toggle && a.attr("aria-expanded", !1)), e._config.onTransitionStart && e._config.onTransitionStart(t))
                    })
                }, e.prototype._show = function(e) {
                    if (!this._transitioning && !n(e).hasClass(this._config.collapsingClass)) {
                        var t = this,
                            i = n(e),
                            a = n.Event(d.SHOW);
                        if (i.trigger(a), !a.isDefaultPrevented()) {
                            i.parent(this._config.parentTrigger).addClass(this._config.activeClass), this._config.toggle && this._hide(i.parent(this._config.parentTrigger).siblings().children(this._config.subMenu + "." + this._config.collapseInClass).attr("aria-expanded", !1)), i.removeClass(this._config.collapseClass).addClass(this._config.collapsingClass).height(0), this.setTransitioning(!0);
                            var o = function() {
                                i.removeClass(t._config.collapsingClass).addClass(t._config.collapseClass + " " + t._config.collapseInClass).height("").attr("aria-expanded", !0), t.setTransitioning(!1), i.trigger(d.SHOWN)
                            };
                            return s.supportsTransitionEnd() ? void i.height(i[0].scrollHeight).one(s.TRANSITION_END, o).emulateTransitionEnd(c) : void o()
                        }
                    }
                }, e.prototype._hide = function(e) {
                    if (!this._transitioning && n(e).hasClass(this._config.collapseInClass)) {
                        var t = this,
                            i = n(e),
                            a = n.Event(d.HIDE);
                        if (i.trigger(a), !a.isDefaultPrevented()) {
                            i.parent(this._config.parentTrigger).removeClass(this._config.activeClass), i.height(i.height())[0].offsetHeight, i.addClass(this._config.collapsingClass).removeClass(this._config.collapseClass).removeClass(this._config.collapseInClass), this.setTransitioning(!0);
                            var o = function() {
                                t._transitioning && t._config.onTransitionEnd && t._config.onTransitionEnd(), t.setTransitioning(!1), i.trigger(d.HIDDEN), i.removeClass(t._config.collapsingClass).addClass(t._config.collapseClass).attr("aria-expanded", !1)
                            };
                            return s.supportsTransitionEnd() ? void(0 == i.height() || "none" == i.css("display") ? o() : i.height(0).one(s.TRANSITION_END, o).emulateTransitionEnd(c)) : void o()
                        }
                    }
                }, e.prototype.setTransitioning = function(n) {
                    this._transitioning = n
                }, e.prototype.dispose = function() {
                    n.removeData(this._element, a), n(this._element).find(this._config.parentTrigger).has(this._config.subMenu).children(this._config.triggerElement).off("click"), this._transitioning = null, this._config = null, this._element = null
                }, e.prototype._getConfig = function(e) {
                    return e = n.extend({}, f, e)
                }, e._jQueryInterface = function(t) {
                    return this.each(function() {
                        var s = n(this),
                            o = s.data(a),
                            r = n.extend({}, f, s.data(), "object" === ("undefined" == typeof t ? "undefined" : i(t)) && t);
                        if (!o && /dispose/.test(t) && this.dispose(), o || (o = new e(this, r), s.data(a, o)), "string" == typeof t) {
                            if (void 0 === o[t]) throw new Error('No method named "' + t + '"');
                            o[t]()
                        }
                    })
                }, e
            }();
        return n.fn[e] = u._jQueryInterface, n.fn[e].Constructor = u, n.fn[e].noConflict = function() {
            return n.fn[e] = l, u._jQueryInterface
        }, u
    }(jQuery)
}), 

//  Dropdown Mega Menu

! function(n) {
    "use strict";
    n(document).ready(function() {
        n(document).trigger("mailbox.ready")
    }), n(document).on("mailbox.ready", function() {
        var e = n(".add-tooltip");
        e.length && e.tooltip();
        var t = n(".add-popover");
        t.length && t.popover(), n("#navbar-container .navbar-top-links").on("shown.bs.dropdown", ".dropdown", function() {
            n(this).find(".nano").nanoScroller({
                preventPageScrolling: !0
            })
        }), n.mailboxNav("bind"), n.mailboxAside("bind")
    })
}(jQuery), ! function(n) {
    "use strict";
    var e = null,
        t = function(n) {
            {
                var e = n.find(".mega-dropdown-toggle");
                n.find(".mega-dropdown-menu")
            }
            e.on("click", function(e) {
                e.preventDefault(), n.toggleClass("open")
            })
        },
        i = {
            toggle: function() {
                return this.toggleClass("open"), null
            },
            show: function() {
                return this.addClass("open"), null
            },
            hide: function() {
                return this.removeClass("open"), null
            }
        };
    n.fn.mailboxMega = function(e) {
        var s = !1;
        return this.each(function() {
            i[e] ? s = i[e].apply(n(this).find("input"), Array.prototype.slice.call(arguments, 1)) : "object" != typeof e && e || t(n(this))
        }), s
    }, n(document).on("mailbox.ready", function() {
        e = n(".mega-dropdown"), e.length && (e.mailboxMega(), n("html").on("click", function(t) {
            n(t.target).closest(".mega-dropdown").length || e.removeClass("open")
        }))
    })
}(jQuery), ! function(n) {
    "use strict";
    n(document).on("mailbox.ready", function() {
        var e = n('[data-dismiss="panel"]');
        e.length ? e.one("click", function(e) {
            e.preventDefault();
            var t = n(this).parents(".panel");
            t.addClass("remove").on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(n) {
                "opacity" == n.originalEvent.propertyName && t.remove()
            })
        }) : e = null
    })
}(jQuery), ! function(n) {
    "use strict";
    n(document).one("mailbox.ready", function() {
        var e = n(".scroll-top"),
            t = n(window),
            i = function() {
                return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)
            }();
        if (e.length && !i) {
            var s = !1,
                a = 250,
                o = function() {
                    t.scrollTop() > a && !s ? (e.addClass("in").stop(!0, !0).css({
                        animation: "none"
                    }).show(0).css({
                        animation: "jellyIn .8s"
                    }), s = !0) : t.scrollTop() < a && s && (e.removeClass("in"), s = !1)
                };
            o(), t.scroll(o), e.on("click", function(e) {
                e.preventDefault(), n("body, html").animate({
                    scrollTop: 0
                }, 500)
            })
        } else e = null, t = null;
        i = null
    })
}(jQuery), 

// MailBox Overlay Effect 

! function(n) {
    "use strict";
    var e = {
            displayIcon: !0,
            iconColor: "text-dark",
            iconClass: "fa fa-refresh fa-spin fa-2x",
            title: "",
            desc: ""
        },
        t = function() {
            return (65536 * (1 + Math.random()) | 0).toString(16).substring(1)
        },
        i = {
            show: function(e) {
                var i = n(e.attr("data-target")),
                    s = "mailbox-overlay-" + t() + t() + "-" + t(),
                    a = n('<div id="' + s + '" class="panel-overlay"></div>');
                return e.prop("disabled", !0).data("mailboxOverlay", s), i.addClass("panel-overlay-wrap"), a.appendTo(i).html(e.data("overlayTemplate")), null
            },
            hide: function(e) {
                var t = n(e.attr("data-target")),
                    i = n("#" + e.data("mailboxOverlay"));
                return i.length && (e.prop("disabled", !1), t.removeClass("panel-overlay-wrap"), i.hide().remove()), null
            }
        },
        s = function(t, i) {
            if (t.data("overlayTemplate")) return null;
            var s = n.extend({}, e, i),
                a = s.displayIcon ? '<span class="panel-overlay-icon ' + s.iconColor + '"><i class="' + s.iconClass + '"></i></span>' : "";
            return t.data("overlayTemplate", '<div class="panel-overlay-content pad-all unselectable">' + a + '<h4 class="panel-overlay-title">' + s.title + "</h4><p>" + s.desc + "</p></div>"), null
        };
    n.fn.mailboxOverlay = function(e) {
        return i[e] ? i[e](this) : "object" != typeof e && e ? null : this.each(function() {
            s(n(this), e)
        })
    }
}(jQuery), ! function(n) {
    "use strict";
    var e, i, s, a, t = {},
        o = !1,
        r = function() {
            var n = document.body || document.documentElement,
                e = n.style,
                t = void 0 !== e.transition || void 0 !== e.WebkitTransition;
            return t
        }();
    n.mailboxNoty = function(l) {
        {
            var h, c = {
                    type: "primary",
                    icon: "",
                    title: "",
                    message: "",
                    closeBtn: !0,
                    container: "page",
                    floating: {
                        position: "top-right",
                        animationIn: "jellyIn",
                        animationOut: "fadeOut"
                    },
                    html: null,
                    focus: !0,
                    timer: 0,
                    onShow: function() {},
                    onShown: function() {},
                    onHide: function() {},
                    onHidden: function() {}
                },
                f = n.extend({}, c, l),
                d = n('<div class="alert-wrap"></div>'),
                u = function() {
                    var n = "";
                    return l && l.icon && (n = '<div class="media-left alert-icon"><i class="' + f.icon + '"></i></div>'), n
                },
                g = function() {
                    var n = f.closeBtn ? '<button class="close" type="button"><i class="pci-cross pci-circle"></i></button>' : "",
                        e = '<div class="alert alert-' + f.type + '" role="alert">' + n + '<div class="media">';
                    return f.html ? e + f.html + "</div></div>" : e + u() + '<div class="media-body"><h4 class="alert-title">' + f.title + '</h4><p class="alert-message">' + f.message + "</p></div></div>"
                }(),
                p = function() {
                    return f.onHide(), "floating" === f.container && f.floating.animationOut && (d.removeClass(f.floating.animationIn).addClass(f.floating.animationOut), r || (f.onHidden(), d.remove())), d.removeClass("in").on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(n) {
                        "max-height" == n.originalEvent.propertyName && (f.onHidden(), d.remove())
                    }), clearInterval(h), null
                },
                v = function(e) {
                    n("body, html").animate({
                        scrollTop: e
                    }, 300, function() {
                        d.addClass("in")
                    })
                };
            ! function() {
                if (f.onShow(), "page" === f.container) e || (e = n('<div id="page-alert"></div>'), a && a.length || (a = n("#content-container")), a.prepend(e)), i = e, f.focus && v(0);
                else if ("floating" === f.container) t[f.floating.position] || (t[f.floating.position] = n('<div id="floating-' + f.floating.position + '" class="floating-container"></div>'), s && a.length || (s = n("#container")), s.append(t[f.floating.position])), i = t[f.floating.position], f.floating.animationIn && d.addClass("in animated " + f.floating.animationIn), f.focus = !1;
                else {
                    var r = n(f.container),
                        l = r.children(".panel-alert"),
                        c = r.children(".panel-heading");
                    if (!r.length) return o = !1, !1;
                    l.length ? i = l : (i = n('<div class="panel-alert"></div>'), c.length ? c.after(i) : r.prepend(i)), f.focus && v(r.offset().top - 30)
                }
                return o = !0, !1
            }()
        }
        if (o) {
            if (i.append(d.html(g)), d.find('[data-dismiss="noty"]').one("click", p), f.closeBtn && d.find(".close").one("click", p), f.timer > 0 && (h = setInterval(p, f.timer)), !f.focus) var y = setInterval(function() {
                d.addClass("in"), clearInterval(y)
            }, 200);
            d.one("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function(n) {
                "max-height" != n.originalEvent.propertyName && "animationend" != n.type || !o || (f.onShown(), o = !1)
            })
        }
    }
}(jQuery), ! function(n) {
    "use strict";
    var e = {
            dynamicMode: !0,
            selectedOn: null,
            onChange: null
        },
        t = function(t, i) {
            var s = n.extend({}, e, i),
                a = t.find(".lang-selected"),
                o = a.parent(".lang-selector").siblings(".dropdown-menu"),
                r = o.find("a"),
                l = r.filter(".active").find(".lang-id").text(),
                c = r.filter(".active").find(".lang-name").text(),
                f = function(n) {
                    r.removeClass("active"), n.addClass("active"), a.html(n.html()), l = n.find(".lang-id").text(), c = n.find(".lang-name").text(), t.trigger("onChange", [{
                        id: l,
                        name: c
                    }]), "function" == typeof s.onChange && s.onChange.call(this, {
                        id: l,
                        name: c
                    })
                };
            r.on("click", function(e) {
                s.dynamicMode && (e.preventDefault(), e.stopPropagation()), t.dropdown("toggle"), f(n(this))
            }), s.selectedOn && f(n(s.selectedOn))
        },
        i = {
            getSelectedID: function() {
                return n(this).find(".lang-id").text()
            },
            getSelectedName: function() {
                return n(this).find(".lang-name").text()
            },
            getSelected: function() {
                var e = n(this);
                return {
                    id: e.find(".lang-id").text(),
                    name: e.find(".lang-name").text()
                }
            },
            setDisable: function() {
                return n(this).addClass("disabled"), null
            },
            setEnable: function() {
                return n(this).removeClass("disabled"), null
            }
        };
    n.fn.mailboxLanguage = function(e) {
        var s = !1;
        return this.each(function() {
            i[e] ? s = i[e].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof e && e || t(n(this), e)
        }), s
    }
}(jQuery), 

// Triggers Checked and Unchecked
//  Toggle On or Off
// Radio Buttons
// Mail Ready
// Main Navigation Container Placement (Not Included in HTML YET)

! function(n) {
    "use strict";
    var e, t = function(e) {
            if (!e.data("mailbox-check")) {
                e.data("mailbox-check", !0), e.text().trim().length ? e.addClass("form-text") : e.removeClass("form-text");
                var t = e.find("input")[0],
                    i = t.name,
                    s = function() {
                        return "radio" == t.type && i ? n(".form-radio").not(e).find("input").filter('input[name="' + i + '"]').parent() : !1
                    }(),
                    a = function() {
                        "radio" == t.type && s.length && s.each(function() {
                            var e = n(this);
                            e.hasClass("active") && e.trigger("mailbox.ch.unchecked"), e.removeClass("active")
                        }), t.checked ? e.addClass("active").trigger("mailbox.ch.checked") : e.removeClass("active").trigger("mailbox.ch.unchecked")
                    };
                t.checked ? e.addClass("active") : e.removeClass("active"), n(t).on("change", a)
            }
        },
        i = {
            isChecked: function() {
                return this[0].checked
            },
            toggle: function() {
                return this[0].checked = !this[0].checked, this.trigger("change"), null
            },
            toggleOn: function() {
                return this[0].checked || (this[0].checked = !0, this.trigger("change")), null
            },
            toggleOff: function() {
                return this[0].checked && "checkbox" == this[0].type && (this[0].checked = !1, this.trigger("change")), null
            }
        },
        s = function() {
            e = n(".form-checkbox, .form-radio"), e.length && e.mailboxCheck()
        };
    n.fn.mailboxCheck = function(e) {
        var s = !1;
        return this.each(function() {
            i[e] ? s = i[e].apply(n(this).find("input"), Array.prototype.slice.call(arguments, 1)) : "object" != typeof e && e || t(n(this))
        }), s
    }, n(document).on("mailbox.ready", s).on("change", ".form-checkbox, .form-radio", s).on("change", ".btn-file :file", function() {
        var e = n(this),
            t = e.get(0).files ? e.get(0).files.length : 1,
            i = e.val().replace(/\\/g, "/").replace(/.*\//, ""),
            s = function() {
                try {
                    return e[0].files[0].size
                } catch (n) {
                    return "Nan"
                }
            }(),
            a = function() {
                if ("Nan" == s) return "Unknown";
                var n = Math.floor(Math.log(s) / Math.log(1024));
                return 1 * (s / Math.pow(1024, n)).toFixed(2) + " " + ["B", "kB", "MB", "GB", "TB"][n]
            }();
        e.trigger("fileselect", [t, i, a])
    })
}(jQuery), ! function(n) {
    n(document).on("mailbox.ready", function() {
        var e = n("#mainnav-shortcut");
        e.length ? e.find("li").each(function() {
            var e = n(this);
            e.popover({
                animation: !1,
                trigger: "hover",
                placement: "bottom",
                container: "#mainnav-container",
                viewport: "#mainnav-container",
                template: '<div class="popover mainnav-shortcut"><div class="arrow"></div><div class="popover-content"></div>'
            })
        }) : e = null
    })
}(jQuery), ! function(n, e) {
    var t = {};
    t.eventName = "resizeEnd", t.delay = 250, t.poll = function() {
        var i = n(this),
            s = i.data(t.eventName);
        s.timeoutId && e.clearTimeout(s.timeoutId), s.timeoutId = e.setTimeout(function() {
            i.trigger(t.eventName)
        }, t.delay)
    }, n.event.special[t.eventName] = {
        setup: function() {
            var e = n(this);
            e.data(t.eventName, {}), e.on("resize", t.poll)
        },
        teardown: function() {
            var i = n(this),
                s = i.data(t.eventName);
            s.timeoutId && e.clearTimeout(s.timeoutId), i.removeData(t.eventName), i.off("resize", t.poll)
        }
    }, n.fn[t.eventName] = function(n, e) {
        return arguments.length > 0 ? this.on(t.eventName, null, n, e) : this.trigger(t.eventName)
    }
}(jQuery, this), ! function(n) {
    "use strict";
    var e = null,
        t = null,
        i = null,
        s = null,
        a = null,
        o = null,
        r = !1,
        l = !1,
        c = null,
        f = null,
        u = n(window),
        h = !1,
        g = function() {
            var e, i = n('#mainnav-menu > li > a, #mainnav-menu-wrap .mainnav-widget a[data-toggle="menu-widget"]');
            i.each(function() {
                var a = n(this),
                    o = a.children(".menu-title"),
                    r = a.siblings(".collapse"),
                    l = n(a.attr("data-target")),
                    c = l.length ? l.parent() : null,
                    f = null,
                    d = null,
                    u = null,
                    h = null,
                    y = (a.outerHeight() - a.height() / 4, function() {
                        return l.length && a.on("click", function(n) {
                            n.preventDefault()
                        }), r.length ? (a.on("click", function(n) {
                            n.preventDefault()
                        }).parent("li").removeClass("active"), !0) : !1
                    }()),
                    C = null,
                    b = function(n) {
                        clearInterval(C), C = setInterval(function() {
                            n.nanoScroller({
                                preventPageScrolling: !0,
                                alwaysVisible: !0
                            }), clearInterval(C)
                        }, 100)
                    };
                n(document).on("click", function(e) {
                    n(e.target).closest("#mainnav-container").length || a.removeClass("hover").popover("hide")
                }), n("#mainnav-menu-wrap > .nano").on("update", function() {
                    a.removeClass("hover").popover("hide")
                }), a.popover({
                    animation: !1,
                    trigger: "manual",
                    container: "#mainnav",
                    viewport: a,
                    html: !0,
                    title: function() {
                        return y ? o.html() : null
                    },
                    content: function() {
                        var e;
                        return y ? (e = n('<div class="sub-menu"></div>'), r.addClass("pop-in").wrap('<div class="nano-content"></div>').parent().appendTo(e)) : l.length ? (e = n('<div class="sidebar-widget-popover"></div>'), l.wrap('<div class="nano-content"></div>').parent().appendTo(e)) : e = '<span class="single-content">' + o.html() + "</span>", e
                    },
                    template: '<div class="popover menu-popover"><h4 class="popover-title"></h4><div class="popover-content"></div></div>'
                }).on("show.bs.popover", function() {
                    if (!f) {
                        if (f = a.data("bs.popover").tip(), d = f.find(".popover-title"), u = f.children(".popover-content"), !y && 0 == l.length) return;
                        h = u.children(".sub-menu")
                    }!y && 0 == l.length
                }).on("shown.bs.popover", function() {
                    if (!y && 0 == l.length) {
                        var e = 0 - .5 * a.outerHeight();
                        return void u.css({
                            "margin-top": e + "px",
                            width: "auto"
                        })
                    }
                    var i = parseInt(f.css("top")),
                        o = a.outerHeight(),
                        r = function() {
                            return t.hasClass("mainnav-fixed") ? n(window).outerHeight() - i - o : n(document).height() - i - o
                        }(),
                        c = u.find(".nano-content").children().css("height", "auto").outerHeight();
                    u.find(".nano-content").children().css("height", ""), i > r ? (d.length && !d.is(":visible") && (o = Math.round(0 - .5 * o)), i -= 5, u.css({
                        top: "",
                        bottom: o + "px",
                        height: i
                    }).children().addClass("nano").css({
                        width: "100%"
                    }).nanoScroller({
                        preventPageScrolling: !0
                    }), b(u.find(".nano"))) : (!t.hasClass("navbar-fixed") && s.hasClass("affix-top") && (r -= 50), c > r ? ((t.hasClass("navbar-fixed") || s.hasClass("affix-top")) && (r -= o + 5), r -= 5, u.css({
                        top: o + "px",
                        bottom: "",
                        height: r
                    }).children().addClass("nano").css({
                        width: "100%"
                    }).nanoScroller({
                        preventPageScrolling: !0
                    }), b(u.find(".nano"))) : (d.length && !d.is(":visible") && (o = Math.round(0 - .5 * o)), u.css({
                        top: o + "px",
                        bottom: "",
                        height: "auto"
                    }))), d.length && d.css("height", a.outerHeight()), u.on("click", function() {
                        u.find(".nano-pane").hide(), b(u.find(".nano"))
                    })
                }).on("click", function() {
                    t.hasClass("mainnav-sm") && (i.popover("hide"), a.addClass("hover").popover("show"))
                }).on(function() {
                    i.popover("hide"), a.addClass("hover").popover("show").one("hidden.bs.popover", function() {
                        a.removeClass("hover"), y ? r.removeAttr("style").appendTo(a.parent()) : l.length && l.appendTo(c), clearInterval(e)
                    })
                }, function() {
                    clearInterval(e), e = setInterval(function() {
                        f && (f.one("mouseleave", function() {
                            a.removeClass("hover").popover("hide")
                        }), f.is(":hover") || a.removeClass("hover").popover("hide")), clearInterval(e)
                    }, 100)
                })
            }), l = !0
        },
        p = function() {
            var t = n("#mainnav-menu").find(".collapse");
            t.length && t.each(function() {
                var e = n(this);
                e.hasClass("in") ? e.parent("li").addClass("active") : e.parent("li").removeClass("active")
            }), e.popover("destroy").unbind("mouseenter mouseleave"), l = !1
        },
        v = function() {
            var i, e = t.width();
            i = 740 >= e ? "xs" : e > 740 && 992 > e ? "sm" : e >= 992 && 1200 >= e ? "md" : "lg", f != i && (f = i, c = i, "sm" == c && t.hasClass("mainnav-lg") ? (t.addClass("lg-mainnav-lg"), n.mailboxNav("collapse")) : "xs" == c && t.hasClass("mainnav-lg") ? t.removeClass("mainnav-sm mainnav-out mainnav-lg").addClass("mainnav-sm lg-mainnav-lg") : "md" != c && "lg" != c || !t.hasClass("lg-mainnav-lg") || (t.removeClass("lg-mainnav-lg"), n.mailboxNav("expand")))
        },
        m = function() {
            s.css(t.hasClass("boxed-layout") && t.hasClass("mainnav-fixed") && i.length ? {
                left: i.offset().left + "px"
            } : {
                left: ""
            })
        },
        y = function() {
            if (!h) try {
                s.mailboxAffix("update")
            } catch (n) {
                h = !0
            }
        },
        C = function() {
            return y(), p(), v(), m(), ("collapse" == r || t.hasClass("mainnav-sm")) && (t.removeClass("mainnav-in mainnav-out mainnav-lg"), g()), a = n("#mainnav").height(), r = !1, null
        },
        T = {
            revealToggle: function() {
                t.hasClass("reveal") || t.addClass("reveal"), t.toggleClass("mainnav-in mainnav-out").removeClass("mainnav-lg mainnav-sm"), l && p()
            },
            revealIn: function() {
                t.hasClass("reveal") || t.addClass("reveal"), t.addClass("mainnav-in").removeClass("mainnav-out mainnav-lg mainnav-sm"), l && p()
            },
            revealOut: function() {
                t.hasClass("reveal") || t.addClass("reveal"), t.removeClass("mainnav-in mainnav-lg mainnav-sm").addClass("mainnav-out"), l && p()
            },
            slideToggle: function() {
                t.hasClass("slide") || t.addClass("slide"), t.toggleClass("mainnav-in mainnav-out").removeClass("mainnav-lg mainnav-sm"), l && p()
            },
            slideIn: function() {
                t.hasClass("slide") || t.addClass("slide"), t.addClass("mainnav-in").removeClass("mainnav-out mainnav-lg mainnav-sm"), l && p()
            },
            slideOut: function() {
                t.hasClass("slide") || t.addClass("slide"), t.removeClass("mainnav-in mainnav-lg mainnav-sm").addClass("mainnav-out"), l && p()
            },
            pushToggle: function() {
                t.toggleClass("mainnav-in mainnav-out").removeClass("mainnav-lg mainnav-sm"), t.hasClass("mainnav-in mainnav-out") && t.removeClass("mainnav-in"), l && p()
            },
            pushIn: function() {
                t.addClass("mainnav-in").removeClass("mainnav-out mainnav-lg mainnav-sm"), l && p()
            },
            pushOut: function() {
                t.removeClass("mainnav-in mainnav-lg mainnav-sm").addClass("mainnav-out"), l && p()
            },
            colExpToggle: function() {
                return t.hasClass("mainnav-lg mainnav-sm") && t.removeClass("mainnav-lg"), t.toggleClass("mainnav-lg mainnav-sm").removeClass("mainnav-in mainnav-out"), u.trigger("resize")
            },
            collapse: function() {
                return t.addClass("mainnav-sm").removeClass("mainnav-lg mainnav-in mainnav-out"), r = "collapse", u.trigger("resize")
            },
            expand: function() {
                return t.removeClass("mainnav-sm mainnav-in mainnav-out").addClass("mainnav-lg"), u.trigger("resize")
            },
            togglePosition: function() {
                t.toggleClass("mainnav-fixed"), y()
            },
            fixedPosition: function() {
                t.addClass("mainnav-fixed"), o.nanoScroller({
                    preventPageScrolling: !0
                }), y()
            },
            staticPosition: function() {
                t.removeClass("mainnav-fixed"), o.nanoScroller({
                    preventPageScrolling: !1
                }), y()
            },
            update: C,
            refresh: C,
            getScreenSize: function() {
                return f
            },
            bind: function() {
                var r = n("#mainnav-menu");
                if (0 == r.length) return !1;
                e = n('#mainnav-menu > li > a, #mainnav-menu-wrap .mainnav-widget a[data-toggle="menu-widget"]'), t = n("#container"), i = t.children(".boxed"), s = n("#mainnav-container"), a = n("#mainnav").height();
                var l = null;
                s.on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(e) {
                    (l || e.target === s[0]) && (clearInterval(l), l = setInterval(function() {
                        n(window).trigger("resize"), clearInterval(l), l = null
                    }, 300))
                });
                var c = n(".mainnav-toggle");
                c.length && c.on("click", function(e) {
                    e.preventDefault(), e.stopPropagation(), n.mailboxNav(c.hasClass("push") ? "pushToggle" : c.hasClass("slide") ? "slideToggle" : c.hasClass("reveal") ? "revealToggle" : "colExpToggle")
                });
                try {
                    r.metisMenu({
                        toggle: !0
                    })
                } catch (f) {
                    console.error(f.message)
                }
                try {
                    o = n("#mainnav-menu-wrap > .nano"), o.length && o.nanoScroller({
                        preventPageScrolling: t.hasClass("mainnav-fixed") ? !0 : !1
                    })
                } catch (f) {
                    console.error(f.message)
                }
                n(window).on("resizeEnd", C).trigger("resize")
            }
        };
    n.mailboxNav = function(n, e) {
        if (T[n]) {
            ("colExpToggle" == n || "expand" == n || "collapse" == n) && ("xs" == c && "collapse" == n ? n = "pushOut" : "xs" != c && "sm" != c || "colExpToggle" != n && "expand" != n || !t.hasClass("mainnav-sm") || (n = "pushIn"));
            var i = T[n].apply(this, Array.prototype.slice.call(arguments, 1));
            if ("bind" != n && C(), e) return e();
            if (i) return i
        }
        return null
    }, n.fn.isOnScreen = function() {
        var n = {
            top: u.scrollTop(),
            left: u.scrollLeft()
        };
        n.right = n.left + u.width(), n.bottom = n.top + u.height();
        var e = this.offset();
        return e.right = e.left + this.outerWidth(), e.bottom = e.top + this.outerHeight(), !(n.right < e.left || n.left > e.right || n.bottom < e.bottom || n.top > e.top)
    }
}(jQuery), 

// Aside Placement Yet Only on Right Side

! function(n) {
    "use strict";
    var t, e = null,
        i = n(window),
        s = {
            toggleHideShow: function() {
                t.toggleClass("aside-in"), i.trigger("resize"), t.hasClass("aside-in") && a()
            },
            show: function() {
                t.addClass("aside-in"), i.trigger("resize"), a()
            },
            hide: function() {
                t.removeClass("aside-in"), i.trigger("resize")
            },
            toggleAlign: function() {
                t.toggleClass("aside-left"), c()
            },
            alignLeft: function() {
                t.addClass("aside-left"), c()
            },
            alignRight: function() {
                t.removeClass("aside-left"), c()
            },
            togglePosition: function() {
                t.toggleClass("aside-fixed"), c()
            },
            fixedPosition: function() {
                t.addClass("aside-fixed"), c()
            },
            staticPosition: function() {
                t.removeClass("aside-fixed"), c()
            },
            toggleTheme: function() {
                t.toggleClass("aside-bright")
            },
            brightTheme: function() {
                t.addClass("aside-bright")
            },
            darkTheme: function() {
                t.removeClass("aside-bright")
            },
            update: function() {
                c()
            },
            bind: function() {
                f()
            }
        },
        a = function() {
            var e = t.width();
            t.hasClass("mainnav-in") && e > 740 && (e > 740 && 992 > e ? n.mailboxNav("collapse") : t.removeClass("mainnav-in mainnav-lg mainnav-sm").addClass("mainnav-out"))
        },
        o = n("#container").children(".boxed"),
        c = function() {
            try {
                e.mailboxAffix("update")
            } catch (n) {}
            var i = {};
            i = t.hasClass("boxed-layout") && t.hasClass("aside-fixed") && o.length ? t.hasClass("aside-left") ? {
                "-ms-transform": "translateX(" + o.offset().left + "px)",
                "-webkit-transform": "translateX(" + o.offset().left + "px)",
                transform: "translateX(" + o.offset().left + "px)"
            } : {
                "-ms-transform": "translateX(" + (0 - o.offset().left) + "px)",
                "-webkit-transform": "translateX(" + (0 - o.offset().left) + "px)",
                transform: "translateX(" + (0 - o.offset().left) + "px)"
            } : {
                "-ms-transform": "",
                "-webkit-transform": "",
                transform: "",
                right: ""
            }, e.css(i)
        },
        f = function() {
            if (e = n("#aside-container"), e.length) {
                t = n("#container"), i.on("resizeEnd", c), e.on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(n) {
                    n.target == e[0] && i.trigger("resize")
                }), e.find(".nano").nanoScroller({
                    preventPageScrolling: t.hasClass("aside-fixed") ? !0 : !1
                });
                var s = n(".aside-toggle");
                s.length && s.on("click", function(e) {
                    e.preventDefault(), n.mailboxAside("toggleHideShow")
                })
            }
        };
    n.mailboxAside = function(n, e) {
        return s[n] && (s[n].apply(this, Array.prototype.slice.call(arguments, 1)), e) ? e() : null
    }
}(jQuery), ! function(n) {
    "use strict";
    var e, t, i, s, a, o, r = function(n) {
            clearInterval(o), o = setInterval(function() {
                n[0] == e[0] ? s.nanoScroller({
                    flash: !0,
                    preventPageScrolling: i.hasClass("mainnav-fixed") ? !0 : !1
                }) : n[0] == t[0] && a.nanoScroller({
                    preventPageScrolling: i.hasClass("aside-fixed") ? !0 : !1
                }), clearInterval(o), o = null
            }, 500)
        },
        l = function() {
            i = n("#container"), e = n("#mainnav-container"), t = n("#aside-container"), s = n("#mainnav-menu-wrap > .nano"), a = n("#aside > .nano"), e.length && e.mailboxAffix({
                className: "mainnav-fixed"
            }), t.length && t.mailboxAffix({
                className: "aside-fixed"
            })
        };
    n.fn.mailboxAffix = function(e) {
        return this.each(function() {
            var s, t = n(this);
            "object" != typeof e && e ? "update" == e ? (t.data("mailbox.af.class") || l(), s = t.data("mailbox.af.class"), r(t)) : "bind" == e && l() : (s = e.className, t.data("mailbox.af.class", e.className)), i.hasClass(s) && !i.hasClass("navbar-fixed") ? t.affix({
                offset: {
                    top: n("#navbar").outerHeight()
                }
            }).on("affixed.bs.affix affix.bs.affix", function() {
                r(t)
            }) : (!i.hasClass(s) || i.hasClass("navbar-fixed")) && (n(window).off(t.attr("id") + ".affix"), t.removeClass("affix affix-top affix-bottom").removeData("bs.affix"))
        })
    }
}(jQuery);