module.exports = {
  block: 'page',
  title: 'Title of the page',
  favicon: '/favicon.ico',
  head: [
  { elem: 'meta', attrs: { name: 'description', content: '' } },
  { elem: 'meta', attrs: { name: 'viewport', content: 'width=device-width, initial-scale=1' } },
  { elem: 'css', url: 'index.min.css' }
  ],
  scripts: [{ elem: 'js', url: 'index.min.js' }],
  mods: { theme: 'islands' },
  content: [{
    block: 'content',
    content: [{
      elem: 'head',
      content: 'ВНИМАНИЕ: Точно указывайте все данные. Анкеты, заполненные не полностью или нечетко, рассматриваться не смогут.'
    }, {
      block: 'profile-form',
      content: [{
        block: 'profile-form',
        elem: 'wrapper',
        content: {
          block: 'tabs',
          content: [{
            elem: 'line',
            content: [{
              block: 'link',
              mix: [{ block: 'tabs', elem: 'link', js: true }, { block: 'tabs-item', js: { id: 'tab-1'} }],
              url: '#link-1',
              mods: { pseudo: true, theme: 'islands', size: 'xl' },
              content: [{
                block: 'image',
                width: 300,
                height: 300,
                content: '<?xml version="1.0" encoding="iso-8859-1"?> <!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  --> <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"> <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="482.032px" height="482.032px" viewBox="0 0 482.032 482.032" style="enable-background:new 0 0 482.032 482.032;" xml:space="preserve"> <g> <path d="M386.163,48.499L217.807,216.857c-7.646,1.901-15.05,1.533-20.277-3.687c-12.381-12.381,5.53-39.459,14.835-51.738 c2.679-3.528,1.751-4.749-2.27-2.877l-36.834,17.142c-4.015,1.872-7.902,6.927-8.846,11.257 c-2.914,13.387-9.812,40.158-20.3,50.646c-11.8,11.798-82.429,25.519-106.325,29.892c-4.358,0.781-7.938,4.98-8.299,9.405 c-2.96,36.347-21.045,78.954-28.722,95.669c-1.855,4.023-0.254,5.582,3.767,3.719c52.676-24.389,89.847-12.383,98.364-3.859 c7.402,7.406-14.757,78.178-22.421,101.781c-1.365,4.207,0.651,5.902,4.554,3.803l72.122-38.932 c3.901-2.101,7.801-7.326,8.782-11.65c4.711-20.73,18.372-76.357,32.366-90.355c12.106-12.106,32.801-15.608,44.144-16.639 c4.412-0.389,9.78-3.542,11.94-7.405l15.028-26.718c2.176-3.863,1.134-4.729-2.585-2.312c-11.27,7.334-34.737,19.188-50.468,3.455 c-6.854-6.854-5.67-18.459-0.974-31.05L405.423,66.358c3.418-2.843,11.95-9.004,19.119-6.083c0,0,27.139-32.226,45.456-31.881 c0,0,6.268-14.074,12.034-25.271L387.565,24.32C387.565,24.32,395.488,36.873,386.163,48.499z M155.207,330.984l-9.043,9.037 c-3.136,3.134-8.213,3.134-11.353,0l-24.115-24.109c-3.132-3.146-3.132-8.219,0-11.364l9.043-9.037 c3.132-3.138,8.209-3.138,11.349,0l24.119,24.108C158.339,322.765,158.339,327.839,155.207,330.984z M191.599,283.235 c3.136,3.131,3.136,8.204,0,11.346l-9.041,9.049c-3.132,3.126-8.211,3.126-11.351,0l-24.119-24.121 c-3.132-3.126-3.132-8.207,0-11.345l9.047-9.045c3.132-3.138,8.211-3.138,11.351,0l4.027,4.023l18.556,18.562L191.599,283.235z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg> ' },
              {
                tag: 'span',
                content:'Музыканту'
              }]
            },{
              block: 'link',
              mix: [{ block: 'tabs', elem: 'link', js: true }, { block: 'tabs-item', js: { id: 'tab-2'} }],
              url: '#link-1',
              mods: { pseudo: true, theme: 'islands', size: 'xl' },
              content: [{ block: 'image',
                width: 300,
                height: 300,
                content: '<?xml version="1.0" encoding="iso-8859-1"?> <!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  --> <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"> <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="475.085px" height="475.085px" viewBox="0 0 475.085 475.085" style="enable-background:new 0 0 475.085 475.085;" xml:space="preserve"> <g> <g> <path d="M237.541,328.897c25.128,0,46.632-8.946,64.523-26.83c17.888-17.884,26.833-39.399,26.833-64.525V91.365 c0-25.126-8.938-46.632-26.833-64.525C284.173,8.951,262.669,0,237.541,0c-25.125,0-46.632,8.951-64.524,26.84 c-17.893,17.89-26.838,39.399-26.838,64.525v146.177c0,25.125,8.949,46.641,26.838,64.525 C190.906,319.951,212.416,328.897,237.541,328.897z"/> <path d="M396.563,188.15c-3.606-3.617-7.898-5.426-12.847-5.426c-4.944,0-9.226,1.809-12.847,5.426 c-3.613,3.616-5.421,7.898-5.421,12.845v36.547c0,35.214-12.518,65.333-37.548,90.362c-25.022,25.03-55.145,37.545-90.36,37.545 c-35.214,0-65.334-12.515-90.365-37.545c-25.028-25.022-37.541-55.147-37.541-90.362v-36.547c0-4.947-1.809-9.229-5.424-12.845 c-3.617-3.617-7.895-5.426-12.847-5.426c-4.952,0-9.235,1.809-12.85,5.426c-3.618,3.616-5.426,7.898-5.426,12.845v36.547 c0,42.065,14.04,78.659,42.112,109.776c28.073,31.118,62.762,48.961,104.068,53.526v37.691h-73.089 c-4.949,0-9.231,1.811-12.847,5.428c-3.617,3.614-5.426,7.898-5.426,12.847c0,4.941,1.809,9.233,5.426,12.847 c3.616,3.614,7.898,5.428,12.847,5.428h182.719c4.948,0,9.236-1.813,12.847-5.428c3.621-3.613,5.431-7.905,5.431-12.847 c0-4.948-1.81-9.232-5.431-12.847c-3.61-3.617-7.898-5.428-12.847-5.428h-73.08v-37.691 c41.299-4.565,75.985-22.408,104.061-53.526c28.076-31.117,42.12-67.711,42.12-109.776v-36.547 C401.998,196.049,400.185,191.77,396.563,188.15z"/> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg> '},
              {
                tag: 'span',
                content: 'Вокалисту'
              }]
            },{
              block: 'link',
              mix: [{ block: 'tabs', elem: 'link', js: true }, { block: 'tabs-item', js: { id: 'tab-3'} }],
              url: '#link-1',
              mods: { pseudo: true, theme: 'islands', size: 'xl' },
              content: [{
                block: 'image',
                width: 300,
                height: 300,
                content: '<?xml version="1.0" encoding="iso-8859-1"?> <!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  --> <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"> <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="80.13px" height="80.13px" viewBox="0 0 80.13 80.13" style="enable-background:new 0 0 80.13 80.13;" xml:space="preserve" > <g> <path d="M48.355,17.922c3.705,2.323,6.303,6.254,6.776,10.817c1.511,0.706,3.188,1.112,4.966,1.112 c6.491,0,11.752-5.261,11.752-11.751c0-6.491-5.261-11.752-11.752-11.752C53.668,6.35,48.453,11.517,48.355,17.922z M40.656,41.984 c6.491,0,11.752-5.262,11.752-11.752s-5.262-11.751-11.752-11.751c-6.49,0-11.754,5.262-11.754,11.752S34.166,41.984,40.656,41.984 z M45.641,42.785h-9.972c-8.297,0-15.047,6.751-15.047,15.048v12.195l0.031,0.191l0.84,0.263 c7.918,2.474,14.797,3.299,20.459,3.299c11.059,0,17.469-3.153,17.864-3.354l0.785-0.397h0.084V57.833 C60.688,49.536,53.938,42.785,45.641,42.785z M65.084,30.653h-9.895c-0.107,3.959-1.797,7.524-4.47,10.088 c7.375,2.193,12.771,9.032,12.771,17.11v3.758c9.77-0.358,15.4-3.127,15.771-3.313l0.785-0.398h0.084V45.699 C80.13,37.403,73.38,30.653,65.084,30.653z M20.035,29.853c2.299,0,4.438-0.671,6.25-1.814c0.576-3.757,2.59-7.04,5.467-9.276 c0.012-0.22,0.033-0.438,0.033-0.66c0-6.491-5.262-11.752-11.75-11.752c-6.492,0-11.752,5.261-11.752,11.752 C8.283,24.591,13.543,29.853,20.035,29.853z M30.589,40.741c-2.66-2.551-4.344-6.097-4.467-10.032 c-0.367-0.027-0.73-0.056-1.104-0.056h-9.971C6.75,30.653,0,37.403,0,45.699v12.197l0.031,0.188l0.84,0.265 c6.352,1.983,12.021,2.897,16.945,3.185v-3.683C17.818,49.773,23.212,42.936,30.589,40.741z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg> ' },
              {
                tag: 'span',
                content: 'Коллективу'
              }]
            }]
          }, {
            elem: 'content',
            content: [{
              elem: 'item',
              elemMods: { open: true },
              mix: { block: 'tabs-item', js: { id: 'tab-1'} },
              content: [{
                block: 'profile-form',
                elem: 'section-group',
                content: [{
                  block: 'profile-form',
                  elem: 'section-head',
                  tag: 'h2',
                  content: 'Контактная информация'
                }, {
                  block: 'control-group',
                  content: [{
                    block: 'input',
                    mods: { theme: 'islands', size: 'l', 'has-clear': true },
                    name: 'profile_first_name',
                    placeholder: 'Имя'
                  }, {
                    block: 'input',
                    mods: { theme: 'islands', size: 'l', 'has-clear': true },
                    name: 'profile_second_name',
                    placeholder: 'Фамилия'
                  }, {
                    block: 'input',
                    mods: { theme: 'islands', size: 'l', 'has-clear': true },
                    name: 'profile_second_name',
                    placeholder: 'Отчество'
                  }]
                }, {
                  block: 'control-group',
                  content: [{
                    block: 'input',
                    mods: { theme: 'islands', size: 'l', 'has-clear': true },
                    name: 'profile_phone',
                    placeholder: 'Контактный телефон'
                  }, {
                    block: 'input',
                    mods: { theme: 'islands', size: 'l', 'has-clear': true },
                    name: 'date_of_birth',
                    placeholder: 'Дата рождения'
                  }]
                },{
                  block: 'control-group',
                  content: [{
                    block: 'input',
                    mods: { theme: 'islands', size: 'l', 'has-clear': true },
                    name: 'profile_phone',
                    placeholder: 'Страна проживания'
                  }, {
                    block: 'input',
                    mods: { theme: 'islands', size: 'l', 'has-clear': true },
                    name: 'date_of_birth',
                    placeholder: 'Город проживания'
                  }]
                }]
              }, {
                block: 'profile-form',
                elem: 'section-group',
                content: [{
                  block: 'profile-form',
                  elem: 'section-head',
                  tag: 'h2',
                  content: 'Информация об образовании'
                }, {
                  block: 'control-group',
                  content: [{
                    block: 'input',
                    mods: { theme: 'islands', size: 'l', 'has-clear': true },
                    name: 'date_of_birth',
                    placeholder: 'Название УО'
                  }, {
                    block: 'input',
                    mods: { theme: 'islands', size: 'l', 'has-clear': true },
                    name: 'date_of_birth',
                    placeholder: 'Cпециальность'
                  }, {
                    block: 'button',
                    mods: { type: 'link', view: 'action', size: 'l', theme: 'islands' },
                    text: 'Добавить еще',
                    icon: {
                      block: 'icon',
                      content: ' <?xml version="1.0" encoding="UTF-8" standalone="no"?> <svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" version="1.1" id="svg2" viewBox="0 0 15 15" height="15" width="15"> <defs id="defs4" /> <metadata id="metadata7"> <rdf:RDF> <cc:Work rdf:about=""> <dc:format>image/svg+xml</dc:format> <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage" /> <dc:title></dc:title> </cc:Work> </rdf:RDF> </metadata> <g transform="translate(-75.847656,-275.63488)" id="layer1"> <g id="flowRoot4136" style="font-size:30px;font-family:sans-serif;letter-spacing:0px;word-spacing:0px;fill:#000000;stroke-width:1px"> <path id="path4145" d="m 84.133928,277.13488 0,5.20561 5.213728,0 0,1.58879 -5.213728,0 0,5.2056 -1.572544,0 0,-5.2056 -5.213728,0 0,-1.58879 5.213728,0 0,-5.20561 1.572544,0 z" /> </g> </g> </svg> '
                    }
                  }]
                }]
              }, {
                block: 'profile-form',
                elem: 'section-group',
                content: [{
                  block: 'profile-form',
                  elem: 'section-head',
                  tag: 'h2',
                  content: 'Информация о музыкальном образовании (если есть)'
                }, {
                  block: 'control-group',
                  content: [{
                    block: 'input',
                    mods: { theme: 'islands', size: 'l', 'has-clear': true },
                    name: 'date_of_birth',
                    placeholder: 'Название УО'
                  }, {
                    block: 'input',
                    mods: { theme: 'islands', size: 'l', 'has-clear': true },
                    name: 'date_of_birth',
                    placeholder: 'Cпециальность'
                  }, {
                    block: 'button',
                    mods: { type: 'link', view: 'action', size: 'l', theme: 'islands' },
                    text: 'Добавить еще',
                    icon: {
                      block: 'icon',
                      content: ' <?xml version="1.0" encoding="UTF-8" standalone="no"?> <svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" version="1.1" id="svg2" viewBox="0 0 15 15" height="15" width="15"> <defs id="defs4" /> <metadata id="metadata7"> <rdf:RDF> <cc:Work rdf:about=""> <dc:format>image/svg+xml</dc:format> <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage" /> <dc:title></dc:title> </cc:Work> </rdf:RDF> </metadata> <g transform="translate(-75.847656,-275.63488)" id="layer1"> <g id="flowRoot4136" style="font-size:30px;font-family:sans-serif;letter-spacing:0px;word-spacing:0px;fill:#000000;stroke-width:1px"> <path id="path4145" d="m 84.133928,277.13488 0,5.20561 5.213728,0 0,1.58879 -5.213728,0 0,5.2056 -1.572544,0 0,-5.2056 -5.213728,0 0,-1.58879 5.213728,0 0,-5.20561 1.572544,0 z" /> </g> </g> </svg> '
                    }
                  }]
                }]
              }, {
                block : 'checkbox-group',
                mods : { theme : 'islands', size : 'l' },
                name : 'checkbox-islands',
                options : [
                  { val : 1, text : '1.ФИО (полностью):' },
                  { val : 2, text : '2.Дата рождения:' },
                  { val : 3, text : '3.Владение музыкальным инструментом(ми) каким(ми) и на каком уровне' },
                  { val : 4, text : '4.Вид деятельности на данный момент' },
                  { val : 5, text : '5.Страна и город проживания' },
                  { val : 6, text : '6.Профессиональное прошлое (в каких сферах работали и т.д.)' },
                  { val : 7, text : '7.Образование(если присутствует: название УО, специальность)' },
                  { val : 8, text : '8.Контактный номер телефона (с указанием кода)' },
                  { val : 9, text : '9.Опыт работы в музыкальных коллективах (присутствует/не имеется)' },
                  { val : 10, text : '10.Опыт участия в вокальных шоу городского, республиканского, международного уровня (да/нет (если “да”, то в каких))' },
                  { val : 11, text : '11. Почему Вы выбрали именно этот инструмент(ы) (ответ в свободной форме)' },
                  { val : 12, text : '12.Сотрудничаете с каким-либо коллективом на данный момент? (да/нет)' },
                  { val : 13, text : '13.Музыкальные предпочтения для прослушивания' },
                  { val : 14, text : '14.В каком стиле предпочитаете исполнять музыку (перечислить стили)' },
                  { val : 15, text : '15.Готовы ли при необходимости исполнять музыку, которая не соответствует Вашим предпочтениям (ответ в свободной форме)' },
                  { val : 16, text : '16.Опыт работы на большой сцене (присутствует/не имеется)' },
                  { val : 17, text : '17.Опыт работы по контракту (присутствует/не имеется)' },
                  { val : 18, text : '18.Имеется ли музыкальное образование? (да/нет)' },
                  { val : 19, text : '19.Есть ли у Вас кумиры среди музыкантов(кто)' }
                ]
              }]
            },{
              elem: 'item',
              elemMods: { closed: true },
              mix: { block: 'tabs-item', js: { id: 'tab-2'} },
              content: {
                block : 'checkbox-group',
                mods : { theme : 'islands', size : 'l' },
                name : 'checkbox-islands',
                options : [
                  { val : 1, text : '1.ФИО каждого участника (полностью)' },
                  { val : 2, text : '2.Название коллектива' },
                  { val : 3, text : '3.Описание коллектива (набор инструментов, жанр исполнения)' },
                  { val : 4, text : '4.Вид деятельности на данный момент (авторский материал/каверы)' },
                  { val : 5, text : '5.Страна и город проживания' },
                  { val : 6, text : '8.Контактный номер телефона представителя (с указанием кода)' },
                  { val : 7, text : '9.Опыт работы на сцене коллективом (присутствует/не имеется)' },
                  { val : 8, text : '10.Опыт участия в вокальных шоу городского, республиканского, международного уровня (да/нет (если “да”, то в каких))' },
                  { val : 9, text : '11. Что является мотивацией для развития вашего коллектива? (св. форма)' },
                  { val : 10, text : '13. Музыкальные предпочтения для исполнения (перечислить стили)' },
                  { val : 11, text : '15. Готовы ли при необходимости исполнять музыку, которая не соответствует Вашим предпочтениям (ответ в свободной форме)' },
                  { val : 12, text : '16. Опыт работы на большой сцене (присутствует/не имеется)' },
                  { val : 13, text : '17. Какое оборудование вам нужно для работы на сцене?' },
                ]
              }
            },{
              elem: 'item',
              elemMods: { closed: true },
              mix: [
                { block: 'tabs-item', js: { id: 'tab-3'} }
              ],
              content: {
                block : 'checkbox-group',
                mods : { theme : 'islands', size : 'l' },
                name : 'checkbox-islands',
                options : [
                  { val : 1, text : '1.ФИО (полностью)' },
                  { val : 2, text : '2.Дата рождения' },
                  { val : 3, text : '3.Владение музыкальным инструментом(ми) (если присутствует, то каким(ми)и на каком уровне)' },
                  { val : 4, text : '4.Вид деятельности на данный момент' },
                  { val : 5, text : '5.Страна и город проживания' },
                  { val : 6, text : '6.Профессиональное прошлое (в каких сферах работали и т.д.)' },
                  { val : 7, text : '7.Образование(если присутствует: название УО, специальность)' },
                  { val : 8, text : '8.Контактный номер телефона (с указанием кода)' },
                  { val : 9, text : '9.Опыт работы в музыкальных коллективах (присутствует/не имеется)' },
                  { val : 10, text : '10.Опыт участия в вокальных шоу городского, республиканского, международного уровня (да/нет (если “да”, то в каких))' },
                  { val : 11, text : '11. Почему вы начали петь?' },
                  { val : 12, text : '12.Авторские композиции (присутствуют/не имеется)' },
                  { val : 13, text : '13.Музыкальные предпочтения для прослушивания' },
                  { val : 14, text : '14.В каком стиле предпочитаете исполнять музыку (перечислить стили)' },
                  { val : 15, text : '15.Готовы ли при необходимости исполнять музыку, которая не соответствует Вашим предпочтениям (ответ в свободной форме)' },
                  { val : 16, text : '16.Опыт работы на большой сцене (присутствует/не имеется)' },
                  { val : 17, text : '17.Опыт работы по контракту (присутствует/не имеется)' },
                  { val : 18, text : '18.Сколько лет Вы поете?' },
                  { val : 19, text : '19.Есть ли у Вас кумиры среди музыкантов(кто)?' }
                ]
              }
            }]
          }]
        }
      }]
    }]
  }]
};