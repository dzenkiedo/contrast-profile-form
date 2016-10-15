modules.define('tabs-item', ['i-bem__dom', 'jquery'], function(provide, BEMDOM, $) {

    provide(BEMDOM.decl(this.name,
        {
          beforeSetMod: {
            'js': {
              'inited': function() {

              }
            }
          },
          onSetMod: {
            'js': {
              'inited': function() {
                // debugger;
                this.bindTo('pointerclick', this._onClick)
              }
            }
          },
          _onClick: function() {
            console.log('tabs-item inited');
            var tabs = this.findBlockOutside('tabs');
            var openTabsItem = tabs.elem('item', 'open');
            tabs.delMod(openTabsItem, 'open');
            tabs.setMod(openTabsItem, 'closed');
            tabs.delMod(this.domElem.eq(1), 'closed');
            tabs.setMod(this.domElem.eq(1), 'open');
            // console.log( this.findBlockOn($(this.domElem[1]), { block: 'tabs__item' }) );
          },
          openContent: function(elem) {
            debugger;
          }
        },
        {
            /* статические методы */
        })
    );

});
