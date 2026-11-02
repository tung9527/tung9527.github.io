;(function() {
  var that = $.extend(true, {}, admin_module)
  fetch(that)
  TEMPLOADFUNS[that.hash] = function() {
      fetch(that)
    }
})()
function fetch(that) {
  metui.request({
      url: that.own_name + '&c=index&a=doGetSetup'
    },
    function(result) {
      let data = result.data
      Object.keys(data).map(item => {
        if (item === 'met_img_rename') {
          if (data[item] > 0 && that.obj.find(`[name="${item}"]`).val() === '0') that.obj.find(`[name="${item}"]`).click()
          return
        }
        if (item === 'met_logs') {
          if (data[item] > 0 && that.obj.find(`[name="${item}"]`).val() === '0') that.obj.find(`[name="${item}"]`).click()
          return
        }
        if (item === 'met_login_code') {
          if (data[item] > 0 && that.obj.find(`[name="${item}"]`).val() === '0') that.obj.find(`[name="${item}"]`).click()
          return
        }
        if (item === 'met_memberlogin_code') {
          if (data[item] > 0 && that.obj.find(`[name="${item}"]`).val() === '0') that.obj.find(`[name="${item}"]`).click()
          return
        }
        if (item === 'disable_cssjs') {
          if (data[item] > 0 && that.obj.find(`[name="${item}"]`).val() === '0') that.obj.find(`[name="${item}"]`).click()
          return
        }
        if (item === 'access_type') {
          that.obj.find(`[name="${item}"][value="${data[item]}"]`).click()
          return
        }
        if (item === 'install') {
          if (data[item] > 0) that.obj.find(`.delete-file`).show()
          return
        }

        that.obj.find(`[name=${item}]`).val(data[item])
      })
    }
  )
  const btn_delete = that.obj.find('.btn-delete')
  btn_delete.off().click(function() {
    metui.request({
        url: that.own_name + '&c=index&a=doDelInstallFile'
      },
      function() {
        setTimeout(() => {
          window.location.reload()
        }, 500);

      }
    )
  })
  metui.use(['form', 'formvalidation'], function() {
    var order = that.obj.find('#safe-form').attr('data-validate_order')
    formSaveCallback(order, {
      true_fun: function(result) {
        setTimeout(() => {
          result.data ? (window.location.href = result.data.url) : null
        }, 500)
      }
    })
  })
}