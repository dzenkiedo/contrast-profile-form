modules.define('profile-form', ['i-bem__dom', 'jquery'], function(provide, BEMDOM, $) {

  provide(BEMDOM.decl(this.name, {
    onSetMod: {
      'js': {
        'inited': function() {
          // this.domElem.on('submit', function() {
          //   debugger;
          // });
        }
      }
    }
  }));
})
