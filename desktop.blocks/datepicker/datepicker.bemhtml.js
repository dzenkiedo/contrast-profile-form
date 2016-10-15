block('datepicker')(
  js()(true),
  content()(function() {
    var id = this.generateId();
    return {
        block: 'control-group',
        content: [{
          block: 'input',
          mix: { block: this.ctx.block, elem: 'input' },
          mods: { theme: 'islands', size: 'xl', 'has-clear': true },
          name: this.ctx.name,
          placeholder: this.ctx.text
        }, {
          block: 'dropdown',
          js: true,
          mix: { block: this.ctx.block, elem: 'dropdown' },
          mods: { switcher: 'button', theme: 'islands', size: 'xl' },
          switcher: {
            block: 'button',
            mods: { theme: 'islands', size: 'xl', view: 'action' },
            icon: {
              block: 'icon',
              width: 100,
              content: '<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"> <path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/> <path d="M0 0h24v24H0z" fill="none"/> </svg>'
            }
          },
          popup: {
            block: 'popup',
            directions: ['right-center', 'top-center'],
            mods: { theme: 'islands', size: 'xl' },
            content: {
              block: 'control-group',
              mods: { dropdown: true },
              content: [{
                block: 'select',
                mix: { block: this.ctx.block, elem: 'select' },
                mods: { mode: 'radio-check', theme: 'islands', size: 'xl' },
                name: 'day',
                text: 'Число',
                options: (function() {
                  var arr = [];
                  for (var i = 1; i < 32; i++) {
                    arr.push({ val: i, text: i });
                  }
                  return arr;
                }())
              }, {
                block: 'select',
                mix: { block: this.ctx.block, elem: 'select' },
                mods: { mode: 'radio-check', theme: 'islands', size: 'xl' },
                name: 'month',
                text: 'Месяц',
                options: [
                { val: 1, text: 'Январь' },
                { val: 2, text: 'Февраль' },
                { val: 3, text: 'Март' },
                { val: 4, text: 'Апрель' },
                { val: 5, text: 'Май' },
                { val: 6, text: 'Июнь' },
                { val: 7, text: 'Июль' },
                { val: 8, text: 'Август' },
                { val: 9, text: 'Сентябрь' },
                { val: 10, text: 'Октябрь' },
                { val: 11, text: 'Ноябрь' },
                { val: 12, text: 'Декабрь' }
                ]
              }, {
                block: 'select',
                mix: { block: this.ctx.block, elem: 'select' },
                mods: { mode: 'radio-check', theme: 'islands', size: 'xl' },
                name: 'year',
                text: 'Год',
                options: (function() {
                  var arr = [];
                  for (var i = 0; i < 40; i++) {
                    arr.push({ val: 1976+i, text: 1976+i });
                  }
                  return arr;
                }())
              }]
            }
          }
        }]
      }
    }));
