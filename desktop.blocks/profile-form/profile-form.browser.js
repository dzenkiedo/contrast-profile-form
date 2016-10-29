modules.define('profile-form', ['i-bem__dom', 'jquery'], function(provide, BEMDOM, $) {

  provide(BEMDOM.decl(this.name, {
    onSetMod: {
      'js': {
        'inited': function() {
          this.bindTo('submit', this._onSubmit);
        }
      }
    },
    _onSubmit: function(e) {
      e.preventDefault();
      var formData = new FormData(this.findBlockOutside('profile-form').domElem[0]);
      var modalWindow = this.findBlockOutside('page').findBlockInside('modal');
      modalWindow.setMod('visible');
      // debugger;
      $.ajax({
        url: location.href,
        method: 'POST',
        async: true,
        contentType: false,
        data: formData,
        processData: false,
        complete: function(data) {
          modalWindow.delMod('visible');
        }
      });
    }
  }));
});
