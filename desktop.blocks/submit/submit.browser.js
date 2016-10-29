modules.define('submit', ['i-bem__dom', 'jquery'], function(provide, BEMDOM, $) {

  provide(BEMDOM.decl(this.name, {

    onSetMod: {
      'js': {
        'inited': function() {
          this.bindTo('pointerclick', this._onClick)
        }
      }
    },
    _onClick: function(e) {
      // var formData = new FormData(this.findBlockOutside('profile-form').domElem[0]).entries();
      // console.log(e);
      // debugger;
      // e.submit();
      // // debugger;
    }

  }));
});
