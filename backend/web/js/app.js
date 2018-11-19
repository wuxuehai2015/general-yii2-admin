$(function () {
    $(".app-tooltips").tooltip();
    $(".app-tooltip").tooltip();
    $(".app-ajax-get").click(function (e) {
        e.preventDefault();
        var _this = $(this);
        if (_this.hasClass("disabled")) return false;
        if (_this.hasClass("app-confirm")) {

            var title = _this.attr("title") || _this.attr("data-original-title") || _this.text();
            confirm_text = "您确定要 " + title + " 吗？"

            if (confirm(confirm_text)) {
                _this.addClass("disabled");
                $.get(_this.attr("href"), function (rt) {
                    if (rt.status == 1) {
                        app_alert("succ", rt.msg, 3000, location.href);
                    } else {
                        _this.removeClass("disabled")
                        app_alert("error", rt.msg, 3000, "");
                    }
                });
            }
        } else {
            $.get(_this.attr("href"), function (rt) {
                if (rt.status == 1) {
                    app_alert("succ", rt.msg, 3000, location.href);
                } else {
                    _this.removeClass("disabled")
                    app_alert("error", rt.msg, 3000, "");
                }
            });
        }
    });

    //隐藏模态框
    $("#ModalFriend form input[type=reset]").click(function () {
        $("#ModalFriend").modal("hide");
    });


    $(".app-ajax-form [type=submit]").click(function (e) {
        e.preventDefault();
        var form = $(this).parents("form"),
            method = form.attr("method"),
            action = form.attr("action"),
            data = form.serialize(),
            _url = form.attr("data-url");
        var require = form.find("[required=required]"),
            l = require.length;
        $.each(require, function () {
            if (!$(this).val()) {
                $(this).focus();
                return false;
            } else {
                l--;
            }
        });
        if (!_url || _url == undefined) {
            _url = location.href;
        }
        if (l > 0) return false;
        if (method == "post") {
            if (form.attr("enctype") == "multipart/form-data") {
                form.attr("target", "notarget");
                form.submit();
            } else {
                $.post(action, data, function (rt) {
                    if (rt.status == 1) {
                        app_alert("success", rt.msg, 2000, _url);
                    } else {
                        app_alert("error", rt.msg, 3000, "");
                    }
                });
            }

        } else {
            $.get(action, data, function (rt) {
                if (rt.status == 1) {
                    app_alert("success", rt.msg, 2000, _url);
                } else {
                    app_alert("error", rt.msg, 3000, "");
                }
            });
        }
    });


    //内容变更
    $(".app-change-update").change(function () {
        var _this = $(this),
            _url = _this.attr("data-url"),
            field = _this.attr("name"),
            value = _this.val();
        $.get(_url, {
            field: field,
            value: value
        }, function (rt) {
            if (rt.status == 1) {
                app_alert("success", rt.msg, 2000, "")
            } else {
                app_alert("error", rt.msg, 2000, "")
            }
        });
    });

    //site option ,change reload a new link
    $("#SiteOption").change(function () {
        var _this = $(this),
            sid = _this.val(),
            _url = _this.attr("data-url");
        location.href = _url + "&sid=" + sid
    });

    //创建样式
    $("#app-add-style [type=range]").change(function () {
        $("#app-quality").val($(this).val());
    });
    //水印位置的选择
    $("#app-add-style .app-watermark-position span").click(function () {
        $(this).addClass("active").siblings("span").removeClass("active");
        $("#app-watermark-position").val($(this).text());
    });
    $("#app-add-style select[name=Method]").change(function () {
        var val = $(this).val();
        $("#app-add-style input[name=Width]").attr("readonly", null);
        $("#app-add-style input[name=Height]").attr("readonly", null);
        if (val == 21) {
            $("#app-add-style input[name=Height]").val("0").attr("readonly", "readonly");
        }
        if (val == 22) {
            $("#app-add-style input[name=Width]").val("0").attr("readonly", "readonly");
        }
    });


    //cls：success/error
    //msg:message
    //timeout:超时刷新和跳转时间
    //url:有url链接的话，跳转url链接
    function app_alert(cls, msg, timeout, url) {
        var timestamp = new Date().getTime();
        if (timeout > 0) {
            t = timeout
        } else {
            t = 3000
        }
        if (cls == "error" || cls == "danger") {
            cls = "danger";
        } else {
            cls = "success";
        }
        html = '<div class="alert alert-' + cls + ' alert-' + timestamp + ' alert-dismissable app-alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + msg + '</div>';
        $("body").append(html);
        $(".app-alert").fadeIn();
        setTimeout(function () {
            $(".alert-" + timestamp).fadeOut();
            $(".alert-" + timestamp).remove();
        }, t);
        if (url) {
            setTimeout(function () {
                location.href = url
            }, t - 500);
        }
    }


    //iframe加载后处理
    $("#target").load(function () {
        var data = $(window.frames['target'].document.body).find("pre").html();
        var obj = eval('(' + data + ')');
        if (obj.status == 1) {
            app_alert("success", obj.msg, 2500, location.href);
        } else {
            app_alert("danger", obj.msg, 2500, "");
        }
    });

    //全选
    $(".app-select-all").click(function () {
        var _this = $(this),
            IsChecked = _this.prop("checked"),
            items = $(".app-select-item");
        $.each(items, function () {
            $(this).prop("checked", IsChecked);
        })
    });


    //批量操作
    $("a.btn-for-all").click(function (e) {
        e.preventDefault();
        var _this = $(this),
            _url = _this.attr("href");
        if (_this.hasClass("app-confirm") && !confirm("您确定要 " + _this.text() + " 吗?")) return false;
        var items = $(".app-select-item"),
            ids = [];
        $.each(items, function () {
            if ($(this).prop("checked")) {
                ids.push($(this).val());
            }
        });
        if (ids.length == 0) {
            app_alert("error", "请选择您要操作的内容", 3000, "");
            return false;
        } else {
            $.post(_url, {id: ids.join(",")}, function (ret) {
                if (ret.status == 1) {
                    app_alert("succ", ret.msg, 3000, location.pathname);
                } else {
                    app_alert("error", ret.msg, 3000, "");
                }
                return;
            });
        }
    });


    //无刷新的文件上传
    $("#notarget").load(function () {
        var data = $(window.frames['notarget'].document.body).find("pre").text();
        var obj = eval('(' + data + ')');
        if (obj.status == 1) {
            app_alert("succ", obj.msg, 2500, location.href);
        } else {
            app_alert("danger", obj.msg, 2500, "");
        }
    });


    //收起展示
    $(".app-node a>.fa").click(function () {
        alert(1);
        return;
        var _this = $(this),
            id = _this.parents(".app-node").attr("data-id");
        console.log(id)
        if (_this.hasClass("fa-minus-cirlce")) {
            $(".app-node-" + id).fadeOut();
        } else {
            $(".app-node-" + id).fadeIn();
        }

    });

    //展开文档
    $(".app-node a>.fa").click(function () {
        var _this = $(this),
            id = _this.parents(".app-node").attr("data-id");
        var cls = ".app-node-" + id
        if (_this.hasClass("fa-plus-circle")) {
            _this.addClass("fa-minus-circle").removeClass("fa-plus-circle");
            $(cls).removeClass("hidden");
        } else {
            //关闭
            var nodes = $(cls);
            $(cls).addClass("hidden");
            $.each(nodes, function () {
                var id = $(this).attr("data-id");
                if (id != undefined) {
                    $(".app-node-" + id).addClass("hidden");
                    $(this).find("a>.fa").addClass("fa-plus-circle").removeClass("fa-minus-circle");
                }
            });
            _this.addClass("fa-plus-circle").removeClass("fa-minus-circle");
        }

    });

    //显示文档备注模态框
    $(".ModalRemark").click(function () {
        $.get('/admin/doc/remark', {dsid: $(this).attr("data-dsid")}, function (ret) {
            if (ret.status == 0) {
                app_alert("danger", ret.msg, 5000, "");
            } else {
                var form = $("#ModalRemark form");
                form.find("[name=TimeCreate]").val(ret.data.TimeCreate);
                form.find("[name=Id]").val(ret.data.Id);
                form.find("[name=Content]").val(ret.data.Content);
                form.find(".form-group-download [value=" + ret.data.AllowDownload + "]").prop("checked", "checked");
                form.find(".form-group-status [value=" + ret.data.Status + "]").prop("checked", "checked");
                ret.data.TimeCreate > 0 ? form.find(".remark-tips").hide() : form.find(".remark-tips").show();
                $("#ModalRemark").modal("show");
            }
        })

    });


    //变更用户积分
    $(".ModalScoreBtn").click(function () {
        var _this = $(this),
            uid = _this.attr("data-id"),
            username = _this.attr("data-username");
        $(".ModalScoreUser").text(username);
        $("#ModalScore form").find("[name=uid]").val(uid);
        $("#ModalScore").modal("show");
    });


    $("#ModalCate .form-chanel [name=Cid]").change(function () {
        var cid = $(this).val(),
            url = $(this).attr("data-url");
        if (cid > 0) {
            $.get(url, {Cid: cid}, function (ret) {
                if (ret.data.length > 0) {
                    var html = '<option value="">==请选择上一级分类==</option>';
                    $.each(ret.data, function () {
                        console.log(this);
                        html += '<option value="' + this.Id + '"> ' + this.Title + '</option>';
                    })
                    $("#ModalCate .form-cate [name=Pid]").html(html);
                }
                $("#ModalCate .form-cate").removeClass("hidden");
            })
        } else {
            $("#ModalCate .form-cate").addClass("hidden");
            $("#ModalCate .form-cate [name=Pid]").html('');
        }
    });


//	文库分类选择
    var CatesJson = $("#CatesJson").val();
    if (CatesJson != undefined) {
        var CatesObj = JSON.parse(CatesJson)
    }
    $(".level-top").change(function () {
        var pid = $(this).val();
        var options = ['<option value="0" >请选择一级分类</option>'];
        if (pid != 0) {
            $.each(CatesObj, function () {
                if (this.Pid == pid) {
                    options.push('<option value="' + this.Id + '" >' + this.Title + '</option>');
                }
            });
        }
        $(".level-one").html(options.join(""));
    });
    $(".level-one").change(function () {
        var pid = $(this).val();
        var options = ['<option value="0" >请选择二级分类</option>'];
        if (pid != 0) {
            $.each(CatesObj, function () {
                if (this.Pid == pid) {
                    options.push('<option value="' + this.Id + '" >' + this.Title + '</option>');
                }
            });
        }
        $(".level-two").html(options.join(""));
    });


    //全选与全不选
    $(".checkbox-all").click(function () {
        var items = $(".checkbox-item");
        var checked = $(this).prop("checked");
        $.each(items, function () {
            $(this).prop("checked", checked);
        });
    });


    //gitbook书籍采集和发布
    $(".btn-gitbook-publish").click(function () {
        var form = $(this).parents("form"),
            checkboxItems = $(".checkbox-item"),
            ids = [];
        $.each(checkboxItems, function () {
            if ($(this).prop("checked")) {
                ids.push($(this).val());
            }
        });
        if (ids.length == 0) {
            app_alert("danger", "请选择要发布的文档", 3000, "");
            return false
        }
        var data = form.serialize() + "&Ids=" + ids.join(",")
        $.get("/admin/psGitbook", data, function (ret) {
            if (ret.status == 0) {
                app_alert("danger", ret.msg, 3000, "");
            } else {
                app_alert("success", ret.msg, 3000, "");
            }
        })
    });
});

function categoryToggle(obj) {
    var _this = $(obj),
        id = _this.parents("tr").attr("data-id"),
        deep = _this.parents("tr").attr("data-deep");
    var cls = ".parent-" + deep + "-" + id;
    console.log(cls);
    if (_this.hasClass("fa-plus-circle")) {
        $(cls).show();
        _this.addClass("fa-minus-circle").removeClass("fa-plus-circle");
    } else {
        $(cls).hide();
        _this.addClass("fa-plus-circle").removeClass("fa-minus-circle");
    }
}
