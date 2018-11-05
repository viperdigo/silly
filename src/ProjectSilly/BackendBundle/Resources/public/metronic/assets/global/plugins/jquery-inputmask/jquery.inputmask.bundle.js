/*!
 * jquery.inputmask.bundle
 * http://github.com/RobinHerbots/jquery.inputmask
 * Copyright (c) 2010 - 2015 Robin Herbots
 * Licensed under the MIT license (http://www.opensource.org/licenses/mit-license.php)
 * Version: 3.1.64-118
 */
!function (a) {
    function b(b) {
        this.el = void 0, this.opts = a.extend(!0, {}, this.defaults, b), this.noMasksCache = b && void 0 !== b.definitions, this.userOptions = b || {}, e(this.opts.alias, b, this.opts)
    }

    function c(a) {
        var b = document.createElement("input"), c = "on" + a, d = c in b;
        return d || (b.setAttribute(c, "return;"), d = "function" == typeof b[c]), b = null, d
    }

    function d(a) {
        var b = "text" == a || "tel" == a || "password" == a;
        if (!b) {
            var c = document.createElement("input");
            c.setAttribute("type", a), b = "text" === c.type, c = null
        }
        return b
    }

    function e(b, c, d) {
        var f = d.aliases[b];
        return f ? (f.alias && e(f.alias, void 0, d), a.extend(!0, d, f), a.extend(!0, d, c), !0) : (void 0 == d.mask && (d.mask = b), !1)
    }

    function f(b, c, d) {
        function f(a) {
            var b = g.data("inputmask-" + a.toLowerCase());
            void 0 != b && (b = "boolean" == typeof b ? b : b.toString(), "mask" == a && 0 == b.indexOf("[") ? (d[a] = b.replace(/[\s[\]]/g, "").split("','"), d[a][0] = d[a][0].replace("'", ""), d[a][d[a].length - 1] = d[a][d[a].length - 1].replace("'", "")) : d[a] = b)
        }

        var g = a(b), h = g.data("inputmask");
        if (h && "" != h)try {
            h = h.replace(new RegExp("'", "g"), '"');
            var i = a.parseJSON("{" + h + "}");
            a.extend(!0, d, i)
        } catch (j) {
        }
        for (var k in c)f(k);
        if (d.alias) {
            e(d.alias, d, c);
            for (var k in c)f(k)
        }
        return a.extend(!0, c, d), c
    }

    function g(c, d) {
        function e(b) {
            function d(a, b, c, d) {
                this.matches = [], this.isGroup = a || !1, this.isOptional = b || !1, this.isQuantifier = c || !1, this.isAlternator = d || !1, this.quantifier = {
                    min: 1,
                    max: 1
                }
            }

            function e(b, d, e) {
                var f = c.definitions[d], g = 0 == b.matches.length;
                if (e = void 0 != e ? e : b.matches.length, f && !q) {
                    f.placeholder = a.isFunction(f.placeholder) ? f.placeholder.call(this, c) : f.placeholder;
                    for (var h = f.prevalidator, i = h ? h.length : 0, j = 1; j < f.cardinality; j++) {
                        var k = i >= j ? h[j - 1] : [], l = k.validator, m = k.cardinality;
                        b.matches.splice(e++, 0, {
                            fn: l ? "string" == typeof l ? new RegExp(l) : new function () {
                                this.test = l
                            } : new RegExp("."),
                            cardinality: m ? m : 1,
                            optionality: b.isOptional,
                            newBlockMarker: g,
                            casing: f.casing,
                            def: f.definitionSymbol || d,
                            placeholder: f.placeholder,
                            mask: d
                        })
                    }
                    b.matches.splice(e++, 0, {
                        fn: f.validator ? "string" == typeof f.validator ? new RegExp(f.validator) : new function () {
                            this.test = f.validator
                        } : new RegExp("."),
                        cardinality: f.cardinality,
                        optionality: b.isOptional,
                        newBlockMarker: g,
                        casing: f.casing,
                        def: f.definitionSymbol || d,
                        placeholder: f.placeholder,
                        mask: d
                    })
                } else b.matches.splice(e++, 0, {
                    fn: null,
                    cardinality: 0,
                    optionality: b.isOptional,
                    newBlockMarker: g,
                    casing: null,
                    def: d,
                    placeholder: void 0,
                    mask: d
                }), q = !1
            }

            function f(a, b) {
                a.isGroup && (a.isGroup = !1, e(a, c.groupmarker.start, 0), b !== !0 && e(a, c.groupmarker.end))
            }

            function g(a, b, c, d) {
                b.matches.length > 0 && (void 0 == d || d) && (c = b.matches[b.matches.length - 1], f(c)), e(b, a)
            }

            function h() {
                if (s.length > 0) {
                    if (m = s[s.length - 1], g(k, m, o, !m.isAlternator), m.isAlternator) {
                        n = s.pop();
                        for (var a = 0; a < n.matches.length; a++)n.matches[a].isGroup = !1;
                        s.length > 0 ? (m = s[s.length - 1], m.matches.push(n)) : r.matches.push(n)
                    }
                } else g(k, r, o)
            }

            function i(a) {
                function b(a) {
                    return a == c.optionalmarker.start ? a = c.optionalmarker.end : a == c.optionalmarker.end ? a = c.optionalmarker.start : a == c.groupmarker.start ? a = c.groupmarker.end : a == c.groupmarker.end && (a = c.groupmarker.start), a
                }

                a.matches = a.matches.reverse();
                for (var d in a.matches) {
                    var e = parseInt(d);
                    if (a.matches[d].isQuantifier && a.matches[e + 1] && a.matches[e + 1].isGroup) {
                        var f = a.matches[d];
                        a.matches.splice(d, 1), a.matches.splice(e + 1, 0, f)
                    }
                    void 0 != a.matches[d].matches ? a.matches[d] = i(a.matches[d]) : a.matches[d] = b(a.matches[d])
                }
                return a
            }

            for (var j, k, l, m, n, o, p = /(?:[?*+]|\{[0-9\+\*]+(?:,[0-9\+\*]*)?\})\??|[^.?*+^${[]()|\\]+|./g, q = !1, r = new d, s = [], t = []; j = p.exec(b);)if (k = j[0], q)h(); else switch (k.charAt(0)) {
                case c.escapeChar:
                    q = !0;
                    break;
                case c.optionalmarker.end:
                case c.groupmarker.end:
                    if (l = s.pop(), void 0 != l)if (s.length > 0) {
                        if (m = s[s.length - 1], m.matches.push(l), m.isAlternator) {
                            n = s.pop();
                            for (var u = 0; u < n.matches.length; u++)n.matches[u].isGroup = !1;
                            s.length > 0 ? (m = s[s.length - 1], m.matches.push(n)) : r.matches.push(n)
                        }
                    } else r.matches.push(l); else h();
                    break;
                case c.optionalmarker.start:
                    s.push(new d(!1, !0));
                    break;
                case c.groupmarker.start:
                    s.push(new d(!0));
                    break;
                case c.quantifiermarker.start:
                    var v = new d(!1, !1, !0);
                    k = k.replace(/[{}]/g, "");
                    var w = k.split(","), x = isNaN(w[0]) ? w[0] : parseInt(w[0]), y = 1 == w.length ? x : isNaN(w[1]) ? w[1] : parseInt(w[1]);
                    if (("*" == y || "+" == y) && (x = "*" == y ? 0 : 1), v.quantifier = {
                            min: x,
                            max: y
                        }, s.length > 0) {
                        var z = s[s.length - 1].matches;
                        if (j = z.pop(), !j.isGroup) {
                            var A = new d(!0);
                            A.matches.push(j), j = A
                        }
                        z.push(j), z.push(v)
                    } else {
                        if (j = r.matches.pop(), !j.isGroup) {
                            var A = new d(!0);
                            A.matches.push(j), j = A
                        }
                        r.matches.push(j), r.matches.push(v)
                    }
                    break;
                case c.alternatormarker:
                    s.length > 0 ? (m = s[s.length - 1], o = m.matches.pop()) : o = r.matches.pop(), o.isAlternator ? s.push(o) : (n = new d(!1, !1, !1, !0), n.matches.push(o), s.push(n));
                    break;
                default:
                    h()
            }
            for (; s.length > 0;)l = s.pop(), f(l, !0), r.matches.push(l);
            return r.matches.length > 0 && (o = r.matches[r.matches.length - 1], f(o), t.push(r)), c.numericInput && i(t[0]), t
        }

        function f(f, g) {
            if (void 0 == f || "" == f)return void 0;
            if (1 == f.length && 0 == c.greedy && 0 != c.repeat && (c.placeholder = ""), c.repeat > 0 || "*" == c.repeat || "+" == c.repeat) {
                var h = "*" == c.repeat ? 0 : "+" == c.repeat ? 1 : c.repeat;
                f = c.groupmarker.start + f + c.groupmarker.end + c.quantifiermarker.start + h + "," + c.repeat + c.quantifiermarker.end
            }
            var i;
            return void 0 == b.prototype.masksCache[f] || d === !0 ? (i = {
                mask: f,
                maskToken: e(f),
                validPositions: {},
                _buffer: void 0,
                buffer: void 0,
                tests: {},
                metadata: g
            }, d !== !0 && (b.prototype.masksCache[c.numericInput ? f.split("").reverse().join("") : f] = i)) : i = a.extend(!0, {}, b.prototype.masksCache[f]), i
        }

        function g(a) {
            return a = a.toString()
        }

        var h = void 0;
        if (a.isFunction(c.mask) && (c.mask = c.mask.call(this, c)), a.isArray(c.mask)) {
            if (c.mask.length > 1) {
                c.keepStatic = void 0 == c.keepStatic ? !0 : c.keepStatic;
                var i = "(";
                return a.each(c.numericInput ? c.mask.reverse() : c.mask, function (b, c) {
                    i.length > 1 && (i += ")|("), i += g(void 0 == c.mask || a.isFunction(c.mask) ? c : c.mask)
                }), i += ")", f(i, c.mask)
            }
            c.mask = c.mask.pop()
        }
        return c.mask && (h = void 0 == c.mask.mask || a.isFunction(c.mask.mask) ? f(g(c.mask), c.mask) : f(g(c.mask.mask), c.mask)), h
    }

    function h(e, f, g) {
        function h(a, b, c) {
            b = b || 0;
            var d, e, f, g = [], h = 0;
            do {
                if (a === !0 && i().validPositions[h]) {
                    var j = i().validPositions[h];
                    e = j.match, d = j.locator.slice(), g.push(c === !0 ? j.input : H(h, e))
                } else f = r(h, d, h - 1), e = f.match, d = f.locator.slice(), g.push(H(h, e));
                h++
            } while ((void 0 == da || da > h - 1) && null != e.fn || null == e.fn && "" != e.def || b >= h);
            return g.pop(), g
        }

        function i() {
            return f
        }

        function n(a) {
            var b = i();
            b.buffer = void 0, b.tests = {}, a !== !0 && (b._buffer = void 0, b.validPositions = {}, b.p = 0)
        }

        function o(a, b) {
            var c = i(), d = -1, e = c.validPositions;
            void 0 == a && (a = -1);
            var f = d, g = d;
            for (var h in e) {
                var j = parseInt(h);
                e[j] && (b || null != e[j].match.fn) && (a >= j && (f = j), j >= a && (g = j))
            }
            return d = -1 != f && a - f > 1 || a > g ? f : g
        }

        function p(b, c, d) {
            if (g.insertMode && void 0 != i().validPositions[b] && void 0 == d) {
                var e, f = a.extend(!0, {}, i().validPositions), h = o();
                for (e = b; h >= e; e++)delete i().validPositions[e];
                i().validPositions[b] = c;
                var j, k = !0, l = i().validPositions;
                for (e = j = b; h >= e; e++) {
                    var m = f[e];
                    if (void 0 != m)for (var n = j, p = -1; n < C() && (null == m.match.fn && l[e] && (l[e].match.optionalQuantifier === !0 || l[e].match.optionality === !0) || null != m.match.fn);) {
                        if (null == m.match.fn || !g.keepStatic && l[e] && (void 0 != l[e + 1] && u(e + 1, l[e].locator.slice(), e).length > 1 || void 0 != l[e].alternation) ? n++ : n = D(j), t(n, m.match.def)) {
                            k = A(n, m.input, !0, !0) !== !1, j = n;
                            break
                        }
                        if (k = null == m.match.fn, p == n)break;
                        p = n
                    }
                    if (!k)break
                }
                if (!k)return i().validPositions = a.extend(!0, {}, f), !1
            } else i().validPositions[b] = c;
            return !0
        }

        function q(a, b, c, d) {
            var e, f = a;
            i().p = a;
            for (e = f; b > e; e++)void 0 != i().validPositions[e] && (c === !0 || 0 != g.canClearPosition(i(), e, o(), d, g)) && delete i().validPositions[e];
            for (n(!0), e = f + 1; e <= o();) {
                for (; void 0 != i().validPositions[f];)f++;
                var h = i().validPositions[f];
                f > e && (e = f + 1);
                var j = i().validPositions[e];
                void 0 != j && B(e) && void 0 == h ? (t(f, j.match.def) && A(f, j.input, !0) !== !1 && (delete i().validPositions[e], e++), f++) : e++
            }
            var k = o(), l = C();
            for (c !== !0 && void 0 != i().validPositions[k] && i().validPositions[k].input == g.radixPoint && delete i().validPositions[k], e = k + 1; l >= e; e++)i().validPositions[e] && delete i().validPositions[e];
            n(!0)
        }

        function r(a, b, c) {
            var d = i().validPositions[a];
            if (void 0 == d)for (var e = u(a, b, c), f = o(), h = i().validPositions[f] || u(0)[0], j = void 0 != h.alternation ? h.locator[h.alternation].toString().split(",") : [], k = 0; k < e.length && (d = e[k], !(d.match && (g.greedy && d.match.optionalQuantifier !== !0 || (d.match.optionality === !1 || d.match.newBlockMarker === !1) && d.match.optionalQuantifier !== !0) && (void 0 == h.alternation || h.alternation != d.alternation || void 0 != d.locator[h.alternation] && z(d.locator[h.alternation].toString().split(","), j)))); k++);
            return d
        }

        function s(a) {
            return i().validPositions[a] ? i().validPositions[a].match : u(a)[0].match
        }

        function t(a, b) {
            for (var c = !1, d = u(a), e = 0; e < d.length; e++)if (d[e].match && d[e].match.def == b) {
                c = !0;
                break
            }
            return c
        }

        function u(b, c, d, e) {
            function f(c, d, e, g) {
                function j(e, g, n) {
                    if (h > 1e4)return alert("jquery.inputmask: There is probably an error in your mask definition or in the code. Create an issue on github with an example of the mask you are using. " + i().mask), !0;
                    if (h == b && void 0 == e.matches)return k.push({match: e, locator: g.reverse()}), !0;
                    if (void 0 != e.matches) {
                        if (e.isGroup && n !== e) {
                            if (e = j(c.matches[m + 1], g))return !0
                        } else if (e.isOptional) {
                            var o = e;
                            if (e = f(e, d, g, n)) {
                                var p = k[k.length - 1].match, q = 0 == a.inArray(p, o.matches);
                                if (!q)return !0;
                                l = !0, h = b
                            }
                        } else if (e.isAlternator) {
                            var r, s = e, t = [], u = k.slice(), v = g.length, w = d.length > 0 ? d.shift() : -1;
                            if (-1 == w || "string" == typeof w) {
                                var x = h, y = d.slice(), z = [];
                                "string" == typeof w && (z = w.split(","));
                                for (var A = 0; A < s.matches.length; A++) {
                                    if (k = [], e = j(s.matches[A], [A].concat(g), n) || e, e !== !0 && void 0 != e && z[z.length - 1] < s.matches.length) {
                                        var B = c.matches.indexOf(e) + 1;
                                        c.matches.length > B && (e = j(c.matches[B], [B].concat(g.slice(1, g.length)), n), e && (z.push(B.toString()), a.each(k, function (a, b) {
                                            b.alternation = g.length - 1
                                        })))
                                    }
                                    r = k.slice(), h = x, k = [];
                                    for (var C = 0; C < y.length; C++)d[C] = y[C];
                                    for (var D = 0; D < r.length; D++) {
                                        var E = r[D];
                                        E.alternation = E.alternation || v;
                                        for (var F = 0; F < t.length; F++) {
                                            var G = t[F];
                                            if (E.match.mask == G.match.mask && ("string" != typeof w || -1 != a.inArray(E.locator[E.alternation].toString(), z))) {
                                                r.splice(D, 1), D--, G.locator[E.alternation] = G.locator[E.alternation] + "," + E.locator[E.alternation], G.alternation = E.alternation;
                                                break
                                            }
                                        }
                                    }
                                    t = t.concat(r)
                                }
                                "string" == typeof w && (t = a.map(t, function (b, c) {
                                    if (isFinite(c)) {
                                        var d, e = b.alternation, f = b.locator[e].toString().split(",");
                                        b.locator[e] = void 0, b.alternation = void 0;
                                        for (var g = 0; g < f.length; g++)d = -1 != a.inArray(f[g], z), d && (void 0 != b.locator[e] ? (b.locator[e] += ",", b.locator[e] += f[g]) : b.locator[e] = parseInt(f[g]), b.alternation = e);
                                        if (void 0 != b.locator[e])return b
                                    }
                                })), k = u.concat(t), h = b, l = k.length > 0
                            } else e = s.matches[w] ? j(s.matches[w], [w].concat(g), n) : !1;
                            if (e)return !0
                        } else if (e.isQuantifier && n !== c.matches[a.inArray(e, c.matches) - 1])for (var H = e, I = d.length > 0 ? d.shift() : 0; I < (isNaN(H.quantifier.max) ? I + 1 : H.quantifier.max) && b >= h; I++) {
                            var J = c.matches[a.inArray(H, c.matches) - 1];
                            if (e = j(J, [I].concat(g), J)) {
                                var p = k[k.length - 1].match;
                                p.optionalQuantifier = I > H.quantifier.min - 1;
                                var q = 0 == a.inArray(p, J.matches);
                                if (q) {
                                    if (I > H.quantifier.min - 1) {
                                        l = !0, h = b;
                                        break
                                    }
                                    return !0
                                }
                                return !0
                            }
                        } else if (e = f(e, d, g, n))return !0
                    } else h++
                }

                for (var m = d.length > 0 ? d.shift() : 0; m < c.matches.length; m++)if (c.matches[m].isQuantifier !== !0) {
                    var n = j(c.matches[m], [m].concat(e), g);
                    if (n && h == b)return n;
                    if (h > b)break
                }
            }

            var g = i().maskToken, h = c ? d : 0, j = c || [0], k = [], l = !1;
            if (e === !0 && i().tests[b])return i().tests[b];
            if (void 0 == c) {
                for (var m, n = b - 1; void 0 == (m = i().validPositions[n]) && n > -1 && (!i().tests[n] || void 0 == (m = i().tests[n][0]));)n--;
                void 0 != m && n > -1 && (h = n, j = m.locator.slice())
            }
            for (var o = j.shift(); o < g.length; o++) {
                var p = f(g[o], j, [o]);
                if (p && h == b || h > b)break
            }
            return (0 == k.length || l) && k.push({
                match: {
                    fn: null,
                    cardinality: 0,
                    optionality: !0,
                    casing: null,
                    def: ""
                }, locator: []
            }), i().tests[b] = a.extend(!0, [], k), i().tests[b]
        }

        function v() {
            return void 0 == i()._buffer && (i()._buffer = h(!1, 1)), i()._buffer
        }

        function w() {
            return void 0 == i().buffer && (i().buffer = h(!0, o(), !0)), i().buffer
        }

        function x(a, b, c) {
            if (c = c || w().slice(), a === !0)n(), a = 0, b = c.length; else for (var d = a; b > d; d++)delete i().validPositions[d], delete i().tests[d];
            for (var d = a; b > d; d++)c[d] != g.skipOptionalPartCharacter && A(d, c[d], !0, !0)
        }

        function y(a, b) {
            switch (b.casing) {
                case"upper":
                    a = a.toUpperCase();
                    break;
                case"lower":
                    a = a.toLowerCase()
            }
            return a
        }

        function z(b, c) {
            for (var d = g.greedy ? c : c.slice(0, 1), e = !1, f = 0; f < b.length; f++)if (-1 != a.inArray(b[f], d)) {
                e = !0;
                break
            }
            return e
        }

        function A(b, c, d, e) {
            function f(b, c, d, e) {
                var f = !1;
                return a.each(u(b), function (h, j) {
                    for (var k = j.match, l = c ? 1 : 0, m = "", r = (w(), k.cardinality); r > l; r--)m += F(b - (r - 1));
                    if (c && (m += c), f = null != k.fn ? k.fn.test(m, i(), b, d, g) : c != k.def && c != g.skipOptionalPartCharacter || "" == k.def ? !1 : {
                            c: k.def,
                            pos: b
                        }, f !== !1) {
                        var s = void 0 != f.c ? f.c : c;
                        s = s == g.skipOptionalPartCharacter && null === k.fn ? k.def : s;
                        var t = b, u = w();
                        if (void 0 != f.remove && (a.isArray(f.remove) || (f.remove = [f.remove]), a.each(f.remove.sort(function (a, b) {
                                return b - a
                            }), function (a, b) {
                                q(b, b + 1, !0)
                            })), void 0 != f.insert && (a.isArray(f.insert) || (f.insert = [f.insert]), a.each(f.insert.sort(function (a, b) {
                                return a - b
                            }), function (a, b) {
                                A(b.pos, b.c, !0)
                            })), f.refreshFromBuffer) {
                            var v = f.refreshFromBuffer;
                            if (d = !0, x(v === !0 ? v : v.start, v.end, u), void 0 == f.pos && void 0 == f.c)return f.pos = o(), !1;
                            if (t = void 0 != f.pos ? f.pos : b, t != b)return f = a.extend(f, A(t, s, !0)), !1
                        } else if (f !== !0 && void 0 != f.pos && f.pos != b && (t = f.pos, x(b, t), t != b))return f = a.extend(f, A(t, s, !0)), !1;
                        return 1 != f && void 0 == f.pos && void 0 == f.c ? !1 : (h > 0 && n(!0), p(t, a.extend({}, j, {input: y(s, k)}), e) || (f = !1), !1)
                    }
                }), f
            }

            function h(b, c, d, e) {
                for (var f, h, j, k, l = a.extend(!0, {}, i().validPositions), m = o(); m >= 0 && (k = i().validPositions[m], !k || void 0 == k.alternation || (f = m, h = i().validPositions[f].alternation, r(f).locator[k.alternation] == k.locator[k.alternation])); m--);
                if (void 0 != h) {
                    f = parseInt(f);
                    for (var p in i().validPositions)if (p = parseInt(p), k = i().validPositions[p], p >= f && void 0 != k.alternation) {
                        var q = i().validPositions[f].locator[h].toString().split(","), s = k.locator[h] || q[0];
                        s.length > 0 && (s = s.split(",")[0]);
                        for (var t = 0; t < q.length; t++)if (s < q[t]) {
                            for (var u, v, w = p; w >= 0; w--)if (u = i().validPositions[w], void 0 != u) {
                                v = u.locator[h], u.locator[h] = parseInt(q[t]);
                                break
                            }
                            if (s != u.locator[h]) {
                                for (var x = [], y = 0, z = p + 1; z < o() + 1; z++) {
                                    var B = i().validPositions[z];
                                    B && (null != B.match.fn ? x.push(B.input) : b > z && y++), delete i().validPositions[z], delete i().tests[z]
                                }
                                for (n(!0), g.keepStatic = !g.keepStatic, j = !0; x.length > 0;) {
                                    var C = x.shift();
                                    if (C != g.skipOptionalPartCharacter && !(j = A(o() + 1, C, !1, !0)))break
                                }
                                if (u.alternation = h, u.locator[h] = v, j) {
                                    for (var D = o(b) + 1, E = 0, z = p + 1; z < o() + 1; z++) {
                                        var B = i().validPositions[z];
                                        B && null == B.match.fn && b > z && E++
                                    }
                                    b += E - y, j = A(b > D ? D : b, c, d, e)
                                }
                                if (g.keepStatic = !g.keepStatic, j)return j;
                                n(), i().validPositions = a.extend(!0, {}, l)
                            }
                        }
                        break
                    }
                }
                return !1
            }

            function j(b, c) {
                for (var d = i().validPositions[c], e = d.locator, f = e.length, g = b; c > g; g++)if (!B(g)) {
                    var h = u(g), j = h[0], k = -1;
                    a.each(h, function (a, b) {
                        for (var c = 0; f > c; c++)b.locator[c] && z(b.locator[c].toString().split(","), e[c].toString().split(",")) && c > k && (k = c, j = b)
                    }), p(g, a.extend({}, j, {input: j.match.def}), !0)
                }
            }

            d = d === !0;
            for (var k = w(), l = b - 1; l > -1 && !i().validPositions[l]; l--);
            for (l++; b > l; l++)void 0 == i().validPositions[l] && ((!B(l) || k[l] != H(l)) && u(l).length > 1 || k[l] == g.radixPoint || "0" == k[l] && a.inArray(g.radixPoint, k) < l) && f(l, k[l], !0);
            var m = b, s = !1, t = a.extend(!0, {}, i().validPositions);
            if (m < C() && (s = f(m, c, d, e), (!d || e) && s === !1)) {
                var v = i().validPositions[m];
                if (!v || null != v.match.fn || v.match.def != c && c != g.skipOptionalPartCharacter) {
                    if ((g.insertMode || void 0 == i().validPositions[D(m)]) && !B(m))for (var E = m + 1, G = D(m); G >= E; E++)if (s = f(E, c, d, e), s !== !1) {
                        j(m, E), m = E;
                        break
                    }
                } else s = {caret: D(m)}
            }
            if (s === !1 && g.keepStatic && N(k) && (s = h(b, c, d, e)), s === !0 && (s = {pos: m}), a.isFunction(g.postValidation) && 0 != s && !d) {
                n(!0);
                var I = g.postValidation(w(), g);
                if (I) {
                    if (I.refreshFromBuffer) {
                        var J = I.refreshFromBuffer;
                        x(J === !0 ? J : J.start, J.end, I.buffer), n(!0), s = I
                    }
                } else n(!0), i().validPositions = a.extend(!0, {}, t), s = !1
            }
            return s
        }

        function B(a) {
            var b = s(a);
            if (null != b.fn)return b.fn;
            if (!g.keepStatic && void 0 == i().validPositions[a]) {
                for (var c = u(a), d = !0, e = 0; e < c.length; e++)if ("" != c[e].match.def && (void 0 == c[e].alternation || c[e].locator[c[e].alternation].length > 1)) {
                    d = !1;
                    break
                }
                return d
            }
            return !1
        }

        function C() {
            var a;
            da = ca.prop("maxLength"), -1 == da && (da = void 0);
            var b, c = o(), d = i().validPositions[c], e = void 0 != d ? d.locator.slice() : void 0;
            for (b = c + 1; void 0 == d || null != d.match.fn || null == d.match.fn && "" != d.match.def; b++)d = r(b, e, b - 1), e = d.locator.slice();
            var f = s(b - 1);
            return a = "" != f.def ? b : b - 1, void 0 == da || da > a ? a : da
        }

        function D(a) {
            var b = C();
            if (a >= b)return b;
            for (var c = a; ++c < b && !B(c) && (g.nojumps !== !0 || g.nojumpsThreshold > c););
            return c
        }

        function E(a) {
            var b = a;
            if (0 >= b)return 0;
            for (; --b > 0 && !B(b););
            return b
        }

        function F(a) {
            return void 0 == i().validPositions[a] ? H(a) : i().validPositions[a].input
        }

        function G(b, c, d, e, f) {
            if (e && a.isFunction(g.onBeforeWrite)) {
                var h = g.onBeforeWrite.call(b, e, c, d, g);
                if (h) {
                    if (h.refreshFromBuffer) {
                        var i = h.refreshFromBuffer;
                        x(i === !0 ? i : i.start, i.end, h.buffer || c), n(!0), c = w()
                    }
                    d = void 0 != h.caret ? h.caret : d
                }
            }
            b._valueSet(c.join("")), void 0 != d && K(b, d), f === !0 && (ga = !0, a(b).trigger("input"))
        }

        function H(a, b) {
            if (b = b || s(a), void 0 != b.placeholder)return b.placeholder;
            if (null == b.fn) {
                if (!g.keepStatic && void 0 == i().validPositions[a]) {
                    for (var c, d = u(a), e = !1, f = 0; f < d.length; f++) {
                        if (c && "" != d[f].match.def && d[f].match.def != c.match.def && (void 0 == d[f].alternation || d[f].alternation == c.alternation)) {
                            e = !0;
                            break
                        }
                        1 != d[f].match.optionality && 1 != d[f].match.optionalQuantifier && (c = d[f])
                    }
                    if (e)return g.placeholder.charAt(a % g.placeholder.length)
                }
                return b.def
            }
            return g.placeholder.charAt(a % g.placeholder.length)
        }

        function I(c, d, e, f) {
            function h() {
                var a = !1, b = v().slice(l, D(l)).join("").indexOf(k);
                if (-1 != b && !B(l)) {
                    a = !0;
                    for (var c = v().slice(l, l + b), d = 0; d < c.length; d++)if (" " != c[d]) {
                        a = !1;
                        break
                    }
                }
                return a
            }

            var j = void 0 != f ? f.slice() : c._valueGet().split(""), k = "", l = 0;
            if (n(), i().p = D(-1), d && c._valueSet(""), !e)if (1 != g.autoUnmask) {
                var m = v().slice(0, D(-1)).join(""), p = j.join("").match(new RegExp("^" + b.escapeRegex(m), "g"));
                p && p.length > 0 && (j.splice(0, p.length * m.length), l = D(l))
            } else l = D(l);
            a.each(j, function (b, d) {
                var f = a.Event("keypress");
                f.which = d.charCodeAt(0), k += d;
                var j = o(void 0, !0), m = i().validPositions[j], n = r(j + 1, m ? m.locator.slice() : void 0, j);
                if (!h() || e || g.autoUnmask) {
                    var p = e ? b : null == n.match.fn && n.match.optionality && j + 1 < i().p ? j + 1 : i().p;
                    T.call(c, f, !0, !1, e, p), l = p + 1, k = ""
                } else T.call(c, f, !0, !1, !0, j + 1)
            }), d && G(c, w(), a(c).is(":focus") ? D(o(0)) : void 0, a.Event("checkval"))
        }

        function J(b) {
            if (b[0].inputmask && !b.hasClass("hasDatepicker")) {
                var c = [], d = i().validPositions;
                for (var e in d)d[e].match && null != d[e].match.fn && c.push(d[e].input);
                var f = (ea ? c.reverse() : c).join(""), h = (ea ? w().slice().reverse() : w()).join("");
                return a.isFunction(g.onUnMask) && (f = g.onUnMask.call(b, h, f, g) || f), f
            }
            return b[0]._valueGet()
        }

        function K(b, c, d) {
            function e(a) {
                if (ea && "number" == typeof a && (!g.greedy || "" != g.placeholder)) {
                    var b = w().join("").length;
                    a = b - a
                }
                return a
            }

            var f, h = b.jquery && b.length > 0 ? b[0] : b;
            if ("number" != typeof c)return h.setSelectionRange ? (c = h.selectionStart, d = h.selectionEnd) : window.getSelection ? (f = window.getSelection().getRangeAt(0), (f.commonAncestorContainer.parentNode == h || f.commonAncestorContainer == h) && (c = f.startOffset, d = f.endOffset)) : document.selection && document.selection.createRange && (f = document.selection.createRange(), c = 0 - f.duplicate().moveStart("character", -1e5), d = c + f.text.length), {
                begin: e(c),
                end: e(d)
            };
            if (c = e(c), d = e(d), d = "number" == typeof d ? d : c, a(h).is(":visible")) {
                var i = a(h).css("font-size").replace("px", "") * d;
                if (h.scrollLeft = i > h.scrollWidth ? i : 0, k || 0 != g.insertMode || c != d || d++, h.setSelectionRange)h.selectionStart = c, h.selectionEnd = d; else if (window.getSelection) {
                    if (f = document.createRange(), void 0 == h.firstChild) {
                        var j = document.createTextNode("");
                        h.appendChild(j)
                    }
                    f.setStart(h.firstChild, c < h._valueGet().length ? c : h._valueGet().length), f.setEnd(h.firstChild, d < h._valueGet().length ? d : h._valueGet().length), f.collapse(!0);
                    var l = window.getSelection();
                    l.removeAllRanges(), l.addRange(f)
                } else h.createTextRange && (f = h.createTextRange(), f.collapse(!0), f.moveEnd("character", d), f.moveStart("character", c), f.select())
            }
        }

        function L(b) {
            var c, d, e = w(), f = e.length, g = o(), h = {}, j = i().validPositions[g], k = void 0 != j ? j.locator.slice() : void 0;
            for (c = g + 1; c < e.length; c++)d = r(c, k, c - 1), k = d.locator.slice(), h[c] = a.extend(!0, {}, d);
            var l = j && void 0 != j.alternation ? j.locator[j.alternation] : void 0;
            for (c = f - 1; c > g && (d = h[c], (d.match.optionality || d.match.optionalQuantifier || l && (l != h[c].locator[j.alternation] && null != d.match.fn || null == d.match.fn && d.locator[j.alternation] && z(d.locator[j.alternation].toString().split(","), l.toString().split(",")) && "" != u(c)[0].def)) && e[c] == H(c, d.match)); c--)f--;
            return b ? {l: f, def: h[f] ? h[f].match : void 0} : f
        }

        function M(a) {
            for (var b = L(), c = a.length - 1; c > b && !B(c); c--);
            return a.splice(b, c + 1 - b), a
        }

        function N(b) {
            if (a.isFunction(g.isComplete))return g.isComplete.call(ca, b, g);
            if ("*" == g.repeat)return void 0;
            {
                var c = !1, d = L(!0), e = E(d.l);
                o()
            }
            if (void 0 == d.def || d.def.newBlockMarker || d.def.optionality || d.def.optionalQuantifier) {
                c = !0;
                for (var f = 0; e >= f; f++) {
                    var h = r(f).match;
                    if (null != h.fn && void 0 == i().validPositions[f] && h.optionality !== !0 && h.optionalQuantifier !== !0 || null == h.fn && b[f] != H(f, h)) {
                        c = !1;
                        break
                    }
                }
            }
            return c
        }

        function O(a, b) {
            return ea ? a - b > 1 || a - b == 1 && g.insertMode : b - a > 1 || b - a == 1 && g.insertMode
        }

        function P(c) {
            var d = a._data(c).events, e = !1;
            a.each(d, function (c, d) {
                a.each(d, function (a, c) {
                    if ("inputmask" == c.namespace && "setvalue" != c.type) {
                        var d = c.handler;
                        c.handler = function (a) {
                            if (!(this.disabled || this.readOnly && !("keydown" == a.type && a.ctrlKey && 67 == a.keyCode || a.keyCode == b.keyCode.TAB))) {
                                switch (a.type) {
                                    case"input":
                                        if (ga === !0 || e === !0)return ga = !1, a.preventDefault();
                                        break;
                                    case"keydown":
                                        fa = !1, e = !1;
                                        break;
                                    case"keypress":
                                        if (fa === !0)return a.preventDefault();
                                        fa = !0;
                                        break;
                                    case"compositionstart":
                                        e = !0;
                                        break;
                                    case"compositionupdate":
                                        ga = !0;
                                        break;
                                    case"compositionend":
                                        e = !1
                                }
                                return d.apply(this, arguments)
                            }
                            a.preventDefault()
                        }
                    }
                })
            })
        }

        function Q(b) {
            function c(b) {
                if (void 0 == a.valHooks[b] || 1 != a.valHooks[b].inputmaskpatch) {
                    var c = a.valHooks[b] && a.valHooks[b].get ? a.valHooks[b].get : function (a) {
                        return a.value
                    }, d = a.valHooks[b] && a.valHooks[b].set ? a.valHooks[b].set : function (a, b) {
                        return a.value = b, a
                    };
                    a.valHooks[b] = {
                        get: function (b) {
                            a(b);
                            if (b.inputmask) {
                                if (b.inputmask.opts.autoUnmask)return b.inputmask.unmaskedvalue();
                                var d = c(b), e = b.inputmask.maskset, f = e._buffer;
                                return f = f ? f.join("") : "", d != f ? d : ""
                            }
                            return c(b)
                        }, set: function (b, c) {
                            var e, f = a(b);
                            return e = d(b, c), b.inputmask && f.triggerHandler("setvalue.inputmask"), e
                        }, inputmaskpatch: !0
                    }
                }
            }

            function d() {
                a(this);
                return this.inputmask ? this.inputmask.opts.autoUnmask ? this.inputmask.unmaskedvalue() : g.call(this) != v().join("") ? g.call(this) : "" : g.call(this)
            }

            function e(b) {
                h.call(this, b), this.inputmask && a(this).triggerHandler("setvalue.inputmask")
            }

            function f(b) {
                a(b).bind("mouseenter.inputmask", function (b) {
                    var c = a(this), d = this, e = d._valueGet();
                    "" != e && e != w().join("") && c.triggerHandler("setvalue.inputmask")
                });
//!! the bound handlers are executed in the order they where bound
                var c = a._data(b).events, d = c.mouseover;
                if (d) {
                    for (var e = d[d.length - 1], f = d.length - 1; f > 0; f--)d[f] = d[f - 1];
                    d[0] = e
                }
            }

            var g, h;
            if (!b._valueGet) {
                var i;
                Object.getOwnPropertyDescriptor && void 0 == b.value ? (g = function () {
                    return this.textContent
                }, h = function (a) {
                    this.textContent = a
                }, Object.defineProperty(b, "value", {
                    get: d,
                    set: e
                })) : ((i = Object.getOwnPropertyDescriptor && Object.getOwnPropertyDescriptor(b, "value")) && i.configurable, document.__lookupGetter__ && b.__lookupGetter__("value") ? (g = b.__lookupGetter__("value"), h = b.__lookupSetter__("value"), b.__defineGetter__("value", d), b.__defineSetter__("value", e)) : (g = function () {
                    return b.value
                }, h = function (a) {
                    b.value = a
                }, c(b.type), f(b))), b._valueGet = function (a) {
                    return ea && a !== !0 ? g.call(this).split("").reverse().join("") : g.call(this)
                }, b._valueSet = function (a) {
                    h.call(this, ea ? a.split("").reverse().join("") : a)
                }
            }
        }

        function R(c, d, e, f) {
            function h() {
                if (g.keepStatic) {
                    n(!0);
                    var b, d = [], e = a.extend(!0, {}, i().validPositions);
                    for (b = o(); b >= 0; b--) {
                        var f = i().validPositions[b];
                        if (f && (null != f.match.fn && d.push(f.input), delete i().validPositions[b], void 0 != f.alternation && f.locator[f.alternation] == r(b).locator[f.alternation]))break
                    }
                    if (b > -1)for (; d.length > 0;) {
                        i().p = D(o());
                        var h = a.Event("keypress");
                        h.which = d.pop().charCodeAt(0), T.call(c, h, !0, !1, !1, i().p)
                    } else i().validPositions = a.extend(!0, {}, e)
                }
            }

            if ((g.numericInput || ea) && (d == b.keyCode.BACKSPACE ? d = b.keyCode.DELETE : d == b.keyCode.DELETE && (d = b.keyCode.BACKSPACE), ea)) {
                var j = e.end;
                e.end = e.begin, e.begin = j
            }
            if (d == b.keyCode.BACKSPACE && (e.end - e.begin < 1 || 0 == g.insertMode) ? (e.begin = E(e.begin), void 0 == i().validPositions[e.begin] || i().validPositions[e.begin].input != g.groupSeparator && i().validPositions[e.begin].input != g.radixPoint || e.begin--) : d == b.keyCode.DELETE && e.begin == e.end && (e.end = B(e.end) ? e.end + 1 : D(e.end) + 1, void 0 == i().validPositions[e.begin] || i().validPositions[e.begin].input != g.groupSeparator && i().validPositions[e.begin].input != g.radixPoint || e.end++), q(e.begin, e.end, !1, f), f !== !0) {
                h();
                var k = o(e.begin);
                k < e.begin ? (-1 == k && n(), i().p = D(k)) : i().p = e.begin
            }
        }

        function S(d) {
            var e = this, f = a(e), h = d.keyCode, k = K(e);
            h == b.keyCode.BACKSPACE || h == b.keyCode.DELETE || j && 127 == h || d.ctrlKey && 88 == h && !c("cut") ? (d.preventDefault(), 88 == h && ($ = w().join("")), R(e, h, k), G(e, w(), i().p, d, $ != w().join("")), e._valueGet() == v().join("") ? f.trigger("cleared") : N(w()) === !0 && f.trigger("complete"), g.showTooltip && f.prop("title", i().mask)) : h == b.keyCode.END || h == b.keyCode.PAGE_DOWN ? setTimeout(function () {
                var a = D(o());
                g.insertMode || a != C() || d.shiftKey || a--, K(e, d.shiftKey ? k.begin : a, a)
            }, 0) : h == b.keyCode.HOME && !d.shiftKey || h == b.keyCode.PAGE_UP ? K(e, 0, d.shiftKey ? k.begin : 0) : (g.undoOnEscape && h == b.keyCode.ESCAPE || 90 == h && d.ctrlKey) && d.altKey !== !0 ? (I(e, !0, !1, $.split("")), f.click()) : h != b.keyCode.INSERT || d.shiftKey || d.ctrlKey ? 0 != g.insertMode || d.shiftKey || (h == b.keyCode.RIGHT ? setTimeout(function () {
                var a = K(e);
                K(e, a.begin)
            }, 0) : h == b.keyCode.LEFT && setTimeout(function () {
                var a = K(e);
                K(e, ea ? a.begin + 1 : a.begin - 1)
            }, 0)) : (g.insertMode = !g.insertMode, K(e, g.insertMode || k.begin != C() ? k.begin : k.begin - 1)), g.onKeyDown.call(this, d, w(), K(e).begin, g), ha = -1 != a.inArray(h, g.ignorables)
        }

        function T(c, d, e, f, h) {
            var j = this, k = a(j), l = c.which || c.charCode || c.keyCode;
            if (!(d === !0 || c.ctrlKey && c.altKey) && (c.ctrlKey || c.metaKey || ha))return !0;
            if (l) {
                46 == l && 0 == c.shiftKey && "," == g.radixPoint && (l = 44);
                var m, o = d ? {begin: h, end: h} : K(j), q = String.fromCharCode(l), r = O(o.begin, o.end);
                r && (i().undoPositions = a.extend(!0, {}, i().validPositions), R(j, b.keyCode.DELETE, o, !0), o.begin = i().p, g.insertMode || (g.insertMode = !g.insertMode, p(o.begin, f), g.insertMode = !g.insertMode), r = !g.multi), i().writeOutBuffer = !0;
                var s = ea && !r ? o.end : o.begin, t = A(s, q, f);
                if (t !== !1) {
                    if (t !== !0 && (s = void 0 != t.pos ? t.pos : s, q = void 0 != t.c ? t.c : q), n(!0), void 0 != t.caret)m = t.caret; else {
                        var v = i().validPositions;
                        m = !g.keepStatic && (void 0 != v[s + 1] && u(s + 1, v[s].locator.slice(), s).length > 1 || void 0 != v[s].alternation) ? s + 1 : D(s)
                    }
                    i().p = m
                }
                if (e !== !1) {
                    var y = this;
                    if (setTimeout(function () {
                            g.onKeyValidation.call(y, t, g)
                        }, 0), i().writeOutBuffer && t !== !1) {
                        var z = w();
                        G(j, z, d ? void 0 : g.numericInput ? E(m) : m, c, d !== !0), d !== !0 && setTimeout(function () {
                            N(z) === !0 && k.trigger("complete")
                        }, 0)
                    } else r && (i().buffer = void 0, i().validPositions = i().undoPositions)
                } else r && (i().buffer = void 0, i().validPositions = i().undoPositions);
                if (g.showTooltip && k.prop("title", i().mask), d && a.isFunction(g.onBeforeWrite)) {
                    var B = g.onBeforeWrite.call(this, c, w(), m, g);
                    if (B && B.refreshFromBuffer) {
                        var C = B.refreshFromBuffer;
                        x(C === !0 ? C : C.start, C.end, B.buffer), n(!0), B.caret && (i().p = B.caret)
                    }
                }
                if (c.preventDefault(), d)return t
            }
        }

        function U(b) {
            var c = this, d = a(c), e = c._valueGet(!0), f = K(c);
            if ("propertychange" == b.type && c._valueGet().length <= C())return !0;
            if ("paste" == b.type) {
                var h = e.substr(0, f.begin), i = e.substr(f.end, e.length);
                h == v().slice(0, f.begin).join("") && (h = ""), i == v().slice(f.end).join("") && (i = ""), window.clipboardData && window.clipboardData.getData ? e = h + window.clipboardData.getData("Text") + i : b.originalEvent && b.originalEvent.clipboardData && b.originalEvent.clipboardData.getData && (e = h + b.originalEvent.clipboardData.getData("text/plain") + i)
            }
            var j = e;
            if (a.isFunction(g.onBeforePaste)) {
                if (j = g.onBeforePaste.call(c, e, g), j === !1)return b.preventDefault(), !1;
                j || (j = e)
            }
            return I(c, !1, !1, ea ? j.split("").reverse() : j.split("")), G(c, w(), void 0, b, !0), d.click(), N(w()) === !0 && d.trigger("complete"), !1
        }

        function V(b) {
            var c = this;
            I(c, !0, !1), N(w()) === !0 && a(c).trigger("complete"), b.preventDefault()
        }

        function W(a) {
            var b = this;
            $ = w().join(""), ("" == aa || 0 != a.originalEvent.data.indexOf(aa)) && (_ = K(b))
        }

        function X(b) {
            var c = this, d = K(c);
            0 == b.originalEvent.data.indexOf(aa) && (n(), d = _);
            var e = b.originalEvent.data;
            K(c, d.begin, d.end);
            for (var f = 0; f < e.length; f++) {
                var h = a.Event("keypress");
                h.which = e.charCodeAt(f), fa = !1, ha = !1, T.call(c, h)
            }
            setTimeout(function () {
                var a = i().p;
                G(c, w(), g.numericInput ? E(a) : a)
            }, 0), aa = b.originalEvent.data
        }

        function Y(a) {
        }

        function Z(c) {
            ca = a(c), g.showTooltip && ca.prop("title", i().mask), ("rtl" == c.dir || g.rightAlign) && ca.css("text-align", "right"), ("rtl" == c.dir || g.numericInput) && (c.dir = "ltr", ca.removeAttr("dir"), c.inputmask.isRTL = !0, ea = !0), ca.unbind(".inputmask"), (ca.is(":input") && d(ca.attr("type")) || c.isContentEditable) && (ca.closest("form").bind("submit", function (a) {
                $ != w().join("") && ca.change(), g.clearMaskOnLostFocus && ca[0]._valueGet && ca[0]._valueGet() == v().join("") && ca[0]._valueSet(""), g.removeMaskOnSubmit && ca.inputmask("remove")
            }).bind("reset", function () {
                setTimeout(function () {
                    ca.triggerHandler("setvalue.inputmask")
                }, 0)
            }), ca.bind("mouseenter.inputmask", function () {
                var b = a(this), c = this;
                ja = !0, !b.is(":focus") && g.showMaskOnHover && c._valueGet() != w().join("") && G(c, w())
            }).bind("blur.inputmask", function (b) {
                var c = a(this), d = this;
                if (d.inputmask) {
                    var e = d._valueGet(), f = w().slice();
                    ia = !0, $ != f.join("") && setTimeout(function () {
                        c.change(), $ = f.join("")
                    }, 0), "" != e && (g.clearMaskOnLostFocus && (e == v().join("") ? f = [] : M(f)), N(f) === !1 && (setTimeout(function () {
                        c.trigger("incomplete")
                    }, 0), g.clearIncomplete && (n(), f = g.clearMaskOnLostFocus ? [] : v().slice())), G(d, f, void 0, b))
                }
            }).bind("focus.inputmask", function (b) {
                var c = (a(this), this), d = c._valueGet();
                g.showMaskOnFocus && (!g.showMaskOnHover || g.showMaskOnHover && "" == d) ? c._valueGet() != w().join("") && G(c, w(), D(o())) : ja === !1 && K(c, D(o())), g.positionCaretOnTab === !0 && setTimeout(function () {
                    K(c, D(o()))
                }, 0), $ = w().join("")
            }).bind("mouseleave.inputmask", function () {
                var b = a(this), c = this;
                if (ja = !1, g.clearMaskOnLostFocus) {
                    var d = w().slice(), e = c._valueGet();
                    b.is(":focus") || e == b.attr("placeholder") || "" == e || (e == v().join("") ? d = [] : M(d), G(c, d))
                }
            }).bind("click.inputmask", function () {
                var b = a(this), c = this;
                if (b.is(":focus")) {
                    var d = K(c);
                    if (d.begin == d.end)if (g.radixFocus && "" != g.radixPoint && -1 != a.inArray(g.radixPoint, w()) && (ia || w().join("") == v().join("")))K(c, a.inArray(g.radixPoint, w())), ia = !1; else {
                        var e = d.begin, f = D(o(e));
                        f > e ? K(c, B(e) ? e : D(e)) : K(c, g.numericInput ? 0 : f)
                    }
                }
            }).bind("dblclick.inputmask", function () {
                var a = this;
                setTimeout(function () {
                    K(a, 0, D(o()))
                }, 0)
            }).bind(m + ".inputmask dragdrop.inputmask drop.inputmask", U).bind("cut.inputmask", function (c) {
                ga = !0;
                var d = this, e = a(d), f = K(d);
                if (ea) {
                    var h = window.clipboardData || c.originalEvent.clipboardData, j = h.getData("text").split("").reverse().join("");
                    h.setData("text", j)
                }
                R(d, b.keyCode.DELETE, f), G(d, w(), i().p, c, $ != w().join("")), d._valueGet() == v().join("") && e.trigger("cleared"), g.showTooltip && e.prop("title", i().mask)
            }).bind("complete.inputmask", g.oncomplete).bind("incomplete.inputmask", g.onincomplete).bind("cleared.inputmask", g.oncleared), ca.bind("keydown.inputmask", S).bind("keypress.inputmask", T), l || ca.bind("compositionstart.inputmask", W).bind("compositionupdate.inputmask", X).bind("compositionend.inputmask", Y), "paste" === m && ca.bind("input.inputmask", V)), ca.bind("setvalue.inputmask", function () {
                var b = this, c = b._valueGet();
                b._valueSet(a.isFunction(g.onBeforeMask) ? g.onBeforeMask.call(b, c, g) || c : c), I(b, !0, !1), $ = w().join(""), (g.clearMaskOnLostFocus || g.clearIncomplete) && b._valueGet() == v().join("") && b._valueSet("")
            }), Q(c);
            var e = a.isFunction(g.onBeforeMask) ? g.onBeforeMask.call(c, c._valueGet(), g) || c._valueGet() : c._valueGet();
            I(c, !0, !1, e.split(""));
            var f = w().slice();
            $ = f.join("");
            var h;
            try {
                h = document.activeElement
            } catch (j) {
            }
            N(f) === !1 && g.clearIncomplete && n(), g.clearMaskOnLostFocus && (f.join("") == v().join("") ? f = [] : M(f)), G(c, f), h === c && K(c, D(o())), P(c)
        }

        var $, _, aa, ba, ca, da, ea = !1, fa = !1, ga = !1, ha = !1, ia = !0, ja = !0;
        if (void 0 != e)switch (e.action) {
            case"isComplete":
                return ba = e.el, ca = a(ba), f = ba.inputmask.maskset, g = ba.inputmask.opts, N(e.buffer);
            case"unmaskedvalue":
                if (ba = e.el, void 0 == ba) {
                    ca = a({}), ba = ca[0], ba.inputmask = new b, ba.inputmask.opts = g, ba.inputmask.el = ba, ba.inputmask.maskset = f, ba.inputmask.isRTL = g.numericInput, g.numericInput && (ea = !0);
                    var ka = (a.isFunction(g.onBeforeMask) ? g.onBeforeMask.call(ca, e.value, g) || e.value : e.value).split("");
                    I(ca, !1, !1, ea ? ka.reverse() : ka), a.isFunction(g.onBeforeWrite) && g.onBeforeWrite.call(this, void 0, w(), 0, g)
                } else ca = a(ba);
                return f = ba.inputmask.maskset, g = ba.inputmask.opts, ea = ba.inputmask.isRTL, J(ca);
            case"mask":
                $ = w().join(""), Z(e.el);
                break;
            case"format":
                ca = a({}), ca[0].inputmask = new b, ca[0].inputmask.opts = g, ca[0].inputmask.el = ca[0], ca[0].inputmask.maskset = f, ca[0].inputmask.isRTL = g.numericInput, g.numericInput && (ea = !0);
                var ka = (a.isFunction(g.onBeforeMask) ? g.onBeforeMask.call(ca, e.value, g) || e.value : e.value).split("");
                return I(ca, !1, !1, ea ? ka.reverse() : ka), a.isFunction(g.onBeforeWrite) && g.onBeforeWrite.call(this, void 0, w(), 0, g), e.metadata ? {
                    value: ea ? w().slice().reverse().join("") : w().join(""),
                    metadata: ca.inputmask("getmetadata")
                } : ea ? w().slice().reverse().join("") : w().join("");
            case"isValid":
                ca = a({}), ca[0].inputmask = new b, ca[0].inputmask.opts = g, ca[0].inputmask.el = ca[0], ca[0].inputmask.maskset = f, ca[0].inputmask.isRTL = g.numericInput, g.numericInput && (ea = !0);
                var ka = e.value.split("");
                I(ca, !1, !0, ea ? ka.reverse() : ka);
                for (var la = w(), ma = L(), na = la.length - 1; na > ma && !B(na); na--);
                return la.splice(ma, na + 1 - ma), N(la) && e.value == la.join("");
            case"getemptymask":
                return ba = e.el, ca = a(ba), f = ba.inputmask.maskset, g = ba.inputmask.opts, v();
            case"remove":
                ba = e.el, ca = a(ba), f = ba.inputmask.maskset, g = ba.inputmask.opts, ba._valueSet(J(ca)), ca.unbind(".inputmask"), ba.inputmask = void 0;
                var oa;
                Object.getOwnPropertyDescriptor && (oa = Object.getOwnPropertyDescriptor(ba, "value")), oa && oa.get ? ba._valueGet && Object.defineProperty(ba, "value", {
                    get: ba._valueGet,
                    set: ba._valueSet
                }) : document.__lookupGetter__ && ba.__lookupGetter__("value") && ba._valueGet && (ba.__defineGetter__("value", ba._valueGet), ba.__defineSetter__("value", ba._valueSet));
                try {
                    delete ba._valueGet, delete ba._valueSet
                } catch (pa) {
                    ba._valueGet = void 0, ba._valueSet = void 0
                }
                break;
            case"getmetadata":
                if (ba = e.el, ca = a(ba), f = ba.inputmask.maskset, g = ba.inputmask.opts, a.isArray(f.metadata)) {
                    for (var qa, ra = o(), sa = ra; sa >= 0; sa--)if (i().validPositions[sa] && void 0 != i().validPositions[sa].alternation) {
                        qa = i().validPositions[sa].alternation;
                        break
                    }
                    return void 0 != qa ? f.metadata[i().validPositions[ra].locator[qa]] : f.metadata[0]
                }
                return f.metadata
        }
    }

    b.prototype = {
        defaults: {
            placeholder: "_",
            optionalmarker: {start: "[", end: "]"},
            quantifiermarker: {start: "{", end: "}"},
            groupmarker: {start: "(", end: ")"},
            alternatormarker: "|",
            escapeChar: "\\",
            mask: null,
            oncomplete: a.noop,
            onincomplete: a.noop,
            oncleared: a.noop,
            repeat: 0,
            greedy: !0,
            autoUnmask: !1,
            removeMaskOnSubmit: !1,
            clearMaskOnLostFocus: !0,
            insertMode: !0,
            clearIncomplete: !1,
            aliases: {},
            alias: null,
            onKeyDown: a.noop,
            onBeforeMask: void 0,
            onBeforePaste: void 0,
            onBeforeWrite: void 0,
            onUnMask: void 0,
            showMaskOnFocus: !0,
            showMaskOnHover: !0,
            onKeyValidation: a.noop,
            skipOptionalPartCharacter: " ",
            showTooltip: !1,
            numericInput: !1,
            rightAlign: !1,
            undoOnEscape: !0,
            radixPoint: "",
            groupSeparator: "",
            radixFocus: !1,
            nojumps: !1,
            nojumpsThreshold: 0,
            keepStatic: void 0,
            positionCaretOnTab: !1,
            definitions: {
                9: {validator: "[0-9]", cardinality: 1, definitionSymbol: "*"},
                a: {validator: "[A-Za-z\u0410-\u044f\u0401\u0451\xc0-\xff\xb5]", cardinality: 1, definitionSymbol: "*"},
                "*": {validator: "[0-9A-Za-z\u0410-\u044f\u0401\u0451\xc0-\xff\xb5]", cardinality: 1}
            },
            ignorables: [8, 9, 13, 19, 27, 33, 34, 35, 36, 37, 38, 39, 40, 45, 46, 93, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123],
            isComplete: void 0,
            canClearPosition: a.noop,
            postValidation: void 0
        }, masksCache: {}, mask: function (c) {
            var d = c.jquery && c.length > 0 ? c[0] : c, e = a.extend(!0, {}, this.opts);
            f(c, e, a.extend(!0, {}, this.userOptions));
            var i = g(e, this.noMasksCache);
            return void 0 != i && (d.inputmask = new b, d.inputmask.opts = e, d.inputmask.noMasksCache = this.noMasksCache, d.inputmask.el = d, d.inputmask.maskset = i, d.inputmask.isRTL = !1, h({
                action: "mask",
                el: d
            }, i, d.inputmask.opts)), c
        }, unmaskedvalue: function () {
            return this.el ? h({action: "unmaskedvalue", el: this.el}) : void 0
        }, remove: function () {
            return this.el ? (h({action: "remove", el: this.el}), this.el.inputmask = void 0, this.el) : void 0
        }, getemptymask: function () {
            return this.el ? h({action: "getemptymask", el: this.el}) : void 0
        }, hasMaskedValue: function () {
            return !this.opts.autoUnmask
        }, isComplete: function () {
            return this.el ? h({action: "isComplete", buffer: this.el._valueGet().split(""), el: this.el}) : void 0
        }, getmetadata: function () {
            return this.el ? h({action: "getmetadata", el: this.el}) : void 0
        }
    }, b.extendDefaults = function (c) {
        a.extend(b.prototype.defaults, c)
    }, b.extendDefinitions = function (c) {
        a.extend(b.prototype.defaults.definitions, c)
    }, b.extendAliases = function (c) {
        a.extend(b.prototype.defaults.aliases, c)
    }, b.format = function (c, d, f) {
        var i = a.extend(!0, {}, b.prototype.defaults, d);
        return e(i.alias, d, i), h({action: "format", value: c, metadata: f}, g(i, d && void 0 !== d.definitions), i)
    }, b.unmask = function (c, d) {
        var f = a.extend(!0, {}, b.prototype.defaults, d);
        return e(f.alias, d, f), h({action: "unmaskedvalue", value: c}, g(f, d && void 0 !== d.definitions), f)
    }, b.isValid = function (c, d) {
        var f = a.extend(!0, {}, b.prototype.defaults, d);
        return e(f.alias, d, f), h({action: "isValid", value: c}, g(f, d && void 0 !== d.definitions), f)
    }, b.escapeRegex = function (a) {
        var b = ["/", ".", "*", "+", "?", "|", "(", ")", "[", "]", "{", "}", "\\", "$", "^"];
        return a.replace(new RegExp("(\\" + b.join("|\\") + ")", "gim"), "\\$1")
    }, b.keyCode = {
        ALT: 18,
        BACKSPACE: 8,
        CAPS_LOCK: 20,
        COMMA: 188,
        COMMAND: 91,
        COMMAND_LEFT: 91,
        COMMAND_RIGHT: 93,
        CONTROL: 17,
        DELETE: 46,
        DOWN: 40,
        END: 35,
        ENTER: 13,
        ESCAPE: 27,
        HOME: 36,
        INSERT: 45,
        LEFT: 37,
        MENU: 93,
        NUMPAD_ADD: 107,
        NUMPAD_DECIMAL: 110,
        NUMPAD_DIVIDE: 111,
        NUMPAD_ENTER: 108,
        NUMPAD_MULTIPLY: 106,
        NUMPAD_SUBTRACT: 109,
        PAGE_DOWN: 34,
        PAGE_UP: 33,
        PERIOD: 190,
        RIGHT: 39,
        SHIFT: 16,
        SPACE: 32,
        TAB: 9,
        UP: 38,
        WINDOWS: 91
    };
    var i = navigator.userAgent, j = null !== i.match(new RegExp("iphone", "i")), k = (null !== i.match(new RegExp("android.*safari.*", "i")), null !== i.match(new RegExp("android.*chrome.*", "i"))), l = null !== i.match(new RegExp("android.*firefox.*", "i")), m = (/Kindle/i.test(i) || /Silk/i.test(i) || /KFTT/i.test(i) || /KFOT/i.test(i) || /KFJWA/i.test(i) || /KFJWI/i.test(i) || /KFSOWI/i.test(i) || /KFTHWA/i.test(i) || /KFTHWI/i.test(i) || /KFAPWA/i.test(i) || /KFAPWI/i.test(i), c("paste") ? "paste" : c("input") ? "input" : "propertychange");
    return window.inputmask = b, b
}(jQuery), function (a) {
    return void 0 === a.fn.inputmask && (a.fn.inputmask = function (b, c) {
        var d;
        if (c = c || {}, "string" == typeof b)switch (b) {
            case"mask":
                return d = new inputmask(c), this.each(function () {
                    d.mask(this)
                });
            case"unmaskedvalue":
                var e = this.jquery && this.length > 0 ? this[0] : this;
                return e.inputmask ? e.inputmask.unmaskedvalue() : a(e).val();
            case"remove":
                return this.each(function () {
                    this.inputmask && this.inputmask.remove()
                });
            case"getemptymask":
                var e = this.jquery && this.length > 0 ? this[0] : this;
                return e.inputmask ? e.inputmask.getemptymask() : "";
            case"hasMaskedValue":
                var e = this.jquery && this.length > 0 ? this[0] : this;
                return e.inputmask ? e.inputmask.hasMaskedValue() : !1;
            case"isComplete":
                var e = this.jquery && this.length > 0 ? this[0] : this;
                return e.inputmask ? e.inputmask.isComplete() : !0;
            case"getmetadata":
                var e = this.jquery && this.length > 0 ? this[0] : this;
                return e.inputmask ? e.inputmask.getmetadata() : void 0;
            default:
                return c.alias = b, d = new inputmask(c), this.each(function () {
                    d.mask(this)
                })
        } else {
            if ("object" == typeof b)return d = new inputmask(b), this.each(function () {
                d.mask(this)
            });
            if (void 0 == b)return this.each(function () {
                d = new inputmask(c), d.mask(this)
            })
        }
    }), a.fn.inputmask
}(jQuery), function (a) {
    return inputmask.extendDefinitions({
        h: {
            validator: "[01][0-9]|2[0-3]",
            cardinality: 2,
            prevalidator: [{validator: "[0-2]", cardinality: 1}]
        },
        s: {validator: "[0-5][0-9]", cardinality: 2, prevalidator: [{validator: "[0-5]", cardinality: 1}]},
        d: {validator: "0[1-9]|[12][0-9]|3[01]", cardinality: 2, prevalidator: [{validator: "[0-3]", cardinality: 1}]},
        m: {validator: "0[1-9]|1[012]", cardinality: 2, prevalidator: [{validator: "[01]", cardinality: 1}]},
        y: {
            validator: "(19|20)\\d{2}",
            cardinality: 4,
            prevalidator: [{validator: "[12]", cardinality: 1}, {
                validator: "(19|20)",
                cardinality: 2
            }, {validator: "(19|20)\\d", cardinality: 3}]
        }
    }), inputmask.extendAliases({
        "dd/mm/yyyy": {
            mask: "1/2/y",
            placeholder: "dd/mm/yyyy",
            regex: {
                val1pre: new RegExp("[0-3]"), val1: new RegExp("0[1-9]|[12][0-9]|3[01]"), val2pre: function (a) {
                    var b = inputmask.escapeRegex.call(this, a);
                    return new RegExp("((0[1-9]|[12][0-9]|3[01])" + b + "[01])")
                }, val2: function (a) {
                    var b = inputmask.escapeRegex.call(this, a);
                    return new RegExp("((0[1-9]|[12][0-9])" + b + "(0[1-9]|1[012]))|(30" + b + "(0[13-9]|1[012]))|(31" + b + "(0[13578]|1[02]))")
                }
            },
            leapday: "29/02/",
            separator: "/",
            yearrange: {minyear: 1900, maxyear: 2099},
            isInYearRange: function (a, b, c) {
                if (isNaN(a))return !1;
                var d = parseInt(a.concat(b.toString().slice(a.length))), e = parseInt(a.concat(c.toString().slice(a.length)));
                return (isNaN(d) ? !1 : d >= b && c >= d) || (isNaN(e) ? !1 : e >= b && c >= e)
            },
            determinebaseyear: function (a, b, c) {
                var d = (new Date).getFullYear();
                if (a > d)return a;
                if (d > b) {
                    for (var e = b.toString().slice(0, 2), f = b.toString().slice(2, 4); e + c > b;)e--;
                    var g = e + f;
                    return a > g ? a : g
                }
                return d
            },
            onKeyDown: function (b, c, d, e) {
                var f = a(this);
                if (b.ctrlKey && b.keyCode == inputmask.keyCode.RIGHT) {
                    var g = new Date;
                    f.val(g.getDate().toString() + (g.getMonth() + 1).toString() + g.getFullYear().toString()), f.triggerHandler("setvalue.inputmask")
                }
            },
            getFrontValue: function (a, b, c) {
                for (var d = 0, e = 0, f = 0; f < a.length && "2" != a.charAt(f); f++) {
                    var g = c.definitions[a.charAt(f)];
                    g ? (d += e, e = g.cardinality) : e++
                }
                return b.join("").substr(d, e)
            },
            definitions: {
                1: {
                    validator: function (a, b, c, d, e) {
                        var f = e.regex.val1.test(a);
                        return d || f || a.charAt(1) != e.separator && -1 == "-./".indexOf(a.charAt(1)) || !(f = e.regex.val1.test("0" + a.charAt(0))) ? f : (b.buffer[c - 1] = "0", {
                            refreshFromBuffer: {
                                start: c - 1,
                                end: c
                            }, pos: c, c: a.charAt(0)
                        })
                    }, cardinality: 2, prevalidator: [{
                        validator: function (a, b, c, d, e) {
                            var f = a;
                            isNaN(b.buffer[c + 1]) || (f += b.buffer[c + 1]);
                            var g = 1 == f.length ? e.regex.val1pre.test(f) : e.regex.val1.test(f);
                            if (!d && !g) {
                                if (g = e.regex.val1.test(a + "0"))return b.buffer[c] = a, b.buffer[++c] = "0", {
                                    pos: c,
                                    c: "0"
                                };
                                if (g = e.regex.val1.test("0" + a))return b.buffer[c] = "0", c++, {pos: c}
                            }
                            return g
                        }, cardinality: 1
                    }]
                }, 2: {
                    validator: function (a, b, c, d, e) {
                        var f = e.getFrontValue(b.mask, b.buffer, e);
                        -1 != f.indexOf(e.placeholder[0]) && (f = "01" + e.separator);
                        var g = e.regex.val2(e.separator).test(f + a);
                        if (!d && !g && (a.charAt(1) == e.separator || -1 != "-./".indexOf(a.charAt(1))) && (g = e.regex.val2(e.separator).test(f + "0" + a.charAt(0))))return b.buffer[c - 1] = "0", {
                            refreshFromBuffer: {
                                start: c - 1,
                                end: c
                            }, pos: c, c: a.charAt(0)
                        };
                        if (e.mask.indexOf("2") == e.mask.length - 1 && g) {
                            var h = b.buffer.join("").substr(4, 4) + a;
                            if (h != e.leapday)return !0;
                            var i = parseInt(b.buffer.join("").substr(0, 4), 10);
                            return i % 4 === 0 ? i % 100 === 0 ? i % 400 === 0 ? !0 : !1 : !0 : !1
                        }
                        return g
                    }, cardinality: 2, prevalidator: [{
                        validator: function (a, b, c, d, e) {
                            isNaN(b.buffer[c + 1]) || (a += b.buffer[c + 1]);
                            var f = e.getFrontValue(b.mask, b.buffer, e);
                            -1 != f.indexOf(e.placeholder[0]) && (f = "01" + e.separator);
                            var g = 1 == a.length ? e.regex.val2pre(e.separator).test(f + a) : e.regex.val2(e.separator).test(f + a);
                            return d || g || !(g = e.regex.val2(e.separator).test(f + "0" + a)) ? g : (b.buffer[c] = "0", c++, {pos: c})
                        }, cardinality: 1
                    }]
                }, y: {
                    validator: function (a, b, c, d, e) {
                        if (e.isInYearRange(a, e.yearrange.minyear, e.yearrange.maxyear)) {
                            var f = b.buffer.join("").substr(0, 6);
                            if (f != e.leapday)return !0;
                            var g = parseInt(a, 10);
                            return g % 4 === 0 ? g % 100 === 0 ? g % 400 === 0 ? !0 : !1 : !0 : !1
                        }
                        return !1
                    }, cardinality: 4, prevalidator: [{
                        validator: function (a, b, c, d, e) {
                            var f = e.isInYearRange(a, e.yearrange.minyear, e.yearrange.maxyear);
                            if (!d && !f) {
                                var g = e.determinebaseyear(e.yearrange.minyear, e.yearrange.maxyear, a + "0").toString().slice(0, 1);
                                if (f = e.isInYearRange(g + a, e.yearrange.minyear, e.yearrange.maxyear))return b.buffer[c++] = g.charAt(0), {pos: c};
                                if (g = e.determinebaseyear(e.yearrange.minyear, e.yearrange.maxyear, a + "0").toString().slice(0, 2), f = e.isInYearRange(g + a, e.yearrange.minyear, e.yearrange.maxyear))return b.buffer[c++] = g.charAt(0), b.buffer[c++] = g.charAt(1), {pos: c}
                            }
                            return f
                        }, cardinality: 1
                    }, {
                        validator: function (a, b, c, d, e) {
                            var f = e.isInYearRange(a, e.yearrange.minyear, e.yearrange.maxyear);
                            if (!d && !f) {
                                var g = e.determinebaseyear(e.yearrange.minyear, e.yearrange.maxyear, a).toString().slice(0, 2);
                                if (f = e.isInYearRange(a[0] + g[1] + a[1], e.yearrange.minyear, e.yearrange.maxyear))return b.buffer[c++] = g.charAt(1), {pos: c};
                                if (g = e.determinebaseyear(e.yearrange.minyear, e.yearrange.maxyear, a).toString().slice(0, 2), e.isInYearRange(g + a, e.yearrange.minyear, e.yearrange.maxyear)) {
                                    var h = b.buffer.join("").substr(0, 6);
                                    if (h != e.leapday)f = !0; else {
                                        var i = parseInt(a, 10);
                                        f = i % 4 === 0 ? i % 100 === 0 ? i % 400 === 0 ? !0 : !1 : !0 : !1
                                    }
                                } else f = !1;
                                if (f)return b.buffer[c - 1] = g.charAt(0), b.buffer[c++] = g.charAt(1), b.buffer[c++] = a.charAt(0), {
                                    refreshFromBuffer: {
                                        start: c - 3,
                                        end: c
                                    }, pos: c
                                }
                            }
                            return f
                        }, cardinality: 2
                    }, {
                        validator: function (a, b, c, d, e) {
                            return e.isInYearRange(a, e.yearrange.minyear, e.yearrange.maxyear)
                        }, cardinality: 3
                    }]
                }
            },
            insertMode: !1,
            autoUnmask: !1
        },
        "mm/dd/yyyy": {
            placeholder: "mm/dd/yyyy", alias: "dd/mm/yyyy", regex: {
                val2pre: function (a) {
                    var b = inputmask.escapeRegex.call(this, a);
                    return new RegExp("((0[13-9]|1[012])" + b + "[0-3])|(02" + b + "[0-2])")
                }, val2: function (a) {
                    var b = inputmask.escapeRegex.call(this, a);
                    return new RegExp("((0[1-9]|1[012])" + b + "(0[1-9]|[12][0-9]))|((0[13-9]|1[012])" + b + "30)|((0[13578]|1[02])" + b + "31)")
                }, val1pre: new RegExp("[01]"), val1: new RegExp("0[1-9]|1[012]")
            }, leapday: "02/29/", onKeyDown: function (b, c, d, e) {
                var f = a(this);
                if (b.ctrlKey && b.keyCode == inputmask.keyCode.RIGHT) {
                    var g = new Date;
                    f.val((g.getMonth() + 1).toString() + g.getDate().toString() + g.getFullYear().toString()), f.triggerHandler("setvalue.inputmask")
                }
            }
        },
        "yyyy/mm/dd": {
            mask: "y/1/2",
            placeholder: "yyyy/mm/dd",
            alias: "mm/dd/yyyy",
            leapday: "/02/29",
            onKeyDown: function (b, c, d, e) {
                var f = a(this);
                if (b.ctrlKey && b.keyCode == inputmask.keyCode.RIGHT) {
                    var g = new Date;
                    f.val(g.getFullYear().toString() + (g.getMonth() + 1).toString() + g.getDate().toString()), f.triggerHandler("setvalue.inputmask")
                }
            }
        },
        "dd.mm.yyyy": {
            mask: "1.2.y",
            placeholder: "dd.mm.yyyy",
            leapday: "29.02.",
            separator: ".",
            alias: "dd/mm/yyyy"
        },
        "dd-mm-yyyy": {
            mask: "1-2-y",
            placeholder: "dd-mm-yyyy",
            leapday: "29-02-",
            separator: "-",
            alias: "dd/mm/yyyy"
        },
        "mm.dd.yyyy": {
            mask: "1.2.y",
            placeholder: "mm.dd.yyyy",
            leapday: "02.29.",
            separator: ".",
            alias: "mm/dd/yyyy"
        },
        "mm-dd-yyyy": {
            mask: "1-2-y",
            placeholder: "mm-dd-yyyy",
            leapday: "02-29-",
            separator: "-",
            alias: "mm/dd/yyyy"
        },
        "yyyy.mm.dd": {
            mask: "y.1.2",
            placeholder: "yyyy.mm.dd",
            leapday: ".02.29",
            separator: ".",
            alias: "yyyy/mm/dd"
        },
        "yyyy-mm-dd": {
            mask: "y-1-2",
            placeholder: "yyyy-mm-dd",
            leapday: "-02-29",
            separator: "-",
            alias: "yyyy/mm/dd"
        },
        datetime: {
            mask: "1/2/y h:s",
            placeholder: "dd/mm/yyyy hh:mm",
            alias: "dd/mm/yyyy",
            regex: {
                hrspre: new RegExp("[012]"),
                hrs24: new RegExp("2[0-4]|1[3-9]"),
                hrs: new RegExp("[01][0-9]|2[0-4]"),
                ampm: new RegExp("^[a|p|A|P][m|M]"),
                mspre: new RegExp("[0-5]"),
                ms: new RegExp("[0-5][0-9]")
            },
            timeseparator: ":",
            hourFormat: "24",
            definitions: {
                h: {
                    validator: function (a, b, c, d, e) {
                        if ("24" == e.hourFormat && 24 == parseInt(a, 10))return b.buffer[c - 1] = "0", b.buffer[c] = "0", {
                            refreshFromBuffer: {
                                start: c - 1,
                                end: c
                            }, c: "0"
                        };
                        var f = e.regex.hrs.test(a);
                        if (!d && !f && (a.charAt(1) == e.timeseparator || -1 != "-.:".indexOf(a.charAt(1))) && (f = e.regex.hrs.test("0" + a.charAt(0))))return b.buffer[c - 1] = "0", b.buffer[c] = a.charAt(0), c++, {
                            refreshFromBuffer: {
                                start: c - 2,
                                end: c
                            }, pos: c, c: e.timeseparator
                        };
                        if (f && "24" !== e.hourFormat && e.regex.hrs24.test(a)) {
                            var g = parseInt(a, 10);
                            return 24 == g ? (b.buffer[c + 5] = "a", b.buffer[c + 6] = "m") : (b.buffer[c + 5] = "p", b.buffer[c + 6] = "m"), g -= 12, 10 > g ? (b.buffer[c] = g.toString(), b.buffer[c - 1] = "0") : (b.buffer[c] = g.toString().charAt(1), b.buffer[c - 1] = g.toString().charAt(0)), {
                                refreshFromBuffer: {
                                    start: c - 1,
                                    end: c + 6
                                }, c: b.buffer[c]
                            }
                        }
                        return f
                    }, cardinality: 2, prevalidator: [{
                        validator: function (a, b, c, d, e) {
                            var f = e.regex.hrspre.test(a);
                            return d || f || !(f = e.regex.hrs.test("0" + a)) ? f : (b.buffer[c] = "0", c++, {pos: c})
                        }, cardinality: 1
                    }]
                }, s: {
                    validator: "[0-5][0-9]", cardinality: 2, prevalidator: [{
                        validator: function (a, b, c, d, e) {
                            var f = e.regex.mspre.test(a);
                            return d || f || !(f = e.regex.ms.test("0" + a)) ? f : (b.buffer[c] = "0", c++, {pos: c})
                        }, cardinality: 1
                    }]
                }, t: {
                    validator: function (a, b, c, d, e) {
                        return e.regex.ampm.test(a + "m")
                    }, casing: "lower", cardinality: 1
                }
            },
            insertMode: !1,
            autoUnmask: !1
        },
        datetime12: {mask: "1/2/y h:s t\\m", placeholder: "dd/mm/yyyy hh:mm xm", alias: "datetime", hourFormat: "12"},
        "hh:mm t": {mask: "h:s t\\m", placeholder: "hh:mm xm", alias: "datetime", hourFormat: "12"},
        "h:s t": {mask: "h:s t\\m", placeholder: "hh:mm xm", alias: "datetime", hourFormat: "12"},
        "hh:mm:ss": {mask: "h:s:s", placeholder: "hh:mm:ss", alias: "datetime", autoUnmask: !1},
        "hh:mm": {mask: "h:s", placeholder: "hh:mm", alias: "datetime", autoUnmask: !1},
        date: {alias: "dd/mm/yyyy"},
        "mm/yyyy": {mask: "1/y", placeholder: "mm/yyyy", leapday: "donotuse", separator: "/", alias: "mm/dd/yyyy"},
        shamsi: {
            regex: {
                val2pre: function (a) {
                    var b = inputmask.escapeRegex.call(this, a);
                    return new RegExp("((0[1-9]|1[012])" + b + "[0-3])")
                }, val2: function (a) {
                    var b = inputmask.escapeRegex.call(this, a);
                    return new RegExp("((0[1-9]|1[012])" + b + "(0[1-9]|[12][0-9]))|((0[1-9]|1[012])" + b + "30)|((0[1-6])" + b + "31)")
                }, val1pre: new RegExp("[01]"), val1: new RegExp("0[1-9]|1[012]")
            },
            yearrange: {minyear: 1300, maxyear: 1499},
            mask: "y/1/2",
            leapday: "/12/30",
            placeholder: "yyyy/mm/dd",
            alias: "mm/dd/yyyy",
            clearIncomplete: !0
        }
    }), inputmask
}(jQuery), function (a) {
    return inputmask.extendDefinitions({
        A: {
            validator: "[A-Za-z\u0410-\u044f\u0401\u0451\xc0-\xff\xb5]",
            cardinality: 1,
            casing: "upper"
        },
        "&": {validator: "[0-9A-Za-z\u0410-\u044f\u0401\u0451\xc0-\xff\xb5]", cardinality: 1, casing: "upper"},
        "#": {validator: "[0-9A-Fa-f]", cardinality: 1, casing: "upper"}
    }), inputmask.extendAliases({
        url: {
            mask: "ir",
            placeholder: "",
            separator: "",
            defaultPrefix: "http://",
            regex: {
                urlpre1: new RegExp("[fh]"),
                urlpre2: new RegExp("(ft|ht)"),
                urlpre3: new RegExp("(ftp|htt)"),
                urlpre4: new RegExp("(ftp:|http|ftps)"),
                urlpre5: new RegExp("(ftp:/|ftps:|http:|https)"),
                urlpre6: new RegExp("(ftp://|ftps:/|http:/|https:)"),
                urlpre7: new RegExp("(ftp://|ftps://|http://|https:/)"),
                urlpre8: new RegExp("(ftp://|ftps://|http://|https://)")
            },
            definitions: {
                i: {
                    validator: function (a, b, c, d, e) {
                        return !0
                    }, cardinality: 8, prevalidator: function () {
                        for (var a = [], b = 8, c = 0; b > c; c++)a[c] = function () {
                            var a = c;
                            return {
                                validator: function (b, c, d, e, f) {
                                    if (f.regex["urlpre" + (a + 1)]) {
                                        var g, h = b;
                                        a + 1 - b.length > 0 && (h = c.buffer.join("").substring(0, a + 1 - b.length) + "" + h);
                                        var i = f.regex["urlpre" + (a + 1)].test(h);
                                        if (!e && !i) {
                                            for (d -= a, g = 0; g < f.defaultPrefix.length; g++)c.buffer[d] = f.defaultPrefix[g], d++;
                                            for (g = 0; g < h.length - 1; g++)c.buffer[d] = h[g], d++;
                                            return {pos: d}
                                        }
                                        return i
                                    }
                                    return !1
                                }, cardinality: a
                            }
                        }();
                        return a
                    }()
                }, r: {validator: ".", cardinality: 50}
            },
            insertMode: !1,
            autoUnmask: !1
        },
        ip: {
            mask: "i[i[i]].i[i[i]].i[i[i]].i[i[i]]", definitions: {
                i: {
                    validator: function (a, b, c, d, e) {
                        return c - 1 > -1 && "." != b.buffer[c - 1] ? (a = b.buffer[c - 1] + a, a = c - 2 > -1 && "." != b.buffer[c - 2] ? b.buffer[c - 2] + a : "0" + a) : a = "00" + a, new RegExp("25[0-5]|2[0-4][0-9]|[01][0-9][0-9]").test(a)
                    }, cardinality: 1
                }
            }
        },
        email: {
            mask: "*{1,64}[.*{1,64}][.*{1,64}][.*{1,64}]@*{1,64}[.*{2,64}][.*{2,6}][.*{1,2}]",
            greedy: !1,
            onBeforePaste: function (a, b) {
                return a = a.toLowerCase(), a.replace("mailto:", "")
            },
            definitions: {"*": {validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~-]", cardinality: 1, casing: "lower"}}
        }
    }), inputmask
}(jQuery), function (a) {
    return inputmask.extendAliases({
        numeric: {
            mask: function (a) {
                function b(b) {
                    for (var c = "", d = 0; d < b.length; d++)c += a.definitions[b[d]] ? "\\" + b[d] : b[d];
                    return c
                }

                if (0 !== a.repeat && isNaN(a.integerDigits) && (a.integerDigits = a.repeat), a.repeat = 0, a.groupSeparator == a.radixPoint && ("." == a.radixPoint ? a.groupSeparator = "," : "," == a.radixPoint ? a.groupSeparator = "." : a.groupSeparator = ""), " " === a.groupSeparator && (a.skipOptionalPartCharacter = void 0), a.autoGroup = a.autoGroup && "" != a.groupSeparator, a.autoGroup && ("string" == typeof a.groupSize && isFinite(a.groupSize) && (a.groupSize = parseInt(a.groupSize)), isFinite(a.integerDigits))) {
                    var c = Math.floor(a.integerDigits / a.groupSize), d = a.integerDigits % a.groupSize;
                    a.integerDigits = parseInt(a.integerDigits) + (0 == d ? c - 1 : c)
                }
                a.placeholder.length > 1 && (a.placeholder = a.placeholder.charAt(0)), a.definitions[";"] = a.definitions["~"], a.definitions[";"].definitionSymbol = "~", 1 == a.numericInput && (a.radixFocus = !1, a.digitsOptional = !1, isNaN(a.digits) && (a.digits = 2), a.decimalProtect = !1);
                var e = b(a.prefix);
                return e += "[+]", e += "~{1," + a.integerDigits + "}", void 0 != a.digits && (isNaN(a.digits) || parseInt(a.digits) > 0) && (e += a.digitsOptional ? "[" + (a.decimalProtect ? ":" : a.radixPoint) + ";{" + a.digits + "}]" : (a.decimalProtect ? ":" : a.radixPoint) + ";{" + a.digits + "}"), "" != a.negationSymbol.back && (e += "[-]"), e += b(a.suffix), a.greedy = !1, e
            },
            placeholder: "",
            greedy: !1,
            digits: "*",
            digitsOptional: !0,
            radixPoint: ".",
            radixFocus: !0,
            groupSize: 3,
            groupSeparator: "",
            autoGroup: !1,
            allowPlus: !0,
            allowMinus: !0,
            negationSymbol: {front: "-", back: ""},
            integerDigits: "+",
            prefix: "",
            suffix: "",
            rightAlign: !0,
            decimalProtect: !0,
            min: void 0,
            max: void 0,
            step: 1,
            insertMode: !0,
            autoUnmask: !1,
            unmaskAsNumber: !1,
            postFormat: function (b, c, d, e) {
                e.numericInput === !0 && (b = b.reverse(), isFinite(c) && (c = b.join("").length - c - 1));
                var f = !1;
                b.length >= e.suffix.length && b.join("").indexOf(e.suffix) == b.length - e.suffix.length && (b.length = b.length - e.suffix.length, f = !0), c = c >= b.length ? b.length - 1 : c < e.prefix.length ? e.prefix.length : c;
                var g = !1, h = b[c];
                if ("" == e.groupSeparator || e.numericInput !== !0 && -1 != a.inArray(e.radixPoint, b) && c > a.inArray(e.radixPoint, b) || new RegExp("[" + inputmask.escapeRegex(e.negationSymbol.front) + "+]").test(h)) {
                    if (f)for (var i = 0, j = e.suffix.length; j > i; i++)b.push(e.suffix.charAt(i));
                    return {pos: c}
                }
                var k = b.slice();
                h == e.groupSeparator && (k.splice(c--, 1), h = k[c]), d ? h != e.radixPoint && (k[c] = "?") : k.splice(c, 0, "?");
                var l = k.join(""), m = l;
                if (l.length > 0 && e.autoGroup || d && -1 != l.indexOf(e.groupSeparator)) {
                    var n = inputmask.escapeRegex(e.groupSeparator);
                    g = 0 == l.indexOf(e.groupSeparator), l = l.replace(new RegExp(n, "g"), "");
                    var o = l.split(e.radixPoint);
                    if (l = "" == e.radixPoint ? l : o[0], l != e.prefix + "?0" && l.length >= e.groupSize + e.prefix.length)for (var p = new RegExp("([-+]?[\\d?]+)([\\d?]{" + e.groupSize + "})"); p.test(l);)l = l.replace(p, "$1" + e.groupSeparator + "$2"), l = l.replace(e.groupSeparator + e.groupSeparator, e.groupSeparator);
                    "" != e.radixPoint && o.length > 1 && (l += e.radixPoint + o[1])
                }
                g = m != l, b.length = l.length;
                for (var i = 0, j = l.length; j > i; i++)b[i] = l.charAt(i);
                var q = a.inArray("?", b);
                if (-1 == q && h == e.radixPoint && (q = a.inArray(e.radixPoint, b)), d ? b[q] = h : b.splice(q, 1), !g && f)for (var i = 0, j = e.suffix.length; j > i; i++)b.push(e.suffix.charAt(i));
                return {
                    pos: e.numericInput && isFinite(c) ? b.join("").length - q - 1 : q,
                    refreshFromBuffer: g,
                    buffer: e.numericInput === !0 ? b.reverse() : b
                }
            },
            onBeforeWrite: function (b, c, d, e) {
                if (b && "blur" == b.type) {
                    var f = c.join(""), g = f.replace(e.prefix, "");
                    if (g = g.replace(e.suffix, ""), g = g.replace(new RegExp(inputmask.escapeRegex(e.groupSeparator), "g"), ""), "," === e.radixPoint && (g = g.replace(inputmask.escapeRegex(e.radixPoint), ".")), isFinite(g) && isFinite(e.min) && parseFloat(g) < parseFloat(e.min))return a.extend(!0, {
                        refreshFromBuffer: !0,
                        buffer: (e.prefix + e.min).split("")
                    }, e.postFormat((e.prefix + e.min).split(""), 0, !0, e));
                    if (e.numericInput !== !0) {
                        var h = "" != e.radixPoint ? c.join("").split(e.radixPoint) : [c.join("")], i = h[0].match(e.regex.integerPart(e)), j = 2 == h.length ? h[1].match(e.regex.integerNPart(e)) : void 0;

                        !i || i[0] != e.negationSymbol.front + "0" && i[0] != e.negationSymbol.front && "+" != i[0] || void 0 != j && !j[0].match(/^0+$/) || c.splice(i.index, 1);
                        var k = a.inArray(e.radixPoint, c);
                        if (-1 != k && isFinite(e.digits) && !e.digitsOptional) {
                            for (var l = 1; l <= e.digits; l++)(void 0 == c[k + l] || c[k + l] == e.placeholder.charAt(0)) && (c[k + l] = "0");
                            return {refreshFromBuffer: !0, buffer: c}
                        }
                    }
                }
                if (e.autoGroup) {
                    var m = e.postFormat(c, d - 1, !0, e);
                    return m.caret = d <= e.prefix.length ? m.pos : m.pos + 1, m
                }
            },
            regex: {
                integerPart: function (a) {
                    return new RegExp("[" + inputmask.escapeRegex(a.negationSymbol.front) + "+]?\\d+")
                }, integerNPart: function (a) {
                    return new RegExp("[\\d" + inputmask.escapeRegex(a.groupSeparator) + "]+")
                }
            },
            signHandler: function (a, b, c, d, e) {
                if (!d && e.allowMinus && "-" === a || e.allowPlus && "+" === a) {
                    var f = b.buffer.join("").match(e.regex.integerPart(e));
                    if (f && f[0].length > 0)return b.buffer[f.index] == ("-" === a ? "+" : e.negationSymbol.front) ? "-" == a ? "" != e.negationSymbol.back ? {
                        pos: f.index,
                        c: e.negationSymbol.front,
                        remove: f.index,
                        caret: c,
                        insert: {pos: b.buffer.length - e.suffix.length - 1, c: e.negationSymbol.back}
                    } : {
                        pos: f.index,
                        c: e.negationSymbol.front,
                        remove: f.index,
                        caret: c
                    } : "" != e.negationSymbol.back ? {
                        pos: f.index,
                        c: "+",
                        remove: [f.index, b.buffer.length - e.suffix.length - 1],
                        caret: c
                    } : {
                        pos: f.index,
                        c: "+",
                        remove: f.index,
                        caret: c
                    } : b.buffer[f.index] == ("-" === a ? e.negationSymbol.front : "+") ? "-" == a && "" != e.negationSymbol.back ? {
                        remove: [f.index, b.buffer.length - e.suffix.length - 1],
                        caret: c - 1
                    } : {remove: f.index, caret: c - 1} : "-" == a ? "" != e.negationSymbol.back ? {
                        pos: f.index,
                        c: e.negationSymbol.front,
                        caret: c + 1,
                        insert: {pos: b.buffer.length - e.suffix.length, c: e.negationSymbol.back}
                    } : {pos: f.index, c: e.negationSymbol.front, caret: c + 1} : {pos: f.index, c: a, caret: c + 1}
                }
                return !1
            },
            radixHandler: function (b, c, d, e, f) {
                if (!e && (-1 != a.inArray(b, [",", "."]) && (b = f.radixPoint), b === f.radixPoint && void 0 != f.digits && (isNaN(f.digits) || parseInt(f.digits) > 0))) {
                    var g = a.inArray(f.radixPoint, c.buffer), h = c.buffer.join("").match(f.regex.integerPart(f));
                    if (-1 != g && c.validPositions[g])return c.validPositions[g - 1] ? {caret: g + 1} : {
                        pos: h.index,
                        c: h[0],
                        caret: g + 1
                    };
                    if (!h || "0" == h[0] && h.index + 1 != d)return c.buffer[h ? h.index : d] = "0", {
                        pos: (h ? h.index : d) + 1,
                        c: f.radixPoint
                    }
                }
                return !1
            },
            leadingZeroHandler: function (b, c, d, e, f) {
                if (1 == f.numericInput) {
                    if ("0" == c.buffer[c.buffer.length - f.prefix.length - 1])return {
                        pos: d,
                        remove: c.buffer.length - f.prefix.length - 1
                    }
                } else {
                    var g = c.buffer.join("").match(f.regex.integerNPart(f)), h = a.inArray(f.radixPoint, c.buffer);
                    if (g && !e && (-1 == h || h >= d))if (0 == g[0].indexOf("0")) {
                        d < f.prefix.length && (d = g.index);
                        var i = a.inArray(f.radixPoint, c._buffer), j = c._buffer && c.buffer.slice(h).join("") == c._buffer.slice(i).join("") || 0 == parseInt(c.buffer.slice(h + 1).join("")), k = c._buffer && c.buffer.slice(g.index, h).join("") == c._buffer.slice(f.prefix.length, i).join("") || "0" == c.buffer.slice(g.index, h).join("");
                        if (-1 == h || j && k)return c.buffer.splice(g.index, 1), d = d > g.index ? d - 1 : g.index, {
                            pos: d,
                            remove: g.index
                        };
                        if (g.index + 1 == d || "0" == b)return c.buffer.splice(g.index, 1), d = g.index, {
                            pos: d,
                            remove: g.index
                        }
                    } else if ("0" === b && d <= g.index && g[0] != f.groupSeparator)return !1
                }
                return !0
            },
            postValidation: function (b, c) {
                var d = !0, e = b.join(""), f = e.replace(c.prefix, "");
                return f = f.replace(c.suffix, ""), f = f.replace(new RegExp(inputmask.escapeRegex(c.groupSeparator), "g"), ""), "," === c.radixPoint && (f = f.replace(inputmask.escapeRegex(c.radixPoint), ".")), f = f.replace(new RegExp("^" + inputmask.escapeRegex(c.negationSymbol.front)), "-"), f = f.replace(new RegExp(inputmask.escapeRegex(c.negationSymbol.back) + "$"), ""), f = f == c.negationSymbol.front ? f + "0" : f, isFinite(f) && (isFinite(c.max) && (d = parseFloat(f) <= parseFloat(c.max)), d && isFinite(c.min) && (0 >= f || f.toString().length >= c.min.toString().length) && (d = parseFloat(f) >= parseFloat(c.min), d || (d = a.extend(!0, {
                    refreshFromBuffer: !0,
                    buffer: (c.prefix + c.min).split("")
                }, c.postFormat((c.prefix + c.min).split(""), 0, !0, c)), d.refreshFromBuffer = !0))), d
            },
            definitions: {
                "~": {
                    validator: function (b, c, d, e, f) {
                        var g = f.signHandler(b, c, d, e, f);
                        if (!g && (g = f.radixHandler(b, c, d, e, f), !g && (g = e ? new RegExp("[0-9" + inputmask.escapeRegex(f.groupSeparator) + "]").test(b) : new RegExp("[0-9]").test(b), g === !0 && (g = f.leadingZeroHandler(b, c, d, e, f), g === !0)))) {
                            var h = a.inArray(f.radixPoint, c.buffer);
                            g = -1 != h && f.digitsOptional === !1 && d > h && !e ? {pos: d, remove: d} : {pos: d}
                        }
                        return g
                    }, cardinality: 1, prevalidator: null
                }, "+": {
                    validator: function (a, b, c, d, e) {
                        var f = e.signHandler(a, b, c, d, e);
                        return !f && (d && e.allowMinus && a === e.negationSymbol.front || e.allowMinus && "-" == a || e.allowPlus && "+" == a) && (f = "-" == a ? "" != e.negationSymbol.back ? {
                            pos: c,
                            c: "-" === a ? e.negationSymbol.front : "+",
                            caret: c + 1,
                            insert: {pos: b.buffer.length, c: e.negationSymbol.back}
                        } : {pos: c, c: "-" === a ? e.negationSymbol.front : "+", caret: c + 1} : !0), f
                    }, cardinality: 1, prevalidator: null, placeholder: ""
                }, "-": {
                    validator: function (a, b, c, d, e) {
                        var f = e.signHandler(a, b, c, d, e);
                        return !f && d && e.allowMinus && a === e.negationSymbol.back && (f = !0), f
                    }, cardinality: 1, prevalidator: null, placeholder: ""
                }, ":": {
                    validator: function (a, b, c, d, e) {
                        var f = e.signHandler(a, b, c, d, e);
                        if (!f) {
                            var g = "[" + inputmask.escapeRegex(e.radixPoint) + ",\\.]";
                            f = new RegExp(g).test(a), f && b.validPositions[c] && b.validPositions[c].match.placeholder == e.radixPoint && (f = {caret: c + 1})
                        }
                        return f ? {c: e.radixPoint} : f
                    }, cardinality: 1, prevalidator: null, placeholder: function (a) {
                        return a.radixPoint
                    }
                }
            },
            onUnMask: function (a, b, c) {
                var d = a.replace(c.prefix, "");
                return d = d.replace(c.suffix, ""), d = d.replace(new RegExp(inputmask.escapeRegex(c.groupSeparator), "g"), ""), c.unmaskAsNumber ? (d = d.replace(inputmask.escapeRegex.call(this, c.radixPoint), "."), Number(d)) : d
            },
            isComplete: function (a, b) {
                var c = a.join(""), d = a.slice();
                if (b.postFormat(d, 0, !0, b), d.join("") != c)return !1;
                var e = c.replace(b.prefix, "");
                return e = e.replace(b.suffix, ""), e = e.replace(new RegExp(inputmask.escapeRegex(b.groupSeparator), "g"), ""), "," === b.radixPoint && (e = e.replace(inputmask.escapeRegex(b.radixPoint), ".")), isFinite(e)
            },
            onBeforeMask: function (a, b) {
                if ("" != b.radixPoint && isFinite(a))a = a.toString().replace(".", b.radixPoint); else {
                    var c = a.match(/,/g), d = a.match(/\./g);
                    d && c ? d.length > c.length ? (a = a.replace(/\./g, ""), a = a.replace(",", b.radixPoint)) : c.length > d.length ? (a = a.replace(/,/g, ""), a = a.replace(".", b.radixPoint)) : a = a.indexOf(".") < a.indexOf(",") ? a.replace(/\./g, "") : a = a.replace(/,/g, "") : a = a.replace(new RegExp(inputmask.escapeRegex(b.groupSeparator), "g"), "")
                }
                if (0 == b.digits && (-1 != a.indexOf(".") ? a = a.substring(0, a.indexOf(".")) : -1 != a.indexOf(",") && (a = a.substring(0, a.indexOf(",")))), "" != b.radixPoint && isFinite(b.digits) && -1 != a.indexOf(b.radixPoint)) {
                    var e = a.split(b.radixPoint), f = e[1].match(new RegExp("\\d*"))[0];
                    if (parseInt(b.digits) < f.toString().length) {
                        var g = Math.pow(10, parseInt(b.digits));
                        a = a.replace(inputmask.escapeRegex(b.radixPoint), "."), a = Math.round(parseFloat(a) * g) / g, a = a.toString().replace(".", b.radixPoint)
                    }
                }
                return a.toString()
            },
            canClearPosition: function (b, c, d, e, f) {
                var g = b.validPositions[c].input, h = g != f.radixPoint && isFinite(g) || c == d || g == f.groupSeparator || g == f.negationSymbol.front || g == f.negationSymbol.back;
                if (h && isFinite(g)) {
                    var i;
                    if (!e && b.buffer) {
                        i = b.buffer.join("").substr(0, c).match(f.regex.integerNPart(f));
                        var j = c + 1, k = null == i || 0 == parseInt(i[0].replace(new RegExp(inputmask.escapeRegex(f.groupSeparator), "g"), ""));
                        if (k)for (; b.validPositions[j] && (b.validPositions[j].input == f.groupSeparator || "0" == b.validPositions[j].input);)delete b.validPositions[j], j++
                    }
                    var l = [];
                    for (var m in b.validPositions)l.push(b.validPositions[m].input);
                    1 == f.numericInput && (c = l.join("").length - c, l.reverse()), i = l.join("").match(f.regex.integerNPart(f));
                    var n = a.inArray(f.radixPoint, b.buffer);
                    if (i && (-1 == n || n >= c))if (0 == i[0].indexOf("0"))h = i.index != c || -1 == n; else {
                        var o = parseInt(i[0].replace(new RegExp(inputmask.escapeRegex(f.groupSeparator), "g"), ""));
                        -1 != n && 10 > o && (b.validPositions[c].input = "0", b.p = f.prefix.length + 1, h = !1)
                    }
                }
                return h
            },
            onKeyDown: function (b, c, d, e) {
                var f = a(this);
                if (b.ctrlKey)switch (b.keyCode) {
                    case inputmask.keyCode.UP:
                        f.val(parseFloat(this.inputmask.unmaskedvalue()) + parseInt(e.step)), f.triggerHandler("setvalue.inputmask");
                        break;
                    case inputmask.keyCode.DOWN:
                        f.val(parseFloat(this.inputmask.unmaskedvalue()) - parseInt(e.step)), f.triggerHandler("setvalue.inputmask")
                }
            }
        },
        currency: {
            prefix: "$ ",
            groupSeparator: ",",
            alias: "numeric",
            placeholder: "0",
            autoGroup: !0,
            digits: 2,
            digitsOptional: !1,
            clearMaskOnLostFocus: !1
        },
        decimal: {alias: "numeric"},
        integer: {alias: "numeric", digits: 0, radixPoint: ""},
        percentage: {
            alias: "numeric",
            digits: 2,
            radixPoint: ".",
            placeholder: "0",
            autoGroup: !1,
            min: 0,
            max: 100,
            suffix: " %",
            allowPlus: !1,
            allowMinus: !1
        },
        numeric2: {alias: "numeric"}
    }), inputmask
}(jQuery), function (a) {
    return inputmask.extendAliases({
        phone: {
            url: "phone-codes/phone-codes.js", countrycode: "", mask: function (b) {
                b.definitions["#"] = b.definitions[9];
                var c = [];
                return a.ajax({
                    url: b.url, async: !1, dataType: "json", success: function (a) {
                        c = a
                    }, error: function (a, c, d) {
                        alert(d + " - " + b.url)
                    }
                }), c = c.sort(function (a, b) {
                    return (a.mask || a) < (b.mask || b) ? -1 : 1
                })
            }, keepStatic: !1, nojumps: !0, nojumpsThreshold: 1, onBeforeMask: function (a, b) {
                var c = a.replace(/^0/g, "");
                return (c.indexOf(b.countrycode) > 1 || -1 == c.indexOf(b.countrycode)) && (c = "+" + b.countrycode + c), c
            }
        }, phonebe: {alias: "phone", url: "phone-codes/phone-be.js", countrycode: "32", nojumpsThreshold: 4}
    }), inputmask
}(jQuery), function (a) {
    return inputmask.extendAliases({
        Regex: {
            mask: "r",
            greedy: !1,
            repeat: "*",
            regex: null,
            regexTokens: null,
            tokenizer: /\[\^?]?(?:[^\\\]]+|\\[\S\s]?)*]?|\\(?:0(?:[0-3][0-7]{0,2}|[4-7][0-7]?)?|[1-9][0-9]*|x[0-9A-Fa-f]{2}|u[0-9A-Fa-f]{4}|c[A-Za-z]|[\S\s]?)|\((?:\?[:=!]?)?|(?:[?*+]|\{[0-9]+(?:,[0-9]*)?\})\??|[^.?*+^${[()|\\]+|./g,
            quantifierFilter: /[0-9]+[^,]/,
            isComplete: function (a, b) {
                return new RegExp(b.regex).test(a.join(""))
            },
            definitions: {
                r: {
                    validator: function (b, c, d, e, f) {
                        function g(a, b) {
                            this.matches = [], this.isGroup = a || !1, this.isQuantifier = b || !1, this.quantifier = {
                                min: 1,
                                max: 1
                            }, this.repeaterPart = void 0
                        }

                        function h() {
                            var a, b, c = new g, d = [];
                            for (f.regexTokens = []; a = f.tokenizer.exec(f.regex);)switch (b = a[0], b.charAt(0)) {
                                case"(":
                                    d.push(new g(!0));
                                    break;
                                case")":
                                    var e = d.pop();
                                    d.length > 0 ? d[d.length - 1].matches.push(e) : c.matches.push(e);
                                    break;
                                case"{":
                                case"+":
                                case"*":
                                    var h = new g(!1, !0);
                                    b = b.replace(/[{}]/g, "");
                                    var i = b.split(","), j = isNaN(i[0]) ? i[0] : parseInt(i[0]), k = 1 == i.length ? j : isNaN(i[1]) ? i[1] : parseInt(i[1]);
                                    if (h.quantifier = {min: j, max: k}, d.length > 0) {
                                        var l = d[d.length - 1].matches;
                                        if (a = l.pop(), !a.isGroup) {
                                            var e = new g(!0);
                                            e.matches.push(a), a = e
                                        }
                                        l.push(a), l.push(h)
                                    } else {
                                        if (a = c.matches.pop(), !a.isGroup) {
                                            var e = new g(!0);
                                            e.matches.push(a), a = e
                                        }
                                        c.matches.push(a), c.matches.push(h)
                                    }
                                    break;
                                default:
                                    d.length > 0 ? d[d.length - 1].matches.push(b) : c.matches.push(b)
                            }
                            c.matches.length > 0 && f.regexTokens.push(c)
                        }

                        function i(b, c) {
                            var d = !1;
                            c && (k += "(", m++);
                            for (var e = 0; e < b.matches.length; e++) {
                                var f = b.matches[e];
                                if (1 == f.isGroup)d = i(f, !0); else if (1 == f.isQuantifier) {
                                    var g = a.inArray(f, b.matches), h = b.matches[g - 1], j = k;
                                    if (isNaN(f.quantifier.max)) {
                                        for (; f.repeaterPart && f.repeaterPart != k && f.repeaterPart.length > k.length && !(d = i(h, !0)););
                                        d = d || i(h, !0), d && (f.repeaterPart = k), k = j + f.quantifier.max
                                    } else {
                                        for (var l = 0, o = f.quantifier.max - 1; o > l && !(d = i(h, !0)); l++);
                                        k = j + "{" + f.quantifier.min + "," + f.quantifier.max + "}"
                                    }
                                } else if (void 0 != f.matches)for (var p = 0; p < f.length && !(d = i(f[p], c)); p++); else {
                                    var q;
                                    if ("[" == f.charAt(0)) {
                                        q = k, q += f;
                                        for (var r = 0; m > r; r++)q += ")";
                                        var s = new RegExp("^(" + q + ")$");
                                        d = s.test(n)
                                    } else for (var t = 0, u = f.length; u > t; t++)if ("\\" != f.charAt(t)) {
                                        q = k, q += f.substr(0, t + 1), q = q.replace(/\|$/, "");
                                        for (var r = 0; m > r; r++)q += ")";
                                        var s = new RegExp("^(" + q + ")$");
                                        if (d = s.test(n))break
                                    }
                                    k += f
                                }
                                if (d)break
                            }
                            return c && (k += ")", m--), d
                        }

                        null == f.regexTokens && h();
                        var j = c.buffer.slice(), k = "", l = !1, m = 0;
                        j.splice(d, 0, b);
                        for (var n = j.join(""), o = 0; o < f.regexTokens.length; o++) {
                            var g = f.regexTokens[o];
                            if (l = i(g, g.isGroup))break
                        }
                        return l
                    }, cardinality: 1
                }
            }
        }
    }), inputmask
}(jQuery);