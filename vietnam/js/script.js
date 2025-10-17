// 
! function(e) {
	"use strict";

	function a() {
		return l.width()
	}

	function s(e, a) {
		var s = e;
		!0 === (!0 === a || "open" === a || 1 === a) ? s.slideDown(600) : (s.slideUp(500), s.find("li.nav-opened").removeClass("nav-opened").children("ul").slideUp(300))
	}

	function t() {
		l.width() > 767 ? (m.removeClass("nav-mobile"), m.find(".has-children").removeClass("nav-opened").removeClass("rollover").children("ul").removeAttr("style")) : m.addClass("nav-mobile")
	}
	var l = e(window),
	n = e("body");
	"ontouchstart" in document.documentElement || n.addClass("no-touch");
	var i = a();
	l.on("resize", function() {
		i = a()
	});
	var r = e(".is-sticky");
	if (r.length > 0) {
		var o = e("#mainnav").offset();
		l.scroll(function() {
			var e = l.scrollTop();
			l.width() > 991 && e > o.top + 4 ? r.hasClass("has-fixed") || r.addClass("has-fixed") : r.hasClass("has-fixed") && r.removeClass("has-fixed")
		})
	}
	var c = e("#slider");
	c.length > 0 && c.carousel({
		interval: 6e3,
		pause: "null"
	});
	var d = e(".has-carousel");
	d.length > 0 && d.each(function() {
		var a = e(this),
		s = a.data("items") ? a.data("items") : 4,
		t = s >= 3 ? 3 : s,
		l = t >= 2 ? 2 : t,
		n = a.data("delay") ? a.data("delay") : 4e3,
		i = !!a.data("auto"),
		r = !!a.data("loop"),
		o = !!a.data("dots"),
		c = !!a.data("navs"),
		d = a.data("margin") ? a.data("margin") : 30;
		a.owlCarousel({
			navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
			items: s,
			loop: r,
			nav: c,
			dots: o,
			margin: d,
			autoplay: i,
			autoplayTimeout: n,
			autoplaySpeed: 700,
			responsive: {
				0: {
					items: 1
				},
				480: {
					items: l
				},
				768: {
					items: t
				},
				1170: {
					items: s
				}
			}
		})
	});
	var h = e(".logo-carousel");
	h.length > 0 && h.owlCarousel({
		items: 5,
		loop: !0,
		margin: 30,
		responsive: {
			0: {
				items: 2
			},
			379: {
				items: 3
			},
			720: {
				items: 4
			},
			1280: {
				items: 6
			}
		}
	});
	var u = e(".has-parallax");
	u.length > 0 && u.each(function() {
		e(this).parallaxie({
			speed: .3,
			offset: 0
		})
	});
	var v = window.location.href,
	f = v.split("#"),
	g = e(".nav li a");
	g.length > 0 && g.each(function() {
		v === this.href && "" !== f[1] && e(this).closest("li").addClass("active").parent().closest("li").addClass("active")
	});
	var m = e("#mainnav"),
	p = e(".navbar"),
	C = m.find("li"),
	y = m.find("a");
	t(), l.on("resize", function() {
		t()
	}), C.has("ul").addClass("has-children"), C.on({
		mouseenter: function() {
			e(this).addClass("rollover")
		},
		mouseleave: function() {
			e(this).removeClass("rollover")
		}
	}), y.on("click touchstart", function(a) {
		var t = e(this),
		l = t.parent(),
		n = t.attr("href");
		return "click" === a.type && i > 767 || (l.hasClass("has-children") ? l.hasClass("nav-opened") ? (l.removeClass("nav-opened"), "#" !== n || (s(l.children("ul"), "close"), !1)) : (l.addClass("nav-opened"), l.siblings().removeClass("nav-opened"), s(l.siblings().children("ul"), "close"), setTimeout(function() {
			s(l.children("ul"), "open")
		}, 150), !1) : "#" !== n && void 0)
	});
	var b = e("#preloader");
	b.length > 0 && l.on("load", function() {
		b.children().fadeOut(300), b.delay(150).fadeOut(500), n.delay(100).css({
			overflow: "visible"
		})
	});
	var w = e(".scroll-to");
	w.length > 0 && w.on("click", function() {
		var a = i >= 992 ? p.height() - 10 : 0;
		return e("html, body").animate({
			scrollTop: e(e.attr(this, "href")).offset().top - a
		}, 1200), !1
	});
	var x = e('.nav li a[href^="#"]');
	x.length > 0 && n.hasClass("site-onepage") && x.on("click", function(a) {
		if (location.pathname.replace(/^\//, "") === this.pathname.replace(/^\//, "") || location.hostname === this.hostname) {
			var s = e(this.hash),
			t = !!this.hash.slice(1) && e("[name=" + this.hash.slice(1) + "]"),
			l = i >= 992 ? p.height() - 10 : 0;
			(s = s.length ? s : t).length && (e("html,body").animate({
				scrollTop: s.offset().top - l
			}, 1200), i < 768 && (p.find(".navbar-toggle").addClass("collapsed"), p.find(".navbar-collapse").collapse("hide")))
		}
		a.preventDefault()
	}), n.scrollspy({
		target: "#mainnav",
		offset: 80
	});
	var k = e(".map-holder");
	if (k.length > 0) {
		new GMaps({
			div: "#gmap",
			lat: -12.043333,
			lng: -77.028333
		});
		k.on("click", function() {
			e(this).children().css("pointer-events", "auto")
		}), k.on("mouseleave", function() {
			e(this).children().css("pointer-events", "none")
		})
	}
	var T = e(".imagebg");
	T.length > 0 && T.each(function() {
		var a = e(this),
		s = a.parent(),
		t = a.data("overlay"),
		l = a.children("img").attr("src"),
		n = void 0 !== t && "" !== t && t.split("-");
		void 0 !== l && "" !== l && (s.hasClass("has-bg-image") || s.addClass("has-bg-image"), "" !== n && "dark" === n[0] && (s.hasClass("light") || s.addClass("light")), a.css("background-image", 'url("' + l + '")').addClass("bg-image-loaded"))
	});
	var j = e(".gallery-filter ul"),
	D = e(".filter-menu li");
	D.length > 0 && (D.on("click", function() {
		D.removeClass("active"), e(this).addClass("active")
	}), l.on("load", function() {
		j.filterizr({
			delay: 25
		})
	}));
	var A = e(".gallery-lightbox");
	A.length > 0 && A.magnificPopup({
		delegate: "a",
		type: "image",
		gallery: {
			enabled: !0
		},
		image: {
			titleSrc: function(e) {
				var a = "",
				s = e.el.find("img").attr("title"),
				t = e.el.find("img").attr("alt");
				return void 0 !== s && "" !== s && (a += s), void 0 !== t && "" !== t && (void 0 === s || "" === s ? a += t : a = a + "<small>" + t + "</small>"), "" === a && (a = e.el.attr("title")), a
			}
		},
		zoom: {
			enabled: !0
		}
	});
	var F = e(".single-lightbox");
	F.length > 0 && F.magnificPopup({
		gallery: {
			enabled: !0
		},
		type: "image"
	});
	var S = e("#contact-us"),
	U = e("#quote-request"),
	P = e(".g-recaptcha");
	if (U.length > 0 || S.length > 0) {
		if (!e().validate || !e().ajaxSubmit) return console.log("quoteForm: jQuery Form or Form Validate not Defined."), !0;
		var z = P.length > 0,
		H = "Please confirm captcha to proceed.";
		if (U.length > 0) {
			var q = U.find(".form-results");
			U.validate({
				ignore: [],
				invalidHandler: function() {
					q.slideUp(400)
				},
				submitHandler: function(a) {
					!0 !== z || grecaptcha.getResponse() ? (q.slideUp(400), e(a).ajaxSubmit({
						target: q,
						dataType: "json",
						success: function(s) {
							var t = "error" === s.result ? "alert-danger" : "alert-success";
							q.removeClass("alert-danger alert-success").addClass("alert " + t).html(s.message).slideDown(400), "error" !== s.result && (e(a).clearForm(), !0 === z && grecaptcha.reset())
						}
					})) : q.removeClass("alert-danger alert-success").addClass("alert alert-danger").html(H).slideDown(400)
				}
			})
		}
		if (S.length > 0) {
			var B = S.find(".form-results");
			S.validate({
				invalidHandler: function() {
					B.slideUp(400)
				},
				submitHandler: function(a) {
					!0 !== z || grecaptcha.getResponse() ? (B.slideUp(400), e(a).ajaxSubmit({
						target: B,
						dataType: "json",
						success: function(s) {
							var t = "error" === s.result ? "alert-danger" : "alert-success";
							B.removeClass("alert-danger alert-success").addClass("alert " + t).html(s.message).slideDown(400), "error" !== s.result && (e(a).clearForm(), !0 === z && grecaptcha.reset())
						}
					})) : B.removeClass("alert-danger alert-success").addClass("alert alert-danger").html(H).slideDown(400)
				}
			})
		}
	}

	// search click open
	var $btnOn = $("i.on")
	var $dropdown = $(".search-dropdown")
	$btnOn.click(function(e){
		e.stopPropagation();
		$dropdown.addClass("open");

	});

	$('body').click(function(event){
		if (!$(event.target).closest($dropdown).length) {

			if( $dropdown.hasClass("open") ){
				$dropdown.removeClass("open");
			}
		}
	});

	
}(jQuery);