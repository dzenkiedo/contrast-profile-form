modules.define('datepicker', ['i-bem__dom', 'jquery'], function(provide, BEMDOM, $) {

  provide(BEMDOM.decl(this.name, {

    onSetMod: {
      'js': {
        'inited': function(e) {
          var innerDropdown = this.findBlockInside('dropdown'),
              select = this.findBlocksOn(this.elem('select'), 'select'),
              input = this.findBlockOn( this.elem('input'), 'input');
          this.bindTo(this.elem('input'), 'pointerclick', function() {
            innerDropdown.onSwitcherClick(e);
            // if (innerDropdown.hasMod('opened')) {
            //   this.setMod(this.elem('dropdown'), 'open');
            // } else {
            //   this.delMod(this.elem('dropdown'), 'open');
            // }
          });
          this.bindTo(this.elem('switcher'), 'pointerclick', function(){
            innerDropdown.onSwitcherClick(e);
          });
          this.bindTo(this.elem('submit'), 'pointerclick', function() {
            var dates = select.map(function(item, index) {
              return item.getVal()
            }).join('/');
            input.setVal(dates);
            innerDropdown.onSwitcherClick(e);
          });
        }
      }
    },
  }));
});
