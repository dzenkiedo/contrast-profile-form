modules.define('property', ['i-bem__dom', 'jquery'], function(provide, BEMDOM, $) {

  provide(BEMDOM.decl(this.name, {

    onSetMod: {
      'js': {
        'inited': function() {

        }
      },
      'disabled': {
        'true': function(e) {
          var ctx = this;
          var controlsArray = [];
          this._innerBlocks.forEach(function(innerBlocksItem) {
            if ( ctx.findBlocksInside(innerBlocksItem).length > 0 ) {
              controlsArray.push(ctx.findBlocksInside(innerBlocksItem));
            }
          });
          // debugger;
          controlsArray.forEach(function(controlsArrayItem) {
            controlsArrayItem[0].setMod('disabled');
          });
        },
        '': function() {
          var ctx = this;
          var controlsArray = [];
          this._innerBlocks.forEach(function(innerBlocksItem) {
            if (ctx.findBlocksInside({ block: innerBlocksItem, mods: { disabled: true } }).length > 0  ) {
              controlsArray.push(ctx.findBlocksInside(innerBlocksItem));
            }
          });

          // console.log(controlsArray);
          controlsArray.forEach(function(controlsArrayItem) {
            controlsArrayItem[0].delMod('disabled');
          });
        }
      }
    },
    _innerBlocks: [
      'datepicker',
      'input',
      'attach',
      'select', 
      'menu',
      'menu-item',
      'radio-group',
      'checkbox-group',
      'checkbox',
      'select',
      'radio',
      'textarea',
      'button'
    ]
  }));
});
