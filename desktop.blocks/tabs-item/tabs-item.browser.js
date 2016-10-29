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
                this.bindTo('pointerclick', this._onClick);
                var properties = this.findBlockOutside('tabs').findBlocksInside('property');
                var tabsParams = this.params['props'];
                var resArray = [];
                // console.log(properties);
                // console.log(this.findBlockInside('tabs__item').hasMod('open'));

                // console.log(this.findBlockOutside('tabs').findBlockInside('tabs-item').hasMod('active'));
                if( this.hasMod('active') ) {
                  properties.forEach(function(propItem, index) {
                    // console.log(propItem.params['id']);
                    // console.log(!tabsParams.includes(propItem.params['id']));
                    // console.log(tabsParams.includes(propItem.params['id']));
                    if(!tabsParams.includes(propItem.params['id'])) {
                      resArray.push(propItem);
                    }
                  });
                  resArray.forEach(function(item) {
                    item.setMod('disabled');
                  });
                }
              }
            },

            'active': {
              'true': function() {
                debugger;
                var properties = this.findBlockOutside('tabs').findBlocksInside('property');
                var tabsParams = this.params['props'];
                var resArray = [];
                // console.log(properties);
                // console.log(this.findBlockInside('tabs__item').hasMod('open'));

                // console.log(this.hasMod('active'));
                // console.log(this.findBlockOutside('tabs').findBlockInside('tabs-item').hasMod('active'));
                properties.forEach(function(propItem, index) {
                  // console.log(propItem.params['id']);
                  // console.log(!tabsParams.includes(propItem.params['id']));
                  // console.log(tabsParams.includes(propItem.params['id']));
                  debugger;
                  if(!tabsParams.includes(propItem.params['id'])) {
                    resArray.push(propItem);
                  }
                  debugger;
                });
                resArray.forEach(function(item) {
                  item.setMod('disabled');
                });
              },
              '': function() {
                // debugger;
                var properties = this.findBlockOutside('tabs').findBlocksInside('property');
                var tabsParams = this.params['props'];
                var resArray = [];
                // console.log(properties);
                // console.log(this.findBlockInside('tabs__item').hasMod('open'));

                // console.log(this.hasMod('active'));
                // console.log(this.findBlockOutside('tabs').findBlockInside('tabs-item').hasMod('active'));
                properties.forEach(function(propItem, index) {
                  // console.log(propItem.params['id']);
                  // console.log(!tabsParams.includes(propItem.params['id']));
                  // console.log(tabsParams.includes(propItem.params['id']));
                  if(!tabsParams.includes(propItem.params['id'])) {
                    resArray.push(propItem);
                  }
                });
                resArray.forEach(function(item) {
                  item.delMod('disabled');
                });
              }
            },
          },
          _onClick: function() {

            var properties = this.findBlockOutside('tabs').findBlocksInside('property');
            var tabsParams = this.params['props'];
            var resArray = [];
            // console.log(properties);
            // console.log(this.findBlockInside('tabs__item').hasMod('open'));
            this.findBlockOutside('tabs')
              .findBlocksInside({ block: 'tabs-item', mods: { active: true } })
              .forEach(function(blockItem) {
                blockItem.delMod('active');
              });
            this.setMod('active');
            this.findBlockOutside('tabs').findBlockInside('category-select').elem('input').attr('value', this.params['category']);
            
            var tabs = this.findBlockOutside('tabs');
            var openTabsItem = tabs.elem('item', 'open');
            tabs.delMod(openTabsItem, 'open');
            tabs.setMod(openTabsItem, 'closed');
            tabs.delMod(this.domElem.eq(1), 'closed');
            tabs.setMod(this.domElem.eq(1), 'open');
            // console.log( this.findBlockOn($(this.domElem[1]), { block: 'tabs__item' }) );
          },
          openContent: function(elem) {
            // debugger;
          }
        },
        {
            /* статические методы */
        })
    );

});
