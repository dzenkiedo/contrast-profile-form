modules.define('datepicker', ['i-bem__dom', 'jquery'], function(provide, BEMDOM, $) {

  provide(BEMDOM.decl(this.name, {

    onSetMod: {
      'js': {
        'inited': function(e) {
          var innerDropdown = this.findBlockInside('dropdown');
          this.bindTo(this.elem('input'), 'pointerclick', function() {
            // if( this.hasMod() )
            debugger;
            var dateInput = this.elem('input');
            var dateValues = this.elem('select');
            innerDropdown.onSwitcherClick(e);
            if (innerDropdown.hasMod('opened')) {
              this.setMod(this.elem('dropdown'), 'open');
            } else {
              this.delMod(this.elem('dropdown'), 'open');
            }
          });
        }
      }
    },
    onElemSetMod: {
      'dropdown': {
        'open': {
          '': function() {
            var dates = this.findBlocksOn(this.elem('select'), 'select').map(function(item, index) {
              return item.getVal()
            }).join('.');
            this.findBlockOn( this.elem('input'), 'input').setVal(dates);
          }
        }
      }
    }
  }));
});
